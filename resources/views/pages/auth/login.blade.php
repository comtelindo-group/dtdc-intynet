<html lang="en" data-bs-theme="light">

<head>
    <title>Login | Contact</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href={{ asset('assets/plugins/global/plugins.bundle.css') }} rel="stylesheet" type="text/css">
    <link href={{ asset('assets/css/style.bundle.css') }} rel="stylesheet" type="text/css">
</head>


<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat">
    <script>
        var defaultThemeMode = "light";
        var themeMode = "light";
    </script>
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <style>
            body {
                background-image: url({{ asset('assets/media/auth/bg3-dark.jpg') }});
            }

            [data-bs-theme="dark"] body {
                background-image: url({{ asset('assets/media/auth/bg4-dark.jpg') }});
            }
        </style>
        <div class="d-flex flex-column flex-column-fluid flex-lg-row">
            <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
                <div class="d-flex flex-center flex-lg-start flex-column align-items-center">
                    <div class="mb-7 text-center">
                        <img alt="Logo" src={{ asset('assets/media/logos/logo-mantap.png') }} class="w-75">
                    </div>
                </div>
            </div>

            <div
                class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
                <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-10"
                    style="background-color: rgba(255, 255, 255, 0.1) !important;">
                    @if (session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-10">
                        <form class="form w-100" method="POST" id="kt_sign_in_form" action="{{ route('login') }}">
                            @csrf
                            <div class="text-center mb-15">
                                <h1 class="text-white fw-bolder mb-3">
                                    Sign In
                                </h1>
                                <div class="text-white fw-bold fs-6">
                                    Silahkan Login Sebelum Menggunakan Aplikasi
                                </div>
                            </div>
                            <div class="fv-row mb-8 fv-plugins-icon-container">
                                <input type="text" placeholder="Email" name="email" autocomplete="off"
                                    class="form-control bg-transparent text-white border-white" autofocus required>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="fv-row mb-8 fv-plugins-icon-container">
                                <input type="password" placeholder="Password" name="password" autocomplete="off"
                                    class="form-control bg-transparent text-white border-white" required>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                    <span class="indicator-label">
                                        Sign In</span>
                                </button>
                            </div>
                            <div class="text-center text-white pt-15">
                                <span class="fw-bold">Belum Punya Akun?</span>
                                <a href="{{ route('register') }}" class="link-primary fw-bolder">Daftar Sekarang</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
