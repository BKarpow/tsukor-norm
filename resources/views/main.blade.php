@extends('layouts.app')

@section('meta')
    <meta name="description" content="Наш сайт для діабетиків дозволяє вести щоденник самоконтролю та аналізувати рівень цукру в крові. Ми також маємо рекомендації щодо продуктів, корисних для діабетиків. Простий та безпечний у використанні.">
@endsection

@section('title') Головна {{env('APP_NAME')}} @endsection

@section('content')

<!-- ======= Hero Section ======= -->
<section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url(assets/img/slide/slide-1.webp)">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animate__animated animate__fadeInDown">Вітаю на сайті <span>{{env('APP_NAME')}}</span></h2>
              <p class="animate__animated animate__fadeInUp">Цей сайт створено як корисний інструмент для людей які хворіють на цукровий діабет.</p>
              <a href="{{route('home')}}" class="btn-get-started animate__animated animate__fadeInUp scrollto">
                Увійти в трекер
              </a>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" style="background-image: url(assets/img/slide/slide-2.webp)">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animate__animated animate__fadeInDown">Тримай цукор під контролем</h2>
              <p class="animate__animated animate__fadeInUp">Записуйте та аналізуйте свій цурок крові.</p>
              <a href="{{route('home')}}" class="btn-get-started animate__animated animate__fadeInUp scrollto">Увійти в трекер здоров'я</a>
            </div>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item" style="background-image: url(assets/img/slide/slide-3.webp)">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animate__animated animate__fadeInDown">Обирай корисне харчування</h2>
              <p class="animate__animated animate__fadeInUp">Одним із перших засобів контролю рівня цукру є дієта. Підбір привильних продуктів за глікемічним індексом - тримає діабет під контролем.</p>
              <a href="{{ route('ig.index') }}"
              class="btn-get-started animate__animated animate__fadeInUp scrollto">Зручна тпблиця продуктів</a>
            </div>
          </div>
        </div>

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

    </div>
  </section><!-- End Hero -->

  <!-- IG Product list -->
  <div class="container my-2">
    <div class="row justify-content-center align-items-center ">
        <div class="col-md-11">
            <h2 class="text-center">Продукти для діабетика</h2>
            <ig-list></ig-list>
        </div>
        <!-- /.col-md-11 -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
  <!-- /IG Product list -->

  <!-- ======= Featured Services Section ======= -->
  <section id="featured-services" class="featured-services section-bg">
    <div class="container">

      <div class="row no-gutters">
        <div class="col-lg-4 col-md-6">
          <div class="icon-box">
            <div class="icon">
                <i class="bi bi-journal-check"></i>
            </div>
            <h4 class="title">
                <a href="{{route('home')}}">Трекер</a>
            </h4>
            <p class="description">
                Трекер діабету - це онлайн-сервіс, який допомагає людям з діабетом контролювати рівень цукру в крові та вести щоденник своїх показників.
            </p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="icon-box">
            <div class="icon"><i class="bi bi-briefcase"></i></div>
            <h4 class="title"><a href="{{route('ig.index')}}">Глікемічні індекси продуктів</a></h4>
            <p class="description">
                Дізнайтеся глікемічні індекси продуктів та розрахуйте хлібні одиниці з нашою корисною інструментальною сторінкою. Зробіть своє харчування здоровішим та керуйте рівнем цукру в крові за допомогою нашого простого та зручного калькулятора. Приєднуйтесь до нашої спільноти та зберігайте свої улюблені продукти для швидкого доступу до них у майбутньому. Доступно для безкоштовного використання!
            </p>
          </div>
        </div>
        {{-- <div class="col-lg-4 col-md-6">
          <div class="icon-box">
            <div class="icon"><i class="bi bi-calendar4-week"></i></div>
            <h4 class="title"><a href="">Sed ut perspiciatis</a></h4>
            <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur trade stravi</p>
          </div>
        </div> --}}
      </div>

    </div>
  </section><!-- End Featured Services Section -->


@endsection
