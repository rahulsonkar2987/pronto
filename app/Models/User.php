<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\PetManage;
use App\Models\Help;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'socialite_id',
        'image',
        'user_name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'state',
        'city',
        'pin_code',
        'status',
        'gender',
        'remember_token',
        'password',
        'terms_conditions',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // 'password',
        // 'remember_token',
        // 'email_verified_at',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function scopeActive()
    {
        return $this->where('status','1');
    }


    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = bcrypt($value);
    // }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucfirst($value);
    }

    // public function setUsernameAttribute($value)
    // {
    //     $firstName = $this->attributes['first_name'];
    //     $lastName = strtolower($this->attributes['last_name']);

    //     $username = $firstName. rand(00000,9999);

    //     $i = 0;
    //     while(User::where('user_name',$username)->exists())
    //     {
    //         $i++;
    //         $username = $firstName . $i;
    //     }
    //     $this->attributes['user_name'] = $username;
    // }

    public function setStatusAttribute($value)
    {
        $this->attributes['status']=$value=='Active' ? '1' : '0';
    }

    public function getStatusAttribute()
    {
       return $this->attributes['status']=='1' ? 'Active' : 'Inactive';
    }


    public function setGenderAttribute($value)
    {
        // gender
        if($value=='Male'){
            $this->attributes['gender']='0';
        }elseif($value=='Female'){
            $this->attributes['gender']='1';
        }else{
            $this->attributes['gender']='2';
        }
    }

    public function getGenderAttribute()
    {
        $value = $this->attributes['gender'];
       if($value=='0'){
        return "Male";
        }elseif($value=='1'){
            return 'Female';
        }else{
            return 'Other';
        }
    }



    public function helps()
    {
        return $this->hasMany(Help::class,'user_id');
    }

    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class,'id');
    }



}
