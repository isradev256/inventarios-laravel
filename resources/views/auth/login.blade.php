@extends('layouts.master-without-nav')
@section('title')
    @lang('translation.Login')
@endsection
@section('content')
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <a href="{{ url('index') }}" class="mb-5 d-block auth-logo">
                            <img src="{{ URL::asset('/assets/images/logo-dark.png') }}" alt="" height="22"
                                class="logo logo-dark">
                            <img src="{{ URL::asset('/assets/images/logo-light.png') }}" alt="" height="22"
                                class="logo logo-light">
                        </a>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">¡Bienvenido Zysoft Orfa!</h5>
                                <p class="text-muted">Inicia sesión para continuar en Zysoft Orfa.</p>
                            </div>
                            <div class="p-2 mt-4">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label" for="email">Correo electrónico</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email', 'admin@themesbrand.com') }}" id="email"
                                            placeholder="Ingresa tu correo electrónico">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="float-end">
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}" class="text-muted">¿Olvidaste tu contraseña?</a>
                                            @endif
                                        </div>
                                        <label class="form-label" for="userpassword">Contraseña</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            value="12345678" name="password" id="userpassword" placeholder="Ingresa tu contraseña">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="auth-remember-check"
                                            name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="auth-remember-check">Recordarme</label>
                                    </div>

                                    <div class="mt-3 text-end">
                                        <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">Iniciar Sesión</button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <div class="signin-other-title">
                                            <h5 class="font-size-14 mb-3 title">Iniciar sesión con</h5>
                                        </div>

                                        <div class="text-center">
                                            <a href="javascript:void()"
                                               style="display: inline-flex; align-items: center; justify-content: center; gap: 12px; background: #ffffff; color: #757575; border: 1px solid #ddd; border-radius: 50px; padding: 12px 24px; font-size: 14px; font-weight: 500; text-decoration: none; transition: all 0.3s ease; width: 100%; max-width: 280px; margin: 0 auto; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"
                                               onmouseover="this.style.backgroundColor='#f5f5f5'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.15)';"
                                               onmouseout="this.style.backgroundColor='#ffffff'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.1)';">
                                                <svg width="20" height="20" viewBox="0 0 24 24">
                                                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                                                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                                                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                                                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                                                </svg>
                                                <span>Continuar con Google</span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <p class="mb-0">¿No tienes una cuenta? <a href="{{ url('register') }}"
                                                class="fw-medium text-primary"> Regístrate ahora </a> </p>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                    <div class="mt-5 text-center">
                        <p>© <script>
                                document.write(new Date().getFullYear())

                            </script> Zysoft Orfa. Creado con <i class="mdi mdi-heart text-danger"></i> por Zysoft Orfa</p>
                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
@endsection
