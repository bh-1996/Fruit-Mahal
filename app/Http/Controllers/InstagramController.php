<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class InstagramController extends Controller
{
    //
    public function instagramRedirect()
    {
        return Socialite::driver('instagram')->redirect();
    }


    public function instagramCallback()
    {
        try {

            $user = Socialite::driver('instagram')->user();

            $searchUser = User::where('instagram_id', $user->id)->first();

            if($searchUser){

                Auth::login($searchUser);
                Toastr::success('You are login successfully..!','Success');
                return redirect('/');

            }else{
                $gitUser = User::create([
                    'full_name' => $user->username,
                    'email' => $user->email,
                    'instagram_id'=> $user->id,
                    'password' => encrypt('gitpwd059')
                ]);

                Auth::login($gitUser);
                Toastr::success('You are login successfully..!','Success');
                return redirect('/');
            }

        } catch (Exception $e) {
            Toastr::error('Something is wrong..?','error');
            dd($e->getMessage());
        }
    }
}
