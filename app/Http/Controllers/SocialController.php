<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class SocialController extends Controller
{
    //
    //
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Google login authentication
     *
     * @return void
     */
    public function loginWithGoogle()
    {
        try {

            $googleUser = Socialite::driver('google')->stateless()->user();
           // dd($googleUser);
            //echo "<pre>";print_r($googleUser);

            $user = User::where('google_id', $googleUser->id)->first();
            //dd($user);
            if($user){
                Auth::login($user);
                Toastr::success('You are login successfully..!','Success');
                return redirect('/');
            }
            else{
                $createUser = User::create([
                    'full_name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => encrypt('test@123')
                ]);
                Toastr::Success('Registration successfull..!','Success');
                Auth::login($createUser);
                Toastr::success('You are login successfully..!','Success');
                return redirect('/');
            }

        }catch (Exception $exception) {
            Toastr::error('Something is wrong..!','Error');
            dd($exception->getMessage());
        }
    }
}
