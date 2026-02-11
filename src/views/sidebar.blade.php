<!-- Left side column. contains the sidebar -->

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url(config('crudbooster.ADMIN_PATH')) }}" class="brand-link text-lg" title="{{ Session::get('appname') }}">
        <span class="brand-text font-weight-light">{{ CRUDBooster::getSetting('appname') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar sidebar-dark-success">

        <!-- Sidebar user panel (optional but common) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ CRUDBooster::myPhoto() }}" class="img-circle elevation-2" alt="{{ cbLang('user_image') }}">
            </div>
            <div class="info">
                <a href="#" class="d-block text-white">{{ CRUDBooster::myName() }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-flat text-sm" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-header">{{ cbLang('menu_navigation') }}</li>

                {{-- Dashboard (if enabled) --}}
                @php
                    $dashboard = false; // or CRUDBooster::sidebarDashboard();
                @endphp
                @if ($dashboard)
                    <li class="nav-item">
                        <a href="{{ CRUDBooster::adminPath() }}"
                            class="nav-link {{ Request::is(config('crudbooster.ADMIN_PATH')) ? 'active' : '' }}">
                            <i
                                class="nav-icon fa fa-tachometer-alt {{ $dashboard->color ? 'text-' . $dashboard->color : '' }}"></i>
                            <p>{{ cbLang('text_dashboard') }}</p>
                        </a>
                    </li>
                @endif

                @foreach (CRUDBooster::sidebarMenu() as $menu)
                    <li
                        class="nav-item {{ !empty($menu->children) ? 'menu-open' : '' }} {{ Request::is($menu->url_path . '*') ? 'menu-open' : '' }}">
                        <a href="{{ $menu->is_broken ? 'javascript:alert(\'' . cbLang('controller_route_404') . '\')' : $menu->url }}"
                            class="nav-link {{ Request::is($menu->url_path . '*') ? 'active' : '' }}">
                            <i
                                class="nav-icon {{ $menu->icon }} {{ $menu->color ? 'text-' . $menu->color : '' }}"></i>
                            <p>
                                {{ $menu->name }}
                                @if (!empty($menu->children))
                                    <i class="right fa fa-angle-left"></i>
                                @endif
                            </p>
                        </a>

                        @if (!empty($menu->children))
                            <ul class="nav nav-treeview">
                                @foreach ($menu->children as $child)
                                    <li class="nav-item">
                                        <a href="{{ $child->is_broken ? 'javascript:alert(\'' . cbLang('controller_route_404') . '\')' : $child->url }}"
                                            class="nav-link {{ Request::is($child->url_path . '*') ? 'active' : '' }}">
                                            <i
                                                class="fa {{$menu->icon}} nav-icon {{ $child->color ? 'text-' . $child->color : '' }}"></i>
                                            <p>{{ $child->name }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach

                @if (CRUDBooster::isSuperadmin())
                    <li class="nav-header">{{ cbLang('SUPERADMIN') }}</li>

                    <!-- Privileges / Roles -->
                    <li
                        class="nav-item {{ Request::is(config('crudbooster.ADMIN_PATH') . '/privileges*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-key"></i>
                            <p>
                                {{ cbLang('Privileges_Roles') }}
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ Route('PrivilegesControllerGetAdd') }}"
                                    class="nav-link {{ Request::is(config('crudbooster.ADMIN_PATH') . '/privileges/add*') ? 'active' : '' }}">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>{{ cbLang('Add_New_Privilege') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Route('PrivilegesControllerGetIndex') }}"
                                    class="nav-link {{ Request::is(config('crudbooster.ADMIN_PATH') . '/privileges') ? 'active' : '' }}">
                                    <i class="fa fa-bars nav-icon"></i>
                                    <p>{{ cbLang('List_Privilege') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Repeat similar pattern for Users, Menu Management, Settings, Module Generator, Statistic Builder, API Generator, Email Templates, Logs -->

                    <!-- Users Management -->
                    <li
                        class="nav-item {{ Request::is(config('crudbooster.ADMIN_PATH') . '/users*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                {{ cbLang('Users_Management') }}
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ Route('AdminCmsUsersControllerGetAdd') }}"
                                    class="nav-link {{ Request::is(config('crudbooster.ADMIN_PATH') . '/users/add*') ? 'active' : '' }}">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>{{ cbLang('add_user') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Route('AdminCmsUsersControllerGetIndex') }}"
                                    class="nav-link {{ Request::is(config('crudbooster.ADMIN_PATH') . '/users') ? 'active' : '' }}">
                                    <i class="fa fa-bars nav-icon"></i>
                                    <p>{{ cbLang('List_users') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Menu Management (single item, no subtree) -->
                    <li class="nav-item">
                        <a href="{{ Route('MenusControllerGetIndex') }}"
                            class="nav-link {{ Request::is(config('crudbooster.ADMIN_PATH') . '/menu_management*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-bars"></i>
                            <p>{{ cbLang('Menu_Management') }}</p>
                        </a>
                    </li>

                    <!-- Settings -->
                    <li
                        class="nav-item {{ Request::is(config('crudbooster.ADMIN_PATH') . '/settings*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-wrench"></i>
                            <p>
                                {{ cbLang('settings') }}
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('SettingsControllerGetAdd') }}"
                                    class="nav-link {{ Request::is(config('crudbooster.ADMIN_PATH') . '/settings/add*') ? 'active' : '' }}">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>{{ cbLang('Add_New_Setting') }}</p>
                                </a>
                            </li>

                            @php
                                $groupSetting = DB::table('cms_settings')
                                    ->select('group_setting')
                                    ->groupBy('group_setting')
                                    ->pluck('group_setting');
                            @endphp

                            @foreach ($groupSetting as $gs)
                                <li class="nav-item">
                                    <a href="{{ route('SettingsControllerGetShow') }}?group={{ urlencode($gs) }}&m=0"
                                        class="nav-link {{ $gs == request()->get('group') ? 'active' : '' }}">
                                        <i class="fa fa-wrench nav-icon"></i>
                                        <p>{{ $gs }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <!-- Module Generator -->
                    <li
                        class="nav-item {{ Request::is(config('crudbooster.ADMIN_PATH') . '/module_generator*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-th"></i>
                            <p>
                                {{ cbLang('Module_Generator') }}
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ Route('ModulsControllerGetStep1') }}"
                                    class="nav-link {{ Request::is(config('crudbooster.ADMIN_PATH') . '/module_generator/step1') ? 'active' : '' }}">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>{{ cbLang('Add_New_Module') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Route('ModulsControllerGetIndex') }}"
                                    class="nav-link {{ Request::is(config('crudbooster.ADMIN_PATH') . '/module_generator') ? 'active' : '' }}">
                                    <i class="fa fa-bars nav-icon"></i>
                                    <p>{{ cbLang('List_Module') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Statistic Builder -->
                    <li
                        class="nav-item {{ Request::is(config('crudbooster.ADMIN_PATH') . '/statistic_builder*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-chart-bar"></i>
                            <p>
                                {{ cbLang('Statistic_Builder') }}
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ Route('StatisticBuilderControllerGetAdd') }}"
                                    class="nav-link {{ Request::is(config('crudbooster.ADMIN_PATH') . '/statistic_builder/add') ? 'active' : '' }}">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>{{ cbLang('Add_New_Statistic') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Route('StatisticBuilderControllerGetIndex') }}"
                                    class="nav-link {{ Request::is(config('crudbooster.ADMIN_PATH') . '/statistic_builder') ? 'active' : '' }}">
                                    <i class="fa fa-bars nav-icon"></i>
                                    <p>{{ cbLang('List_Statistic') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- API Generator -->
                    <li
                        class="nav-item {{ Request::is(config('crudbooster.ADMIN_PATH') . '/api_generator*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-plug"></i>
                            <p>
                                {{ cbLang('API_Generator') }}
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ Route('ApiCustomControllerGetGenerator') }}"
                                    class="nav-link {{ Request::is(config('crudbooster.ADMIN_PATH') . '/api_generator/generator*') ? 'active' : '' }}">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>{{ cbLang('Add_New_API') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Route('ApiCustomControllerGetIndex') }}"
                                    class="nav-link {{ Request::is(config('crudbooster.ADMIN_PATH') . '/api_generator') ? 'active' : '' }}">
                                    <i class="fa fa-bars nav-icon"></i>
                                    <p>{{ cbLang('list_API') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Route('ApiCustomControllerGetScreetKey') }}"
                                    class="nav-link {{ Request::is(config('crudbooster.ADMIN_PATH') . '/api_generator/screet-key*') ? 'active' : '' }}">
                                    <i class="fa fa-bars nav-icon"></i>
                                    <p>{{ cbLang('Generate_Screet_Key') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Email Templates -->
                    <li
                        class="nav-item {{ Request::is(config('crudbooster.ADMIN_PATH') . '/email_templates*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-envelope"></i>
                            <p>
                                {{ cbLang('Email_Templates') }}
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ Route('EmailTemplatesControllerGetAdd') }}"
                                    class="nav-link {{ Request::is(config('crudbooster.ADMIN_PATH') . '/email_templates/add*') ? 'active' : '' }}">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>{{ cbLang('Add_New_Email') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Route('EmailTemplatesControllerGetIndex') }}"
                                    class="nav-link {{ Request::is(config('crudbooster.ADMIN_PATH') . '/email_templates') ? 'active' : '' }}">
                                    <i class="fa fa-bars nav-icon"></i>
                                    <p>{{ cbLang('List_Email_Template') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Logs (single item, no subtree) -->
                    <li class="nav-item">
                        <a href="{{ Route('LogsControllerGetIndex') }}"
                            class="nav-link {{ Request::is(config('crudbooster.ADMIN_PATH') . '/logs*') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-clipboard-list"></i>
                            <p>{{ cbLang('Log_User_Access') }}</p>
                        </a>
                    </li>

                @endif

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
