@extends('layouts.app')

@section('title') Додати показник глюкози @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Мій цукор зараз</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('sugar.add.store') }}">
                        @csrf




                        <div class="form-group py-2">
                            <h5>Виміряно (дата/час)</h5>
                            <date-time-field></date-time-field>
                        </div>
                        <!-- /.form-group py-1 -->

                        <sugar-add-triggers></sugar-add-triggers>

                        

                        <div class="form-group mt-2 col-7">
                            <button class="btn btn-primary btn-lg"> <i-add :size="32"></i-add> Додати</button>
                        </div>
                        <!-- /.form-group.col-7 -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
