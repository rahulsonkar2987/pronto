@extends('admin.layout.app')

@section('data-section');       
    <div class="content-inner">
        <div class="container-fluid">

            {{-- breadcrumb start here  --}}
            <div class="row">
                <div class="page-header">
                    <div class="d-flex align-items-center">
                        <h2 class="page-header-title">Book Viewing</h2>
                        <div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="ti ti-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                                <li class="breadcrumb-item">Book</li>
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
                            <a href="{{route('admin.manage-book.create')}}" class="btn btn-primary">Add New</a>
                            {{-- @endcan --}}
                        </h4>
                        
                      <table class="table" id='table'>
                          <thead>
                              <tr>
                                  <th>Id</th>
                                  <th>Title</th>
                                  <th>Image</th>
                                  <th>Isbn</th>
                                  <th>Author</th>
                                  <th>Status</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                             @foreach ($mb as $key=>$book)
                             <tr>
                                 <td>{{$key+1}} </td>
                                 <td>{{ $book->title }}</td>
                                 <td>
                                    <a href="{{ asset($book->image) }}" target="_black">
                                        <img src="{{ asset($book->image) }}" style="height: 60px;" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                                    </a>
                                 </td>
                                 <td>{{ $book->isbn }}</td>
                                 <td>{{ $book->author }}</td>
                                 <td>{{ $book->status }}</td>
                                <td class="td-actions">
                                    {{-- @can('admin-edit') --}}
                                    <a href="{{route('admin.manage-book.edit',[$book->id])}}"><i class="la la-edit"></i></a>
                                    <a href="{{route('admin.manage-book.show',[$book->id])}}"><i class="la la-eye"></i></a>
                                    {{-- @endcan --}}
                                    {{-- @can('admin-delete') --}}

                                    {{-- <form id="formData" method="GET" class="d-inline"> --}}
                                    {{-- <form action="{{ route('admin.manage-book.destroy',[$book->id]) }}" method="POST" onsubmit="return confirm('do you want to delete this?')" class="d-inline"> --}}
                                    <form id="delete" method="POST" class="d-inline">
                                        @csrf
                                        {{-- @method('delete'); --}}
                                        <input type="hidden" name="id" value="{{ $book->id }}">
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
                    url: "{{route('admin.manage-book.destroy','')}}" + '/' +id,
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

            