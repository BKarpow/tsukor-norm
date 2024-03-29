@extends('layouts.app')

@section('title')
    Глікемічний індекс та хлібні одиниці: корисна інформація для здорового харчування
@endsection
{{-- @section('meta')
    <meta name="description" content="Дізнайтеся глікемічні індекси продуктів та розрахуйте хлібні одиниці з нашою корисною інструментальною сторінкою. Зробіть своє харчування здоровішим та керуйте рівнем цукру в крові за допомогою нашого простого та зручного калькулятора. Приєднуйтесь до нашої спільноти та зберігайте свої улюблені продукти для швидкого доступу до них у майбутньому. Доступно для безкоштовного використання!"/>
@endsection --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('cabinet.buttons')
                <div class="mt-1 d-flex justify-content-center">
                    <a href="{{ route('ig.add') }}" class="btn-tn m-1  scrollto">
                        <i class="fa-solid fa-square-plus"></i> Додати продукт
                    </a><!-- /.btn btn-primary -->
                </div>
                <!-- /.mt-1 d-flex justify-content-center -->
            </div>
            <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

    <ig-list></ig-list>
@endsection
