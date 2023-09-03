@extends('layouts.app')

@section('title')
    Додати нотатку
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @include('cabinet.buttons')
                <div class="card">
                    <div class="card-header">Нова нотатка</div>

                    <div class="card-body">
                        <form action="{{route('note.create.store')}}" method="POST">
                        @csrf
                        <div class="form-group mb-2">

                            <input
                                type="text"
                                name="title"
                                id="title"
                                placeholder="Заголовок нотатки ..."
                                class="form-control"
                                value="{{old('title')}}"
                            />
                            @error('title')
                                <alert-w title="{{$message}}"></alert-w>
                            @enderror
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group mb-2">
                            <textarea
                                name="text"
                                id="text"
                                placeholder="Нотатка ..."
                                required
                                cols="30"
                                rows="10"
                                class="form-control"
                            >{!! old('text') !!}</textarea>
                            <!-- /#.form-control -->
                            @error('text')
                                <alert-w title="{{$message}}"></alert-w>
                            @enderror
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group mb-2">
                            <div class="form-check form-switch">
                                <input
                                    class="form-check-input"
                                    checked
                                    type="checkbox"
                                    role="switch"
                                    id="showMain"
                                    name="showMain"
                                />
                                <label class="form-check-label"
                                for="showMain">
                                    Показувати на головні сторінці
                                </label>
                            </div>
                        </div>
                        <!-- /.form-group mb-2 -->
                        <div class="form-group mb-2">
                            <button type="submit" class="btn btn-primary">
                                Зберегти
                            </button> <!-- /.btn-btn-primary -->
                        </div>
                        <!-- /.form-group mb-2 -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
