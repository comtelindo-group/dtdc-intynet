<!DOCTYPE html>
<html lang="en">

<head>
    <title>DTDC</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href={{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }} rel="stylesheet"
        type="text/css" />
    <link href={{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }} rel="stylesheet" type="text/css" />
    <link href={{ asset('assets/plugins/global/plugins.bundle.css') }} rel="stylesheet" type="text/css" />
    <link href={{ asset('assets/css/style.bundle.css') }} rel="stylesheet" type="text/css" />
    <link rel="icon" href="{{ asset('assets/media/logos/logo-mantap.png') }}">
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> --}}
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>
</head>

<body id="kt_app_body" data-kt-app-header-fixed="true" data-kt-app-header-fixed-mobile="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" class="app-default">
    <script>
        var defaultThemeMode = "light";
        var themeMode = "light";
    </script>
    <script>
        var hostUrl = "assets/";
    </script>
    <script src={{ asset('assets/plugins/global/plugins.bundle.js') }}></script>
    <script src={{ asset('assets/js/scripts.bundle.js') }}></script>
    <script src={{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}></script>
    {{-- <script src={{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}></script> --}}
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
            @yield('navbar')
            <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
                @yield('sidebar')
                <div class="app-main flex-column flex-row-fluid " id="322">
                    <div class="d-flex flex-column flex-column-fluid">
                        <div id="kt_app_content" class="app-content  flex-column-fluid ">
                            <div id="kt_app_content_container" class="app-container  container-xxl ">
                                <div class="row gy-5 gx-xl-10">
                                    <div class="col-xl-12">
                                        @yield('content')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @yield('footer')
                </div>
            </div>
        </div>
    </div>
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-outline ki-arrow-up"></i>
    </div>

</body>

</html>
