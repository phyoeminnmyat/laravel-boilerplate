@extends ('backend.layouts.app')

@section ('title', __('customer::labels.backend.customer.management') . ' | ' . __('customer::labels.backend.customer.edit'))

@section('breadcrumb-links')
    @include('customer::includes.breadcrumb-links')
@endsection

@push('after-styles')

@endpush

@section('content')
{{ html()->modelForm($customer, 'PATCH', route('admin.customer.update', $customer->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('customer::labels.backend.customer.management') }}
                        <small class="text-muted">{{ __('customer::labels.backend.customer.edit') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <div class="row mt-4 mb-4">
                <div class="col">
                    {{ html()->hidden('avatar_type','gravatar' )}}
                    {{ html()->hidden('avatar_location',null )}}
                    {{ html()->hidden('is_customer',1 )}}
                    
                    
                    <div class="form-group row">
                    {{ html()->label(__('customer::labels.backend.customer.table.name').' *')->class('col-md-2 form-control-label')->for('name') }}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('customer::labels.backend.customer.table.name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
                   
                    <div class="form-group row">
                    {{ html()->label(__('customer::labels.backend.customer.table.mobile').' *')->class('col-md-2 form-control-label')->for('mobile') }}

                        <div class="col-md-10">
                            {{ html()->text('mobile')
                                ->class('form-control')
                                ->placeholder(__('customer::labels.backend.customer.table.mobile'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                    {{ html()->label(__('customer::labels.backend.customer.table.fax'))->class('col-md-2 form-control-label')->for('fax') }}

                        <div class="col-md-10">
                            {{ html()->text('fax')
                                ->class('form-control')
                                ->placeholder(__('customer::labels.backend.customer.table.fax'))
                                ->attribute('maxlength', 191)
                             }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                    {{ html()->label(__('customer::labels.backend.customer.table.address').' *')->class('col-md-2 form-control-label')->for('address') }}

                        <div class="col-md-10">
                            {{ html()->textarea('address')
                                ->class('form-control')
                                ->placeholder(__('customer::labels.backend.customer.table.address'))
                            }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.timezone'))->class('col-md-2 form-control-label')->for('timezone') }}

                        <div class="col-md-10">
                            <select name="timezone" id="timezone" class="form-control" required="required">
                                @foreach (timezone_identifiers_list() as $timezone)
                                    <option value="{{ $timezone }}" {{ $timezone == config('app.timezone') ? 'selected' : '' }} {{ $timezone == $customer->user->timezone ? ' selected' : '' }}>{{ $timezone }}</option>
                                @endforeach
                            </select>
                        </div><!--col-->
                    </div><!--form-group-->

                    <h3>Account Informations</h3>
                    <input type="hidden" name="user_id" value="{{ $customer->user->id }}">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.email').' *')->class('col-md-2 form-control-label')->for('email') }}

                        <div class="col-md-10">
                            {{ html()->email('email')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.users.email'))
                                ->attribute('maxlength', 191)
                                ->value($customer->user->email)
                            }}
                        </div><!--col-->
                    </div><!--form-group-->
                    
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.customer.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection

@push('after-scripts')

<script>


</script>
@endpush