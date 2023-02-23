<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\SignUpMail;
use App\Models\User;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        
        // return $request->email;

        $request->validate([
            'email'=>['required', 'string', 'email',function($attribute,$value,$fail){
                if (!User::whereEmail($value)->exists()) {
                    $fail('This Email do not match our records.');
                }
            }],
        ]);
        
        
        $email = $request->email;
        $random = \Str::random(40);
        $domain = \URL::to('/');
        $url = $domain."/reset-password/".$email."/".$random;
        $data = [
            'email' => $email,
            'title' => 'Email Verification',
            'body' => 'Please click below to reset your password.',
            'url' => $url,
        ];
        
        $id= User::whereEmail($email)->first()->id;
        $user = User::find($id);
        $user->remember_token= $random;
        $user->save();
        
        Mail::to($email)->send(new SignUpMail($data));
       return  redirect()->back()->with('status', 'password reset email has been sent now');

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        // $status = Password::sendResetLink(
        //     $request->only('email')
        // );

        // return $status == Password::RESET_LINK_SENT
        //             ? back()->with('status', __($status))
        //             : back()->withInput($request->only('email'))
        //                     ->withErrors(['email' => __($status)]);
    }

    
}
