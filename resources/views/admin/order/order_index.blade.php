@extends('admin.layout.app')

@section('data-section');       
    <div class="content-inner">
        <div class="container-fluid">

            {{-- breadcrumb start here  --}}
            <div class="row">
                <div class="page-header">
                    <div class="d-flex align-items-center">
                        <h2 class="page-header-title">Order Viewing</h2>
                        <div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="ti ti-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                                <li class="breadcrumb-item">Order</li>
                                <li class="breadcrumb-item active">View</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- breadcrumb end here  --}}
                {{-- @auth
                    rohit
                @else
                    dsjf
                @endauth --}}
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card text-left">
                      <div class="card-body">
                        <h4 class="card-title pb-4">
                            {{-- @can('order-create') --}}
                            <a href="{{route('admin.order.create')}}" class="btn btn-danger">Add New</a>
                            {{-- @endcan --}}
                        </h4>
                        
                      <table class="table" id='table'>
                          <thead>
                              <tr>
                                  <th>Id</th>
                                  <th>Order id</th>
                                  <th>User Name</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                             @foreach ($orders as $key=>$order)
                             {{-- {{ dd($loop) }} --}}
                             <tr>
                                 <td>{{$key+1}} </td>
                                 <td>{{ $order->order_id }}</td>
                                 <td>{{ $order->users->user_name }}</td>
                                <td class="td-actions">
                                    <a href="{{ route('admin.order.show',[$order->id]) }}"><i class="la la-eye"></i></a>
                                    {{-- @can('order-edit') --}}
                                    <a href="{{route('admin.order.edit',[$order->id])}}"><i class="la la-edit"></i></a>
                                    {{-- @endcan --}}
                                    {{-- @can('order-delete') --}}
                                    <form action="{{ route('admin.order.destroy',[$order->id]) }}" method="post" class="d-inline" onclick="return confirm('Do you want to delete this?')">
                                        @csrf @method('DELETE')
                                        <button role="button" class=""  style="border: none;background:none;"><i style="font-size:20px;color:rgba(52,40,104,.4)" class="la la-close"></i></button>
                                    </form>
                                    {{-- @endcan --}}
                                </td>

                            </tr>
                             @endforeach 
                          </tbody>
                      </table>

                    </div>
                </div>
            </div>
        </div>
        
    </div>


@endsection

@section('js')
    
<script src="{{asset('admin_assets/assets/vendors/js/datatables/datatables.min.js')}}"></script>

<script>

    $(document).ready(function () {

        $("#table").DataTable();
        
        // $("#table").DataTable({
        //     processing:true,
        //     serverSide:true,
        //     order:[[0,'desc']],
        //     ajax:"",
        //     columns:[
        //         { data:'id' },
        //         { data:'first_name' },
        //         { data:'last_name' },
        //         { data:'email' },
        //         { data:'phone' },
        //     ]
        // });


    });
    
</script>

@endsection

            