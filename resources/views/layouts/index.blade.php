<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->
<head>
    @if(env('APP_ENV') === 'prod')
        @include('static._analytics_head')
    @endif
    <meta charset="utf-8"/>
    <title>@yield('title') - Social Network</title>
    <meta name="description" content="SNet" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap">
    @include('static._styles')
    @yield('custom_css')
</head>
<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed sidebar-panel kt-aside--minimize">

<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

        @include('partials._sidebar')

        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

            <!-- begin::Header -->
        @include('partials._header')
        <!-- end::Header -->

            <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                    @yield('content')
                </div>
            </div>

            @include('partials._footer')
        </div>
    </div>
</div>

<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>
<!-- end::Scrolltop -->

@include('static._scripts')
@yield('custom_scripts')

</body>
<!-- end::Body -->
</html>