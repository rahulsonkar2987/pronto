<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
// use App\Http\Controllers\Auth\User;

class SignUpGoogleController extends Controller
{
    public function create()
    {
        return Socialite::driver(('google'))->redirect();
    }
    public function store(Request $request)
    {
        $res_google=Socialite::driver('google')->user();


        if($user= User::where('socialite_id',$res_google->id)->first() ){
           //
        }else{

            $user = new User();
            $user->socialite_id     = $res_google->id;
            $user->first_name       = $res_google->user['given_name'];
            $user->last_name        = $res_google->user['family_name'];
            $user->email            = $res_google->user['email'];
            $user->email_verified_at = now();
            $user->save();
        }
        $request->session()->put([
            'role'=>true,
            'id'=>$user->id,
            'first_name'=>$user->first_name,
            'last_name'=>$user->last_name,
            'email'=>$user->email,
        ]);
        return redirect()->route('user.dashboard');
    }
}
