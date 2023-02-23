<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\MainCategory;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class SubCategoryController extends Controller
{

    protected $path;
    public function __construct()
    {
        $this->path = 'admin.service_category.s_category_';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id=null)
    {
        $res = new SubCategory();
        // json api start here 
        if ($request->wantsJson() && $request->route()->getName() == 'service.subCategories' ) {
            if(!is_null($id)){
                $res =$res->where('id',$id);
            }
            return response()->json(['success'=>true,'data'=>$res->get()]);
        }
        // json api end here 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res = MainCategory::where('status','1')->orderBy('id','desc')->get(['id','main_category_name']);
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
        $main_category_id = $request->main_category_id;
        $request->validate([
            'main_category_id'=>'required',
            'sub_category_name'=>['required','min:2','max:60',
            function ($attribute, $value, $fail) use ($main_category_id) {
                if ( SubCategory::whereMainCategoryId($main_category_id)->whereSubCategoryName($value)->exists()) {
                    $fail('Both service categories are Already there.');
                }
            }
        ],
            'status'=>'required',
        ]);

        if (SubCategory::create($request->all()) ) {
            $request->session()->flash('MESSAGE','Sub category has been added successfully.');
            return response()->json(['action'=>true]);
        }else{
            $request->session()->flash('MESSAGE','Something error please try again!.');
            return response()->json(['action'=>false]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        $row =  $subCategory;
        $res_mc = MainCategory::all(['id','main_category_name']);
        return view($this->path.'edit',compact('row','res_mc'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $data = $request->except(['_method','_token']);
        $main_category_id = $data['main_category_id'];
        $id = $subCategory->id;
        $request->validate([
            'main_category_id'=>'required',
            'sub_category_name'=>['required','min:2','max:60',
                function ($attribute, $value, $fail) use ($main_category_id,$id) {
                    if ( SubCategory::whereMainCategoryId($main_category_id)->whereSubCategoryName($value)->where('id','!=',$id)->exists()) {
                        $fail('Both service categories are aleardy there.');
                    }
                }
            ],
            'status'=>'required',
        ]);


        if ( $subCategory->update($data) ) {
            $request->session()->flash('MESSAGE','Sub category has been updated successfully.');
            return response()->json(['action'=>true]);
        }else{
            $request->session()->flash('MESSAGE','Something error please try again!.');
            return response()->json(['action'=>false]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        if ($subCategory->delete()) {
            return response()->json(['action'=>true]);
        }else{
            return response()->json(['action'=>false]);
        }
    }
}
