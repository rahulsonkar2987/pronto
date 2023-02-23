<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    protected $path;

    public function __construct()
    {
        $this->path = 'admin.author.author_';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();

        return view($this->path.'index',compact('authors'));
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
            'name'=>'required',
            'status'=>'required',
        ]);

        if (Author::create($request->all())) {
            $request->session()->flash('MESSAGE','Author has been added successfully.');
            return response()->json(['success'=>true]);
        }else{
            $request->session()->flash('MESSAGE','Something error please try again!');
            return response()->json(['success'=>false]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view($this->path.'edit',compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name'=>'required',
            'status'=>'required',
        ]);

        $data = $request->except(['_token','_method']);

        if ($author->update($data)) {
            $request->session()->flash('MESSAGE','Author has been updated successfully.');
            return response()->json(['success'=>true]);
        }else{
            $request->session()->flash('MESSAGE','Something error please try again!');
            return response()->json(['success'=>false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        try {
            if ($author->delete()) {
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
