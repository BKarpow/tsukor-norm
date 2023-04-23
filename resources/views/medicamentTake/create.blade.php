@extends('layouts.app')

@section('title') Прийом ліків @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('cabinet.buttons')
            <div class="card">
                <div class="card-header">Прийом ліків</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('medicamentTake.create') }}">
                        @csrf
                        <div class="form-group col-md-8">
                            <label for="med_id">Оберіть ліки які ви приймаєте</label>
                            <select name="med_id" id="med_id" class="form-control">
                                @if ($medicaments->count() == 0)
                                    <option disabled >У вас ще не додані ліки.</option>
                                @else
                                    @foreach ($medicaments as $med)
                                        <option value="{{$med->id}}">{{$med->name}}</option>
                                    @endforeach
                                @endif
                                </select>
                            <div class="alert alert-info mt-2">
                                <p>Якщо немає припарату який ви зараз приймаєте, його потрібно <a href="{{route('insulin.create')}}"> додати до списку ваших припаратів інсуліну</a>.</p>
                            </div>
                            <!-- /.alert alert-info -->
                            @error('med_id')
                                <div class="alert alert-warning">
                                    <strong>{{$message}}</strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group.col-md-4 -->

                        <div class="form-group col-md-8">
                            <label for="dose">Скільки таблеток ви п'єте</label>
                            <input
                                type="tel"
                                name="dose"
                                id="dose"
                                placeholder="кількість таблеток"
                                required
                                class="form-control p-1"
                                value="1"
                            >
                            @error('dose')
                                <div class="alert alert-warning">
                                    <strong>{{$message}}</strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group.col-md-4 -->

                        <div class="form-group mt-2 col-7">

                            <textarea
                            class="form-control"
                            placeholder="Кілька слів ..."
                            id="note"
                            name="note"
                            >Прийом ліків</textarea>


                            @error('note')
                                <div class="alert alert-warning">
                                    <strong>{{$message}}</strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group.col-7 -->
                        <div class="form-group mt-2 ">
                            <date-time-field></date-time-field>
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group mt-2 col-7">
                            <button class="btn btn-success btn-lg">
                                <i-add :size="32"></i-add>
                                Додати
                            </button>
                        </div>
                        <!-- /.form-group.col-7 -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
