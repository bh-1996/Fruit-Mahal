<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class GithubController extends Controller
{
    //
    public function gitRedirect()
    {
        return Socialite::driver('github')->redirect();
    }


    public function gitCallback()
    {
        try {

            $user = Socialite::driver('github')->stateless()->user();

            $searchUser = User::where('github_id', $user->id)->first();

            if($searchUser){

                Auth::login($searchUser);
                Toastr::success('You are login successfully..!','Success');
                return redirect('/');

            }else{
                $gitUser = User::create([
                    'full_name' => $user->username,
                    'email' => $user->email,
                    'github_id'=> $user->id,
                    'password' => encrypt('gitpwd059')
                ]);

                Auth::login($gitUser);
                Toastr::success('You are login successfully..!','Success');
                return redirect('/');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
