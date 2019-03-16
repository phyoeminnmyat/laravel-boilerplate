@extends ('backend.layouts.app')

@section ('title', __('category::labels.backend.category.management') . ' | ' . __('category::labels.backend.category.create'))

@section('breadcrumb-links')
    @include('category::includes.breadcrumb-links')
@endsection

@push('after-styles')

@endpush

@section('content')
{{ html()->form('POST', route('admin.category.store'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('category::labels.backend.category.management') }}
                        <small class="text-muted">{{ __('category::labels.backend.category.create') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4 mb-4">
                <div class="col">

                    <div class="form-group row">
                    {{ html()->label(__('category::labels.backend.category.table.name'))->class('col-md-2 form-control-label')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('category::labels.backend.category.table.name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                    {{ html()->label(__('category::labels.backend.category.table.email'))->class('col-md-2 form-control-label')->for('email') }}

                        <div class="col-md-10">
                            {{ html()->text('email')
                                ->class('form-control')
                                ->placeholder(__('category::labels.backend.category.table.email'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                    {{ html()->label(__('category::labels.backend.category.table.description'))->class('col-md-2 form-control-label')->for('description') }}

                        <div class="col-md-10">
                            {{ html()->textarea('description')
                                ->class('form-control summer_note')
                                ->placeholder(__('category::labels.backend.category.table.description'))
                                }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                            {{ html()->label(__('category::labels.backend.category.table.status').' *')->class('col-md-2 form-control-label')->for('status') }}

                                <div class="col-md-10">
                                    <label class="switch switch-label switch-pill switch-primary">
                                        {{ html()->checkbox('status', true, '1')->class('switch-input') }}
                                        <span class="switch-slider" data-checked="yes" data-unchecked="no"></span>
                                    </label>
                                </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                            {{ html()->label(__('category::labels.backend.category.table.logo').' *')->class('col-md-2 form-control-label')->for('logo') }}

                                <div class="col-md-10">
                                    {{ html()->file('logo')}}
                                </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.category.index'), __('buttons.general.cancel')) }}
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

<script>
$(document).ready( function () {

    $('.summer_note').summernote({
        height: 300
    });
});

</script>
@endpush