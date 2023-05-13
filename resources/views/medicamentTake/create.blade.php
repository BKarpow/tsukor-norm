@extends('layouts.app')

@section('title') Прийом ліків @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('cabinet.buttons')
            <div class="card">
                <div class="card-header">Прийом ліків</div>

                <div class="card-body">

                        <div class="alert alert-info mb-2">
                            <p>Оберіть ліки та вкажіть кількість (таблеток), яку ви зараз приймаєте. Якщо немає припарату який ви зараз приймаєте, його потрібно <a href="{{route('medicamentTake.create')}}"> додати до списку ваших ліків</a>.</p>
                        </div>
                        <!-- /.alert alert-info -->
                        <create-med-take></create-med-take>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
