<?php

namespace Modules\Mtg\Http\Controllers;

use App\Notifications\VerifyUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Mtg\Entities\MtgCard;
use Modules\Mtg\Entities\MtgCardSet;
use Modules\Mtg\Entities\MtgOrder;
use Modules\Mtg\Entities\MtgOrderDetails;
use Modules\Mtg\Entities\MtgOrderStatus;
use Modules\Mtg\Notifications\OrderCreated;
use Modules\User\Entities\UserAddress;
use Stripe;

class MtgController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(){

        $data = array();
        $sets = MtgCardSet::select('block', 'name', 'code', 'cardcount')
            ->where('block', '!=', '')
            ->where('onlineOnly', 0)
            ->orderBy('block', 'asc')
            ->orderBy('name')
            ->get();

        $data['sets'] = $sets;

        $first_set = $sets->first();
        $data['first_set'] = $first_set;
        $cards = $first_set->cards;
        $data['cards'] = $cards;

        return view('mtg::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('mtg::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('mtg::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('mtg::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function get_card_set_by_code($code){
        $set = MtgCardSet::where('code', '=', $code)->get()->first();
        $cards = $set->cards;

        return [
            'carousel' => view('mtg::carousel', ['cards' => $cards])->render(),
            'icon' => strtolower($set->code),
            'available_cards' => $cards->sum('qty'),
            'total_cards' => $cards->count()
        ];
    }

    public function add_to_cart(Request $request){

        $error = false;
        if( ! $cart = $request->session()->get('cart')){
            $cart = collect();
        }


        $card = MtgCard::find($request->card_id);

        if($card && $card->qty) {
            // this is valid card and has stock available
            $key = $card->id;
            if($cart->has($key)){
                $value = $cart->get($key) + 1; // get current quantity + 1
                $cart->put($key, $value);  // set quantity against the card id
            }else{
                $cart->put($key, 1); // set quantity=1 against the card id
            }
        }else{
            $error = true;
        }

        //put the cart back in the session
        $request->session()->put('cart', $cart);

        return ['error' => $error, 'items' => $cart->sum() ];
    }

    public function update_cart(Request $request){
        $cart = session('cart');

        $card = MtgCard::find($request->card_id);

        $key = $card->id;

        if($request->quantity == 'plus'){
            if($card && $card->qty) {
                // this is valid card and has stock available
                $value = $cart->get($key) + 1; // get current quantity + 1
            }
        }else{
            $value = $cart->get($key) - 1; // get current quantity - 1
        }

        $cart->put($key, $value);  // set quantity against the card id

        $cart = $this->remove_zero_quantity($cart);

        //put the cart back in the session
        $request->session()->put('cart', $cart);

        if(get_cart_amount() >= env('minimum', 0)){
            $next_step = '<a href="'.url('mtg/checkout').'" class="btn btn-outline-info">Proceed to Checkout</a>';
        }else{
            $next_step = '<div class="alert alert-danger">';
            $next_step .= 'Minimum order amount must be grater or equal to £'. number_format(env('minimum', 0), 2);
            $next_step .= '</div>';
        }


        return [
            'items' => $cart->sum(),
            'cart' => view('mtg::cart-details', ['cart' => $cart])->render(),
            'next' => $next_step
        ];
    }

    public function remove_zero_quantity($cart){
        $new_cart = collect();
        foreach ($cart as $id => $quantity){
            if($quantity > 0){
                $new_cart->put($id, $quantity);
            }
        }

        return $new_cart;
    }

    public function show_cart(){
        $data = array();
        $cart = session('cart');

        if( ! $cart ){
            flash()->error('Cart is empty!')->important();
            alert()->error('Cart is empty!')->persistent('Close');
            return redirect('/mtg');
        }

        $data['cart'] = $cart;

        return view('mtg::cart', $data);
    }

    public function checkout(){

        if(get_cart_amount() < env('minimum', 0)){
            return redirect('mtg/show-cart');
        }

        $data = array();
        $cart = session('cart');
        $data['cart'] = $cart;
        $user = '';
        if(auth()->user()){
            $user = auth()->user();
        }
        $data['user'] = $user;
        return view('mtg::checkout', $data);
    }

    public function submit_checkout(Request $request){

        // check if I need to create an user account
        if($request->has('password')){
            // create new user account
            $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6',
            ]);

            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->verify_token = md5(time());
            $user->active = 1;

            if($user->save()){

                if($request->has('send_email')){
                    $user->notify(new VerifyUser($user));
                }

                // attach role
                $user->roles()->attach(2); // user role id

                // login the user straight way
                auth()->login($user);

            }
        }

        $user = auth()->id() ? auth()->user() : '';

        //create order object
        $order = new MtgOrder;
        $order->name = $request->name;
        $order->phone_number = $request->phone_number;
        $order->email = $user ? $user-> email : $request->email;
        $order->add_line_1 = $request->add_line_1;
        $order->add_line_2 = $request->add_line_2;
        $order->add_line_3 = $request->add_line_3;
        $order->city = $request->city;
        $order->county = $request->county;
        $order->postcode = $request->postcode;
        $order->note = $request->note;

        // save order info
        if($order->save()){
            $cart = session('cart');
            // save order details
            foreach ($cart as $card_id => $quantity){
                $card = get_card_info_by_id($card_id);
                $details = new MtgOrderDetails;
                $details->card_id = $card->id;
                $details->price = $card->cardPrice;
                $details->quantity = $quantity;
                $order->items()->save($details);
            }
        }

        // update order status
        $order->statuses()->save(new MtgOrderStatus(['status_id' => get_status_id_by_name('New')]));

        // associate with user
        if($user){
            $user->orders()->save($order);

            // update new address for user
            $address = new UserAddress;
            $address->add_line_1 = $order->add_line_1;
            $address->add_line_2 = $order->add_line_2;
            $address->add_line_3 = $order->add_line_3;
            $address->city = $order->city;
            $address->county = $order->county;
            $address->postcode = $order->postcode;
            $address->note = $order->note;
            $user->addresses()->save($address);
        }


        // get actual cart amount
        $amount = get_cart_amount();

        // add shipping cost
        if(env('shipping_cost', 0)){
            $shipping_cost = env('shipping_cost_value');
            $amount = $amount + $shipping_cost;
            $order->shipping_cost = $shipping_cost;
            $order->save();
        }

        // convert to penny fot stripe
        $amount = $amount * 100;

        // handling fee
        if(env('card_handling_fee', 0)){
            $fee = ($amount *1.4/100) + 20;  // 1.4% + 20p
            $amount = $amount + $fee;

            $order->handling_cost = number_format($fee/100, 2);
            $order->save();
        }

        // now it's time to process the payment
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try{
            $charge = Stripe\Charge::create([
                'amount' => round($amount), // remove decimal
                'currency' => 'gbp',
                'description' => $order->id,
                'source' => $request->stripe_token,
            ]);
        } catch (\Exception $e){
            return array('err' => true, 'msg' => $e->getMessage());
        }

        if($charge && $charge->paid){

            // destroy the cart
            $request->session()->put('cart', null);

            $order->paid = true;
            $order->stripe_ref = $charge->id;

            $order->save();

            // send email notification
            $order->notify(new OrderCreated($order));

            return ['err' => false, 'order_id' => $order->id];

        }else{
            return ['err' => true];
        }

    }

    public function thank_you($order_id){
        $order = MtgOrder::find($order_id);

        return view('mtg::thank-you', ['order' => $order]);
    }
}
