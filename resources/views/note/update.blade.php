@extends('layouts.app')

@section('title')
    Редагувати {{$note->title}}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @include('cabinet.buttons')
                <div class="card">
                    <div class="card-header">Редагувати</div>

                    <div class="card-body">
                        <form action="{{route('note.edit.action', ['note'=>$note])}}" method="POST">
                        @csrf
                        <div class="form-group mb-2">

                            <input
                                type="text"
                                name="title"
                                id="title"
                                placeholder="Заголовок нотатки ..."
                                class="form-control"
                                value="{{$note->title}}"
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
                            >{!! $note->text !!}</textarea>
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
                                    @if ((bool)$note->show_main)
                                        checked
                                    @endif
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
                            <div class="form-check form-switch">
                                <input
                                    class="form-check-input"
                                    @if ((bool)$note->public)
                                        checked
                                    @endif
                                    type="checkbox"
                                    role="switch"
                                    id="public"
                                    name="public"
                                />
                                <label class="form-check-label"
                                for="public">
                                   Показувати (Не в архіві!)
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
