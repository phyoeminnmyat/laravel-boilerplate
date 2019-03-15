@can('create category')
<div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
    <a href="{{ route('admin.category.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="{{ __('category::menus.backend.category.create') }}"><i class="fas fa-plus-circle"></i></a>
</div>
<!--btn-toolbar-->
@endcan