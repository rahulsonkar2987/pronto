@extends('admin.layout.app')

@section('data-section');  
<div class="content-inner">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card text-left">
                  <img class="card-img-top" src="holder.js/100px180/" alt="">
                  <div class="card-body">
                    <h4 class="card-title pb-4">
                        <a href="{{route('admin.manage-book.index')}}" class="btn btn-primary">Back</a>
                    </h4>
                    
                    <div class="container bootstrap snippets bootdey">
                        <div class="panel-body inf-content">
                            <div class="row">
                                <div class="col-md-6" style="border-right: 20px;color:red">
                                    <div class="table-responsive">
                                        <table class="table table-user-information">
                                            <tbody>
                                                <tr>        
                                                    <td td width='50%'><strong> {{ ln('Image','ucwords') }} </strong></td>
                                                    <td class="text-primary">
                                                        <img src="{{ asset($book->image) }}" width="80" height="60" alt="" srcset="">
                                                    </td>
                                                </tr>
                                                <tr>        
                                                    <td td width='50%'><strong>{{ ln('title','ucwords') }}</strong></td>
                                                    <td class="text-primary">  {{$book->title}} </td>
                                                </tr>
                                                <tr>
                                                    <td><strong> {{ ln('isbn','ucwords') }}</strong></td>
                                                    <td class="text-primary">{{$book->isbn}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong> {{ ln('isbn10','ucwords') }}  </strong></td>
                                                    <td class="text-primary"> {{$book->isbn10}} </td>
                                                </tr>
                            
                                                <tr>        
                                                    <td><strong> {{ ln('isbn13','ucwords') }} </strong></td>
                                                    <td class="text-primary">{{$book->isbn13}}</td>
                                                </tr>

                                                <tr>
                                                    <td><strong> {{ ln('main_category_name','ucwords') }} </strong></td>
                                                    <td>{{$book->mainCategories->main_category_name}}</td>

                                                </tr>

                                                <tr>
                                                    <td><strong> {{ ln('sub_category_name','ucwords') }} </strong></td>
                                                    <td>{{$book->subCategories->sub_category_name}}</td>
                                                </tr> 
                                            
                                                <tr>
                                                    <td><strong> {{ ln('authors','ucwords') }} </strong></td>
                                                    <td>{{$book->authors}}</td>
                                                </tr> 

                                                <tr>
                                                    <td><strong> {{ ln('language','ucwords') }} </strong></td>
                                                    <td>{{$book->language}}</td>
                                                </tr> 
                                                
                                                <tr>
                                                    <td><strong> {{ ln('edition','ucwords') }} </strong></td>
                                                    <td>{{$book->edition}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong> {{ ln('Yes','ucwords') }} </strong></td>
                                                    <td>
                                                        <input type="checkbox" class="" n value="1" @if(isset($book->popular))  {{ $book->popular=='1' ? 'checked' : '' }} @endif readonly>
                                                    </td>
                                                </tr> 
                                                {{-- <tr>
                                                    <td><strong> {{ ln('created_at','ucwords') }} </strong></td>
                                                    <td>{{date('d-M-Y',strtotime($book->created_at))}}</td>
                                                </tr>                                    --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="table-responsive">
                                        <table class="table table-user-information">
                                            <tr>
                                                <td><strong> {{ ln('publisher','ucwords') }} </strong></td>
                                                <td>{{$book->publisher}}</td>
                                            </tr> 

                                            <tr>
                                                <td><strong> {{ ln('date_published','ucwords') }} </strong></td>
                                                <td>{{ $book->date_published }}</td>
                                            </tr>

                                            <tr>
                                                <td><strong>{{ ln('dimensions','ucwords') }}</strong></td>
                                                <td>{{ $book->dimensions }}</td>
                                            </tr>

                                            <tr>
                                                <td><strong>{{ ln('pages','ucwords') }}</strong></td>
                                                <td>{{ $book->pages }}</td>
                                            </tr>

                                            <tr>
                                                <td><strong>{{ ln('price','ucwords') }}</strong></td>
                                                <td>{{ $book->price }}</td>
                                            </tr>


                                            <tr>
                                                <td><strong>{{ ln('status','ucwords') }}</strong></td>
                                                <td>{{ $book->status}}</td>
                                            </tr>
                                           
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>                                        
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
