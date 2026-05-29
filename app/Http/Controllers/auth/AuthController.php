<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
        try{

            $user = new User();
            $user->name= $request->name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->password = Hash::make($request->password);
            $user->country_code = '+91';
            $user->currency = 'INR';
            $user->save();


            return back()->with('success', 'User is registered successfully');

        }catch(\Throwable $e){
            dd($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }
}
