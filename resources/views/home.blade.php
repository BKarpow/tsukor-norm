@extends('layouts.app')

@section('title') Мій щоденник @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Моя карта</div>

            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link active"
                            id="home-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#home-tab-pane"
                            type="button"
                            role="tab"
                            aria-controls="home-tab-pane"
                            aria-selected="true">
                            Мій цукор
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link"
                            id="bp-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#bp-tab-pane"
                            type="button"
                            role="tab"
                            aria-controls="bp-tab-pane"
                            aria-selected="false">
                            АТ та пульс
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link"
                            id="med"
                            data-bs-toggle="tab"
                            data-bs-target="#med-pane"
                            type="button" role="tab"
                            aria-controls="med-pane"
                            aria-selected="false">
                            Мої ліки
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link"
                            id="profile-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#profile-tab-pane"
                            type="button" role="tab"
                            aria-controls="profile-tab-pane"
                            aria-selected="false">
                            Налаштування
                        </button>
                    </li>
                </ul>
                    <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        @include('cabinet.sugar')
                    </div> <!-- End tab sugar -->
                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        @include('cabinet.setup')
                    </div> <!-- End tab setting -->
                    <div
                        class="tab-pane fade"
                        id="bp-tab-pane"
                        role="tabpanel"
                        aria-labelledby="bp-tab"
                        tabindex="0">
                        @include('cabinet.bp')
                    </div> <!-- End tab bp -->

                    <div
                        class="tab-pane fade"
                        id="med-pane"
                        role="tabpanel"
                        aria-labelledby="med"
                        tabindex="0">
                        @include('cabinet.medicament')
                    </div> <!-- End tab bp -->

                    </div>
                </div> <!-- /.cart-body -->
            </div>
        </div>
    </div>
</div>
@endsection
