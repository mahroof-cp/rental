@extends('admin.layouts.admin')
<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="ThemeSelect">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Blank') | {{config('settings.'.langKey('company_name')) ? config('settings.'.langKey('company_name')) : "RENTAL"}}</title>
    <link rel="apple-touch-icon" href="{{asset("images/admin/favicon.png")}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset("images/admin/favicon.png")}}">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin/custom/custom.css') }}" />
    @stack('vendor-style')
    @stack('style')
</head>
<body>
    <div id="loader">
        <div class="preloader-wrapper active">
            <div class="spinner-layer spinner-red-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('admin.layouts.navigation')
            <div class="layout-page">
                @include('admin.layouts.topbar')
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        {{ $slot }}
                    </div>
                    @include('admin.layouts.footer')
                </div>
                <div class="content-backdrop fade"></div>
            </div>
        </div>
    </div>

    <div class="general-notification col-md-6">
        <div id="sucess-msg">
            @if (session('success'))
            <div id="sessionSuccess" class="hide">{{ session('success') }}</div>
            @endif
        </div>
        @if (session('error'))
        <div id="sessionError" class="hide">{{ session('error') }}</div>
        @endif
    </div>

    <div id="model-area">
    </div>

    <script src="{{ asset('vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    @stack('vendor-script')
    <script src="{{ asset('vendor/js/menu.js') }}"></script>
    <script src="{{ asset('js/admin/config/config.js') }}"></script>
    <script src="{{ asset('js/admin/main/main.js') }}"></script>
    @stack('script')
</body>
</html>
