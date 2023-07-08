@extends('layouts.app')

@section('title') Моя аптечка @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
                    @include('cabinet.buttons')
                    <div class="my-1">
                        <a href="{{route('med.create')}}" class="btn btn-dark">
                            <i class="bi bi-node-plus-fill"></i> Додати припарат
                        </a> <!-- /.btn btn-dark -->
                    </div>
                    <!-- /.my-1 -->
                    <m-app></m-app>

        </div>
    </div>
 </div>

@endsection
