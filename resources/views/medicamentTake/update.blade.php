@extends('layouts.app')

@section('title') Редагування часу та дози прийому ліків @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('cabinet.buttons')
            <div class="card">
                <div class="card-header">Прийом ліків</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('medicamentTake.update', ['medicamentTake' => $medicament]) }}">
                        @csrf
                        <div class="my-2 alert alert-info">
                            <p>
                                {{$medicament->med->name}}, ({{$medicament->med->dose}})
                            </p>
                            <p>
                                {{$medicament->med->note}}
                            </p>
                        </div>
                        <!-- /.my-2 alert alert-info -->

                        <div class="form-group col-md-8">
                            <label for="dose">Яку дозу приняли</label>
                            <input
                                type="tel"
                                name="dose"
                                id="dose"
                                placeholder="кількість таблеток"
                                required
                                class="form-control p-1"
                                value="{{$medicament->dose}}"
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
                            >{{$medicament->note}}</textarea>


                            @error('note')
                                <div class="alert alert-warning">
                                    <strong>{{$message}}</strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group.col-7 -->
                        
                        <div class="form-group mt-2 ">
                            <date-time-field dt="{{$medicament->created_at}}"></date-time-field>
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group mt-2 col-7">
                            <button class="btn btn-success btn-lg">
                                <i class="fa-sharp fa-solid fa-floppy-disk"></i>
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
