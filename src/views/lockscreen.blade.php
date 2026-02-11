<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>::LOCKSCREEN::</title>
    <meta name='generator' content='CRUDBooster' />
    <meta name='robots' content='noindex,nofollow' />
    <link rel="shortcut icon"
        href="{{ CRUDBooster::getSetting('favicon') ? asset(CRUDBooster::getSetting('favicon')) : asset('vendor/crudbooster/assets/logo_crudbooster.png') }}">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 5.3.8 -->
    <link href="{{ asset('vendor/crudbooster/assets/adminlte/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- Font Awesome Icons -->
    <!-- Font Awesome Free 5.15.4 -->
    <link href="{{ asset('vendor/crudbooster/assets/adminlte/font-awesome/css') }}/font-awesome.min.css"
        rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <!-- AdminLTE v3.2.0 -->
    <link href="{{ asset('vendor/crudbooster/assets/adminlte/dist/css/AdminLTE.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <link rel='stylesheet' href='{{ asset('vendor/crudbooster/assets/css/main.css') }}' />
    <style type="text/css">
        .lockscreen {
            background: {{ CRUDBooster::getSetting('login_background_color') ?: '#dddddd' }} url('{{ CRUDBooster::getSetting('login_background_image') ? asset(CRUDBooster::getSetting('login_background_image')) : asset('vendor/crudbooster/assets/bg_blur3.jpg') }}');
            color: {{ CRUDBooster::getSetting('login_font_color') ?: '#ffffff' }} !important;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }
    </style>

</head>

<body class="lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo">
            <a href="{{ url('/') }}">
                <img title='{!! ($appname ?? false) == 'CRUDBooster' ? '<b>CRUD</b>Booster' : $appname ?? false !!}'
                    src='{{ CRUDBooster::getSetting('logo') ? asset(CRUDBooster::getSetting('logo')) : asset('vendor/crudbooster/assets/logo_crudbooster.png') }}'
                    style='max-width: 100%;max-height:170px' />
            </a>
        </div>
        <!-- User name -->
        <div class="lockscreen-name">{{ Session::get('admin_name') }}</div>

        <!-- START LOCK SCREEN ITEM -->
        <div class="lockscreen-item">
            <!-- lockscreen image -->
            <div class="lockscreen-image">
                <img src="{{ Session::get('admin_photo') ?: asset('assets/adminlte/dist/img/user2-160x160.jpg') }}"
                    alt="user image" />
            </div>
            <!-- /.lockscreen-image -->

            <!-- lockscreen credentials (contains the form) -->
            <form class="lockscreen-credentials" method='post'
                action="{{ url(config('crudbooster.ADMIN_PATH') . '/unlock-screen') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="input-group">
                    <input type="password" class="form-control" required name='password' placeholder="password" />
                    <div class="input-group-append">
                        <button class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
                    </div>
                </div>
            </form><!-- /.lockscreen credentials -->

        </div><!-- /.lockscreen-item -->
        <div class="text-center">
            {{ cbLang('text_enter_the_password') }}
        </div>
        <div class='text-center'>
            <a class="text-lightblue" href="{{ route('getLogout') }}">{{ cbLang('text_or_sign_in') }}</a>
        </div>
        <div class='lockscreen-footer text-center'>
            Copyright &copy; {{ date('Y') }}<br>
            All rights reserved
        </div>
    </div><!-- /.center -->


    <!-- jQuery 3.6.3 -->
    <script src="{{ asset('vendor/crudbooster/assets/adminlte/plugins/jQuery/jquery-3.6.3.min.js') }}"></script>
    <!-- Bootstrap 5.3.8 JS -->
    <script src="{{ asset('vendor/crudbooster/assets/adminlte/bootstrap/js/bootstrap.min.js') }}" type="text/javascript">
    </script>
</body>

</html>
