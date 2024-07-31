<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class FacebookController extends Controller
{
    //
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {

        try {
            $user = Socialite::driver('facebook')->stateless()->user();
           //dd($user);
            // echo "<pre>";print_r($user);
            $finduser = User::where('facebook_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);
                Toastr::success('You are login successfully..!','Success');
                 return redirect('/');

            }else{
                $newUser = User::create([
                    'full_name' => $user->name,
                    'email' => $user->email,
                    'facebook_id'=> $user->id,
                    'password' => encrypt('123456dummy')
                ]);

                Auth::login($newUser);
                Toastr::success('You are login successfully..!','Success');
                 return redirect('/');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
