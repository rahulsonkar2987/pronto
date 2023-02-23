<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{

    protected $path;
    public function __construct()
    {
        $this->path = 'admin.banner.banner_';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $res = Banner::orderBy('id');
            if ($request->wantsJson() ){
                $id = $request->id;
                $data = $id ? $res->where('id',$id) : $res ;
                return response()->json(['success'=>true,'data'=>$data->get()], 200);
            }
            $res = $res->get();
            return view($this->path.'index',compact('res'));
        } catch (\Throwable $th) {
            return response()->json(['success'=>false,'msg'=>$th->getMessage()]);
        }
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

        // $file = $request->file('image');
        // $file_extension = strtolower($file->extension());
        // list($width,$height)=getimagesize($file);
        // $nWidth = $width;
        // $nHeight = $height;

        // $newImage = imagecreatetruecolor($nWidth,$nHeight);
        // if ($file_extension=='jpeg' || $file_extension =='jpg' ) {
        //     $source = imagecreatefromjpeg($file);
        //     imagecopyresized($newImage,$source,0,0,0,0,$nWidth,$nHeight,$width,$height);
        //     $file_name = time().'.jpg';
        //     imagejpeg($newImage,'upload/'.$file_name,50);
        // }elseif($file_extension=='png'){
        //     $source = imagecreatefrompng($file);


        //     $white = imagecolorallocate($source, 255, 255, 255);
        //     $grey = imagecolorallocate($source, 128, 128, 128);
        //     $black = imagecolorallocate($source, 0, 0, 0);
        //     $font = 'arial.ttf';
        //     $text = 'this is testing';

        //     // imagefilledrectangle($source, 0, 0, 399, 29, $grey);

        //     // imagestring($source,20,2,10,'this is testing now ',$black);

        //     // Add some shadow to the text
        //     // imagettftext($source, 20, 0, 11, 21, $grey, $font, $text);
        //     imagettftext($source, 36, 0, 10, 20, $grey, $font, $text);


        //     imagecopyresized($newImage,$source,0,0,0,0,$nWidth,$nHeight,$width,$height);
        //     $file_name = time().'.png';
        //     imagepng($newImage,'upload/'.$file_name,9);
        // }elseif($file_extension=='gif'){
        //     $source = imagecreatefromgif($file);
        //     imagecopyresized($newImage,$source,0,0,0,0,$nWidth,$nHeight,$width,$height);
        //     $file_name = time().'.gif';
        //     imagegif($newImage,'upload/'.$file_name,50);
        // }

        // return 'success';
        // die();

        
        $request->validate([
            'title' => 'required',
            'image' => 'required|max:5120|mimes:jpg,png',
            'link' => 'required',
        ],[
            "image.max"=>"The image must not be greater than 5 MB.",
        ]);

        if ($request->hasFile('image')) {
            $path = image($request->file('image'),'upload/banner');
        }
        $data = $request->all();
        $data['image'] = $path;
        if ( Banner::create($data) ) {
            $request->session()->flash('MESSAGE','Banner has been added successfully.');
            return response()->json(['action'=>true]);
        }else{
            $request->session()->flash('MESSAGE','Something error please try again!');
            return response()->json(['action'=>false]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        $row = $banner;
        return view($this->path.'edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|max:5120|mimes:jpg,png',
            'link' => 'required',
        ],[
            "image.max"=>"The image must not be greater than 5 MB.",
        ]);

        
        $data = $request->except(['_token','_method']);
        if($request->hasFile('image')){
            $del_image = Banner::whereId($banner->id)->first()->image;
            $path = image($request->file('image'),'upload/banner');
            $data['image'] = $path;
            if (file_exists($del_image)) {
                unlink($del_image);
            }
        }

        if ($banner->update($data)) {
            $request->session()->flash('MESSAGE','Banner has been updated successfully');
            return response()->json(['action'=>true]);
        }else{
            $request->session()->flash('MESSAGE','Something error please try again!');
            return response()->json(['action'=>false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        if($banner->delete()){
            session()->flash('MESSAGE','Banner has been deleted successfully.');
            return redirect()->back();
        }
        session()->flash('MESSAGE','Something error please try again!');
        return redirect()->back();
    }
}
