@extends('admin.layout.app')
@section('css')
    <meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('categories','show')
@section('main_category_active','active')

@section('data-section');       
    <div class="content-inner">
        <div class="container-fluid">

            {{-- breadcrumb start here  --}}
            <div class="row">
                <div class="page-header">
                    <div class="d-flex align-items-center">
                        <h2 class="page-header-title">Service categories Viewing</h2>
                        <div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="ti ti-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                                <li class="breadcrumb-item">Service main category</li>
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
                            <a href="{{route('admin.main_category.create')}}" class="btn btn-danger">Add Main Category</a>
                            <a href="{{route('admin.sub_category.create')}}" class="btn btn-danger">Add Sub Category</a>
                            {{-- @endcan --}}
                        </h4>
                        
                      <table class="table" id='table'>
                          <thead>
                              <tr>
                                  <th>Sr NO.</th>
                                  <th>Sub Category Name</th>
                                  <th>Main Category Name</th>
                                  <th>Status</th>
                                  <th>Premium</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                             @foreach ($res as $key=>$row)
                             <tr>
                                <td>{{$key+1}} </td>
                                 <td>{{ $row->sub_category_name }}</td>
                                 <td>{{ $row->main_category_name }}</td>
                                 <td>
                                    @if ($row->status=='1')
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-warning">Inactive</span>
                                    @endif
                                 </td>
                                 <td>
                                    @if($row->premium)
                                        <span><i class="fas fa-check-square text-danger"></i></span>
                                    @else
                                    <input type="checkbox"  disabled>
                                    @endif
                                 </td>
                                <td class="td-actions">
                                    {{-- <a href="{{ route('admin.main_category.show',[$row->id]) }}"><i class="la la-eye"></i></a> --}}
                                    {{-- @can('admin-edit') --}}
                                    <a href="{{route('admin.sub_category.edit',[$row->id])}}"><i class="la la-edit"></i></a>
                                    {{-- @endcan --}}
                                    {{-- @can('admin-delete') --}}
                                    {{-- <form id="formData" method="GET" class="d-inline"> --}}
                                    <a href="#" data-id="{{ $row->id }}"  class="delete dis_btn"><i class="la la-close"></i></a>

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

        $(document).on('click','.delete', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var token = $(this).data('token');
            var tr = $(this);
            if (confirm('Do you want to delete this?')) {
                $.ajax({
                    url: "{{route('admin.sub_category.destroy','')}}"+'/'+id,
                    type: "delete",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    data: {id:id},
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    error:function (jqXHR,get_error) {
                        getError(jqXHR,get_error);
                    },
                    success: function(get){
                        console.log(get.data);
                        if(get.action==true){
                            $(tr).fadeOut().closest("tr").remove();
                        }else if(get.action==false){
                            location.reload();
                        }
                    }
                });
            }
        });



    });
    
</script>

@endsection

            