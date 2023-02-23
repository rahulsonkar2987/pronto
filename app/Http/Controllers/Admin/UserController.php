<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Dflydev\DotAccessData\Data;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    protected $path;
    public function __construct()
    {

        // $this->middleware('admin');
        // $this->middleware('permission:usere-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
        // $this->middleware('permission:user-create', ['only' => ['create','store']]);
        // $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->path = 'admin.user.user_';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = User::orderBy('id','desc')->get(['first_name','last_name','id','email','status']);
        return view($this->path.'index',compact('res'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->path.'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image'=>'required|mimes:,jpg,jpeg,png|max:5120',
            'first_name'=>'required',
            'last_name'=>'required',
            'user_name'=>'required|alpha_dash|unique:users,user_name',
            'email'=>'required|email|unique:users,email',
            'phone'=>'required',
            'city'=>'required',
            'pin_code'=>'required',
            'status'=>'required',
            'password'=>'required',
        ]);

        $data = $request->except(['_method','_token']);

        if($request->hasFile('image')){
            $image = $request->image;
            $file_name = 'r3p'.time().rand().'.'.$image->extension();

            $img_path = 'upload/user/'.$file_name;
            Image::make($image)->save(public_path('/').$img_path,50);
            $data['image'] = $img_path;
        }

        if(User::create($data)){
            $request->session()->flash('MESSAGE','User has been added successfully');
            return response()->json(['success'=>true]);
        }else{
            $request->session()->flash('MESSAGE','Something error please try again!');
            return response()->json(['success'=>false]);
        }
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view($this->path.'show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view($this->path.'edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {

        $request->validate([
            'image'=>'nullable|mimes:,jpg,jpeg,png|max:5120',
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email|unique:users,email,'.$user->id,
            'phone'=>'required',
            'city'=>'required',
            'pin_code'=>'required',
            'status'=>'required',
        ]);
        $data = $request->except(['_token','_method']);


        if (isset($data['image'])) {
            $image_del = $user->image;
            $image = $data['image'];
            $file_name = 'r3p'.time().rand().'.'.$image->extension();
            $image_path ='upload/main_category/'.$file_name;
            Image::make($image)->save(public_path('/').$image_path,50);
            $data['image']=$image_path;

            if (file_exists($image_del)) {
                unlink($image_del);
            }
        }

        
        if(empty($data['password'])){
            unset($data['password']);
        }else{
            $data['password'] = bcrypt($data['password']);
        }

        if(empty($data['password'])){
            unset($data['password']);
        }
        
        $imagePath = image($request->image,'upload/user');
        
        $data['image'] = $imagePath;

        if($user->update($data)){
            $request->session()->flash('MESSAGE','User has been updated successfully.');
        }else{
            $request->session()->flash('MESSAGE','Something error please try again!');
        }
        return response()->json(['action'=>true], 200);




        // $res = User::find($id);

        // $
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        return response()->json(['success'=>true]);
         
        try {
            $image_del = $user->image;
            if ($user->delete()) {
                if (file_exists($image_del)) {
                    unlink($image_del);
                }
                session()->flash('MESSAGE','User has been deleted');
                return response()->json(['success'=>true]);
            }else{
                session()->flash('MESSAGE','Something error please try again!');
                return response()->json(['success'=>false]);
            }
        }catch (\Throwable $th) {
            return response()->json(['msg'=>get_class($th)]);
        }
    }
}
