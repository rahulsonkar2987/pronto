<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if(Auth::guard('admin')->check()){
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminLoginRequest $request)
    {
        $request->authenticate();

        // $request->session()->regenerate();
        $request->session()->flash('MESSAGE','Login Success');
        return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
    }

    public function editPassword()
    {
        return view('admin.auth.change-password');
    }

    public function updatePassword(Request $request)
    {
        $admin=Admin::find(Auth::guard('admin')->user()->id);

            $request->validate([
            'current_password' => [
                'required',
                    function ($attribute, $value, $fail) use ($admin) {
                        if (! \Hash::check($value, $admin->password)) {
                            $fail('Your password was not updated, since the provided current password does not match.');
                        }
                    }   
            ],
            'password' => [
                'required', 'min:4', 'confirmed', 'different:current_password'
            ]
        ]);

        $admin->password=bcrypt($request->password);
        if($admin->save()){
            $request->session()->flash('MESSAGE','Your password has been updated successfully');
            return json_encode(array('data'=>'saved'));
        }else{
            $request->session()->flash('MESSAGE','Something error please try again!');
            return json_encode(array('data'=>'unsaved'));
        }

    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        // return 'admin';
        Auth::guard('admin')->logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        return redirect()->route('admin.create');
    }
}
