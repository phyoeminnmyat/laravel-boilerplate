@extends ('backend.layouts.app')

@section ('title', __('email::labels.backend.email.management'))

@section('breadcrumb-links')
    @include('email::includes.breadcrumb-links')
@endsection

@push('after-styles')

@endpush

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('email::labels.backend.email.management') }}
                    <small class="text-muted">{{ __('email::labels.backend.email.show') }}</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong>{{ __('email::labels.backend.email.table.created') }}:</strong> {{ $email->updated_at->timezone(get_user_timezone()) }} ({{ $email->created_at->diffForHumans() }}),
                    <strong>{{ __('email::labels.backend.email.table.last_updated') }}:</strong> {{ $email->created_at->timezone(get_user_timezone()) }} ({{ $email->updated_at->diffForHumans() }})
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