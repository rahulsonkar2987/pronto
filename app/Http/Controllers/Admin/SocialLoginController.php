<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialLogin;

class SocialLoginController extends Controller
{

    protected $path;
    public function __construct()
    {
        $this->path = 'admin.setting.';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facebook = SocialLogin::where('key','facebook_api')->first();
        $google = SocialLogin::where('key','google_api')->first();
        $google_map = SocialLogin::where('key','google_map_api')->first();
        $isbn = SocialLogin::where('key','isbn_api')->first();
        return view($this->path.'social',compact('facebook','google','google_map','isbn'));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SocialLogin  $socialLogin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SocialLogin $socialLogin)
    {
        $msg=[];
        $facebookClientId = $request->facebook_client_id;
        $facebookClientSecret = $request->facebook_client_secret;
        $facebookActive = $request->facebook_active;
        
        SocialLogin::updateOrCreate(['key'=>'facebook_api'],[
            'key'=>'facebook_api',
            'client_id'=>$facebookClientId,
            'client_secret_id'=>$facebookClientSecret,
            'status'=>$facebookActive ?? '0',
        ]);

        $googleActive = $request->google_active;
        $googleClientId = $request->google_client_id;
        $googleClientSecret = $request->google_client_secret;

         SocialLogin::updateOrCreate(['key'=>'google_api'],[
            'key'=>'google_api',
            'client_id'=>$googleClientId,
            'client_secret_id'=>$googleClientSecret,
            'status'=>$googleActive ?? '0',
        ]);


        $googleMapActive = $request->google_map_active;
        $googleMapClientId = $request->google_map_client_id;
        $googleMapClientSecret = $request->google_map_client_secret;

        SocialLogin::updateOrCreate(['key'=>'google_map_api'],[
            'key'=>'google_map_api',
            'client_id' => $googleMapClientId,
            'client_secret_id'=> $googleMapClientSecret,
            'status' => $googleMapActive ?? '0',
        ]);


        $isbnActive = $request->isbn_active;
        $isbnClientId = $request->isbn_client_id;
        $isbnClientClientSecret = $request->isbn_client_secret;

        SocialLogin::updateOrCreate(['key'=>'isbn_api'],[
            'key'=>'isbn_api',
            'client_id' => $isbnClientId,
            'client_secret_id'=> $isbnClientClientSecret,
            'status' => $isbnActive ?? '0',
        ]);
        
        $msg[]="API updated successfully.";
        \Artisan::call('optimize');
        // dd(Artisan::call('optimize'));
        $request->session()->flash('MESSAGE',$msg[0]);
        return redirect()->back();

    }

}
