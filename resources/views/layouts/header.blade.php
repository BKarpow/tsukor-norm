

<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="/">{{ env('APP_NAME') }}</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        {{-- <a href="index.html" class="logo me-auto">
        <img src="assets/img/logo.png" alt="" class="img-fluid"></a> --}}

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="/">Головна</a></li>
                <li><a class="nav-link scrollto" href="{{ route('home') }}">Трекер діабету</a></li>
                <li><a class="nav-link scrollto" href="{{ route('ig.index') }}">Таблиця ГІ</a></li>
                <li><a class="nav-link scrollto" href="https://blog.tsukor-norm.pp.ua">Блог</a></li>
                <li><a class="nav-link scrollto" href="{{ route('about') }}">Про сайт</a></li>
                {{-- <li><a class="nav-link scrollto" href="#services">Services</a></li> --}}
                {{-- <li><a class="nav-link scrollto " href="#portfolio">Portfolio</a></li> --}}
                {{-- <li><a class="nav-link scrollto" href="#team">Team</a></li> --}}

                <li class="dropdown"><a title="Меню користувача" href="#">
                        @auth
                            {{ auth()->user()->name }}
                        @else
                            Меню користувача
                        @endauth
                        <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        @auth
                            <li><a href="{{ route('sugar.add') }}">+ Глюкоза крові</a></li>
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
                                    Вийти
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
                <li>
                    <a title="Запишіть показник глюкометра на сторінці за цим посиланням" class="getstarted scrollto"
                        href="{{ route('sugar.add') }}">
                        Записати цукор
                    </a>
                </li>

            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
