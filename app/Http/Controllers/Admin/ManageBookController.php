<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\MainCategory;
use App\Models\ManageBook;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Http;

class ManageBookController extends Controller
{


    protected $path;
    public function __construct()
    {
       
        $this->path = 'admin.manage-book.mb_';
    }

    function DownloadImageFromUrl($image_path,$path)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch,CURLOPT_URL, $image_path);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $image_content=curl_exec($ch);
        curl_close($ch);

        $file_name = $path.'r3p'.time().rand().'.'.'jpg';
        $save_file = fopen($file_name,'w');
        fwrite($save_file, $image_content);
        fclose($save_file);

        return $file_name;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mb = ManageBook::with(['admins'])->whereNull('parent_id')->get()->unique('formate_id');
        return view($this->path.'index',compact('mb'));
    }


    public function fetchSubCategory(Request $request)
    {
        // return response()->json(['success'=>true,'data'=>'rohit']);

        $main_category_id = $request->main_category_id;

        $sub_cat = SubCategory::where('main_category_id',$main_category_id)->active()->get();

        $output ="<option value=' '>Select Sub Category</option>";
        foreach ($sub_cat as $key => $sc) {
            $output =  $output. " <option value='".$sc->id."' >".$sc->sub_category_name."</option>";
        }


        return response()->json(['success'=>true,'data'=>$output]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mc = MainCategory::Active()->get();
        $authors = Author::Active()->get();
        $mbp = ManageBook::Active()->get();
        return view($this->path.'create',compact('mc','authors','mbp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $request->validate([
            'title'=>'required',
            'main_category_id'=>'required',
            'author'=>'required',
            // 'image' => 'required|mimes:png,jpg,jpeg|max:5120',
            'isbn'=>'required|unique:manage_books,isbn',
            'isbn10'=>'nullable|unique:manage_books,isbn10',
            'isbn13'=>'nullable|unique:manage_books,isbn13',
            'author'=>'required',
            'quantity'=>'required',
            'price'=>'required',
            'status'=>'required',
        ],[
            'image.max'=> 'The :attribute  must not be greater than 5 MB.',
        ]);

       
        $data['admin_id'] = auth()->guard('admin')->user()->id;
        if(!isset($data['formate_id'])){
            $data['formate_id']=rand().time();
        }
        if($request->hasFile('image')){
            $image = $request->image;
            $file_name = 'r3p'.time().rand().'.'.$image->extension();

            $img_path = 'upload/book/'.$file_name;
            Image::make($image)->save(public_path('/').$img_path,50);
            $data['image'] = $img_path;
        }else{
            $image_path = $this->DownloadImageFromUrl($request->isbn_image_Upload,'upload/book/');
            $data['image'] = $image_path;
        }

        if(ManageBook::create($data)){
            $request->session()->flash('MESSAGE','Book has been added successfully');
            return response()->json(['success'=>true]);
        }else{
            $request->session()->flash('MESSAGE','Something error please try again!');
            return response()->json(['success'=>false]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageBook  $manageBook
     * @return \Illuminate\Http\Response
     */
    public function show(ManageBook $manageBook)
    {
        $book = $manageBook->with([
            'mainCategories',
            'subCategories'
        ])->where('id',$manageBook->id)->first();

        return view($this->path.'show',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageBook  $manageBook
     * @return \Illuminate\Http\Response
     */
    public function edit(ManageBook $manageBook)
    {
        $mc = MainCategory::all();
        $sc = SubCategory::where('main_category_id',$manageBook->main_category_id)->get();

        // $manageBook = $manageBook->with('parentBook')->where('id',$manageBook->id)->first();
        $manageBook = $manageBook->where('formate_id',$manageBook->formate_id)->get();

        $hardcover = [];
        $paperback =[];

        // return $manageBook;

        foreach($manageBook as $key=>$book){

            if($book->formate=='Hardcover'){
                $hardcover['id']=$book->id;
                $hardcover['admin_id']=$book->admin_id;
                $hardcover['main_category_id']=$book->main_category_id;
                $hardcover['sub_category_id']=$book->sub_category_id;
                $hardcover['title']=$book->title;
                $hardcover['formate']=$book->formate;
                $hardcover['formate_id']=$book->formate_id;
                $hardcover['image']=$book->image;
                $hardcover['isbn']=$book->isbn;
                $hardcover['isbn10']=$book->isbn10;
                $hardcover['isbn13']=$book->isbn13;
                $hardcover['language']=$book->language;
                $hardcover['edition']=$book->edition;
                $hardcover['publisher']=$book->publisher;
                $hardcover['author']=$book->language;
                $hardcover['date_published']=$book->date_published;
                $hardcover['condition']=$book->condition;
                $hardcover['quantity']=$book->quantity;
                $hardcover['dimensions']=$book->dimensions;
                $hardcover['pages']=$book->pages;
                $hardcover['price']=$book->price;
                $hardcover['popular']=$book->popular;
                $hardcover['status']=$book->status;
            }
            if($book->formate=='Paperback'){
                $paperback['id']=$book->id;
                $paperback['admin_id']=$book->admin_id;
                $paperback['main_category_id']=$book->main_category_id;
                $paperback['sub_category_id']=$book->sub_category_id;
                $paperback['title']=$book->title;
                $paperback['formate']=$book->formate;
                $paperback['formate_id']=$book->formate_id;
                $paperback['image']=$book->image;
                $paperback['isbn']=$book->isbn;
                $paperback['isbn10']=$book->isbn10;
                $paperback['isbn13']=$book->isbn13;
                $paperback['language']=$book->language;
                $paperback['edition']=$book->edition;
                $paperback['publisher']=$book->publisher;
                $paperback['author']=$book->language;
                $paperback['date_published']=$book->date_published;
                $paperback['condition']=$book->condition;
                $paperback['quantity']=$book->quantity;
                $paperback['dimensions']=$book->dimensions;
                $paperback['pages']=$book->pages;
                $paperback['price']=$book->price;
                $paperback['popular']=$book->popular;
                $paperback['status']=$book->status;
            }
        }

        // return 'rohit';
        // return $manageBook;
        // return gettype($manageBook);
        return view($this->path.'edit',compact('hardcover','paperback','mc','sc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageBook  $manageBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageBook $manageBook)
    {
    //     $action = $request->action;
    //     $isbn = $request->isbn;


       


        $request->validate([
            'title'=>'required',
            'main_category_id'=>'required',
            // 'image' => 'nullable|mimes:png,jpg,jpeg|max:5120',
            'isbn'=>'required|unique:manage_books,isbn,'.$manageBook->id,
            'isbn10'=>'nullable|unique:manage_books,isbn10,'.$manageBook->id,
            'isbn13'=>'nullable|unique:manage_books,isbn13,'.$manageBook->id,
            'author'=>'required',
            'pages'=>'required',
            'price'=>'required',
            'status'=>'required',
        ],[
            'image.max'=> 'The :attribute  must not be greater than 5 MB.',
        ]);

        $data = $request->except(['_method','_token']);

        if($request->popular=='1'){
            $data['popular']='1';
        }else{
            $data['popular']='0';
        }

        $image_del = $manageBook->image;
        if (isset($data['image'])) {
            $image = $data['image'];
            $file_name = 'r3p'.time().rand().'.'.$image->extension();
            $image_path ='upload/book/'.$file_name;
            Image::make($image)->save(public_path('/').$image_path,50);
            $data['image']=$image_path;

            if (file_exists($image_del)) {
                unlink($image_del);
            }
        }else{
            if (!empty($request->isbn_image_Upload)) {
                if (file_exists($image_del)) {
                    unlink($image_del);
                }
                $image_path = $this->DownloadImageFromUrl($request->isbn_image_Upload,'upload/book/');
                $data['image'] = $image_path;
            }
        }

        if (empty($data['formate_id'])) {
            unset($data['formate_id']);
        }


        if ($manageBook->update($data)) {
            $request->session()->flash('MESSAGE','Book has been updated successfully.');
            return response()->json(['success'=>true]);
        }else{
            $request->session()->flash('MESSAGE','Something error please try again!');
            return response()->json(['success'=>false]);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageBook  $manageBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManageBook $manageBook)
    {

        $images_del = $manageBook->orderBy('id','desc')->where('formate_id',$manageBook->formate_id)->get(['id','image']);
        // return $images_del;
        try {
            foreach($images_del as $del){
                if (ManageBook::where('id',$del->id)->delete()) {
                    if (file_exists($del->image)) {
                        unlink($del->image);
                    }
                }
            }
            return response()->json(['success'=>true]);
        }catch (\Throwable $th) {
            session()->flash('MESSAGE',$th->getMessage());
            return response()->json(['success'=>false]);
        }



        // try {
        //     $image_del = $manageBook->image;
        //     if ($manageBook->delete()) {
        //         if (file_exists($image_del)) {
        //             unlink($image_del);
        //         }
        //         return response()->json(['success'=>true]);
        //     }else{
        //         session()->flash('MESSAGE','Something error please try again!');
        //         return response()->json(['success'=>false]);
        //     }
        // }catch (\Throwable $th) {
        //     session()->flash('MESSAGE',$th->getMessage());
        //     return response()->json(['success'=>false]);
        // }
    }


    public function loadAuthorName()
    {
        $authors = Author::Active()->get();

        $output = "<option value=' '>--Select One</option>";
        
        $output ="<option value=' '>Select Sub Category</option>";
        foreach ($authors as $author){
            $output =  $output. " <option value='".$author->id."' >".$author->name."</option>";
        }


        return response()->json(['success'=>true,'data'=>$output]);

    }


    public function GetBookDataFromIsbn(Request $request)
    {
        $isbn = $request->isbn;
        // $isbn = '1504326679';
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => '48875_506a7d4a2e62598f34ccd89d2f401bb9',
        ])->get('https://api2.isbndb.com/search/books',[
            'isbn'=>$isbn,
        ]);
        $book_data = $response->json();

        return $book_data;
    }
}
