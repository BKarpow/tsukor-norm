@extends('layouts.app')

@section('title')
    Трекер цукру
@endsection

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-11">
                @if (session('status'))
                    <div class="alert alert-success mb-2">
                        {{ session('status') }}
                    </div>
                    <!-- /.alert alert-success -->
                @endif
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
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="home-analytics" data-bs-toggle="tab"
                                        data-bs-target="#home-analytics-pane" type="button" role="tab"
                                        aria-controls="home-analytics-pane" aria-selected="false">
                                        Аналітика цукру
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="{{ route('hba1c.index') }}" role="tab"
                                        title="Глікований гемоглобін" aria-selected="true">
                                        HbA1c
                                    </a>
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
                                @if (auth()->user()->use_tablet)
                                    <li class="nav-item" role="presentation">
                                        <a href="{{ route('medicamentTake.index') }}" class="nav-link" role="tab"
                                            aria-selected="false">
                                            Прийом ліків
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="med" data-bs-toggle="tab"
                                            data-bs-target="#med-pane" type="button" role="tab"
                                            aria-controls="med-pane" aria-selected="false">
                                            Мої ліки
                                        </button>
                                    </li>
                                @endif
                                <li class="nav-item" role="presentation">
                                    <a href="{{ route('bloodPressure.index') }}" class="nav-link" role="tab"
                                        aria-selected="false">
                                        АТ та пульс
                                    </a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#profile-tab-pane" type="button" role="tab"
                                        aria-controls="profile-tab-pane" aria-selected="false">
                                        Налаштування
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                    aria-labelledby="home-tab" tabindex="0">
                                    @include('sugar.sugarTable')
                                </div> <!-- End tab sugar -->
                                <div class="tab-pane fade " id="home-analytics-pane" role="tabpanel"
                                    aria-labelledby="home-analytics" tabindex="0">
                                    @include('cabinet.sugar')
                                </div> <!-- End tab sugar -->
                                <div class="tab-pane fade " id="profile-tab-pane" role="tabpanel"
                                    aria-labelledby="profile-tab" tabindex="0">
                                    @include('cabinet.setup')
                                </div> <!-- End tab setting -->

                                @if (auth()->user()->use_tablet)
                                    <div class="tab-pane fade" id="med-pane" role="tabpanel" aria-labelledby="med"
                                        tabindex="0">
                                        @include('cabinet.medicament')
                                    </div> <!-- End tab bp -->
                                @endif

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
