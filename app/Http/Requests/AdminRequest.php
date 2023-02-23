<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        if($request->url()==route('admin.manage.store')){
            return [
                'first_name'=>['required','alpha_dash','alpha','min:2','max:30'],
                'last_name'=>['nullable','alpha_dash','alpha','min:2','max:30'],
                'phone'=>['nullable','numeric'],
                'email'=>['required','email','unique:admins,email'],
                'password'=>['required','min:4'],
                ];
        }else{
            $id = $request->manage;
            return [
                'first_name'=>['required','alpha_dash','alpha','min:2','max:30'],
                'last_name'=>['nullable','alpha_dash','alpha','min:2','max:30'],
                'phone'=>['nullable','numeric'],
                'email'=>'required|email|unique:admins,email,'.$id,
                'password'=>['nullable','min:4'],
                ];
        }
    }
}
