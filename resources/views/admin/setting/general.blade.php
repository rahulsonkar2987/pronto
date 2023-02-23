@extends('admin.layout.app')

{{-- @section('css')
<style>
    a.button {
    -webkit-appearance: button;
    -moz-appearance: button;
    appearance: button;

    text-decoration: none;
    color: initial;
}

</style>
@endsection --}}
@section('data-section');       
    <div class="content-inner">
        <div class="container-fluid">

            {{-- breadcrumb start here  --}}
            <div class="row">
                <div class="page-header">
                    <div class="d-flex align-items-center">
                        <h2 class="page-header-title">Settings</h2>
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
                            {{-- general mene start her  --}}
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                  <a class="nav-item nav-link {{$action == 'general'?'active':'' }}"  data-toggle="tab" href="#general" >General</a>
                                  <a class="nav-item nav-link {{$action== 'logo' ? 'active' : ''  }} "  data-toggle="tab" href="#logo" >Logos</a>
                                  <a class="nav-item nav-link {{$action== 'mail_config' ? 'active' : ''  }}"  data-toggle="tab" href="#mail_configration" >Mail Configuration</a>
                                  <a class="nav-item nav-link {{$action== 'payment_config' ? 'active' : ''  }}"  data-toggle="tab" href="#payment_settings" >Payment Configuration</a>
                                  <a class="nav-item nav-link" {{ $action=='mode_setting' ? 'active' : '' }} data-toggle="tab" href="#mode_setting">Webisite Mode</a>
                                  <a class="nav-item nav-link" {{ $action=='page_seo' ? 'active' : '' }} data-toggle="tab" href="#page_seo">Page Seo</a>
                                  <a class="nav-item nav-link" {{ $action=='api_key' ? 'active' : '' }} data-toggle="tab" href="#api_key">Webisite Api Key</a>
                                </div>
                            </nav>
                            {{-- general mene end her  --}}
                        </h4>

                        <div class="tab-content" id="nav-tabContent" style="font-size: 16px;" >
                        
                            {{-- general setting start here  --}}
                            <div class="tab-pane fade {{$action=='general' ? 'show active' : '' }}" id="general" role="tabpanel" >
                                {{-- form start here  --}}
                                <form class='formData' action="{{ route('admin.setting.general.update',['general']) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <div class="row mx-5 mt-4 mb-4" > 
                                        <div class="col ">
                                            <div class="form-group row">
                                                <label class="col-md-2  text-secondary d-flex align-items-center" for="app_name">App Name</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" name="app_name" value="{{ $config->where('key','app_name')->first()->value }}"  placeholder="App Name" >
                                                    @error('app_name') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                
                                            <div class="form-group row mt-4">
                                                <label class="col-md-2 text-secondary d-flex align-items-center" for="app_url">App URL</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" name="app_url"  value="{{ $config->where('key','app_url')->first()->value }}" placeholder="App URL">
                                                    @error('app_url') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="card-footer mt-5">
                                                <div class="row">
                                                    <div class="col">
                                                        <a class="btn btn-danger" href="{{ route('admin.setting.general.index',['general']) }}">Cancel</a>
                                                    </div>
                                                    <div class="col text-right">
                                                        <input type="submit" class="btn btn-danger submitForm" value="Update">
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- button end her  --}}
                                        </div>
                                    </div>
                                </form>
                                {{-- form end here  --}}
                            </div>
                            {{-- general setting end here  --}}

                            <div class="tab-pane fade {{ $action=='logo' ? 'show active' : '' }}" id="logo" role="tabpanel" >
                                {{-- log form start here  --}}
                                <form class='formData' action="{{ route('admin.setting.general.update',['logo']) }}" method="POST" enctype="multipart/form-data">
                                    @csrf @method('PATCH')
                                    <div class="row mx-5 mt-4 mb-4" > 
                                        <div class="col ">
                                            <div class="form-group row">
                                                <label class="col-md-2  text-secondary d-flex align-items-center" for="app_name">Logo</label>
                                                <div class="col-md-10">
                                                    <input type="file" class="form-control upload_file" name="image" >
                                                    <img id="image"  src="{{ asset($config->where('key','logo')->first()->value) }}" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                                                </div>
                                            </div>
                
                                            <div class="form-group row mt-4">
                                                <label class="col-md-2 text-secondary d-flex align-items-center" for="favicon">Favicon</label>
                                                <div class="col-md-10">
                                                    <input class="form-control upload_file2 mb-2" type="file" name="image2"  value="{{ $config->where('key','favicon')->first()->value }}" placeholder="Favicon">
                                                    <img id="image2"  src="{{ asset($config->where('key','favicon')->first()->value) }}" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                                                </div>
                                            </div>
                                            <div class="card-footer mt-5">
                                                <div class="row">
                                                    <div class="col">
                                                        <a class="btn btn-danger" href="{{ route('admin.setting.general.index',['general']) }}">Cancel</a>
                                                    </div>
                                                    <div class="col text-right">
                                                        <input type="submit" class="btn btn-danger submitForm" value="Update">
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- button end her  --}}
                                        </div>
                                    </div>
                                </form>
                                {{-- log form end here  --}}
                            </div>

                            {{-- mail confi setting start here  --}}
                            <div class="tab-pane fade {{$action=='mail_config' ? 'show active' : '' }}" id="mail_configration" role="tabpanel" >
                                {{-- form start here  --}}
                                <form class='formData' action="{{ route('admin.setting.general.update',['mail_configration']) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <div class="row mx-5">
                                        <div class="col ">
                                            <div class="form-group row mt-4">
                                                <label class="col-md-2 text-secondary d-flex align-items-center" for="mail_mailer">{{ ln('mail_mailer','ucwords') }}</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" name="mail_mailer" value="{{ $mail_config->mail_mailer }}"  placeholder="{{ ln('mail_mailer','ucwords') }}" >
                                                    @error('mail_mailer') <span class="text-danger">{{ $message }}</span> @enderror
                                                    <span>You can select any driver you want for your Mail setup. <b class="text-dark">Ex. SMTP, Mailgun, Mandrill, SparkPost, Amazon SES etc.
                                                        Add single driver only.</b></span>
                                                    
                                                </div>
                                            </div>
                
                                            <div class="form-group row mt-4">
                                                <label class="col-md-2 text-secondary d-flex align-items-center" for="mail_host">{{ ln('mail_host','ucwords') }}</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" name="mail_host" value="{{ $mail_config->mail_host }}"  placeholder="{{ ln('mail_host','ucwords') }}" >
                                                    @error('mail_host') <span class="text-danger">{{ $message }}</span> @enderror
                                                    
                                                </div>
                                            </div>

                                            <div class="form-group row mt-4">
                                                <label class="col-md-2 text-secondary d-flex align-items-center" for="mail_port">{{ ln('mail_port','ucwords') }}</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" name="mail_port" value="{{ $mail_config->mail_port }}"  placeholder="{{ ln('mail_port','ucwords') }}" >
                                                    @error('mail_port') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row mt-4">
                                                <label class="col-md-2 text-secondary d-flex align-items-center" for="mail_username">{{ ln('mail_username','ucwords') }}</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" name="mail_username" value="{{ $mail_config->mail_username }}"  placeholder="{{ ln('mail_username','ucwords') }}" >
                                                    @error('mail_username') <span class="text-danger">{{ $message }}</span> @enderror
                                                    <span>Add your email id you want to configure for sending emails</span>
                                                </div>
                                            </div>

                                            <div class="form-group row mt-4">
                                                <label class="col-md-2 text-secondary d-flex align-items-center" for="mail_password">{{ ln('mail_password','ucwords') }}</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" name="mail_password" value="{{ $mail_config->mail_password }}"  placeholder="{{ ln('mail_password','ucwords') }}" >
                                                    @error('mail_password') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row mt-4">
                                                <label class="col-md-2 text-secondary d-flex align-items-center" for="mail_encryption">{{ ln('mail_encryption','ucwords') }}</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" name="mail_encryption" value="{{ $mail_config->mail_encryption }}"  placeholder="{{ ln('mail_encryption','ucwords') }}" >
                                                    @error('mail_encryption') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row mt-4">
                                                <label class="col-md-2 text-secondary d-flex align-items-center" for="mail_from_address">{{ ln('mail_from_address','ucwords') }}</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" name="mail_from_address" value="{{ $mail_config->mail_from_address }}"  placeholder="{{ ln('mail_from_address','ucwords') }}" >
                                                    @error('mail_from_address') <span class="text-danger">{{ $message }}</span> @enderror
                                                    <span>This email will be used for "Contact Form" correspondence.</span>
                                                </div>
                                            </div>

                                            <div class="form-group row mt-4">
                                                <label class="col-md-2 text-secondary d-flex align-items-center" for="mail_from_name">{{ ln('mail_from_name','ucwords') }}</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" name="mail_from_name" value="{{ $mail_config->mail_from_name }}"  placeholder="{{ ln('mail_from_name','ucwords') }}" >
                                                    @error('mail_from_name') <span class="text-danger">{{ $message }}</span> @enderror
                                                    <span>This will be display name for your sent email.</span>
                                                </div>
                                            </div>


                                            <div class="card-footer mt-5">
                                                <div class="row">
                                                    <div class="col">
                                                        <a class="btn btn-danger" href="{{ route('admin.setting.general.index',['mail_config']) }}">Cancel</a>
                                                    </div>
                                                    <div class="col text-right">
                                                        <input type="submit" class="btn btn-danger submitForm" value="Update">
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- button end her  --}}
                                        </div>
                                    </div>
                                </form>
                                {{-- form end here  --}}
                            </div>
                            {{-- mail config setting end here  --}}

                            {{-- payment config setting start here  --}}
                            <div id="payment_settings" class="tab-pane container fade {{$action=='payment_config' ? 'show active' : '' }}" >
                                <form class='formData' action="{{ route('admin.setting.general.update',['payment_config']) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <div class="row mt-4 mb-4">
                                        <div class="col">
                                        
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="payumoney_active">Pay U moneny Payment Method</label>
                                                <div class="col-md-9">
                                                    <div class="checkbox">
                                                        <label class="switch switch-sm switch-3d switch-primary">
                                                            <input class="switch-input" type="checkbox" name="payumoney_active"  value="1" {{ $apiConfig->where('key','payumoney_api')->first()->status=='1' ? 'checked' : ''  }}>
                                                            <span class="switch-label"></span><span class="switch-handle"></span>
                                                        </label>
                                                        {{-- <a class="float-right font-weight-bold font-italic" href="https://stripe.com/docs/keys" target="_blank">How to get STRIPE API Credentials?</a> --}}
                                                    </div>
                                                    <small>
                                                        <i> Enables payments in site with Debit / Credit Cards</i>
                                                    </small>
                                                    <div class="switch-content {{ $apiConfig->where('key','payumoney_api')->first()->status=='0' ? 'd-none' : ''  }} ">
                                                        <br>
                                                        <div class="form-group row">
                                                            <label class="col-md-2 form-control-label" for="payu_money_client_id">API Key</label>
                                                            <div class="col-md-8 col-xs-12">
                                                                <input class="form-control" type="text" name="payu_money_client_id" id="services__stripe__key" value="{{ $apiConfig->where('key','payumoney_api')->first()->client_id }}">
                                                            </div><!--col-->
                                                        </div><!--form-group-->
                                                        <div class="form-group row">
                                                            <label class="col-md-2 form-control-label" for="payu_monney_secret">API Secret</label>
                                                            <div class="col-md-8 col-xs-12">
                                                                <input class="form-control" type="text" name="payu_monney_secret"  value="{{ $apiConfig->where('key','payumoney_api')->first()->client_secret_id }}">
                                                            </div><!--col-->
                                                        </div><!--form-group-->
                                                    </div>
                                                </div><!--col-->
                                            </div><!--form-group-->
                                            <div class="card-footer mt-5">
                                                <div class="row">
                                                    <div class="col">
                                                        <a class="btn btn-danger" href="{{ route('admin.setting.general.index',['mail_config']) }}">Cancel</a>
                                                    </div>
                                                    <div class="col text-right">
                                                        <input type="submit" class="btn btn-danger submitForm" value="Update">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                            {{-- payment config setting end here --}}

                            {{-- mode setting start here  --}}
                            <div id='mode_setting' class="tab-pane container fade {{ $action=='mode_setting' ? 'show active' : '' }}">
                                <form class='formData' action="{{ route('admin.setting.general.update',['mode_setting']) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <div class="form-group row" > 
                                        <div class="col ">
                                            <div class="form-group row">
                                                <label class="col-md-3  text-secondary d-flex align-items-center" for="website_mode">Website maintenance mode</label>
                                                <div class="checkbox">
                                                    <label class="switch switch-sm switch-3d switch-primary">
                                                        <input class="switch-input" type="checkbox" name="website_mode"  value="1" {{ $config->where('key','website_mode')->first()->value=='on' ? 'checked' : ''  }}>
                                                        <span class="switch-label"></span><span class="switch-handle"></span>
                                                    </label>
                                                </div>
                                            </div>
                
                                            <div class="card-footer mt-5">
                                                <div class="row">
                                                    <div class="col">
                                                        <a class="btn btn-danger" href="{{ route('admin.setting.general.index',['general']) }}">Cancel</a>
                                                    </div>
                                                    <div class="col text-right">
                                                        <input type="submit" class="btn btn-danger submitForm" value="Update">
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- button end her  --}}
                                        </div>
                                    </div>
                                </form>
                            </div>
                            {{-- mode setting end here  --}}

                            {{-- page seo setting start here  --}}
                            <div class="tab-pane fade {{$action=='page_seo' ? 'show active' : '' }}" id="page_seo" role="tabpanel" >
                                {{-- form start here  --}}
                                <form class='formData' action="{{ route('admin.setting.general.update',['page_seo']) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <div class="row mx-5">
                                        <div class="col ">
                                            <div class="form-group row mt-4">
                                                <label class="col-md-2 text-secondary d-flex align-items-center" for="title">{{ ln('title','ucwords') }}</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" name="title" value="{{ $pageSeo->title }}"  placeholder="{{ ln('title','ucwords') }}" >
                                                </div>
                                            </div>
                
                                            <div class="form-group row mt-4">
                                                <label class="col-md-2 text-secondary d-flex align-items-center" for="meta_title">{{ ln('meta_title','ucwords') }}</label>
                                                <div class="col-md-10">
                                                    <textarea  class="form-control" type="text" name="meta_title" placeholder="{{ ln('meta_title','ucwords') }}" cols="30" rows="4">{{ $pageSeo->meta_title }}</textarea>
                                                    @error('meta_title') <span class="text-danger">{{ $message }}</span> @enderror
                                                    
                                                </div>
                                            </div>

                                            <div class="form-group row mt-4">
                                                <label class="col-md-2 text-secondary d-flex align-items-center" for="meta_keywords">{{ ln('meta_keywords','ucwords') }}</label>
                                                <div class="col-md-10">
                                                    <textarea  class="form-control" type="text" name="meta_keywords" placeholder="{{ ln('meta_keywords','ucwords') }}" cols="30" rows="4">{{ $pageSeo->meta_keywords }}</textarea>
                                                    @error('meta_keywords') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row mt-4">
                                                <label class="col-md-2 text-secondary d-flex align-items-center" for="meta_description">{{ ln('meta_description','ucwords') }}</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control" type="text" name="meta_description"  placeholder="{{ ln('meta_description','ucwords') }}"  cols="30" rows="6">{{ $pageSeo->meta_description }}</textarea>
                                                    @error('meta_description') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row mt-4">
                                                <label class="col-md-2 text-secondary d-flex align-items-center" for="status">{{ ln('status','ucwords') }}</label>
                                                <div class="col-md-10">
                                                    <select class="form-control" name="status" id="">
                                                        <option value=" ">--Select One --</option>
                                                        <option value="1" {{ $pageSeo->status =='1' ? 'selected' :'' }}>Active</option>
                                                        <option value="0" {{ $pageSeo->status =='0' ? 'selected' :'' }}>Inactive</option>
                                                    </select>
                                                    @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="card-footer mt-5">
                                                <div class="row">
                                                    <div class="col">
                                                        <a class="btn btn-danger" href="{{ route('admin.setting.general.index',['mail_config']) }}">Cancel</a>
                                                    </div>
                                                    <div class="col text-right">
                                                        <input type="submit" class="btn btn-danger submitForm" value="Update">
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- button end her  --}}
                                        </div>
                                    </div>
                                </form>
                                {{-- form end here  --}}
                            </div>
                            {{-- page seo config setting end here  --}}


                            {{-- web key start here  --}}
                            <div id='api_key' class="tab-pane container fade {{ $action=='api_key' ? 'show active' : '' }}">
                                <form action="{{ route('admin.setting.general.update',['api_key']) }}"  method="POST">
                                    @csrf @method('patch');
                                    <div class="form-group row" > 
                                        <div class="col ">
                                            <div class="form-group row">
                                                <label class="col-md-3  text-secondary d-flex align-items-center" for="api_key">Api key</label>
                                                <span>{{ $config->where('key','api_key')->first()->value }}</span>
                                                <button onclick="return confirm('Are you sure generate new api key')" class="btn" style="background: none"><i class="fa fa-refresh generate_new_key"></i></button>
                                            </div>
                                            {{-- button end her  --}}
                                        </div>
                                    </div>
                                </form>
                            </div>
                            {{-- web key end here  --}}
                            
                            
                        </div>

                           
               


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

            