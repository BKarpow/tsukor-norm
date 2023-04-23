@extends('layouts.app')

@section('title') Редагування виміру @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Мій цукор зараз</div>

                <div class="card-body">
                    @include('cabinet.buttons')
                    <form method="POST" action="{{route('sugar.edit',['mySugar'=>$s])}}">
                        @csrf

                        <div class="form-group mb-2">
                            <label for="glucose">Рівень цукру крові (ммол/л)</label>
                            <input
                                type="tel"
                                required
                                pattern="^\d+\.\d+$"
                                name="glucose"
                                id="glucose"
                                placeholder="наприклад 5,5"
                                class="form-control"
                                value="{{$s->glucoseLevel()}}"
                            />
                            @error('sugar')
                                <div class="alert alert-warning">
                                    <strong>
                                        {{$message}}
                                    </strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                            </div>
                        <!-- /.form-group mb-2 -->

                            <div class="py-2 mt-2">
        <h4>Додатково</h4>
        <div class="form-check form-switch">
            <input
                class="form-check-input"
                type="checkbox"
                role="switch"
                id="before_food"
                name="before_food"
                @if ((bool)$s->before_food) checked @endif
            />
            <label class="form-check-label" for="before_food"> До їжі </label>
        </div>

        <div class="form-check form-switch">
            <input
                class="form-check-input"
                type="checkbox"
                role="switch"
                id="after_food"
                name="after_food"
                @if ((bool)$s->after_food) checked @endif
            />
            <label class="form-check-label" for="after_food">
                Після їжі (не раніше ніж за 2 години ! )
            </label>
        </div>
    </div>
    <!-- .py-2 -->
    <div class="py-2">
        <div class="form-check form-switch">
            <input
                class="form-check-input"
                type="checkbox"
                role="switch"
                id="before_exercise"
                name="before_exercise"
                @if ((bool)$s->before_exercise) checked @endif
            />
            <label class="form-check-label" for="before_exercise">
                До фізичного навантаження
            </label>
        </div>

        <div class="form-check form-switch">
            <input
                class="form-check-input"
                type="checkbox"
                role="switch"
                id="exercise"
                name="exercise"
                @if ((bool)$s->exercise) checked @endif
            />
            <label class="form-check-label" for="exercise">
                Під час фізичного навантаження
            </label>
        </div>

        <div class="form-check form-switch">
            <input
                class="form-check-input"
                type="checkbox"
                role="switch"
                id="after_exercise"
                name="after_exercise"
                @if ((bool)$s->after_exercise) checked @endif
            />
            <label class="form-check-label" for="after_exercise">
                Після фізичного навантаження
            </label>
        </div>
    </div>
    <!-- /.py-2 -->

    <div class="py-2">
        <div class="form-check form-switch">
            <input
                class="form-check-input"
                type="checkbox"
                role="switch"
                id="stress"
                name="stress"
                @if ((bool)$s->stress) checked @endif
            />
            <label class="form-check-label" for="stress"> Стресс </label>
        </div>
    </div>
    <!-- /.py-2 -->

    <div class="py-2">
        <div class="form-check form-switch">
            <input
                class="form-check-input"
                type="checkbox"
                role="switch"
                id="disease"
                name="disease"
                @if ((bool)$s->disease) checked @endif
            />
            <label class="form-check-label" for="disease"> Хвороба </label>
        </div>
    </div>
    <!-- /.py-2 -->

                            <div class="form-group">
                                <textarea
                                    name="comment"
                                    id="comment"
                                    cols="20"
                                    rows="5"
                                    class="form-control"
                                    placeholder="Замітка"
                                >{{$s->comment}}</textarea>
                                <!-- /#.form-control -->
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group py-2">
                                <date-time-field dt="{{$s->created_at}}"></date-time-field>
                            </div>
                            <!-- /.form-group py-1 -->
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
