@extends('admin.layout.app')

@section('data-section');       
    <div class="content-inner">
        <div class="container-fluid">

            {{-- breadcrumb start here  --}}
            <div class="row">
                <div class="page-header">
                    <div class="d-flex align-items-center">
                        <h2 class="page-header-title">Banner Viewing</h2>
                        <div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="ti ti-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                                <li class="breadcrumb-item">Banner</li>
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
                            {{-- @can('admin-create') --}}
                            <a href="{{route('admin.banner.create')}}" class="btn btn-danger">Add New</a>
                            {{-- @endcan --}}
                        </h4>
                        
                      <table class="table" id='table'>
                          <thead>
                              <tr>
                                  <th>Id</th>
                                  <th>Title</th>
                                  <th>Banner</th>
                                  <th>Link</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                             @foreach ($res as $key=>$row)
                             <tr>
                                 <td>{{$key+1}} </td>
                                 <td>{{ $row->title }}</td>
                                 <td><img src="{{ asset($row->image) }}" class="img-fluid"  style="height:50px"  alt="" srcset=""></td>
                                 <td>{{ $row->link }}</td>
                                <td class="td-actions">
                                    {{-- <a href="{{ route('admin.banner.show',[$row->id]) }}"><i class="la la-eye"></i></a> --}}
                                    {{-- @can('admin-edit') --}}
                                    <a href="{{route('admin.banner.edit',[$row->id])}}"><i class="la la-edit"></i></a>
                                    {{-- @endcan --}}
                                    {{-- @can('admin-delete') --}}
                                    {{-- <form id="formData" method="GET" class="d-inline"> --}}
                                    <form action="{{ route('admin.banner.destroy',[$row->id]) }}" method="POST" onsubmit="return confirm('do you want to delete this?')" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $row->id }}">
                                        <button  href="" style="border: none;background:none;">
                                            <i style="font-size:20px;color:rgba(52,40,104,.4)" class="la la-close"></i>
                                        </button>
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

        // $(document).on('submit','#formData', function (e) {
        //     e.preventDefault();
        //     var formData = new FormData(this);
        //     formData.append('_token',$('meta[name=_token]').attr("content"));
        //     formData.append('_method','GET');
        //     var id = formData.get('id');
            
        //     if (confirm("Do you want to delete this?")) {
        //         $.ajax({
        //             // url: "{{ route('admin.banner.destroy',' ') }}"+'/'+id,
        //             'url': 'admin.banner'+id,
        //             type: "DELETE",
        //             data: formData,
        //             processData: false,
        //             contentType: false,
        //             dataType: 'json',
        //             success: function (get) {
        //                 alert(get.data)
        //             }
        //         });
        //     }
        // });

    });
    
</script>

@endsection

            