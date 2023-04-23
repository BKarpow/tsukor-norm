@extends('layouts.app')

@section('title') Тест на кетонові тіла (ацетон) @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('cabinet.buttons')
            <div class="card">
                <div class="card-header">Кетонові тіла</div>

                <div class="card-body">
                    {{-- <div class="p-1 mb-1">
                        <h3>Коротко про HbA1c.</h3>
                        <p><strong>HbA1c</strong> (або глікований гемоглобін А) - це тест, який використовується для оцінки середнього рівня глюкози в крові за останні 2-3 місяці. HbA1c вимірює кількість гемоглобіну, пов'язаного з глюкозою в червоних кров'яних клітинах. Цей тест часто використовується для діагностики та контролю діабету, оскільки він надає інформацію про середній рівень глюкози в крові за більш тривалий період часу, ніж звичайний крововипробування на глюкозу. Чим вищий рівень HbA1c, тим вищий ризик розвитку ускладнень діабету, таких як ураження судин, нервів та нирок.</p>
                    </div>
                    <!-- /.p-1 mb-1 --> --}}
                    <form method="POST" action="{{ route('keton.create') }}">
                        @csrf

                        <keton-input></keton-input>
                        <div class="form-group mt-2 col-7">

                            <textarea
                            class="form-control"
                            placeholder="Кілька слів ..."
                            id="note"
                            name="note"
                            >{{old('note')}}</textarea>


                            @error('note')
                                <div class="alert alert-warning">
                                    <strong>{{$message}}</strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group.col-7 -->

                        <div class="form-group mt-1">
                            <date-time-field :only-date="true"></date-time-field>
                        </div>
                        <!-- /.form-group mb-1 -->

                        <div class="form-group mt-2 col-7">
                            <button class="btn btn-success btn-lg">
                                <i-add :size="32"></i-add>
                                Додати
                            </button>
                        </div>
                        <!-- /.form-group.col-7 -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
