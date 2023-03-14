@extends('layouts.app')

@section('title') Оновлення  @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Оновлення {{$bp->sis}}/{{$bp->dis}}, {{$bp->pulse}}</div>

                <div class="card-body">
                    @include('cabinet.buttons')
                    <form method="POST" action="{{ route('bloodPressure.edit', ['bloodPressure'=>$bp]) }}">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sis">Сісталічне</label>
                                        <input
                                            type="text"
                                            name="sis"
                                            id="sis"
                                            placeholder="В мм.рт.ст."
                                            class="form-control"
                                            value="{{$bp->sis}}"
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
                                            type="text"
                                            name="dis"
                                            id="dis"
                                            placeholder="В мм.рт.ст."
                                            class="form-control"
                                            value="{{$bp->dis}}"
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
                                            type="text"
                                            name="pulse"
                                            id="pulse"
                                            placeholder="Ударів за хвилину"
                                            class="form-control"
                                            value="{{$bp->pulse}}"
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
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <textarea
                                            class="form-control"
                                            placeholder="Кілька слів про свій тиск..."
                                            id="note"
                                            name="note"
                                            >{{$bp->note}}</textarea>
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
                            <date-time-field dt="{{$bp->created_at}}" ></date-time-field>
                        </div>
                        <!-- /.form-group mb-1 -->

                        <div class="form-group ">
                            <button class="btn btn-success btn-lg">
                                <i class="fa-solid fa-floppy-disk"></i>
                                Зберегти
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
