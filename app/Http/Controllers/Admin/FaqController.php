<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    protected $path;
    public function __construct()
    {
        $this->path = 'admin.faq.faq_';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = Faq::Orderby('order_no','asc')->get();
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
            'question'=>'required',
            'answer'=>'required',
            'order_no'=>'required|unique:faqs,order_no',
        ]);

        if( Faq::create($request->all()) ){
            $request->session()->flash('MESSAGE','Faq has been added successfully.');
        }else{
            $request->session()->flash('MESSAGE','Something error try again!');
        }
        return response()->json(['action'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        $row = $faq;
        return view($this->path.'edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question'=>'required',
            'answer'=>'required',
            'order_no'=>'required|unique:faqs,order_no,'.$faq->id,
        ]);
        $data = $request->except(['_token','_method']);
        
        if ($faq->update($data)) {
            $request->session()->flash('MESSAGE','Faq has been updated succefully.');
        }else{
            $request->session()->flash('MESSAGE','Something error please again.');
        }
        return response()->json(['action'=>true]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        if ($faq->delete()) {
            return response()->json(['action'=>true], 200);
        }else{
            return response()->json(['action'=>false], 200);
        }
    }
}
