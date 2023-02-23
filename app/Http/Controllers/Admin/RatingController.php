<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProviderRating;
use App\Models\ProviderService;
use App\Models\User;
use Illuminate\Http\Request;

class RatingController extends Controller
{

    protected $path;
    public function __construct()
    {
        $this->path =  'admin.provider_rating.rating_';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $ratings =  ProviderRating::with([
        'providerServices'=>function($q){                               // providerServices
                    $q->select('id','user_id','name')->with([
                        'users'=>function($q){                              //users
                            $q->select('id','user_name')->with([
                                'providers'=>function($q){                  //providers
                                    $q->select('id','user_id','store_name');
                                }
                            ]);
                        }
                    ]);
                }
        ])->get([
            'id','provider_service_id','text','rating','status'
        ]);


        return view($this->path.'index',compact('ratings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProviderRating  $providerRating
     * @return \Illuminate\Http\Response
     */
    public function show(ProviderRating $providerRating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProviderRating  $providerRating
     * @return \Illuminate\Http\Response
     */
    public function edit(ProviderRating $providerRating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProviderRating  $providerRating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProviderRating $providerRating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProviderRating  $providerRating
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProviderRating $providerRating)
    {
        //
    }
}
