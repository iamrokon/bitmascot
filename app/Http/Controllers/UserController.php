<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Services\UserService;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function signup(){
        return view('user.register');
    }
    public function register(Request $request, UserService $userService){
        // Validate incoming request data
        $validator = Validator::make($request->all(), StoreUserRequest::rules());

        // Check if validation fails
        if ($validator->fails()) {
            $errors = $validator->errors();
            $error_msgs = $errors->all();
            return ['err_field' => $errors, 'err_msg' => $error_msgs];
        }

        $userService->store(
            $request->all(),
            $request->hasFile('nid') ? $request->file('nid') : null
        );
        session()->flash('status', 'Registration successful! Please log in.');
        return "ok";
    }
    public function loginView(){
        return view('user.login');
    }
    public function login(Request $request, UserService $userService){
        // Validate incoming request data
        $validator = Validator::make($request->all(), LoginRequest::rules());

        // Check if validation fails
        if ($validator->fails()) {
            $errors = $validator->errors();
            $error_msgs = $errors->all();
            return ['err_field' => $errors, 'err_msg' => $error_msgs];
        }
        $user = User::where('email', $request->email)->first();

        // if (Auth::attempt($credentials)) {
        if (Hash::check($request->password, $user->password)) {
            // Authentication passed
            $otpData = $userService->sendOtp($user);
            $userId = $user->id;
            session(['user_id' => $userId]);
            return "ok";
        }
        return "ng";
    }
    public function verifyOtpForm()
    {
        return view('user.verify_otp');
    }

    public function verifyOtp(Request $request)
    {
        $user = User::find($request->user_id);

        if ($user && $user->otp == $request->otp) {
            // OTP verification successful, proceed with login
            Auth::login($user);
            if($user->role == 1){
                return 'admin';
            }
            return 'ok';
        }

        return 'ng';
    }
    public function profile()
    {
        $user_id = session('user_id');
        $user = User::find($user_id);
        return view('user.profile',[
            'user' => $user
        ]);
        // return $user;
    }
    public function passwordUpdateForm()
    {
        return view('user.password-update');
    }
    public function passwordUpdate(Request $request, UserService $userService)
    {
        $validator = Validator::make($request->all(), UpdatePasswordRequest::rules());

        // Check if validation fails
        if ($validator->fails()) {
            $errors = $validator->errors();
            $error_msgs = $errors->all();
            return ['err_field' => $errors, 'err_msg' => $error_msgs];
        }

        $user = Auth::user();
        // Check if the old password matches the user's current password
        if (!Hash::check($request->old_password, $user->password)) {
            return "ng";
        }

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();
        session()->flash('status', 'Password updated successfully.');
        return "ok";
    }
    public function userLogout(Request $request)
    {
        Auth::logout(); // Logout the user
        return "ok";
    }
    public function index(){
        $users = User::paginate(10); // Retrieve all users from the database

        return view('admin.index', ['users' => $users]);
    }
    public function search(Request $request){
        $query = $request->search_data;
        // Perform user search based on the query
        $users = User::where('first_name', 'like', "%{$query}%")
                     ->orWhere('last_name', 'like', "%{$query}%")
                     ->paginate(10);

        return view('admin.searched_data',['users' => $users]);
    }
    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        if ($user) {
            return response()->json(['available' => false]); // Email not exists
        }
        return response()->json(['available' => true]); // Email is available
    }
}
