@extends('layouts.app')

@section('title') Оновити ліки {{$med->name}} @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Дрдавання перпарату</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('med.edit', ['medicament'=>$med]) }}">
                        @csrf
                        <div class="form-group col-md-8">
                            <input
                                type="text"
                                name="name"
                                id="name"
                                placeholder="Назва ліків"
                                maxlength="150"
                                required
                                class="form-control p-1"
                                value="{{$med->name}}"
                            >
                            @error('name')
                                <div class="alert alert-warning">
                                    <strong>{{$message}}</strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group.col-md-4 -->


                        <div class="form-group mt-2 col-5">
                            <input
                                type="text"
                                name="dose"
                                id="dose"
                                placeholder="Доза діючої речовини"
                                title="Доза діючої речовини"
                                maxlength="140"
                                class="form-control "
                                value="{{$med->dose}}"
                            >
                            @error('dose')
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
                                name="number"
                                id="number"
                                placeholder="Свільки таблеток в упаковці?"
                                title="Свільки таблеток в упаковці?"
                                maxlength="140"
                                class="form-control "
                                value="{{$med->number}}"
                            >
                            @error('number')
                                <div class="alert alert-warning">
                                    <strong>{{$message}}</strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group.col-5 -->

                         <div class="form-group mt-2 col-5">
                            <input
                                type="url"
                                name="url_shop"
                                id="url_shop"
                                placeholder="Посилання на tabletki.ua"
                                title="Посилання на tabletki.ua"
                                maxlength="140"
                                class="form-control "
                                value="{{$med->url_shop}}"
                            >
                            @error('url_shop')
                                <div class="alert alert-warning">
                                    <strong>{{$message}}</strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group.col-5 -->


                        <div class="form-check form-switch mt-2">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                role="switch"
                                id="sugar_lower"
                                name="sugar_lower"
                                @if((bool)$med->sugar_lower) checked @endif
                            />
                            <label class="form-check-label" for="sugar_lower"> Це припарат для зниження цукру в крові </label>
                        </div>



                        <div class="form-group mt-2 col-7">

                            <textarea
                            class="form-control"
                            placeholder="Кілька слів про ці ліки..."
                            id="note"
                            name="note"
                            >{{$med->note}}</textarea>


                            @error('note')
                                <div class="alert alert-warning">
                                    <strong>{{$message}}</strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group.col-7 -->
                        <div class="form-check form-switch">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                role="switch"
                                id="active"
                                name="active"
                                @if((bool)$med->active) checked @endif
                            />
                            <label class="form-check-label" for="active"> Я приймаю цей припарат </label>
                        </div>
                        <div class="form-group mt-2 col-7">
                            <button class="btn btn-primary btn-lg"> <i-add :size="32"></i-add> Зберегти</button>
                        </div>
                        <!-- /.form-group.col-7 -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
