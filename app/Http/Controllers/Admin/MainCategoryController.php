<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MainCategory;
use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class MainCategoryController extends Controller
{
    protected $path;
    public function __construct()
    {
        $this->path = 'admin.service_category.m_category_';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id=null)
    {

        try {
            $res = DB::table('main_categories');
            $res= $res->join('sub_categories','main_categories.id','=','sub_categories.main_category_id');
            // json api start here 
            if ($request->wantsJson() && $request->route()->getName()=='service.mainCategories') {
                if (!is_null($id)) {
                    $res = $res->where('sub_categories.id',$id);
                }
                return  response()->json(['success'=>true,'data'=>$res->get()]);
            }
            // json api end here 
            $res = $res->get();
            return view($this->path.'index',compact('res'));

        } catch (\Throwable $th) {
            return response()->json(['success'=>$th->getMessage()]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res = MainCategory::orderby('id','desc')->get();
        return view($this->path.'create',compact('res'));
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
            'image' => 'required|mimes:png,jpg,jpeg|max:10240',
            'main_category_name'=>'required|min:2|max:60|unique:main_categories,main_category_name',
            'status'=>'required'
        ],[
            'image.max'=> 'The :attribute  must not be greater than 10 MB.',
        ]);

        $data = $request->all();

        $image = $request->image;
        $file_name = "r3p".time().rand().'.'.$image->extension();

        $image_path ='upload/main_category/'.$file_name;
        Image::make($image)->resize(64,64)->save(public_path('/').$image_path);
        $data['image']=$image_path;

        if (MainCategory::create($data)) {
            $request->session()->flash('MESSAGE','Main Category has been added successfully.');
        }else{
            $request->session()->flash('MESSAGE','Something error please try again!');
        }
        return response()->json(['action'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MainCategory  $mainCategory
     * @return \Illuminate\Http\Response
     */
    public function show(MainCategory $mainCategory)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MainCategory  $mainCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(MainCategory $mainCategory)
    {
        $row = $mainCategory;

        return view($this->path.'edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MainCategory  $mainCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MainCategory $mainCategory)
    {
        $request->validate([
            'image' => 'nullable|mimes:png,jpg,jpeg|max:10240',
            'main_category_name'=>'required|min:2:max:60|unique:main_categories,main_category_name,'.$mainCategory->id,
            'status'=>'required'
        ],[
            'image.max'=> 'The :attribute  must not be greater than 10 MB.',
        ]);

        $data = $request->except(['_method','_token']);

        if (isset($data['image'])) {
            $image_del = $mainCategory->image;
            $image = $data['image'];
            $file_name = 'r3p'.time().rand().'.'.$image->extension();
            $image_path ='upload/main_category/'.$file_name;
            Image::make($image)->resize(64,64)->save(public_path('/').$image_path);
            $data['image']=$image_path;

            if (file_exists($image_del)) {
                unlink($image_del);
            }
        }

        if ($mainCategory->update($data)) {
            $request->session()->flash('MESSAGE','Main category has been updated successfully.');
            return response()->json(['action'=>true]);
        }else{
            $request->session()->flash('MESSAGE','Something error please try again!');
            return response()->json(['action'=>false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MainCategory  $mainCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(MainCategory $mainCategory)
    {

        // if (SubCategory::whereMainCategoryId($mainCategory->id)->exists()) {
        //     session()->flash('MESSAGE','This Main Category used in  sub category  entry. You can not delete this main category!');
        //     return response()->json(['exist'=>true]);
        // }

        try {
            $image_del = $mainCategory->image;
            if ($mainCategory->delete()) {
                if (file_exists($image_del)) {
                    unlink($image_del);
                }
                session()->flash('MESSAGE','Main Category has been deleted');
                return response()->json(['action'=>true]);
            }else{
                session()->flash('MESSAGE','Something error please try again!');
                return response()->json(['action'=>false]);
            }
        }catch(\Illuminate\Database\QueryException $th){
            session()->flash('MESSAGE','This Main Category used in  sub category  entry. You can not delete this main category!');
            return response()->json(['exist'=>true]);
        }catch (\Throwable $th) {
            return response()->json(['msg'=>get_class($th)]);
        }
    }

}
