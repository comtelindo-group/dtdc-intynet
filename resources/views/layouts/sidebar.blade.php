<style>
    .active {
        background-color: rgba(255, 255, 255, 0.1) !important;
    }
</style>
<div id="kt_app_sidebar" class="app-sidebar" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="auto"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div class="app-sidebar-menu flex-grow-1 hover-scroll-y scroll-lg-ps my-5 pe-5" id="kt_aside_menu_wrapper"
        data-kt-scroll="true" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
        data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px">

        @role('admin')
            <a id="kt_aside_menu" style="cursor: pointer;" data-kt-menu="true" href="{{ route('admin.volunteer.index') }}"
                class="px-5 active menu menu-rounded menu-column menu-title-gray-600 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-semibold fs-6 bg py-4 rounded">
                <span class="menu-link d-flex menu-center">
                    <span class="menu-icon me-0">
                        <i class="fa-solid fa-computer"></i>
                    </span>
                </span>
            </a>
        @endrole
        <br>

        <a id="kt_aside_menu" style="cursor: pointer;" data-kt-menu="true" href="/"
            class="px-5 active menu menu-rounded menu-column menu-title-gray-600 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-semibold fs-6 bg py-4 rounded">
            <span class="menu-link d-flex menu-center">
                <span class="menu-icon me-0">
                    <i class="fa-solid fa-clipboard-list"></i>
                </span>
            </span>
        </a>
    </div>
    <div class="d-flex flex-column flex-center pb-4 pb-lg-8" id="kt_app_sidebar_footer">
        <div class="cursor-pointer symbol symbol-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
            data-kt-attach="parent" data-kt-menu-placement="right-end">
            <img src={{ asset('assets/media/avatars/300-7.jpg') }} alt="user" />
        </div>
        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
            data-kt-menu="true">
            <div class="menu-item px-3">
                <div class="menu-content d-flex align-items-center px-3">
                    <div class="symbol symbol-50px me-5">
                        <img alt="Logo" src={{ asset('assets/media/avatars/300-7.jpg') }} />
                    </div>
                    <div class="d-flex flex-column">
                        <div class="fw-bold d-flex align-items-center fs-5">{{ Auth::user()->name }}
                        </div>
                        <a href="#"
                            class="fw-semibold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a>
                    </div>
                </div>
            </div>
            <div class="separator my-2"></div>
            <div class="menu-item px-5">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="menu-link px-5 text-danger">Sign
                    Out</a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>
