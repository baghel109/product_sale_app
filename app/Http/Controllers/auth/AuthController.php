<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {

        try{
            return view('layouts.frontend.register');
        }
        catch(\Exception $e){
            return abort(404, 'Something went wrong');
        }
    }

    public function registerSave(RegisterRequest $request)
    {
        // dd('testssssss');
        try{

            $user = new User();
            $user->name= $request->name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->password = Hash::make($request->password);
            $user->country_code = '+91';
            $user->currency = 'INR';
            $user->verification_token = Str::random(60);
            $user->token_expire_at = Carbon::now()->addHours(1);
            $user->save();

            $this->sendVerificationMail($user);

            return back()->with('success', 'User is registered successfully, Please check your mail for verification your account.');

        }catch(\Throwable $e){
            dd($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function sendVerificationMail($user)
    {
        $data = [
            'name'=> $user->name,
            'url' => url('/user/verify/'.$user->verification_token) 
        ];
     
         
        Mail::send('frontend.mail.verification_user', $data, function($msg) use ($user){
            $msg->to($user->email);
            $msg->subject('Email verification');

        });
    }

    public function verify($token)
    {

         
        try{
            $user = User::where('verification_token', $token)->first();

            if(!$user){
                return abort(403, 'Something went wrong');
            }

            if($user->token_expire_at < Carbon::now()){
                return 'Verification link has expired.';
            }

            
            $user->email_veriifed = 1;
            
            $user->email_verified_at = now();
            
            $user->verification_token = null;
          
            $user->token_expire_at = null;
           
            // dd($user);
            $user->save();

            
            $msg = 'Email verified successfully.';
            return 'Email verified successfully.';
            // return view('auth.verification-message', compact('msg'));

        }catch (\Throwable $e) {
                dd($e->getMessage(), $e->getFile(), $e->getLine());
        }
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginSave(LoginRequest $request)
    {
        try{
            $userCredentails = $request->only('email','password');
            if(Auth::attempt($userCredentails)){            

                if(Auth::user()->email_veriifed == 0){
                    return back()->with('error','Please verify your account for login.');
                }

                if(Auth::user()->is_admin == 1 ){
                    return redirect()->route('admin.dashboard');
                }else{
                    return redirect()->route('front.dashboard');
                }
                    
            }else{
                return back()->with('error','wrong email or password.');
            }

        }catch(\Exception $e){
            return abort(403, 'Something went wrong');
        }
    }

    public function forgotPasswordView()
    {
        
        return view('auth.forgot_password');
    }

    public function forgotPassword(Request $request)
    {


        $user = user::where('email', $request->email)->first();

        if(!$user){
            return back()->with('error','Email not found.');
        }
        
        $token = Str::random(50);

        PasswordReset::updateOrInsert(
            ['email'=> $request->email],
            [
                'email'=> $request->email,
                'token'=> $token,
                'created_at'=> Carbon::now()
            ]
        );
        $data = [
            'name'=> $user->name,
            'url'=> url(config('constant.RESET_PWD').$token)
        ];

        // dd($data, config('constant'));

        Mail::send('frontend.mail.reset_password', $data, function($msg) use($user){
                $msg->to($user->email);
                $msg->subject('Reset Password Mail');
        });

        return back()->with('success','Reset password link has sent on your email. Please check');

        // return view('auth.forgot_password');
    }

    public function resetPasswordView($token)
    {
        // dd('reset');
        $passwordUser = PasswordReset::where('token', $token)->first();

        if(!$passwordUser){
            return back()->with('error', 'token not match');
        }

        $user = User::where('email', $passwordUser->email)->first();

        return view('auth.reset_password', compact('token', 'user'));
    }

    public function resetPasswordUpdate($token, Request $request)
    {        
        try{
                  $user = User::where('id', $request->id)->first();
        
                    if(!$user){
                        return back()->with('error','User not found');
                    }

                    PasswordReset::updateOrInsert(
                        [ 'email'=> $user->email],
                        [ 
                            'email'=> $user->email,
                            'token'=> $token,
                            'created_at' => now()            
                        ]
                    );

                    User::updateOrInsert(
                        ['email'=> $user->email],
                        [
                            'password'=> Hash::make($request->password)
                        ]
                    );
                    
                    return back()->with('success', 'Password updated');
        }catch(\exception $e){

            return back()->with('error', $e->getMessage());

        }
      
    }

    

}
