@extends('layouts.app')

@section('contentnv')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Створення акаунту</div>
                    <div class="my-2 d-flex justify-content-center align-items-center">
                        <a href="/redirect" class="btn-soc-login-g">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                                <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
                              </svg> &nbsp; Увійти через Google
                        </a> <!-- /.btn-soc-login-g -->
                    </div>
                    <!-- /.my-2 d-flex justify-content-center align-items-center -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">
                                    Ім`я
                                </label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">
                                    Email адреса
                                </label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">
                                    Пароль
                                </label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">
                                    Повторіть пароль
                                </label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                {!! RecaptchaV3::field('register') !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="row mb-3">
                                <label for="type_diabet" class="col-md-4 col-form-label text-md-end">
                                    Який у вас тип діабету?
                                </label>

                                <div class="col-md-6">
                                    <select name="type_diabet" id="type_diabet"
                                        class="form-control @error('type_diabet') is-invalid @enderror">
                                        <option selected disabled>Оберіть тип діабету</option>
                                        <option value="1">Перший тип</option>
                                        <option value="2">Другий тип</option>
                                    </select> <!-- /#.form-control -->
                                    @error('type_diabet')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    @error('use_insulin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <div class=" form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" role="switch" id="use_insulin"
                                            name="use_insulin" />
                                        <label class="form-check-label " for="use_insulin">
                                            Використовую інсулін
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    @error('use_tablet')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <div class=" form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" role="switch" id="use_tablet"
                                            name="use_tablet" />
                                        <label class="form-check-label " for="use_tablet">
                                            Використовую медикаменти
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-4">

                                </div>
                                <!-- /.col-md-4 -->
                                <div class="col-md-6 ">
                                    <span class="d-block py-1">
                                        Натискаючи кпопку "Створити акаунт" Ви приймаєте <a href="{{ route('terms') }}"
                                            target="_blank">
                                            умови використання цього сайту
                                        </a>
                                    </span>
                                    <div class="form-group mt-2">
                                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHAV2_SITEKEY') }}"></div>
                                        @error('g-recaptcha-response')
                                            <div class="alert alert-warning">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            <!-- /.alert alert-warning -->
                                        @enderror
                                    </div>
                                    <!-- /.form-group mt-2 -->
                                    <button type="submit" class="btn btn-primary">
                                        Створити акаунт
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
