@extends('layouts.app')

@section('title')
    Додати глікозельований гемоглобін HbA1c
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @include('cabinet.buttons')
                <div class="p-1 mb-1 d-flex justify-content-between align-items-center">
                    <a href="{{route('hba1c.create')}}" class="btn btn-primary mr-2">
                        Додати новий показник
                    </a> <!-- /.btn btn-primary mr-2 -->
                    <a href="https://blog.tsukor-norm.pp.ua/vymiriuvannia/46-hlikovanyj-hemohlobin-hba1c-sho-tse-take-ta-iaki-joho-normy.html"
                        class="btn btn-info mr-2">
                        Що таке глікований гемоглобін та його норми?
                    </a> <!-- /.btn btn-info -->

                </div>
                <!-- /.p-1 mb-1 -->
                <div class="mb-1 p-1">
                    <h3>Мої рівні HbA1c</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>HbA1c %</th>
                                    <th>Дата</th>
                                    <th>Коментар</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hba1cs as $hb)
                                    <tr>
                                        <td>
@if ($hb->exceedingNormDiabet())
<span style="background: var(--red-bg); color: white;">{{ $hb->percentage }}%</span>,
@else
{{ $hb->percentage }}%,
@endif
                                            <div class="mt-1 d-flex justify-content-beetwen flex-wrap">

                                                <delete-btn delete-url="{{ route('hba1c.delete', ['hbA1c' => $hb]) }}">
                                                    <button type="button" class="m-1 btn btn-dark btn-sm">
                                                        Видалити
                                                    </button>
                                                </delete-btn>
                                            </div>
                                            <!-- /.mt-1 -->

                                        </td>
                                        <td>
                                            {{ $hb->dateCreate('d.m.Y') }},
                                            <div class="mt-1">
                                                <small>
                                                    {{ $hb->countLastMoons() }} місяці(в) та
                                                    {{ $hb->countLastDays() }} дні(в) тому.
                                                </small>
                                            </div>
                                            <!-- /.mt-1 -->
                                        </td>
                                        <td>{{ $hb->note }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- /.table -->
                        @if ($hba1cs->count() == 0)
                            <div class="alert alert-info">
                                Поки немає жодного запису про Ваш рівень глікованого гемоглобіну, <a
                                    href="{{ route('hba1c.create') }}">створити новий</a>.
                            </div>
                            <!-- /.alert alert-info -->
                        @endif
                    </div>
                    <!-- /.table-responsive -->
                    <div class="d-flex my-2 justify-content-center align-items-center p-1">
                        {{ $hba1cs->links() }}
                    </div><!-- /.d-flex my-2 justify-content-center align-items-center p-1 -->
                </div>
                <!-- /.mb-1 p-1 -->

            </div>
        </div>
    </div>
@endsection
