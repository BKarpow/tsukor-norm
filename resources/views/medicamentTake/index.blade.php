@extends('layouts.app')

@section('title')
    Препарати ліків
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">

                @include('cabinet.buttons')

                <div class="mb-1 p-1">
                    <h3>Прийом ліків</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-dark">
                            <thead>
                                <tr>
                                    <th>Дата</th>
                                    <th>Ліки</th>
                                    <th>Доза МО</th>
                                    <th>Коментар</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($meds as $m)
                                    <tr>
                                        <td>{{ $m->dateCreate('H:i') }}, <br>
                                            {{ $m->dateCreate('d.m.Y') }}
                                        </td>
                                        <td>
                                            {{ $m->med->name }}
                                            <div class="mt-1 d-flex justify-content-beetwen flex-wrap">
                                                <a class="m-1 btn btn-dark btn-sm"
                                                    href="{{ route('medicamentTake.update', ['medicamentTake' => $m]) }}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <delete-btn
                                                    delete-url="{{ route('medicamentTake.delete', ['medicamentTake' => $m]) }}">
                                                    <button type="button" class="m-1 btn btn-dark btn-sm">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </delete-btn>
                                            </div>
                                            <!-- /.mt-1 -->

                                        </td>
                                        <td>
                                            {{ $m->dose }}x{{$m->med->dose}}
                                        </td>
                                        <td>{{ $m->note }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- /.table -->
                        @if ($meds->count() == 0)
                            <div class="alert alert-info">
                                Ви ще не робили записи про прийом ліків,
                                <a href="{{ route('medicamentTake.create') }}">Новий прийом</a>.
                            </div>
                            <!-- /.alert alert-info -->
                        @endif
                    </div>
                    <!-- /.table-responsive -->
                    <div class="d-flex flex-wrap my-2 justify-content-center align-items-center p-1">
                        {{ $meds->links() }}
                    </div><!-- /.d-flex my-2 justify-content-center align-items-center p-1 -->
                </div>
                <!-- /.mb-1 p-1 -->

            </div>
        </div>
    </div>
@endsection
