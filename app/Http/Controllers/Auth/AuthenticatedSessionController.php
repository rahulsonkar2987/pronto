<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\returnSelf;

class AuthenticatedSessionController extends Controller
{

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // $user=User::whereEmail($request->email)->first();
        $email = $request->email;
        $password = $request->email;

        $request->validate([
            'email'=>['required', 'string', 'email',function($attribute,$value,$fail){
                if (!User::whereEmail($value)->exists()) {
                    $fail('This Email do not match our records.');
                }
            }],
        ]);
        
        $user = User::whereEmail($email)->first();
        $request->validate([
            'password'=>['required',function($attr,$val,$f) use($user){
                if (! Hash::check($val, $user->password)) {
                    $f('This Password do not match our records.');
                }
            }],
        ]);

    if (empty($user->email_verified_at)) {
            return response()->json(['success'=>false,'msg'=>'unVerified','email'=>$email]);
    }

        $request->session()->put([
            'role'=>true,
            'id'=>$user->id,
            'first_name'=>$user->first_name,
            'last_name'=>$user->last_name,
            'email'=>$user->email,
        ]
        );

        return response()->json(['success'=>true]);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        session()->forget(['role','id','first_name','last_name','email']);
        // session()->flash('ERROR','Logout Successfully');


        return redirect()->route('index');
    }
}
