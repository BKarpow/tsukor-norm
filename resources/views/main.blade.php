@extends('layouts.app')

@section('meta')
    <meta name="description" content="Наш сайт для діабетиків дозволяє вести щоденник самоконтролю та аналізувати рівень цукру в крові. Ми також маємо рекомендації щодо продуктів, корисних для діабетиків. Простий та безпечний у використанні.">
@endsection

@section('title') Головна SugarNorm @endsection

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
              <h2 class="animate__animated animate__fadeInDown">Вітаю на сайті <span>SugarNorm</span></h2>
              <p class="animate__animated animate__fadeInUp">Цей сайт створено як корисний інструмент для людей які хворіють на цукровий діабет.</p>
              <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Повний опис</a>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" style="background-image: url(assets/img/slide/slide-2.jpg)">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animate__animated animate__fadeInDown">Тримай цукор під контролем</h2>
              <p class="animate__animated animate__fadeInUp">Записуйте та аналізуйте свій цурок крові.</p>
              <a href="{{route('home')}}" class="btn-get-started animate__animated animate__fadeInUp scrollto">Увійти в трекер здоров'я</a>
            </div>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item" style="background-image: url(assets/img/slide/slide-3.jpg)">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animate__animated animate__fadeInDown">Обирай корисне харчування</h2>
              <p class="animate__animated animate__fadeInUp">Одним із перших засобів контролю рівня цукру є дієта. Підбір привильних продуктів за глікемічним індексом - тримає діабет під контролем.</p>
              <a href="{{ route('ig.index') }}" class="btn-get-started animate__animated animate__fadeInUp scrollto">Зручна тпблиця продуктів</a>
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

  <!-- ======= Featured Services Section ======= -->
  <section id="featured-services" class="featured-services section-bg">
    <div class="container">

      <div class="row no-gutters">
        <div class="col-lg-4 col-md-6">
          <div class="icon-box">
            <div class="icon"><i class="bi bi-laptop"></i></div>
            <h4 class="title"><a href="">Lorem Ipsum</a></h4>
            <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="icon-box">
            <div class="icon"><i class="bi bi-briefcase"></i></div>
            <h4 class="title"><a href="">Dolor Sitema</a></h4>
            <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="icon-box">
            <div class="icon"><i class="bi bi-calendar4-week"></i></div>
            <h4 class="title"><a href="">Sed ut perspiciatis</a></h4>
            <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur trade stravi</p>
          </div>
        </div>
      </div>

    </div>
  </section><!-- End Featured Services Section -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <h1>Вас вітає щоденник діабетика SugarNorm</h1>
            {{-- <img src="/logo_main.jpg"  class="img-fluid mb-2" alt=""> --}}

            <p>Ласкаво просимо на наш веб-ресурс, який створений спеціально для тих, хто має діагноз діабету та бажає контролювати свій стан здоров'я вдома. Наш сайт надає можливість вести щоденник самоконтролю, що дозволить вам відстежувати ваш рівень цукру в крові та реєструвати показники глюкометра.</p>

            <p>Аналітика результатів буде надавати вам повну картину вашого здоров'я, а також допоможе вам зрозуміти, як ваш стан змінюється з часом. Крім того, наш сайт містить рекомендації щодо того, які продукти корисні для діабетиків, що дозволить вам керувати своєю дієтою та зберігати здоров'я під контролем.</p>

            <p>Наші функції легкі у використанні та дозволяють вам зберігати ваші дані в безпеці. Ми зробили все можливе, щоб зробити наш сайт простим та доступним для користувачів будь-якого рівня технічних знань.</p>

            <p>Нехай наш сайт стане для вас надійним помічником та допоможе вам забезпечити здоров'я та благополуччя на довгі роки.</p>

            <section class="mt-4">
                <h2>Навіщо контролювати глюкозу (цукор) крові діабетику?</h2>
                <p>
                    Контроль рівня цукру в крові дуже важливий для людей з діабетом, оскільки високий рівень цукру може призвести до серйозних ускладнень, таких як проблеми з серцево-судинною системою, нирками, зіром, нервовою системою та інші. Низький рівень цукру в крові також може бути небезпечним та призводити до гіпоглікемії, яка може бути життєво небезпечною. Контролювання рівня цукру в крові допомагає діабетикам уникнути цих ускладнень та підтримувати здоровий рівень цукру в крові, що забезпечує нормальне функціонування організму та допомагає запобігти розвитку діабетичних ускладнень.
                    <div class="mt-2">
                        <a href="/home" class=" btn btn-primary btn-lg">
                            Щоденник самоконтролю
                        </a> <!-- /.btn btn-primary btn-lg -->
                    </div>
                    <!-- /.mt-2 -->
                </p>
            </section>

            <section class="mt-4">
                <h2>Навіщо дієта діабетику?</h2>
                <p>
                    Для діабетиків правильне харчування є дуже важливим, оскільки вони повинні контролювати рівень цукру в крові. Неправильне харчування може привести до збільшення рівня цукру в крові, що може призвести до ускладнень діабету, таких як серцеві захворювання, проблеми зі зром, ниркова недостатність та інші. Тому діабетики повинні дотримуватись дієти, що містить достатню кількість білків, жирів та складних вуглеводів, а також включає в себе різноманітні фрукти, овочі та злаки. Правильне харчування допомагає контролювати рівень цукру в крові та знижує ризик розвитку діабетичних ускладнень.
                   <div class="mt-2">
                        <a href="/ig" class=" btn btn-primary btn-lg">
                            Список продуктыв за глікемічним індексом та ХО
                        </a> <!-- /.btn btn-primary btn-lg -->
                    </div>
                    <!-- /.mt-2 -->
                </p>
            </section>

            <section class="mt-4">
                <h2>Що таке хлібна одиниця (ХО)</h2>
                <p>
                    Хлібна одиниця - це спосіб вимірювання кількості вуглеводів у їжі, особливо в харчових продуктах, що містять вуглеводи, таких як хліб, крупи, фрукти та інше. Одиниця вимірювання хлібної одиниці допомагає людям з діабетом контролювати рівень цукру в крові та планувати свій раціон. Одна хлібна одиниця дорівнює близько 15 грамам вуглеводів.
                </p>
            </section>
        </div>
    </div>
</div>
@endsection
