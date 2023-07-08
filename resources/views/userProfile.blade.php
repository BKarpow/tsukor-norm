@extends('layouts.app')

@section('title')
    Профіль користувача
@endsection

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-11">

                <div class="card">
                    <div class="card-header">Профіль та налаштування</div>
                    <!-- home-analytics -->
                    <div class="card-body">
                        @include('cabinet.setup')
                    </div> <!-- /.cart-body -->
                </div>
            </div>
        </div>
    </div>
@endsection
