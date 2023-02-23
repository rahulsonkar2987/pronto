<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Mail\SignUpMail;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
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
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'=>['required','max:12'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms_conditions'=>'required',
        ]);

        try {
        
            $random = $this->sendSignUpMail($request->email);
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone'=>$request->phone,
                'remember_token'=>$random,
                'terms_conditions'=>$request->terms_conditions,
                'password' => Hash::make($request->password),
            ]);
            if ($user==true) {
                 return redirect(RouteServiceProvider::HOME);
            }
        } catch (\Throwable $th) {
            return response()->json(['success'=>false,'msg'=>$th->getMessage()]);
        }

        // event(new Registered($user));

    }
}
