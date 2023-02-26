@extends('layouts.app')

@section('title') Оновити {{ $ig->food }} @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Дрдавання глікемычного індексу продукту</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('ig.update', ['indexGlucose' => $ig->id]) }}">
                        @csrf
                        <div class="form-group col-md-8">
                            <input
                                type="text"
                                name="food"
                                id="food"
                                placeholder="Назва продукту"
                                maxlength="245"
                                required
                                class="form-control p-3"
                                value="{{ $ig->food }}"
                            >
                            @error('food')
                                <div class="alert alert-warning">
                                    <strong>{{$message}}</strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group.col-md-4 -->
                        <div class="form-group mt-2 col-2">

                            <input
                                type="tel"
                                name="ig"
                                id="ig"
                                placeholder="Індекс"
                                title="Вкажіть глікемічний індекс"
                                pattern="^[\d]+$"
                                maxlength="3"
                                required
                                class="form-control "
                                value="{{ $ig->ig }}"
                            >
                            @error('ig')
                                <div class="alert alert-warning">
                                    <strong>{{$message}}</strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group.col-2 -->

                        <calc-ho-inputs :carbohydrates-prop="{{ $ig->carbohydrates }}"></calc-ho-inputs>

                        <div class="form-group mt-2 col-5">
                            <input
                                type="tel"
                                name="protein"
                                id="protein"
                                placeholder="Білок в 100г продукту"
                                title="Білок в 100г продукту"
                                maxlength="8"
                                class="form-control "
                                value="{{ $ig->protein }}"
                            >
                            @error('protein')
                                <div class="alert alert-warning">
                                    <strong>{{$message}}</strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group.col-5 -->

                        <div class="form-group mt-2 col-5">
                            <input
                                type="tel"
                                name="fats"
                                id="fats"
                                placeholder="Жири в 100г продукту"
                                title="Жири в 100г продукту"
                                maxlength="8"
                                class="form-control "
                                value="{{ $ig->fats }}"
                            >
                            @error('fats')
                                <div class="alert alert-warning">
                                    <strong>{{$message}}</strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group.col-5 -->



                        <div class="form-group mt-2 col-5">
                            <input
                                type="tel"
                                name="calories"
                                id="calories"
                                placeholder="ккал в 100г продукту"
                                title="ккал в 100г продукту"
                                maxlength="11"
                                class="form-control "
                                value="{{ $ig->calories }}"
                            >
                            @error('calories')
                                <div class="alert alert-warning">
                                    <strong>{{$message}}</strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group.col-5 -->

                        <div class="form-group mt-2 col-7">

                            <textarea
                            class="form-control"
                            placeholder="Кілька слів про продукт..."
                            id="description_food"
                            name="description_food"
                            >{{ $ig->description_food }}</textarea>


                            @error('description_food')
                                <div class="alert alert-warning">
                                    <strong>{{$message}}</strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group.col-7 -->
                        <div class="form-group mt-2 col-7">
                            <button class="btn btn-success btn-lg"> <i-add :size="32"></i-add> Оновити</button>
                        </div>
                        <!-- /.form-group.col-7 -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
