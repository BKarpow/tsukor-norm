@extends('layouts.app')

@section('title')
    Мої нотатки
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">

                @include('cabinet.buttons')
                <div class="my-1">
                    <div class="btn-group">
                        <a href="{{ route('note.create') }}" class="btn btn-dark">
                            <i class="bi bi-node-plus-fill"></i> Нова нотатка
                        </a> <!-- /.btn btn-dark -->
                        <a href="{{ route('note.arhive') }}" class="btn btn-dark">Архів
                        </a> <!-- /.btn btn-dark -->


                    </div>
                    <!-- /.btn-group -->

                </div>
                <!-- /.my-1 -->
                <div class="mb-1 p-1">
                    <h3>Нотатки</h3>
                    <div class="notes row flex-wrap justify-content-center  align-items-center">
                        @foreach ($notes as $note)
                            <div class="note col-md-5">
                                @if (!empty($note->title))
                                    <h3>{{ $note->title }}</h3>
                                @endif
                                <p>{{ $note->shortText() }}</p>
                                <div class="mt-1 d-flex justify-content-end p-1">
                                    <small class="d-block">
                                        @if ($note->dateCreate() != $note->dateUpdate())
                                            Редаговано: {{$note->dateUpdate()}}
                                        @else
                                            Створено: {{$note->dateCreate()}}
                                        @endif

                                    </small>
                                </div>
                                <!-- /.mt-1 d-flex justify-content-end p-1 -->
                                <div class="my-1 px-2">
                                    <div class="btn-group">
                                        <a href="{{ route('note.show', ['note' => $note]) }}" class="btn btn-dark">
                                            <i class="fa-solid fa-eye fa-xl"></i>
                                        </a> <!-- /.btn btn-info -->
                                        <a href="{{ route('note.edit', ['note' => $note]) }}" class="btn btn-dark"><i
                                                class="fa-solid fa-pen-to-square"></i></a>
                                        <ask
                                            delete-url="/notes/delete/{{$note->id}}"
                                            ask="Видалити нотатку назавжди?"
                                        >
                                            <i class="fa-solid fa-trash-can fa-xl"></i>
                                        </ask>
                                        <ask
                                            delete-url="/notes/move-arhive/{{$note->id}}"
                                            ask="Перенести в арзів?"
                                        >
                                            <i class="fa-solid fa-inbox fa-xl"></i>
                                        </ask>
                                    </div>
                                    <!-- /.btn-group -->

                                </div>
                                <!-- /.mt-1 px-2 -->
                            </div>
                            <!-- /.note -->
                        @endforeach
                    </div>
                    <!-- /.notes d-flex flex-wrap justify-content-center align-items-center -->
                    <div class="d-flex flex-wrap my-2 justify-content-center align-items-center p-1">
                        {{ $notes->links() }}
                    </div><!-- /.d-flex my-2 justify-content-center align-items-center p-1 -->
                </div>
                <!-- /.mb-1 p-1 -->

            </div>
        </div>
    </div>
@endsection
