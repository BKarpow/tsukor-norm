

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="/">{{env('APP_NAME')}}</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="/">Головна</a></li>
          <li><a class="nav-link scrollto active" href="{{route('home')}}">Трекер здоров'я</a></li>
          <li><a class="nav-link scrollto" href="{{route('ig.index')}}">Продукти для діабетика</a></li>
          <li><a class="nav-link scrollto" href="{{route('about')}}">Про сайт</a></li>
          {{-- <li><a class="nav-link scrollto" href="#services">Services</a></li> --}}
          {{-- <li><a class="nav-link scrollto " href="#portfolio">Portfolio</a></li> --}}
          {{-- <li><a class="nav-link scrollto" href="#team">Team</a></li> --}}
          {{-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li> --}}
          <li><a class="nav-link scrollto" href="#contact">Контакти</a></li>
          @auth
          <li><a class="getstarted scrollto" href="{{ route('sugar.add') }}">+ Глюкоза крові</a></li>
          <li>
            <a class="getstarted scrollto" href="{{ route('logout') }}"
               onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-left"></i>  &nbsp; Вийти
            </a>
          </li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          @else
          <li><a class="getstarted scrollto" href="{{ route('login') }}">Увійти</a></li>
          <li><a class="getstarted scrollto" href="{{ route('register') }}">Створити акаунт</a></li>
          @endauth

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->



