@extends ('backend.layouts.app')

@section ('title', app_name() . ' | ' . __('appsetting::labels.backend.appsetting.management'))

@section('breadcrumb-links')
    @include('appsetting::includes.breadcrumb-links')
@endsection

@push('after-styles')
    {{ style("https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css") }}
    <style>
    .caption span {
        font-size: 1.5em;
        font-weight: 500;
    }
    </style>
@endpush

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('appsetting::labels.backend.appsetting.management') }}
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" href="#basic_setting" role="tab" aria-controls="basic_setting" aria-selected="true">
                        <i class="icon-energy"></i> Basic Setting</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#payment_setting" role="tab" aria-controls="payment_setting" aria-selected="true">
                        <i class="icon-energy"></i> Payment Setting</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active show" id="basic_setting" role="tabpanel">
                        {{ html()->form('POST', route('admin.appsetting.appstore'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
                            {!! html()->hidden('tab','basic') !!}

                            <div class="form-group row {{ $errors->has('main_logo') ? ' has-error' : '' }}">
                                {{ html()->label(__('appsetting::labels.backend.appsetting.basic.main_logo'))->class('col-md-2 form-control-label')->for('main_logo') }}
                             
                                <div class="col-md-10">
                                    <input type="file" value="{{ config('app.app_setting.main_logo') }}" id="main_logo" name="main_logo" class="form-control"><br>
                                    @if(config('app.app_setting.main_logo'))
                                        <img src="{{ config('app.app_setting.main_logo') }}" class="thumbnail"  style="width: 200px; height: 150px;">
                                    @endif
                                </div>
                            </div><br><br>
                              
                        
                            <div class="form-group row {{ $errors->has('app_favicon') ? ' has-error' : '' }}">
                                {{ html()->label(__('appsetting::labels.backend.appsetting.basic.fav_icon'))->class('col-md-2 form-control-label')->for('fav_icon') }}
                                <div class="col-md-10">
                                    <input type="file" value="{{ config('app.app_setting.favicon') }}" id="app_favicon" name="app_favicon" class="form-control"><br>
                                    @if(config('app.app_setting.favicon'))
                                        <img src="{{ config('app.app_setting.favicon') }}" class="thumbnail"  style="width: 200px; height: 150px;">
                                    @endif
                                </div>  
                            </div><br><br>


                            <div class="form-group row form-md-line-input">
                            
                                {{ html()->label(__('appsetting::labels.backend.appsetting.basic.app_name'))->class('col-md-2 form-control-label')->for('app_name') }}
                                <div class="col-md-10">
                                    {{-- <input type="text" value="{{ config('app.app_setting.name') }}" id="app_name" name="app_name" class="form-control"><br> --}}
                                    {{ html()->text('app_name')->value(config('app.app_setting.name'))->class('form-control')->id('app_name') }}
                                </div>
                            </div>

                            <div class="form-group row form-md-line-input">
                                {{ html()->label(__('appsetting::labels.backend.appsetting.basic.facebook_link'))->class('col-md-2 form-control-label')->for('facebook_link') }}
                                <div class="col-md-10">
                                    {{ html()->text('facebook')->value(config('app.app_setting.facebook'))->class('form-control')->id('facebook') }}
                                </div>
                            </div>

                            <div class="form-group row form-md-line-input">
                                {{ html()->label(__('appsetting::labels.backend.appsetting.basic.app_email'))->class('col-md-2 form-control-label')->for('app_email') }}
                                <div class="col-md-10">
                                    {{ html()->text('app_email')->value(config('app.app_setting.email'))->class('form-control')->id('app_email') }}
                                </div>
                            </div>

                             <div class="form-group row form-md-line-input">
                                {{ html()->label(__('appsetting::labels.backend.appsetting.basic.phone_number'))->class('col-md-2 form-control-label')->for('phone_number') }}
                                <div class="col-md-10">
                                    {{ html()->text('app_phone')->value(config('app.app_setting.phone'))->class('form-control')->id('app_phone') }}
                                </div>
                            </div>

                            <div class="form-group row form-md-line-input">
                                {{ html()->label(__('appsetting::labels.backend.appsetting.basic.address'))->class('col-md-2 form-control-label')->for('address') }}
                                <div class="col-md-10">
                                    {{ html()->textarea('app_address')->value(config('app.app_setting.address'))->class('form-control')->id('app_address') }}
                                </div>
                            </div>

                            <div class="form-group row form-md-line-input">
                            
                                {{ html()->label(__('appsetting::labels.backend.appsetting.basic.userenquiry_ref'))->class('col-md-2 form-control-label')->for('app_ref') }}
                                <div class="col-md-10">
                                    {{ html()->text('app_ref')->value(config('app.app_setting.app_ref'))->class('form-control')->id('app_ref') }}
                                </div>
                            </div>

                            <div class="form-group row form-md-line-input">
                            
                                {{ html()->label(__('appsetting::labels.backend.appsetting.basic.dollar_rate'))->class('col-md-2 form-control-label')->for('dollar_rate') }}
                                <div class="col-md-10">
                                    {{ html()->text('dollar_rate')->value(config('app.app_setting.dollar_rate'))->class('form-control')->id('dollar_rate') }}
                                </div>
                            </div>

                            <div class="form-group row form-md-line-input">
                                {{ html()->label(__('appsetting::labels.backend.appsetting.basic.google_map_api'))->class('col-md-2 form-control-label')->for('google_map_api') }}
                                <div class="col-md-10">
                                    {{ html()->text('google_map')->value(config('app.app_setting.map_key'))->class('form-control')->id('google_map') }}
                                </div>
                            </div>

                            <div class="form-group row form-md-line-input">
                                {{ html()->label(__('appsetting::labels.backend.appsetting.basic.meta_keywords'))->class('col-md-2 form-control-label')->for('meta_keywords') }}
                                <div class="col-md-10">
                                    {{ html()->textarea('meta_keywords')->value(config('app.app_setting.meta_keywords'))->class('form-control')->id('meta_keywords') }}
                                </div>
                            </div>

                            <div class="form-group row form-md-line-input">
                                {{ html()->label(__('appsetting::labels.backend.appsetting.basic.meta_description'))->class('col-md-2 form-control-label')->for('meta_description') }}
                                <div class="col-md-10">
                                    {{ html()->textarea('meta_description')->value(config('app.app_setting.meta_description'))->class('form-control')->id('meta_description') }}
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col text-right">
                                        {{ form_submit(__('buttons.general.crud.update')) }}
                                    </div><!--row-->
                                </div><!--row-->
                            </div><!--card-footer-->

                        {{ html()->closeModelForm() }}
                    </div>
                    <div class="tab-pane show" id="payment_setting" role="tabpanel">
                        {{ html()->form('POST', route('admin.appsetting.appstore'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
                            {!! html()->hidden('tab','payment') !!}

                            <div class="mb-5">
                                <div class="card card-accent-primary">
                                    @include('appsetting::includes.paypal')
                                </div>
                            </div>

                            <div class="mb-5">
                                <div class="card card-accent-primary">
                                    @include('appsetting::includes.mpu')
                                </div>
                            </div>
                            

                           {{--  <div class="mb-5">
                                <div class="card card-accent-primary">
                                    @include('appsetting::includes.truemoney')
                                </div>
                            </div> --}}

                            <div class="mb-5">
                                <div class="card card-accent-primary">
                                    @include('appsetting::includes.transfer')
                                </div>
                            </div>

                            <div class="mb-5">
                                <div class="card card-accent-primary">
                                    @include('appsetting::includes.onetwothree')
                                </div>
                            </div>

                            <div class="mb-5">
                                <div class="card card-accent-primary">
                                    @include('appsetting::includes.visa_master')
                                </div>
                            </div>

                            <div class="mb-5">
                                <div class="card card-accent-primary">
                                    @include('appsetting::includes.mab')
                                </div>
                            </div>

                            <div class="mb-5">
                                <div class="card card-accent-primary">
                                    @include('appsetting::includes.wave')
                                </div>
                            </div>

                            <div class="mb-5">
                                <div class="card card-accent-primary">
                                    @include('appsetting::includes.kbz_direct')
                                </div>
                            </div>

                            <div class="mb-5">
                                <div class="card card-accent-primary">
                                    @include('appsetting::includes.cb')
                                </div>
                            </div>

                            <div class="mb-5">
                                <div class="card card-accent-primary">
                                    @include('appsetting::includes.offline_sale')
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col text-right">
                                        {{ form_submit(__('buttons.general.crud.update')) }}
                                    </div><!--row-->
                                </div><!--row-->
                            </div><!--card-footer-->

                        {{ html()->closeModelForm() }}
                    </div>
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection

@push('after-scripts')
    <script type="text/javascript">
        

        $(document).ready(function() {
            $('demo').minicolors();
            $('.demo').each(function() {
                //
                // Dear reader, it's actually very easy to initialize MiniColors. For example:
                //
                //  $(selector).minicolors();
                //
                // The way I've done it below is just for the demo, so don't get confused
                // by it. Also, data- attributes aren't supported at this time...they're
                // only used for this demo.
                //
                $(this).minicolors({
                    control: $(this).attr('data-control') || 'hue',
                    defaultValue: $(this).attr('data-defaultValue') || '',
                    inline: $(this).attr('data-inline') === 'true',
                    letterCase: $(this).attr('data-letterCase') || 'lowercase',
                    opacity: $(this).attr('data-opacity'),
                    position: $(this).attr('data-position') || 'bottom left',
                    change: function(hex, opacity) {
                        if (!hex) return;
                        if (opacity) hex += ', ' + opacity;
                        if (typeof console === 'object') {
                            console.log(hex);
                        }
                    },
                    theme: 'bootstrap'
                });

            });

            $('#restore_setting').click(function () {

                swal({
                      title: 'Are you sure?',
                      text: "You are going to restore the default setting of App Setting!",
                      type: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Yes, restore it!',
                      cancelButtonText: 'No, cancel plx!',
                    }).then((result) => {
                      if (result.value) {
                            $.ajax({
                                    type: 'get',
                                    url: '{{ route('admin.appsetting.restore') }}',
                                    data: '',
                                    success: function (data, textStatus, jQxhr) {
                                        swal("Success", "Successfully restored!)", "success");
                                        location.reload();
                                    }
                            });
                        }
                        else{
                            swal("Cancelled", "You cancelled the action!)", "error");
                        }
                });
            });
        });
    </script>
@endpush