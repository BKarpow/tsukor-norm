@extends('layouts.app')

@section('title')
    Трекер цукру
@endsection

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-11">

                <div class="card">
                    <div class="card-header">Моя карта</div>
                    <!-- home-analytics -->
                    <div class="card-body">

                        @if (auth()->user()->type_diabet != null)
                            @include('cabinet.buttons')
                            @include('cabinet.controlDiabet')
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#home-tab-pane" type="button" role="tab"
                                        aria-controls="home-tab-pane" aria-selected="true">
                                        Записник
                                    </button>
                                </li>
                                @if (auth()->user()->use_insulin)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" href="{{ route('insulinLog.index') }}" role="tab"
                                            title="Записи про прийом інсуліну" aria-selected="true">
                                            Інсулін
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" href="{{ route('insulin.index') }}" role="tab"
                                            title="Ваші препарати інсуліну" aria-selected="true">
                                            Препарати інсуліну
                                        </a>
                                    </li>
                                @endif

                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                    aria-labelledby="home-tab" tabindex="0">
                                    @include('sugar.sugarTable')
                                </div> <!-- End tab sugar -->



                            </div>
                        @else
                            @include('cabinet.setupType')
                        @endif
                    </div> <!-- /.cart-body -->
                </div>
            </div>
        </div>
    </div>
@endsection
