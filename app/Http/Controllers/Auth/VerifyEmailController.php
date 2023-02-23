<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Models\User;
use Illuminate\Support\Carbon;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function __invoke(EmailVerificationRequest $request)
    // {
    //     if ($request->user()->hasVerifiedEmail()) {
    //         return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    //     }

    //     if ($request->user()->markEmailAsVerified()) {
    //         event(new Verified($request->user()));
    //     }

    //     return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    // }

    public function verifyEmail($token)
    {
        try {
            $res = User::where('remember_token',$token)->first(['remember_token','id']);
            if(isset($res->remember_token)){
                
                $user = User::find($res->id);
                $user->remember_token = '';
                $user->email_verified_at = Carbon::now()->format('Y-m-d H:i:s');
                $user->save();
                $title = 'You Email verified successfully';
                return view('admin.confirm.verification-email',compact('title'));
            }else{
              return view('errors.404');
            }
          } catch (\Throwable $th) {
            return response()->json(['success'=>false,'msg'=>$th->getMessage(),'line'=>$th->getLine()]);
          }
    }
}
