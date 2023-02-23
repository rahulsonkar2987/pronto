@extends('admin.layout.app')
@section('author','#e76c90');

@section('data-section');       
    <div class="content-inner">
        <div class="container-fluid">

            {{-- breadcrumb start here  --}}
            <div class="row">
                <div class="page-header">
                    <div class="d-flex align-items-center">
                        <h2 class="page-header-title">Author Viewing</h2>
                        <div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="ti ti-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                                <li class="breadcrumb-item">Author</li>
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
                            <a href="{{route('admin.author.create')}}" class="btn btn-primary">Add New</a>
                            {{-- @endcan --}}
                        </h4>
                        
                      <table class="table" id='table'>
                          <thead>
                              <tr>
                                  <th>Id</th>
                                  <th>Name</th>
                                  <th>Status</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                             @foreach ($authors as $key=>$author)
                             {{-- {{ dd($loop) }} --}}
                             <tr>
                                 <td>{{$key+1}} </td>
                                 <td>{{ $author->name }}</td>
                                <td>
                                    @if ($author->status=='Active')
                                        <span class="badge badge-success"">Active</span>
                                    @else
                                        <span class="badge badge-warning">Inactive</span>
                                    @endif
                                </td>
                               
                                <td class="td-actions">
                                    {{-- <a href="{{ route('admin.provider.create',['user_id'=>$author->id]) }}"><i style="font-size:17px" class="fa-solid fa-store"></i></a> --}}
                                    {{-- <a href="{{ route('admin.author.show',[$author->id]) }}"><i class="la la-eye"></i></a> --}}
                                    {{-- @can('admin-edit') --}}
                                    <a href="{{route('admin.author.edit',[$author->id])}}"><i class="la la-edit"></i></a>
                                    {{-- @endcan --}}
                                    {{-- @can('admin-delete') --}}
                                    <form id="delete" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $author->id }}">
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
        
        $(document).on('submit','#delete', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('_method','DELETE');
            var id = formData.get('id');
            var tr = this;
            if (confirm("Do you want to delete this?")) {
                $.ajax({
                    url: "{{route('admin.author.destroy','')}}" + '/' +id,
                    type: "post",
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function (get) {
                        if (get.success==true) {
                            $(tr).fadeOut().closest("tr").remove();
                        }else if(get.success==false){
                            location.reload();
                        }
                    }
                });
            }
        });

    });
    
</script>

@endsection

            