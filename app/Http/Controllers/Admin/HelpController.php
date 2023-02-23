<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Help;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\HelpMail;
use App\Models\User;


class HelpController extends Controller
{

    protected $path;

    public function __construct()
    {
        $this->path = 'admin.help.help_';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $res = Help::with(['users'=>function($q){
            $q->select('id','user_type');
        }])->get();

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
     * filter type
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function type(Request $request)
    {
        $type = $request->type;

        if ($type=='all') {
            return redirect()->route('admin.help.index');
        }

        $res = Help::with(['users'=>function($q) use($type){
            $q->select('id','user_type')->where('user_type',$type);
        }])->whereHas('users',function($q) use($type){
            $q->where('user_type',$type);
        })->get();

        return view($this->path.'index',compact('res'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Help  $help
     * @return \Illuminate\Http\Response
     */
    public function show(Help $help)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Help  $help
     * @return \Illuminate\Http\Response
     */
    public function reply(Help $help)
    {
        $row = $help;
        
        return view($this->path.'reply',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Help  $help
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Help $help)
    {
        $request->validate([
            'user_message'=>'required',
            'admin_message'=>'required',
        ]);

        $data = $request->all();
        $body=[
            'msg'=>$data['admin_message'],
        ];

        $user_email = User::where('id',$data['user_id'])->first()->email;
        Mail::to($user_email)->send(new HelpMail($body));
        if ($help->update($data)) {
            $request->session()->flash('MESSAGE','Reply sent');
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['success'=>false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Help  $help
     * @return \Illuminate\Http\Response
     */
    public function destroy(Help $help)
    {
        //
    }
}
