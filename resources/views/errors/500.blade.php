@extends('layouts.app')

@section('title') 500 - Сервер чудить. @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center" style="height: 100vh;">
        <div class="col-md-11 d-flex flex-wrap justify-content-center align-items-center">
            <h1 class="err-code" style="font-size: 8rem;color:#5cb874;">500</h1>
            <h3 class="mx-2">Помилка сервера, щось йому не добре :(</h3>
        </div>
        <!-- /.col-md-11 -->
    </div>
 </div>

@endsection
