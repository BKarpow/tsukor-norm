@extends('layouts.app')

@section('title') 401 - Несанкціонований вхід. @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center" style="height: 100vh;">
        <div class="col-md-11 d-flex flex-wrap justify-content-center align-items-center">
            <h1 class="err-code" style="font-size: 8rem;color:#5cb874;">401</h1>
            <h3 class="mx-2"> Несанкціонований вхід :(</h3>
        </div>
        <!-- /.col-md-11 -->
    </div>
 </div>

@endsection



@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized'))
