<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Fontawesome Icons -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- BoxIcons Css -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Material Design Icons Css -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- App js -->
    <script src="{{ asset('assets/js/plugin.js') }}"></script>
    <!-- Custom Css -->
    <link href="{{ asset('assets/css/datatables-custom.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/0756825c13.js" crossorigin="anonymous"></script>
    <!-- swal -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Login | {{ config('app.name') }}</title>
</head>

<body>
    <section style="height: 100vh">
        <div class="container h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-md-8 col-lg-6 col-xl-5 p-3">
                    <div class="overflow-hidden card">
                        <div class="bg-primary-subtle">
                            <div class="row">
                                <div class="col-7 col">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary">Selamat Datang!</h5>
                                        <p>CMS Profil Medokan Semampir</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end col"><img
                                        src="{{ asset('assets/images/profile-img.png') }}" alt=""
                                        class="img-fluid"></div>
                            </div>
                        </div>
                        <div class="pt-0 card-body">
                            <div class="auth-logo"><a class="auth-logo-light" href="/">
                                    <div class="avatar-md profile-user-wid mb-4"><span
                                            class="avatar-title rounded-circle bg-light"><img
                                                src="{{ asset('assets/images/logo-m.png') }}" alt=""
                                                class="rounded-circle" height="34"></span></div>
                                </a><a class="auth-logo-dark" href="/">
                                    <div class="avatar-md profile-user-wid mb-4"><span
                                            class="avatar-title rounded-circle bg-light"><img
                                                src="{{ asset('assets/images/logo-m.png') }}" alt=""
                                                class="rounded-circle" height="34"></span></div>
                                </a></div>
                            <div class="p-2">
                                <form class="form-horizontal" method="POST" action="{{ route('login.post') }}">
                                    @csrf

                                    @if ($errors->has('login'))
                                        <div class="alert alert-danger text-center">
                                            {{ $errors->first('login') }}
                                        </div>
                                    @endif

                                    <div class="mb-3">
                                        <label class="form-label form-label">Email</label>
                                        <input name="email" placeholder="Masukkan email" type="text"
                                            class="form-control form-control" aria-invalid="false" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label form-label">Kata Sandi</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input name="password" placeholder="Masukkan kata sandi" type="password"
                                                id="password-input" class="form-control" aria-invalid="false" required>
                                            <button class="btn btn-light " type="button" id="password-toggle">
                                                <i class="mdi mdi-eye-outline" id="password-icon"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mt-3 d-grid"><button class="btn btn-primary btn-block "
                                            type="submit">Masuk</button></div>

                                    <div class="mt-4 text-center"><a class="text-muted" href="/pages-forgot-pwd"><i
                                                class="mdi mdi-lock me-1"></i>Lupa password?</a></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        {{-- <p>Don't have an account ? <a class="fw-medium text-primary" href="/pages-login/pages-register">
                                Signup now </a> </p> --}}
                        <p><span class="fw-bold">© {{ date('Y') }} KKN NR-05 - Universitas 17 Agustus 1945
                                Surabaya.</span>
                            <span class="text-secondary d-none d-lg-inline"><br> Made with <i
                                    class="mdi mdi-heart text-danger"></i> by Candra Haikal</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Script -->
    <script>
        document.getElementById('password-toggle').addEventListener('click', function() {
            const passwordInput = document.getElementById('password-input');
            const passwordIcon = document.getElementById('password-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('mdi-eye-outline');
                passwordIcon.classList.add('mdi-eye-off-outline');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('mdi-eye-off-outline');
                passwordIcon.classList.add('mdi-eye-outline');
            }
        });
    </script>
</body>

</html>
