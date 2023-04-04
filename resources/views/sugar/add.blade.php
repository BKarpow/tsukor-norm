@extends('layouts.app')

@section('title') Додати показник глюкози @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Мій цукор зараз</div>

                <div class="card-body">

                    <div class="alert alert-info my-1">
                        <h5>Зверніть увагу!</h5>
                        <p>Гіпоглікемія - це стан, коли рівень глюкози в крові стає дуже низьким. Це може спричинити різноманітні симптоми, такі як:</p>
                        <ol>
                            <li>Головний біль та позив до блювання</li>
                            <li>Голод та пітливість</li>
                            <li>Серцебиття, тремтіння рук та ніг</li>
                            <li>Слабкість та втома</li>
                            <li>Запаморочення та погане самопочуття</li>
                            <li>Розлади свідомості, які можуть включати збудження, агресію, дезорієнтацію та навіть втрату свідомості</li>

                        </ol>
                        <a href="https://blog.tsukor-norm.pp.ua/vymiriuvannia/43-hipohlikemiia-symptomy-ta-shcho-robyty.html" class="mt-2">
                            Що робити?
                        </a> <!-- /.mt-2 -->
                    </div>
                    <!-- /.alert alert-info my-1 -->
                    @include('cabinet.buttons')
                    <form method="POST" action="{{ route('sugar.add.store') }}">
                        @csrf
                        

                        <sugar-add-triggers></sugar-add-triggers>


                        <div class="form-group py-2">
                            <date-time-field></date-time-field>
                        </div>
                        <!-- /.form-group py-1 -->
                        <div class="form-group mt-2 col-7">
                            <button class="btn btn-primary btn-lg"> <i-add :size="32"></i-add> Додати</button>
                        </div>
                        <!-- /.form-group.col-7 -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
