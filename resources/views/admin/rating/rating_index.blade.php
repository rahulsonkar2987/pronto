@extends('admin.layout.app')
@section('user','#e76c90');

@section('data-section');       
    <div class="content-inner">
        <div class="container-fluid">

            {{-- breadcrumb start here  --}}
            <div class="row">
                <div class="page-header">
                    <div class="d-flex align-items-center">
                        <h2 class="page-header-title">Rating Viewing</h2>
                        <div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="ti ti-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                                <li class="breadcrumb-item">Rating</li>
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
                            {{-- @can('admin-create')
                            <a href="{{route('admin.user.create')}}" class="btn btn-primary">Add New</a>
                            @endcan --}}
                        </h4>
                        
                      <table class="table" id='table'>
                          <thead>
                              <tr>
                                  <th>Id</th>
                                  <th>Provider Store Name</th>
                                  <th>User Name</th>
                                  <th>Text</th>
                                  <th>Rating</th>
                                  <th>Status</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                             @foreach ($ratings as $key=>$rating)
                             {{-- {{ dd($loop) }} --}}
                             <tr>
                                 <td>{{$key+1}} </td>
                                 <td>{{ $rating->providerServices->users->providers->store_name }}</td>
                                 <td>{{ $rating->providerServices->users->user_name }}</td>
                                 <td>{{ $rating->te }}</td>
                                 <td>{{ $rating->rating }}</td>
                                <td>
                                    @if ($rating->status=='1')
                                        <span class="badge badge-success status" data-id="{{ $rating->id }}">Active</span>
                                    @else
                                        <span class="badge badge-warning status" data-id="{{ $rating->id }}">Inactive</span>
                                    @endif
                                </td>
                                <td class="td-actions">
                                    {{-- <a href="{{ route('admin.provider.create',['user_id'=>$row->id]) }}"><i style="font-size:17px" class="fa-solid fa-store"></i></a> --}}
                                    {{-- @can('admin-edit') --}}
                                    {{-- @endcan --}}
                                    {{-- @can('admin-delete') --}}
                                    <form action="{{ route('admin.user.destroy',[$rating->id]) }}" method="post" class="d-inline" onclick="return confirm('Do you want to delete this Admin?')">
                                        @csrf @method('DELETE')
                                        <button role="button" class=""  style="border: none;background:none;"><i style="font-size:20px;color:rgba(52,40,104,.4)" class="la la-close"></i></button>
                                    </form>
                                    {{-- @endcanx --}}
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

        // $(document).on('click','.status', function (e) {
        //     e.preventDefault();
        //     var id = $
        // });



    });
    
</script>

@endsection

            