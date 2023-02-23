<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SignUpMail;
use App\Models\User;

class EmailVerificationNotificationController extends Controller
{

    
    public function sendSignUpMail($email)
    {
        $random = \Str::random(40);
        $domain = \URL::to('/');
        $url = $domain."/verify-email/".$random;
        $data = [
            'email' => $email,
            'title' => 'Email Verification',
            'body' => 'Please click below to verify your email.',
            'url' => $url,
        ];
        Mail::to($email)->send(new SignUpMail($data));

        return $random;
    }

    public function create($email)
    {
        return view('auth.resend-email',compact('email'));
    }
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($email)
    {

    
        $id = User::whereEmail($email)->first()->id;
        $user = User::find($id);
        $user->remember_token= $this->sendSignUpMail($email);
        if ($user->save()) {
            return back()->with('status', 'verification-link-sent');
        }else{
            return back()->with('status', 'Something error please try again!');
        }

        // if ($request->user()->hasVerifiedEmail()) {
        //     return redirect()->intended(RouteServiceProvider::HOME);
        // }

        // $request->user()->sendEmailVerificationNotification();

    }
}
