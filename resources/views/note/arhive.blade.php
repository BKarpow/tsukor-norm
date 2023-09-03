@extends('layouts.app')

@section('title')
    Архів нотаток
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">

                @include('cabinet.buttons')
                <div class="my-1">
                    <a href="{{ route('note.create') }}" class="btn btn-dark">
                        <i class="bi bi-node-plus-fill"></i> Нова нотатка
                    </a> <!-- /.btn btn-dark -->
                </div>
                <!-- /.my-1 -->
                <div class="mb-1 p-1">
                    <h3>В архіві</h3>
                    <div class="notes row flex-wrap justify-content-center  align-items-center">
                        @foreach ($notes as $note)
                            <div class="note col-5">
                                @if (!empty($note->title))
                                    <h3>{{ $note->title }}</h3>
                                @endif
                                <p>{{ $note->shortText() }}</p>
                                <div class="my-1 px-2">
                                    <div class="btn-group">
                                        <a href="{{ route('note.show', ['note' => $note]) }}" class="btn btn-dark">
                                            Читати
                                        </a> <!-- /.btn btn-info -->
                                        <a href="{{ route('note.edit', ['note' => $note]) }}" class="btn btn-dark"><i
                                                class="fa-solid fa-pen-to-square"></i></a>
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
