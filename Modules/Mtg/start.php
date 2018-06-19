<?php

/*
|--------------------------------------------------------------------------
| Register Namespaces and Routes
|--------------------------------------------------------------------------
|
| When your module starts, this file is executed automatically. By default
| it will only load the module's route file. However, you can expand on
| it to load anything else from the module, such as a class or view.
|
*/

if (!app()->routesAreCached()) {
    require __DIR__ . '/Http/routes.php';
}

if( ! function_exists('get_cart_items_quantity') ){
    function get_cart_items_quantity(){
        $cart = session('cart');
        $total = 0;
        if($cart){
            return $cart->sum();
        }

        return $total;
    }
}

if( ! function_exists('get_card_info_by_id') ){
    function get_card_info_by_id($id){
        $card = \Modules\Mtg\Entities\MtgCard::find($id);

        return $card;
    }
}

if( ! function_exists('get_cart_amount') ){
    function get_cart_amount(){
        $cart = session('cart');
        $total = 0;
        if($cart){
            foreach ($cart as $id => $quantity){
                $card = get_card_info_by_id($id);
                $total = $total + ($card->cardPrice * $quantity);
            }
        }

        return $total;
    }
}
