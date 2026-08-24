<!-- Main Header -->
<header class="main-header">

    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-success navbar-dark">

        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <!-- Sidebar toggle button -->
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

            <!-- Notifications Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" 
                   data-bs-toggle="dropdown" 
                   href="#" 
                   title="{{ cbLang('Notifications') }}">
                    <i id="icon_notification" class="far fa-bell"></i>
                    <span id="notification_count" 
                          class="badge badge-danger navbar-badge" 
                          style="display:none">0</span>
                </a>
                
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px">
                    <span class="dropdown-item dropdown-header">
                        {{ cbLang("text_no_notification") }}
                    </span>

                    <div class="dropdown-divider"></div>

                    <!-- Notification list container -->
                    <div id="list_notifications" class="dropdown-body p-0">
                        <!-- Items will be inserted here via JS -->
                        <div class="text-center py-4 text-muted">
                            {{ cbLang("text_no_notification") }}
                        </div>
                    </div>

                    <div class="dropdown-divider"></div>

                    <a href="{{ route('NotificationsControllerGetIndex') }}" 
                       class="dropdown-item dropdown-footer">
                        {{ cbLang("text_view_all_notification") }}
                    </a>
                </div>
            </li>

            <!-- User Menu -->
            <li class="nav-item dropdown user-menu">
                <a href="#" 
                   class="nav-link dropdown-toggle" 
                   data-bs-toggle="dropdown">
                    <img src="{{ CRUDBooster::myPhoto() }}" 
                         class="user-image img-circle elevation-2" 
                         alt="User Image">
                    <span class="d-none d-md-inline">
                        {{ CRUDBooster::myName() }}
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px">
                    <!-- User image & info -->
                    <li class="user-header bg-success">
                        <img src="{{ CRUDBooster::myPhoto() }}" 
                             class="img-circle elevation-2" 
                             alt="User Image">

                        <p>
                            {{ CRUDBooster::myName() }}
                            <small>{{ CRUDBooster::myPrivilegeName() }}</small>
                            <small>
                                <i class="far fa-clock"></i> 
                                <?php echo date('d F Y') ?>
                            </small>
                        </p>
                    </li>

                    <!-- Menu Footer -->
                    <li class="user-footer">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('AdminCmsUsersControllerGetProfile') }}" 
                               class="btn btn-default btn-flat">
                                <i class="fas fa-user mr-1"></i> 
                                {{ cbLang("label_button_profile") }}
                            </a>

                            <div>
                                <a href="{{ route('getLockScreen') }}" 
                                   class="btn btn-default btn-flat" 
                                   title="Lock Screen">
                                    <i class="fas fa-lock"></i>
                                </a>

                                <a href="#"
                                   id="btn-logout"
                                   data-confirm-title="{{ cbLang('alert_want_to_logout') }}"
                                   data-confirm-type="info"
                                   data-confirm-button-color="#DD6B55"
                                   data-confirm-button-text="{{ cbLang('button_logout') }}"
                                   data-confirm-cancel-text="{{ cbLang('button_cancel') }}"
                                   data-confirm-url="{{ route('getLogout') }}"
                                   title="{{ cbLang('button_logout') }}"
                                   class="btn btn-danger btn-flat">
                                    <i class="fas fa-power-off"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>

        </ul>
    </nav>
</header>

@push('bottom')
<script nonce="{{ config('view.script_nonce', '') }}" type="text/javascript">
    $(document).on('click', '#btn-logout', function (e) {
        e.preventDefault();
        var $el = $(this);
        swal({
            title: $el.data('confirm-title') || '',
            type: $el.data('confirm-type') || 'info',
            showCancelButton: true,
            allowOutsideClick: true,
            confirmButtonColor: $el.data('confirm-button-color') || '#DD6B55',
            confirmButtonText: $el.data('confirm-button-text') || 'Logout',
            cancelButtonText: $el.data('confirm-cancel-text') || 'Cancel',
            closeOnConfirm: false
        }, function () {
            location.href = $el.data('confirm-url');
        });
    });
</script>
@endpush