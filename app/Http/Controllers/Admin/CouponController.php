<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class CouponController extends Controller
{
    protected $path;
    public function __construct()
    {
        $this->path = 'admin.coupon.coupon_';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $res = Coupon::orderBy('id')->get();
        /*
        |-------------------------------
        |json api request start here ----
        */
        // if ( $request->wantsJson() ) {
            
        // }
        // //json api request end her
        // $res = $res->ord
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
            'coupon_name' => 'required|unique:coupons,coupon_name',
            'discount_type'=> 'required',
            'discount' => 'required|max:100|numeric',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        try {
            if ( Coupon::create($request->all()) ) {
                $request->session()->flash('MESSAGE','Coupon has been created');
                return response()->json(['action'=>true]);
            }else{
                $request->session()->flash('MESSAGE','Something error please try again!');
                return response()->json(['action'=>false]);
            }
        } catch (\Throwable $th) {
            return response()->json(['action'=>'error','msg'=>$th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        $row = $coupon;
        return view($this->path.'edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'coupon_name' => 'required|unique:coupons,coupon_name,'.$coupon->id,
            'discount_type'=> 'required',
            'discount' => 'required|max:100|numeric',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        try {
            if ($coupon->update($request->all())) {
                $request->session()->flash('MESSAGE','Coupon has been updated.');
                return response()->json(['action'=>true]);
            }else{
                $request->session()->flash('Something error please try again!');
                return response()->json(['action'=>false]);
            }
        } catch (\Throwable $th) {
            return response()->json(['action'=>'error','msg'=>$th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        try {
            if ($coupon->delete()) {
                session()->flash('MESSAGE','Coupan has been deleted.');
                return redirect()->route('admin.coupon.index');
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
