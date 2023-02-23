@extends('admin.layout.app')
@section('user','#e76c90');
@section('data-section');  
<div class="content-inner">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card text-left">
                  <div class="card-body">
                    <h4 class="card-title pb-4">
                        <a href="{{route('admin.user.index')}}" class="btn btn-primary">Back</a>
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
                                                        <img src="{{ asset($user->image ?? 'upload/user/user.png') }}" width="80" height="60" alt="" srcset="">
                                                    </td>
                                                </tr>
                                                <tr>        
                                                    <td td width='50%'><strong>{{ ln('first_name','ucwords') }}</strong></td>
                                                    <td class="text-primary">  {{$user->first_name}} </td>
                                                </tr>
                                                <tr>
                                                    <td><strong> {{ ln('last_name','ucwords') }}</strong></td>
                                                    <td class="text-primary">{{$user->last_name}}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong> {{ ln('email','ucwords') }}  </strong></td>
                                                    <td class="text-primary"> {{$user->email}} </td>
                                                </tr>
                            
                                                <tr>        
                                                    <td><strong> {{ ln('phone','ucwords') }} </strong></td>
                                                    <td class="text-primary">{{$user->phone}}</td>
                                                </tr>

                                                <tr>
                                                    <td><strong> {{ ln('city','ucwords') }} </strong></td>
                                                    <td>{{$user->city}}</td>
                                                </tr>

                                                <tr>
                                                    <td><strong> {{ ln('pin_code','ucwords') }} </strong></td>
                                                    <td>{{$user->pin_code}}</td>
                                                </tr> 
                                                <tr>
                                                    <td><strong> {{ ln('created_at','ucwords') }} </strong></td>
                                                    <td>{{date('d-M-Y',strtotime($user->created_at))}}</td>
                                                </tr>                                   
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="table-responsive">
                                        <table class="table table-user-information">
                                            <tr>
                                                <td><strong> {{ ln('last_login','ucwords') }} </strong></td>
                                                <td>{{$user->last_login}}</td>
                                            </tr> 

                                            <tr>
                                                <td><strong>{{ ln('gender','ucwords') }}</strong></td>
                                                <td>{{ $user->gender='1'?'Male':'Femail' }}</td>
                                            </tr>

                                            <tr>
                                                <td><strong>{{ ln('status','ucwords') }}</strong></td>
                                                <td>{{ $user->status==1?'Active' :'Inactive' }}</td>
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
