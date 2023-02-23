@extends('admin.layout.app')

@section('data-section');       
    <div class="content-inner">
        <div class="container-fluid">

            {{-- breadcrumb start here  --}}
            <div class="row">
                <div class="page-header">
                    <div class="d-flex align-items-center">
                        <h2 class="page-header-title">Social Settings</h2>
                        <div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="ti ti-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                                <li class="breadcrumb-item">User</li>
                                <li class="breadcrumb-item active">View</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card text-left">
                      <div class="card-body">
                        <h4 class="card-title pb-4">
                            {{-- <a href="{{route('admin.user.create')}}" class="btn btn-primary">Add New</a> --}}
                        </h4>
                        <form action="{{ route('admin.setting.social.update') }}" method="post">
                            @csrf
                            @method('PATCH')
                            {{-- facebook api start here  --}}
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="services.facebook.active">Facebook Login Status</label>
                                <div class="col-md-10">
                                    <div class="checkbox">
                                        <label class="switch switch-sm switch-3d switch-primary">
                                            <input class="switch-input" data-toggle="toggle" type="checkbox" name="facebook_active" value="1" {{ $facebook->status=='1' ? 'checked' : '' }}>
                                        </label>
                                        <a class="float-right font-weight-bold font-italic" target="_blank" href="https://developers.facebook.com/apps/">How to get Facebook API Credentials?</a>
                                    </div>
                                    <small><i> Enable / disable facebook login for website</i></small>
                                    <div class="switch-content {{ $facebook->status==0 ? 'd-none' : '' }}">
                                        <br>
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="facebook_client_id">Client ID</label>
                                            <div class="col-md-6 col-xs-12">
                                                <input class="form-control" type="text" name="facebook_client_id"  value="{{ old('facebook_client_id') ?? $facebook->client_id }}">
                                                @error('facebook_client_id') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div><!--col-->
                                        </div><!--form-group-->
        
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="facebook_client_secret">Client Secret</label>
                                            <div class="col-md-6 col-xs-12">
                                                <input class="form-control" type="text" name="facebook_client_secret"  value="{{ old('facebook_client_secret') ?? $facebook->client_secret_id }}">
                                                @error('facebook_client_secret') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div><!--col-->
                                        </div><!--form-group-->
        
                                    </div>
                                </div><!--col-->
                            </div>
                            {{-- gmail google api start her  --}}
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="google_active">Google Login Status</label>
                                <div class="col-md-10">
                                    <div class="checkbox">
                                        <label class="switch switch-sm switch-3d switch-primary">
                                            <input class="switch-input" type="checkbox" name="google_active" id="services__google__active" value="1" {{ $google->status=='1' ? 'checked' : ''  }}>
                                            <span class="switch-label"></span><span class="switch-handle"></span>
                                        </label>
                                        <a class="float-right font-weight-bold font-italic" target="_blank" href="https://console.developers.google.com/apis">How to get Google API Credentials?</a>
                                    </div>
                                    <small><i> Enable / disable Google login for website</i></small>
                                    <div class="switch-content {{ $google->status==0 ? 'd-none' : '' }}">
                                        <br>
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="google_client_id">Client ID</label>
                                            <div class="col-md-6 col-xs-12">
                                                <input class="form-control" type="text" name="google_client_id"  value="{{ old('google_client_id') ?? $google->client_id }}">
                                                @error('google_client_id') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div><!--col-->
                                        </div><!--form-group-->
        
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="services.google.client_secret">Client Secret</label>
                                            <div class="col-md-6 col-xs-12">
                                                <input class="form-control" type="text" name="google_client_secret" value="{{ old('google_client_secret') ?? $google->client_secret_id }}">
                                                @error('google_client_secret') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div><!--col-->
                                        </div><!--form-group-->
                                    </div>
                                </div><!--col-->
                            </div>

                            {{-- {{ map google api start her }} --}}
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="google_active">Google Map Status</label>
                                <div class="col-md-10">
                                    <div class="checkbox">
                                        <label class="switch switch-sm switch-3d switch-primary">
                                            <input class="switch-input" type="checkbox" name="google_map_active"  value="1" {{ $google_map->status=='1' ? 'checked' : ''  }}>
                                            <span class="switch-label"></span><span class="switch-handle"></span>
                                        </label>
                                        <a class="float-right font-weight-bold font-italic" target="_blank" href="https://console.developers.google.com/apis">How to get Google API Credentials?</a>
                                    </div>
                                    <small><i> Enable / disable Map google login for website</i></small>
                                    <div class="switch-content {{ $google_map->status==0 ? 'd-none' : '' }}">
                                        <br>
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="google_client_id">Client ID</label>
                                            <div class="col-md-6 col-xs-12">
                                                <input class="form-control" type="text" name="google_map_client_id"  value="{{ old('google_map_client_id') ?? $google_map->client_id }}">
                                                @error('google_map_client_id') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div><!--col-->
                                        </div><!--form-group-->
        
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="">Client Secret</label>
                                            <div class="col-md-6 col-xs-12">
                                                <input class="form-control" type="text" name="google_map_client_secret" value="{{ old('google_map_client_secret') ?? $google_map->client_secret_id }}">
                                                @error('google_map_client_secret') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div><!--col-->
                                        </div><!--form-group-->
                                    </div>
                                </div><!--col-->
                            </div>

                            {{-- {{ isbn api start her }} --}}
                            <div class="form-group row">
                                <label class="col-md-2 form-control-label" for="google_active">ISBN  Status</label>
                                <div class="col-md-10">
                                    <div class="checkbox">
                                        <label class="switch switch-sm switch-3d switch-primary">
                                            <input class="switch-input" type="checkbox" name="isbn_active"  value="1" {{ $isbn->status=='1' ? 'checked' : ''  }}>
                                            <span class="switch-label"></span><span class="switch-handle"></span>
                                        </label>
                                        <a class="float-right font-weight-bold font-italic" target="_blank" href="https://isbndb.com/apidocs/v2">How to get ISBN  API Credentials?</a>
                                    </div>
                                    <small><i> Enable / disable ISBN login for website</i></small>
                                    <div class="switch-content {{ $isbn->status==0 ? 'd-none' : '' }}">
                                        <br>
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="">Client ID</label>
                                            <div class="col-md-6 col-xs-12">
                                                <input class="form-control" type="text" name="isbn_client_id"  value="{{ old('isbn_client_id') ?? $isbn->client_id }}">
                                                @error('isbn_client_id') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div><!--col-->
                                        </div><!--form-group-->
        
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="">Client Secret</label>
                                            <div class="col-md-6 col-xs-12">
                                                <input class="form-control" type="text" name="isbn_client_secret" value="{{ old('isbn_client_secret') ?? $isbn->client_secret_id }}">
                                                @error('isbn_client_secret') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div><!--col-->
                                        </div><!--form-group-->
                                    </div>
                                </div><!--col-->
                            </div>

                            
                            <div class="row justify-content-end pr-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>  

                        </form>


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


        $(document).on('click', '.switch-input', function (e) {
            var content = $(this).parents('.checkbox').siblings('.switch-content');
            if (content.hasClass('d-none')) {
                $(this).attr('checked', 'checked');
                // content.find('input').attr('required', true);
                content.removeClass('d-none');
            } else {
                content.addClass('d-none');
                // content.find('input').attr('required', false);
            }
        })


    });
    
</script>

@endsection

            