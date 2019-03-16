@extends ('backend.layouts.app')

@section ('title', __('email::labels.backend.email.management') . ' | ' . __('email::labels.backend.email.create'))

@section('breadcrumb-links')
    @include('email::includes.breadcrumb-links')
@endsection

@push('after-styles')
<!-- <link rel="stylesheet" type="text/css" href="/assets/bootstrap-summernote/css/summernote.css"> -->
@endpush

@section('content')
{{ html()->form('POST', route('admin.email.store'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('email::labels.backend.email.management') }}
                        <small class="text-muted">{{ __('email::labels.backend.email.create') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4 mb-4">
                <div class="col">

                    <div class="form-group row">
                    {{ html()->label(__('email::labels.backend.email.table.type'))->class('col-md-2 form-control-label')->for('type')}}
                        <div class="col-md-10">
                            <select class="form-control select2" name="type" data-live-search="true" >
                              <option value="web" selected>Web</option>
                              <option value="mobile">Mobile</option>
                            </select>
                        </div>
                    </div><!--form-group-->
                    
                    <div class="form-group row">
                    {{ html()->label('Name')->class('col-md-2 form-control-label')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder('Name')
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                    {{ html()->label(__('email::labels.backend.email.table.subject'))->class('col-md-2 form-control-label')->for('subject') }}

                        <div class="col-md-10">
                            {{ html()->text('subject')
                                ->class('form-control')
                                ->placeholder(__('email::labels.backend.email.table.subject'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                    {{ html()->label(__('email::labels.backend.email.table.ledgen'))->class('col-md-2 form-control-label')->for('ledgen') }}

                        <div class="col-md-10">
                            {{ html()->text('ledgen')
                                ->class('form-control')
                                ->placeholder(__('email::labels.backend.email.table.ledgen'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                    {{ html()->label(__('email::labels.backend.email.table.content'))->class('col-md-2 form-control-label')->for('content') }}

                        <div class="col-md-10">
                            {{ html()->textarea('content')
                                ->class('form-control summer_note')
                                ->placeholder(__('email::labels.backend.email.table.content'))
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                    {{ html()->label(__('email::labels.backend.email.table.mm_subject'))->class('col-md-2 form-control-label')->for('mm_subject') }}

                        <div class="col-md-10">
                            {{ html()->text('mm_subject')
                                ->class('form-control')
                                ->placeholder(__('email::labels.backend.email.table.mm_subject'))
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                    {{ html()->label(__('email::labels.backend.email.table.mm_content'))->class('col-md-2 form-control-label')->for('mm_content') }}

                        <div class="col-md-10">
                            {{ html()->textarea('mm_content')
                                ->class('form-control summer_note')
                                ->placeholder(__('email::labels.backend.email.table.mm_content'))
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.email.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection

@push('after-scripts')
<!-- <script src="/assets/bootstrap-summernote/js/summernote.min.js"></script> -->
<script>

$(document).ready( function () {
    $('.select2').select2();

    $('.summer_note').summernote({
        height: 300
    });
});
</script>
@endpush