<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    private $path;
    public function __construct()
    {
        $this->path = 'admin.admin_manage.admin_';
        $this->middleware('permission:admin-list|admin-create|admin-edit|admin-delete', ['only' => ['index','store']]);
        $this->middleware('permission:admin-create', ['only' => ['create','store']]);
        $this->middleware('permission:admin-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:admin-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $res = Admin::orderBy('id','DESC')->where('id','!=',Auth::guard('admin')->user()->id)->get();
        // return 'rohit';
        $admins = Admin::orderBy('id','DESC')->paginate(5);
        return view($this->path.'index',compact('admins'))
            ->with('i', ($request->input('page', 1) - 1) * 5);

        return view($this->path.'index',compact('res'));
      
    }

    // public function loadData(Request $request)
    // {
    //     $draw = $request->get('draw');
    //     $start =$request->start;
    //     $rowPerPage =$request->length;
    //     // $orderArray = $request->order;
    //     // $columnNameArray = $request->columns;
    //     // $searchArray = $request->search;


    //     $admin = \DB::table('admins');

    //     $total = $admin->count(); 

    //     $totalFilter = $total;

    //     $arrData = \DB::table('admins');
    //     $arrData = $arrData->skip($start)->take($rowPerPage);
    //     $arrData= $arrData->get();

    //     $response = array(
    //         'draw'=>intval($draw),
    //         'recordsTotal' => $total,
    //         'recordsFiltered' => $totalFilter,
    //         'data'=>$arrData,
    //     );

    //     return response()->json($response);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view($this->path.'create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        // $input = $request->all();
        // $input['password'] = Hash::make($input['password']);
    
        // $user = User::create($input);
        // $user->assignRole($request->input('roles'));
    
        // return redirect()->route('users.index')
        //                 ->with('success','User created successfully');


        $admin=Admin::create($request->all());
        $admin->assignRole($request->input('roles'));

        if($admin){
            $request->session()->flash('MESSAGE','Admin has been Created successfully.');
        }else {
            $request->session()->flash('MESSAGE','Something error please try again!');
        }
        return response()->json(['action'=>true],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::find($id);
        $roles = Role::pluck('name','name')->all();
        $adminRole = $admin->roles->pluck('name','name')->all();

        return view($this->path.'edit',compact('admin','roles','adminRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, $manage)
    {
        // $data = $request->except('_method','_token');
        // return response()->json(['data'=>$manage]);

        $admin = Admin::find($manage);
        $admin->first_name= $request->first_name;
        $admin->last_name= $request->last_name;
        $admin->email = $request->email;
        $admin->phone= $request->phone;
        if(!empty($request->password)){
            $admin->password = $request->password;
        }
        if( $admin->save() ){
            $admin->syncRoles($request->roles);
            // $admin->removeRole($request->roles);
            $request->session()->flash('MESSAGE','Admin has been updated successfully.');
        }else{
            $request->session()->flash('MESSAGE','Something error please try again!');
        }

        return response()->json(['action'=>true],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($manage)
    {

        if(Admin::find($manage)->delete()){
            session()->flash('MESSAGE','Admin has been deleted successfully.');
        }else{
            session()->flash('MESSAGE','Something error please try again');
        }

        return redirect()->route('admin.manage.index');
    }
}
