@extends('layouts.app')

@section('title') Оновити HbA1c @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Оновлення HbA1c</div>

                <div class="card-body">
                    <form method="POST" action="{{route('hba1c.edit', ['hbA1c' => $hba1c])}}">
                        @csrf
                        <div class="form-group col-md-8">
                            <input
                                type="text"
                                name="percentage"
                                id="percentage"
                                placeholder="Рівень HbA1c в %"
                                maxlength="150"
                                required
                                class="form-control p-1"
                                value="{{ $hba1c->percentage }}"
                            >
                            @error('percentage')
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
                            >{{ $hba1c->note }}</textarea>


                            @error('note')
                                <div class="alert alert-warning">
                                    <strong>{{$message}}</strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group.col-7 -->

                        <div class="form-group mt-1">
                            <date-time-field
                                :only-date="true"
                                dt="{{$hba1c->created_at}}"
                            >
                        </date-time-field>
                        @error('created_at')
                                <div class="alert alert-warning">
                                    <strong>{{$message}}</strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group mb-1 -->

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
