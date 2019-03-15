@extends ('backend.layouts.app')

@section ('title', __('customer::labels.backend.customer.management'))

@section('breadcrumb-links')
    @include('customer::includes.breadcrumb-links')
@endsection

@push('after-styles')

@endpush

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('customer::labels.backend.customer.management') }}
                    <small class="text-muted">{{ __('customer::labels.backend.customer.show') }}</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th>{{ __('customer::labels.backend.customer.table.name') }}</th>
                            <td>{{ $customer->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('customer::labels.backend.customer.table.customer_id') }}</th>
                            <td>{{ $customer->customer_id }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('customer::labels.backend.customer.table.mobile') }}</th>
                            <td>{{ $customer->mobile }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('customer::labels.backend.customer.table.fax') }}</th>
                            <td>{{ $customer->fax }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('customer::labels.backend.customer.table.address') }}</th>
                            <td>{!! $customer->address !!}</td>
                        </tr>
                    </table>
                    <h3>Account Informations</h3>
                    <table class="table table-hover">
                        <tr>
                            <th>{{ __('labels.backend.access.users.table.email') }}</th>
                            <td>{{ $customer->user->email }}</td>
                        </tr>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong>{{ __('customer::labels.backend.customer.table.created') }}:</strong> {{ $customer->updated_at->timezone(get_user_timezone()) }} ({{ $customer->created_at->diffForHumans() }}),
                    <strong>{{ __('customer::labels.backend.customer.table.last_updated') }}:</strong> {{ $customer->created_at->timezone(get_user_timezone()) }} ({{ $customer->updated_at->diffForHumans() }})
                </small>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-footer-->
</div><!--card-->
@endsection

@push('after-scripts')

<script>


</script>
@endpush