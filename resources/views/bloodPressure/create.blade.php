@extends('layouts.app')

@section('title') Додати АТ тв пульс @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Дрдавання АТ</div>

                <div class="card-body">
                    @include('cabinet.buttons')
                    <form method="POST" action="{{ route('bloodPressure.create') }}">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tel">Сісталічне</label>
                                        <input
                                            type="tel"
                                            name="sis"
                                            id="sis"
                                            placeholder="В мм.рт.ст."
                                            class="form-control"
                                            value="{{old('sis')}}"
                                        >
                                        @error('sis')
                                            <div class="alert alert-warning">
                                                <strong>{{$message}}</strong>
                                            </div>
                                            <!-- /.alert alert-warning -->
                                        @enderror
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col-md-3 -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dis">Діасталічне</label>
                                        <input
                                            type="tel"
                                            name="dis"
                                            id="dis"
                                            placeholder="В мм.рт.ст."
                                            class="form-control"
                                            value="{{old('dis')}}"
                                        >
                                        @error('dis')
                                            <div class="alert alert-warning">
                                                <strong>{{$message}}</strong>
                                            </div>
                                            <!-- /.alert alert-warning -->
                                        @enderror
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col-md-3 -->
                            </div>
                            <!-- /.row -->
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pulse">Пульс</label>
                                        <input
                                            type="tel"
                                            name="pulse"
                                            id="pulse"
                                            placeholder="Ударів за хвилину"
                                            class="form-control"
                                            value="{{old('pulse')}}"
                                        >
                                        @error('pulse')
                                            <div class="alert alert-warning">
                                                <strong>{{$message}}</strong>
                                            </div>
                                            <!-- /.alert alert-warning -->
                                        @enderror
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col-md-3 -->
                            </div>
                            <!-- /.row -->
                            <div class="row mt-1">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <textarea
                                            class="form-control"
                                            placeholder="Кілька слів про свій тиск..."
                                            id="note"
                                            name="note"
                                            required
                                            >Поточний тиск</textarea>
                                            @error('note')
                                                <div class="alert alert-warning">
                                                    <strong>{{$message}}</strong>
                                                </div>
                                                <!-- /.alert alert-warning -->
                                            @enderror
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col-md-3 -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container -->
                        <div class="form-group mt-1">
                            <date-time-field ></date-time-field>
                        </div>
                        <!-- /.form-group mb-1 -->

                        <div class="form-group mt-2 ">
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
