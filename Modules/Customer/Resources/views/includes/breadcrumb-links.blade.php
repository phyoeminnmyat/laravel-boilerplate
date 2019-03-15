<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('customer::menus.backend.customer.main') }}</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.customer.index') }}">{{ __('customer::menus.backend.customer.all') }}</a>
                @can('create customer')
                <a class="dropdown-item" href="{{ route('admin.customer.create') }}">{{ __('customer::menus.backend.customer.create') }}</a>
                @endcan
                <a class="dropdown-item" href="{{ route('admin.customer.deactivated') }}">{{ __('customer::menus.backend.customer.deactivated') }}</a>
                <a class="dropdown-item" href="{{ route('admin.customer.deleted') }}">{{ __('customer::menus.backend.customer.deleted') }}</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>