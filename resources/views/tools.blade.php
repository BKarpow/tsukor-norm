@extends('layouts.app')

@section('title') Мій щоденник @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Корисні інструменти</div>
                    <div class="my-1">
                        <tools-sugar></tools-sugar>
                    </div>
                    <!-- /.my-1 -->
                <div class="card-body">

                </div><!-- /.cart-body -->
            </div>
        </div>
    </div>
</div>
@endsection
