<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <title>Integra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body class="bg-pattern">
    <div class="bg-overlay"></div>
    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-6 col-md-8">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="">
                                <div class="text-center">
                                    <img src="{{ asset('assets/images/logo-integra-mini.png') }}" height="54">
                                </div>
                                <h4 class="font-size-18 text-muted mt-2 text-center">Integra</h4>
                                <p class="mb-5 text-center">Faça login para continuar.</p>
                                <form class="form-horizontal" action="{{ route('auth') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        @error('alert')
                                        <div class="col-md-12">
                                                <div class="alert alert-danger alert-dismissible fade show mb-2"
                                                    role="alert">
                                                    <strong>Ops!</strong> {{ $message }}
                                                </div>
                                        </div>
                                        @enderror
                                        <div class="col-md-12">
                                            <div class="mb-4">
                                                <label class="form-label" for="username">E-mail</label>
                                                <input type="email" name="email" class="form-control" id="username"
                                                value="{{ old('email') }}" placeholder="Entre com seu e-mail">
                                                @error('email')
                                                    <span class="badge badge-soft-danger mt-2">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label" for="userpassword">Senha</label>
                                                <input type="password" name="password" class="form-control" id="userpassword"
                                                    placeholder="Entre com sua senha">
                                                @error('password')
                                                    <span class="badge badge-soft-danger mt-2">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-check">
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                </div>
                                            </div>
                                            <div class="d-grid mt-4">
                                                <button class="btn btn-primary waves-effect waves-light"
                                                    type="submit">Entrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <p class="text-white-50">© <script>
                                document.write(new Date().getFullYear())
                            </script> Integra </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

</body>


</html>
