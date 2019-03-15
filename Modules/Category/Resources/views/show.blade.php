@extends ('backend.layouts.app')

@section ('title', __('category::labels.backend.category.management'))

@section('breadcrumb-links')
    @include('category::includes.breadcrumb-links')
@endsection

@push('after-styles')

@endpush

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('category::labels.backend.category.management') }}
                    <small class="text-muted">{{ __('category::labels.backend.category.show') }}</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4 mb-4">
            <div class="col">
                <table class="table table-hover">
                        <tr>
                            <th>{{ __('category::labels.backend.category.table.name') }}</th>
                            <td>{{ $category->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('category::labels.backend.category.table.description') }}</th>
                            <td>{{ $category->description }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('category::labels.backend.category.table.status') }}</th>
                            <td>
                                @if($category->status)
                                   <label class="badge badge-success">Active</label>
                                @else
                                    <label class="badge badge-danger">Inactive</label>
                                @endif
                            </td>
                        </tr>
                        
                </table>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->

    <div class="card-footer">
        <div class="row">
            <div class="col">
                <small class="float-right text-muted">
                    <strong>{{ __('category::labels.backend.category.table.created') }}:</strong> {{ $category->updated_at->timezone(get_user_timezone()) }} ({{ $category->created_at->diffForHumans() }}),
                    <strong>{{ __('category::labels.backend.category.table.last_updated') }}:</strong> {{ $category->created_at->timezone(get_user_timezone()) }} ({{ $category->updated_at->diffForHumans() }})
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