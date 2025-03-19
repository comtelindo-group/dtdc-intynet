<div id="kt_app_header" class="app-header d-flex align-items-stretch">
    <div class="app-container container-fluid d-flex align-items-stretch justify-content-between"
        id="kt_app_header_container">
        <div class="app-header-wrapper d-flex flex-grow-1 justify-content-around justify-content-lg-between flex-wrap gap-3 mb-6 mb-lg-0"
            data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
            data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_header_container'}">
            <div class="d-flex align-items-stretch">
                <div class="app-header-logo d-flex flex-center">
                    <a href="/">
                        <img alt="Logo" src={{ asset('assets/media/logos/Logo-Only.png') }} class="h-35px" />
                    </a>
                </div>
                @hasSection ('page-title')
                    <div class="d-flex flex-column justify-content-center w-lg-300px">
                        <h1 class="text-gray-900 fw-bold fs-3 mb-1">@yield('page-title')</h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7">
                            <li class="breadcrumb-item text-muted">
                                <span class="text-muted text-hover-primary">@yield('page-title')</span>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">@yield('page-subtitle')</li>
                            @hasSection ('page-detail')
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-muted">@yield('page-detail')</li>
                            @endif
                        </ul>
                    </div>
                @else
                    <div class="d-flex align-items-center gap-4 w-lg-300px">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold fs-4">
                                <span class="text-gray-500">Page:</span>
                                <span class="text-gray-800">Dashboard</span>
                            </span>
                        </div>
                    </div>
                @endif
            </div>

        </div>
        <div class="d-flex d-lg-none flex-grow-1 flex-stack gap-4">
            <button class="btn btn-icon btn-sm btn-active-color-primary ms-n2" id="kt_app_sidebar_mobile_toggle">
                <i class="ki-outline ki-abstract-14 fs-1"></i>
            </button>
            <a href="/">
                <img alt="Logo" src="{{ asset('assets/media/logos/logo-mantap.png-org.png') }}" class="h-30px" />
            </a>
        </div>
    </div>
</div>
