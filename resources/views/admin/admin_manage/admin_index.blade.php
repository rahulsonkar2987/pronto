@extends('admin.layout.app')

@section('data-section');       
    <div class="content-inner">
        <div class="container-fluid">

            {{-- breadcrumb start here  --}}
            <div class="row">
                <div class="page-header">
                    <div class="d-flex align-items-center">
                        <h2 class="page-header-title">Admin Viewing</h2>
                        <div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="ti ti-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                                <li class="breadcrumb-item">Mange Admin</li>
                                <li class="breadcrumb-item active">View</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- breadcrumb end here  --}}

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card text-left">
                      <img class="card-img-top" src="holder.js/100px180/" alt="">
                      <div class="card-body">
                        <h4 class="card-title pb-4">
                            @can('admin-create')
                            <a href="{{route('admin.manage.create')}}" class="btn btn-danger">Add New</a>
                            @endcan
                        </h4>
                        
                      <table class="table" id='table'>
                          <thead>
                              <tr>
                                  <th>Id</th>
                                  <th>Full Name</th>
                                  <th>Email</th>
                                  <th>Phone No.</th>
                                  <td>Roles</td>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                             @foreach ($admins as $key=>$admin)
                             <tr>
                                <td>{{$key+1}} </td>
                                <td>{{ $admin->first_name.' '.$admin->last_name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->phone }}</td>
                                <td>
                                    @if(!empty($admin->getRoleNames()))
                                        @foreach($admin->getRoleNames() as $v)
                                        <label class="badge badge-success">{{ $v }}</label>
                                        @endforeach
                                    @endif
                                </td>
                                <td class="td-actions">
                                    @can('admin-edit')
                                    <a href="{{route('admin.manage.edit',[$admin->id])}}"><i class="la la-edit"></i></a>
                                    @endcan
                                    @can('admin-delete')
                                    <form action="{{ route('admin.manage.destroy',[$admin->id]) }}" method="post" class="d-inline" onclick="return confirm('Do you want to delete this Admin?')">
                                        @csrf @method('DELETE')
                                        <button role="button" class=""  style="border: none;background:none;"><i style="font-size:20px;color:rgba(52,40,104,.4)" class="la la-close"></i></button>
                                    </form>
                                    @endcan
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

            