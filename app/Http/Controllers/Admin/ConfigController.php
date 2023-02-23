<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\MailSetting;
use Illuminate\Http\Request;
use App\Models\SocialLogin;
use App\Models\PageSeo;
use Illuminate\Support\Str;

class ConfigController extends Controller
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
    public function index(Request $request,$action=null)
    {   
        try {
            $mail_config = MailSetting::first();
            $config = Config::all();
            $apiConfig = SocialLogin::all();
            $pageSeo = PageSeo::first();

            /*
            ------------------------------------
            |json api request start here----------
            */ 
            if ( $request->wantsJson() ) {
                if ($request->route()->getName() == 'api.setting.config') {  /////// config setting
                    $res = $config->where('key',$action)->first();
                    if (!is_null($res)) {
                        return response()->json(['success'=>true,'data'=>$res]);
                    }else{
                        return response()->json(['success'=>false,'msg'=>'Please parse the right key name.']);
                    }
                }elseif($request->route()->getName()=='api.setting.api') {  ///////// social api
                    $res = $apiConfig->where('key',$action)->first();
                    if (!is_null($res)) {
                        return response()->json(['success'=>true,'data'=>$res]);
                    }else{
                        return response()->json(['success'=>false,'msg'=>'Please parse the right key name']);
                    }
                }elseif($request->route()->getName()=='api.setting.pageSeo'){ //// page seo
                    if (!is_null($pageSeo)) {
                        return response()->json(['success'=>true,'data'=>$pageSeo]);
                    }else{
                        return response()->json(['success'=>false,'msg'=>'Page seo setting empty']);
                    }
                }
            }
            // json api request end here


            // return $config;

            return view($this->path.'general',compact('action','config','mail_config','apiConfig','pageSeo'));
        } catch (\Throwable $th) {
            return response()->json(['success'=>false,'msg'=>$th->getMessage()]);
        }
       
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        if($id=='general'){
            $request->validate([
                'app_name' => 'required|max:150',
                'app_url' => 'required|max:150',
            ]);

            Config::where('key','app_name')->update(['value'=>$request->app_name]);
            Config::where('key','app_url')->update(['value'=>$request->app_url]);
            $request->session()->flash('MESSAGE','General setting has been update successfully.');
            return redirect()->route('admin.setting.general.index',['general']);
        }
        
        if ($id=='mail_configration') {
            
            $res = MailSetting::first();
            $res->mail_mailer = $request->mail_mailer;
            $res->mail_host = $request->mail_host;
            $res->mail_port = $request->mail_port;
            $res->mail_username = $request->mail_username;
            $res->mail_password = $request->mail_password;
            $res->mail_encryption = $request->mail_encryption;
            $res->mail_from_address = $request->mail_from_address;
            $res->mail_from_name = $request->mail_from_name;
            if ($res->save()) {
                $request->session()->flash('MESSAGE','Mail Configuration has been updated successfully.');
            }else{
                $request->session()->flash('MESSAGE','Something error please try again');
            }
            return redirect()->route('admin.setting.general.index',['mail_config']);
        }

        if ($id == 'payment_config') {
            $payUMomeyAcitve = $request->payumoney_active;
            $payUMoneyClientId = $request->payu_money_client_id;
            $payUMoneySecret = $request->payu_monney_secret;
            
            SocialLogin::updateOrCreate(['key'=>'payumoney_api'],[
                'key'=>'payumoney_api',
                'client_id' => $payUMoneyClientId,
                'client_secret_id'=> $payUMoneySecret,
                'status' => $payUMomeyAcitve ?? '0',
            ]);
            $request->session()->flash('MESSAGE','PayU money configuration has been updated seccessfully.');
            return redirect()->route('admin.setting.general.index',['payment_config']);
        }

        if ($id == 'mode_setting') {
            $websiteModeActive = $request->website_mode;
            Config::where('key','website_mode')->update(['value'=>$websiteModeActive=='1' ? 'on' : 'off']);
            if($websiteModeActive==1){
                $msg = 'Website maintenance off';
            }else{
                $msg = 'Website maintenance on';
            }
            $request->session()->flash('MESSAGE',$msg);
            return redirect()->route('admin.setting.general.index',['mode_setting']);
        }

        if ($id == 'logo') {
            if ($request->hasFile('image')) {
                $del_image = Config::where('key','logo')->first()->value;
                if (file_exists($del_image)) {
                    unlink($del_image);
                }
                $image = $request->file('image');
                $file_name = 'logo'.'.'.$image->extension();
                $fileDestination= 'upload/setting/logo/';
                $image->move($fileDestination,$file_name);
                $path =$fileDestination.$file_name;
                
                Config::where('key','logo')->update(['value'=>$path]);
              
            }

            if ($request->hasFile('image2')) {
                $del_image = Config::where('key','favicon')->first()->value;
                if (file_exists($del_image)) {
                    unlink($del_image);
                }
                $image2 = $request->file('image2');
                $file_name = 'favicon'.'.'.$image2->extension();
                $fileDestination= 'upload/setting/logo/';
                $image2->move($fileDestination,$file_name);
                $path2 =$fileDestination.$file_name;
                Config::where('key','favicon')->update(['value'=>$path2]);

            }

            $request->session()->flash('MESSAGE','Image has been updated succeefully.');
            return redirect()->route('admin.setting.general.index',['logo']);
        }

        if ($id=='page_seo') {

            $res = PageSeo::first();
            $res->title = $request->title;
            $res->meta_title = $request->meta_title;
            $res->meta_keywords = $request->meta_keywords;
            $res->meta_description = $request->meta_description;
            $res->status = $request->status;

            if($res->save()){
                $request->session()->flash('MESSAGE','Page seo has been updated successfully');
            }else{
                $request->session()->flash('MESSAGE','Something error please try again!');
            }
            return redirect()->route('admin.setting.general.index',['page_seo']);
        }

        if($id=='api_key'){
            $new_api_key = md5(Str::random(40));
            Config::where('key','api_key')->update(['value'=>$new_api_key]);
            $request->session()->flash('MESSAGE','Api Kye has been update successfully.');
            return redirect()->route('admin.setting.general.index',['api_key']);
        }
    }

}
