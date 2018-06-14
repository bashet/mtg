<?php

namespace Modules\User\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Notifications\UserAccountCreated;

class UserController extends Controller
{
    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * description comes here
     */
    public function index(){
        if (Gate::denies('see_all_users', User::class)){
            alert()->error('Access restricted!')->persistent('Close');
            return redirect('/home');
        }
        activity()->performedOn(User::find(1))->log('View user list');
        $users = User::all();
        return view('user::index', array('users' => $users, 'i' => 1));
    }

    public function show($id=0){
        if(! $id){
            $user = auth()->user();
        }else{
            $user = User::find($id);
        }

        if (Gate::denies('see_user_profile', $user)){
            alert()->error('Access restricted!')->persistent('Close');
            return redirect('/home');
        }

        $data = array();
        $data['user'] = $user;

        activity()->on($user)->log('View page: user profile');

        //return view('user.show', $data);
        return view('user::show', $data);
    }

    public function change_pro_pic(Request $request){

        $user = User::find($request->user_id);

        if($user->profile_picture){
            $profile_picture = ProfilePicture::find($user->profile_picture->id);
        }else{
            $profile_picture = new ProfilePicture;
        }
        //$pic = ProfilePicture::where('user_id', $request->user_id)->get()->first();

        $profile_picture->path = str_replace(url(''),'',$request->path);
        $profile_picture->user_id = $request->user_id;

        if($result = $profile_picture->save()){
            activity()->performedOn($user)->log('Change profile picture');
        }

        return Response::json($result);
    }


    public function add_new_user(Request $request){
        $user = auth()->user(); // not required for logic, but I needed a parameter to check ability
        if (Gate::denies('add_new_user', $user)){
            alert()->error('Access restricted!')->persistent('Close');
            return redirect('/home');
        }

        activity()->performedOn(User::find(1))->log('View page: create new user');

        $roles = Role::all();

        return view('user::add_new_user', array('roles' => $roles));
    }

    public function edit_user($id = 0){

        $user = auth()->user(); // not required for logic, but I needed a parameter to check ability
        if (Gate::denies('edit_user', $user)){
            alert()->error('Access restricted!')->persistent('Close');
            return redirect('/home');
        }

        $user = User::find( $id );

        activity()->performedOn($user)->log('Attempted to edit user info');

        $roles = Role::all();
        return view('user::edit_user', array('user' => $user, 'roles' => $roles));
    }

    public function insert_new_user(Request $request){

        if (Gate::denies('add_new_user', User::class)){
            alert()->error('Access restricted!')->persistent('Close');
            return redirect('/home');
        }
        // all the fields are required for new user creation
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);


        if($request->has('active')){
            $active = 1;
        }else{
            $active = 0;
        }

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->verify_token = md5(time());
        $user->active = $active;

        if($user->save()){

            if($request->has('send_email')){
                $user->notify(new UserAccountCreated($user));
            }

            // attach role
            $user->roles()->attach($request->role_id);

            //alert()->success('A new user account has been created!')->persistent('Close');
            flash()->success('A new user account has been created!')->important();

        }

        return redirect('user');
    }

    public function update_user(Request $request){
        //dd($request->input());
        $user = User::find($request->user_id);

        if (Gate::denies('edit_user', $user)){
            alert()->error('Access restricted!')->persistent('Close');
            return redirect('/home');
        }


        $name = $request->input('name');
        $email = $request->input('email');

        // we will update if there is new name
        if($user->name != $name){
            $user->name = $name;
        }

        if($user->email != $email){
            $another_user = User::find($request->input('email')); // check is this email has been used already
            if(! $another_user ){
                $user->email = $email;
            }
        }

        $user->roles()->detach(); // detach all current role
        if($request->role_id){
            $user->roles()->attach($request->role_id); // attach again
        }



        if($request->has('active')){
            $active = 1;
        }else{
            $active = 0;
        }

        if($user->active != $active){
            $user->active = $active;
        }

        if($request->password){
            $user->password = bcrypt($request->password);
        }

        if($user->save()){
            alert()->success('User account has been updated!')->persistent('Close');
            flash()->success('User account has been updated!')->important();
        }

        return redirect('user');

    }
    public function change_status(Request $request){

        if (Gate::denies('change_user_status', User::class)){
            alert()->error('Access restricted!')->persistent('Close');
            return redirect('/home');
        }

        $id = $request->id;
        $user = User::find( $id );

        if($user->active){
            $user->active = 0;
        }else{
            $user->active = 1;
        }


        $user->save();
        return $user->active;
    }

    //Supporting select2 for user search on type
    public function get_all_user_ajax(Request $request){
        //dd($request->input());
        $users = User::select('id','name', 'email', 'phone_number')->where('name', 'like', $request->term.'%')
            ->get();
        return $users;//Response::json($users);
    }

    // get one user information to support role page
    public function get_user_ajax(Request $request){
        //dd($request->input());
        $user = User::find($request->user_id);

        return Response::json(array(
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'roles' => $user->roleAll()->implode(', '),
        ));
    }

    public function login_as(Request $request,$id=0){

        $new_user = User::find( $id );

        if (Gate::denies('login_as', $new_user)){
            alert()->error('Access restricted!')->persistent('Close');
            return redirect('/home');
        }

        activity()->performedOn($new_user)->log('Login as :subject.name');

        $request->session()->put( 'orig_user', auth()->id() );
        auth()->login( $new_user );
        alert()->success($new_user->name .'', 'logged in as: ')->persistent('Close');
        return redirect('/');
    }

    public function back_to_original_user(Request $request)
    {
        $id = $request->session()->pull( 'orig_user' );

        $user = auth()->user();

        $orig_user = User::find( $id );
        auth()->login( $orig_user );
        activity()->log('Back to original login from '. $user->name);
        return back();
    }

    public function delete($id = ''){
        $user = User::find($id);
        if(! $user){
            alert()->error('Incorrect parameter!')->persistent('Close');
            return redirect()->back();
        }
        if (Gate::denies('delete_user', $user)){
            alert()->error('Access restricted!')->persistent('Close');
            return redirect('/home');
        }

        if($user->delete()){
            alert()->success('User has been deleted!')->persistent('Close');
        }

        return redirect()->back();
    }

    public function change_password(Request $request){

        $user = auth()->user(); // not required for logic, but I needed a parameter to check ability
        if (Gate::denies('change_user_password', $user)){
            alert()->error('Access restricted!')->persistent('Close');
            return redirect('/home');
        }

        $user = User::find($request->id);

        if($user){
            $user->password = bcrypt($request->password);
        }

        if($result = $user->save()){
            activity()->performedOn($user)->log('Changed user password.');
        }
        return $result;
    }


    /*
     * Check if the given email already exist for another user account. This will search only user table
     * @arg = email
     * Return = bool
     */
    public function check_email(Request $request){
        $user = User::where('email', $request->email)->get()->first();
        if($user){
            return '1';
        }
        return '0';
    }

    public function show_notifications(){
        return view('user.notifications');
    }

    public function update_notification_status(Request $request){
        $user = auth()->user();
        $notification =$user->notifications->where('id', $request->id)->first();
        if($notification->read()){
            $notification->read_at = NULL;
            $notification->save();
        }else{
            $notification->markAsRead();
        }
        return Response::json($notification);
    }

    public function delete_notification(Request $request){
        $posted_id = explode('_', $request->id);

        $user = auth()->user();
        $notification =$user->notifications->where('id', $posted_id[1])->first();
        $result = $notification->delete();
        return Response::json($result);
    }

    public function get_all_user_for_type_ahead($key = '', $term = ''){
        if($term){
            $users = User::select('id','name', 'email', 'phone_number')->where($key, 'like', $term.'%')->get();
        }else{
            $users = User::select('id','name', 'email', 'phone_number')->get();
        }

        return $users;
    }

    public function get_for_select2(Request $request){
        $users = User::select('id', 'name')->where('name', 'like', '%' . $request->term . '%')->get();

        return $users;
    }
}
