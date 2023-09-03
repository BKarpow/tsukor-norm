@extends('layouts.app')

@section('title')
    {{ $note->title }} | Нотатка
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">

                @include('cabinet.buttons')
                <div class="mb-1 p-1">
                    <h1>{{ $note->title }}</h1>
                    <div  class=" mt-4 mb-2 notes row flex-wrap justify-content-center  align-items-center">

                        <div style="height: 65vh;" class="note col-11 m-2 p-2">

                            {!! $note->text !!}
                        </div>
                        <!-- /.note -->
                    </div>
                    <!-- /.notes d-flex flex-wrap justify-content-center align-items-center -->

                </div>
                <!-- /.mb-1 p-1 -->
            </div>
        </div>
    </div>
@endsection
