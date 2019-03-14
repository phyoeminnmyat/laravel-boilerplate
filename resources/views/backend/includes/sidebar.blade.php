<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                @lang('menus.backend.sidebar.general')
            </li>
            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/dashboard')) }}" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon icon-speedometer"></i> @lang('menus.backend.sidebar.dashboard')
                </a>
            </li>

            <li class="nav-title">
                @lang('menus.backend.sidebar.system')
            </li>

            @if ($logged_in_user->isAdmin())
                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/auth*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/auth*')) }}" href="#">
                        <i class="nav-icon icon-user"></i> @lang('menus.backend.access.title')

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/user*')) }}" href="{{ route('admin.auth.user.index') }}">
                                @lang('labels.backend.access.users.management')

                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/role*')) }}" href="{{ route('admin.auth.role.index') }}">
                                @lang('labels.backend.access.roles.management')
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            @foreach(Module::group() as $module)

                @if($module->enabled())
                    <?php 
                        $module = $module->getLowerName();
                        $route = 'admin.'.$module.'.index';
                        $active = 'admin/'.$module.'*';
                        $mod_trans = $module.'::menus.backend.sidebar.'.$module;
                    ?>
                    @can('manage '.$module)
                        @if($module == "recyclebin")
                        <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern($active), 'open') }}">
                            <a class="nav-link nav-dropdown-toggle" href="#">
                                <i class="{{ config($module.'.icon') }}"></i> {{ trans($mod_trans) }}
                            </a>

                            <ul class="nav-dropdown-items">
                            @foreach(Module::getOrdered() as $submodule)
                                @can('manage '.$submodule->getLowerName())
                                    @if($submodule->enabled() && !in_array($submodule->getLowerName(),config('backend.ignored_bin')))
                                    <?php 
                                        $mod_sub_trans = $submodule->getLowerName().'::menus.backend.sidebar.'.$submodule->getLowerName().'_bin';
                                        $active = url('/admin/recyclebin?submodule='.$submodule->getName());
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ (Request::fullUrl() == $active) ? 'active' : '' }}" href="{{ route($route,['submodule' => $submodule->getName() ]) }}">
                                            {{ trans($mod_sub_trans) }}
                                        </a>
                                    </li>
                                    @endif
                                @endcan
                            @endforeach
                            </ul>
                        </li>
                        @else
                            <li class="nav-item">
                              <a class="nav-link {{ active_class(Active::checkUriPattern($active)) }}" href="{{ route($route) }}">
                                 <i class="{{ config($module.'.icon') }}"></i>
                                 <span style="padding-left: 12px;">{{ trans($mod_trans) }}</span>
                              </a>
                            </li>
                        @endif
                    @endcan
                @endif
            @endforeach

            <li class="divider"></li>

            <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'open') }}">
                <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/log-viewer*')) }}" href="#">
                    <i class="nav-icon icon-list"></i> @lang('menus.backend.log-viewer.main')
                </a>

                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Active::checkUriPattern('admin/log-viewer')) }}" href="{{ route('log-viewer::dashboard') }}">
                            @lang('menus.backend.log-viewer.dashboard')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Active::checkUriPattern('admin/log-viewer/logs*')) }}" href="{{ route('log-viewer::logs.list') }}">
                            @lang('menus.backend.log-viewer.logs')
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
