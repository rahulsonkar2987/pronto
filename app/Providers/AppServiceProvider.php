<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Config as Conf;
use App\Models\MailSetting;
use Illuminate\Support\Facades\Config;
use App\Models\SocialLogin;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $con = Conf::all();
        if(count($con)>0){
            Config::set('APP_NAME',$con->where('key','app_name')->first()->value);  // website set App name
            Config::set('APP_URL',$con->where('key','app_url')->first()->value);   // set url 
            Config::set('logo',$con->where('key','logo')->first()->value);   // set url 
            Config::set('favicon',$con->where('key','favicon')->first()->value);   // set url 

            if ($con->where('key','website_mode')->first()->value=='on') {
                $path =  \Request::path();
                $path =substr($path,0,5);
                if ($path != 'admin') {
                    return abort('503');
                }
            }
        }


        //// social login 
        $apis = SocialLogin::all();
        if(count($con)>0){
            $gmail_login = $apis->where('key','google_api')->where('status','1')->first();
            // env('google_client_id',$gmail_login->client_id ?? '');
            // env('client_secret',$gmail_login->client_secret_id  ?? '');
            Config::set('google_client_id',$gmail_login->client_id ?? '');  // google client id set
            Config::set('client_secret',$gmail_login->client_secret_id  ?? '');  // google client  secret 
        }

       
            
        // mail setting start here 
        $mailSetting = MailSetting::first();
        if (!empty($mailSetting)>0) {
            if ($mailSetting) {
                $data=[
                    'driver'        => $mailSetting->mail_mailer,
                    'host'          => $mailSetting->mail_host,
                    'port'          => $mailSetting->mail_port,
                    'encryption'    => $mailSetting->mail_encryption,
                    'username'      => $mailSetting->mail_username,
                    'password'      => $mailSetting->mail_password,
                    'from'          =>  [
                                        'address'   =>  $mailSetting->mail_from_address,
                                        'name'      =>  $mailSetting->mail_from_name,
                                    ] 
                ];
                Config::set('mail',$data);
            }
        }
        // mail setting end here 
    }
}
