<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MailSetting;
use App\Models\Config;
use App\Models\SocialLogin;
use App\Models\PageSeo;
use Illuminate\Support\Str;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MailSetting::create([
            'mail_mailer'=> 'smtp',
            'mail_host' =>'smtp.gmail.com',
            'mail_port' => 587,
            'mail_username' => 'rohitpippal74@gmail.com',
            'mail_password' => 'dloyatvnrpqhbzmb',
            'mail_encryption' => 'tls',
            'mail_from_address' => 'rohitpippal74@gmail.com',
            'mail_from_name' => 'Paw5',
        ]); 

        Config::create([
            'key' => 'app_name',
            'value' => 'Pronto',
            'status' => '1',
        ]);

        Config::create([
            'key' => 'app_url',
            'value'=> 'http://127.0.0.1:8000',
            'status' => '1',
        ]);

        Config::create([
            'key' => 'website_mode',
            'value' => 'off',
            'status' => '1',
        ]);

        Config::create([
            'key' => 'logo',
            'value' => 'upload/setting/logo/logo.png',
            'status' => '1',
        ]);
        Config::create([
            'key' => 'favicon',
            'value' => 'upload/setting/logo/favicon.png',
            'status' => '1',
        ]);
        Config::create([
            'key' => 'api_key',
            'value' => md5(Str::random(10)),
            'status' => '1',
        ]);
     


        SocialLogin::create( [
            'key' => 'facebook_api',
            'client_id' => 'facebook client id api',
            'client_secret_id' => 'facebook secret api',
            'status' => '1',
        ]);

        SocialLogin::create([
            'key' => 'google_api',
            'client_id' => 'google client id api',
            'client_secret_id' => 'google secret api',
            'status' => '1',
        ]);

        SocialLogin::create([
            'key' => 'google_map_api',
            'client_id' => 'google map client id api',
            'client_secret_id' => 'google map secret api',
            'status' => '1',
        ]);

        SocialLogin::create([
            'key' => 'payumoney_api',
            'client_id' => 'payumoney client id api',
            'client_secret_id' => 'payumoney secret api',
            'status' => '1',
        ]);

        PageSeo::create([
            'title'=>'title',
            'meta_title'=>'this is meta title',
            'meta_keywords' => 'meta_keywoords1,meta_keywoords2,meta_keywoords3',
            'meta_description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam, dolor sint, libero perspiciatis necessitatibus ab dolorum rem reprehenderit, totam veritatis molestias sequi quis veniam debitis consequuntur porro quo dignissimos magni ',
            'status'=>'1'
        ]);



    }
}
