<?php

namespace App\Http\Controllers;

use App\Models\ManageBook;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Stmt\Return_;

class SearchController extends Controller
{

    protected $key;
    public function __construct($key=NULL)
    {
        $this->key = '48875_506a7d4a2e62598f34ccd89d2f401bb9';
    }


    function CallAPI($method, $url,$key=NUll, $data = false)
    {
        $curl = curl_init();

        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // Optional Authentication:
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
          curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization:'.$key,
            'Content-Type: application/json',
         ));
         
        // curl_setopt($curl, CURLOPT_USERPWD, "madison_woo@alumni.brown.edu:LongLake#51");

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        
      

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }

    public function isbn($buyBook)
    {
        $data = Http::withHeaders([
            'Accept'=>'Application/json',
            'Authorization'=>'48875_506a7d4a2e62598f34ccd89d2f401bb9',
        ])->get('https://api2.isbndb.com/search/books',[
            // 'page'=>2,
            // 'pageSize'=>1,
            'isbn'=>$buyBook,
            // 'author'=>$buyBook,
            // 'text'=>''
            // 'subject'=>'ff',
        ]);

        // if ($data->ok()==false) {
        //     return 'roiht';
        // }

        return $data;
    }

    public function author($buyBook,$page,$pageSize)
    {
        $data = Http::withHeaders([
            'Accept'=>'Application/json',
            'Authorization'=>'48875_506a7d4a2e62598f34ccd89d2f401bb9',
        ])->get('https://api2.isbndb.com/search/books',[
            // 'page'=>2,
            // 'pageSize'=>1,
            // 'isbn'=>$buyBook,
            'author'=>$buyBook,
            // 'text'=>''
            // 'subject'=>'ff',
        ]);

        // if ($data->ok()==false) {
        //     return false;
        // }

        return $data;
    }

    public function title($buyBook,$page,$pageSize)
    {
        $data = Http::withHeaders([
            'Accept'=>'Application/json',
            'Authorization'=>'48875_506a7d4a2e62598f34ccd89d2f401bb9',
        ])->get('https://api2.isbndb.com/search/books',[
            'page'=>$page,
            'pageSize'=>$pageSize,
            'text'=>$buyBook,
        ]);

        return $data;
    }



        /**
     * search buy book.
     *
     * @return \Illuminate\Http\Response
     */
    public function buyBook(Request $request)
    {
        $errorMessage = [];
        $buyBook = $request->buyBook;
        if(isset($request->page)){
            $page = $request->page;
        }else{
            $page = 1;
        }
        $total = 0;
        // return $buyBook;
        // get local data from isbn number 
        $data = ManageBook::where('isbn',$buyBook)->get();

        if(count($data)=='0'){
        // fetch isbn api 

            $get = $this->isbn($buyBook);
            if ($get->ok()==true) {    // if data nor found 
                $decode_json =  $get->json();
                // $data = $decode_json;
                foreach ($decode_json['data'] as $key => $value) {
                    if (isset($value['authors'])) {
                        $author = implode(',',$value['authors']);
                    }

                    $data = $data->push([
                        'title'=>$value['title'] ?? '',
                        'isbn13'=>$value['isbn13'] ?? '',
                        'isbn'=>$value['isbn'] ?? '',
                        'author'=>$author ?? '',
                        'image'=>$value['image'] ?? '',
                    ]);
                }
                // return view('search.search-book',compact('data','buyBook'));
            }
            //////////////////////////////

        }


        // fetch title
        if (count($data)==0) {
            $data = ManageBook::where('title','like','%'.$buyBook.'%')->get();

            $get = $this->title(urlencode($buyBook),$page,10);

            if ($get->ok()==true) {
                $decode_json =  $get->json();
                $total = $decode_json['total'];
                foreach ($decode_json['data'] as $key => $value) {
                    if (isset($value['authors'])) {
                        $author = implode(',',$value['authors']);
                    }
    
                    $data = $data->push([
                        'title'=>$value['title'] ?? '',
                        'isbn'=>$value['isbn'] ?? '',
                        'author'=>$author ?? '',
                        'image'=>$value['image'] ?? '',
                    ]);
                }
            }

        }
        //////

        // return $data;
        // if ($data[0]['title'] != $buyBook) {
        //     $data = [];
        // }

        if (count($data)==0) {
        
            // get local data from author number 
            $data = ManageBook::where('author',$buyBook)->get();
            $get = $this->author($buyBook,$page,10);
            if ($get->ok()==true) {

                $decode_json =  $get->json();
                $total = $decode_json['total'];
                foreach ($decode_json['data'] as $key => $value) {
                    if (isset($value['authors'])) {
                        $author = implode(',',$value['authors']);
                    }

                    $data = $data->push([
                        'title'=>$value['title'] ?? '',
                        'isbn13'=>$value['isbn13'] ?? '',
                        'isbn'=>$value['isbn'] ?? '',
                        'author'=>$author ?? '',
                        'image'=>$value['image'] ?? '',
                    ]);
                }
            }elseif( $get['errorMessage'] == 'Not Found'){
                $request->session()->flash('error','Not Found');
            }
        }
        ////////////////////////////

        if (count($data)==0) {
            $request->session()->flash('error','Not Found');
        }

        // return $data;
        return view('search.search-book',compact('data','buyBook','total'));

    }


    function stringInsert($str,$insertstr,$pos)
    {
        $str = substr($str, 0, $pos) . $insertstr . substr($str, $pos);
        return $str;
    }


    public function buyBookDetails($isbn=NULL)
    {
        $data = ManageBook::where('isbn',$isbn)->first();
        if(empty($data)){

            $get = $this->isbn($isbn);
            if ($get->ok()==true) {    // if data nor found 
                $decode_json =  $get->json();
                // return  $decode_json;
                foreach ($decode_json['data'] as $key => $value) {
                    if (isset($value['authors'])) {
                        $author = implode(',',$value['authors']);
                    }
                    $data['title']=$value['title'] ?? '';
                    $data['image']=$value['image'] ?? '';
                    $data['isbn13']=$value['isbn13'] ?? '';
                    $data['isbn']=$value['isbn'] ?? '';
                    $data['author']=$author ?? '';
                    $data['date_published']=$value['date_published'] ?? '';
                    $data['publisher']=$value['publisher'] ?? '';
                    // $data['binding']=$value['binding'] ?? '';
                    $data['pages']=$value['pages'] ?? '';
                    $data['synopsis']=$value['synopsis'] ?? '';
                }
                // return view('search.search-book',compact('data','buyBook'));
            }
            //////////////////////////////
        }
        
        if (isset($data['id'])) {
            $similarBook = ManageBook::where('id','!=',$data['id'])
            // ->where('main_category_id',$data['main_category_id'])
            ->limit(20)
            ->get();
        }else{
            $similarBook = ManageBook::inRandomOrder(20)->get();
        }
        // return $similarBook;
        return view('search.show-book',compact('data','similarBook'));
    }

    public function amazonPriceHistory($isbn=null)
    {
        $get = Http::get('https://api.keepa.com/product',[
            'key'=>'786fc09u868cl88g4llvppn511v5ihdbld3tjqq8mom28rtac4crijm5u4rerk43',
            'asin'=>'0374281629',
            // 'days'=>$days,
            'domain'=>'1',
        ]);

        $get= $get->json();

        $res =  $get['products'][0]['csv'][0];

        $data = [];
        $date='';
        $price='';
        foreach ($res as $key => $value) {
            if($key%2==0){
                $data_convert = ($value+21564000)*60;
                $date = date('Y-m-d' ,$data_convert); 
            }else{
                if($value=="-1"){
                    $date='';
                    continue; 
                   }
                // $price = $value;
                $price = (float)$this->stringInsert($value,'.',-2);
                $data[$date]=$price;
            }
        }

       return $data;

    }


 
}
