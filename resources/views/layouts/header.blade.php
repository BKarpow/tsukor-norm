

<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="/">{{ env('APP_NAME') }}</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        {{-- <a href="index.html" class="logo me-auto">
        <img src="assets/img/logo.png" alt="" class="img-fluid"></a> --}}

        <nav id="navbar" class="navbar me-auto">
            <ul>
                <li><a class="nav-link scrollto active" href="/">Головна</a></li>
                {{-- <li><a class="nav-link scrollto" href="{{ route('home') }}">Трекер діабету</a></li> --}}
                <li><a class="nav-link scrollto" href="{{ route('ig.index') }}">Таблиця ГІ</a></li>
                <li><a class="nav-link scrollto" href="https://blog.tsukor-norm.pp.ua">Блог</a></li>
                <li><a class="nav-link scrollto" href="{{ route('about') }}">Про сайт</a></li>
                {{-- <li><a class="nav-link scrollto" href="#services">Services</a></li> --}}
                {{-- <li><a class="nav-link scrollto " href="#portfolio">Portfolio</a></li> --}}
                {{-- <li><a class="nav-link scrollto" href="#team">Team</a></li> --}}
                @auth

                    @if (auth()->user()->use_tablet)
                        <li class="dropdown"><a title="Мої ліки" href="#">
                            <i class="fa-solid fa-pills fa-xl"></i> &nbsp;
                            Ліки
                            <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a href="{{route('med.index')}}">
                                    <div>
                                        <i class="fa-solid fa-clover fa-xl"></i> &nbsp;
                                    Моя аптечка
                                    </div>
                                </a></li>
                                <li><a href="{{route('medicamentTake.index')}}">
                                    <div>
                                        <i class="fa-solid fa-book-medical fa-xl"></i> &nbsp;
                                    Журнал прийому
                                    </div>
                                </a></li>
                            </ul>
                        </li>
                    @endif  {{-- End medicament construct --}}

                @endauth

                <li class="dropdown"><a title="Меню користувача" href="#">
                        @auth
                        <i class="fa-solid fa-user fa-xl"></i> &nbsp;{{ auth()->user()->name }}
                        @else
                        <i class="fa-solid fa-user fa-xl"></i>
                        @endauth
                        <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        @auth
                            {{-- <li><a href="{{ route('sugar.add') }}">
                                <div>
                                    <i class="fa-solid fa-cubes-stacked fa-xl"></i> &nbsp;
                                Глюкоза крові
                                </div>
                            </a></li> --}}
                            <li><a href="{{ route('sugar.analytic') }}">
                                <div>
                                    <i class="fa-solid fa-chart-line"></i>  &nbsp;
                                Аналітика цукру
                                </div>
                            </a></li>
                            <li><a href="{{ route('hba1c.index') }}">
                                <div>
                                    <i class="fa-solid fa-microscope fa-xl"></i> &nbsp;
                                HbA1c показники
                                </div>
                            </a></li>
                            <li><a href="{{ route('bloodPressure.index') }}">
                                <div>
                                    <i class="fa-solid fa-stethoscope fa-xl"></i> &nbsp;
                                АТ та пульс
                                </div>
                            </a></li>
                            <li><a href="{{ route('user.index') }}">
                                <div><i class="fa-solid fa-gear fa-xl"></i> &nbsp;
                                Налаштування</div>
                            </a>
                        </li>
                            @if (auth()->user()->isAdmin())
                            <li><a href="{{ route('admin.product') }}">Керування прродуктами</a></li>
                            <li>
                                <a href="{{ route('admin.ips') }}"class="">Візити сайту</a><!-- /.btn btn-primary -->
                            </li>
                            @endif

                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                                <div>
                                    <i class="fa-solid fa-right-from-bracket fa-xl"></i> &nbsp;
                                    Вийти
                                    </div>
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @else
                            <li><a href="{{ route('login') }}">Увійти</a></li>
                            <li><a href="{{ route('register') }}">Створити акаунт</a></li>
                        @endauth
                    </ul>
                </li>

            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
