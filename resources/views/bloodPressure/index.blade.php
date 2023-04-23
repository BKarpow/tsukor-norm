@extends('layouts.app')

@section('title')
    АТ та пульс
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @include('cabinet.buttons')
                
                <div class="mb-1 p-1">
                    <h3>Ваші показники</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>АТ та пульс</th>
                                    <th>Дата</th>
                                    <th>Коментар</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bps as $bp)
                                    <tr>
                                        <td>
@if (!$bp->isNormalPressure())
<span style="background: var(--red-bg); color: white;">{{ $bp->sis }}/{{ $bp->dis }}</span>
@else
{{ $bp->sis }}/{{ $bp->dis }}
@endif
, {{$bp->pulse}}чсс
                                            <div class="mt-1 d-flex justify-content-beetwen flex-wrap">

                                                <delete-btn delete-url="{{ route('bloodPressure.delete', ['bloodPressure' => $bp]) }}">
                                                    <button type="button" class="m-1 btn btn-dark btn-sm">
                                                        Видалити
                                                    </button>
                                                </delete-btn>
                                            </div>
                                            <!-- /.mt-1 -->

                                        </td>
                                        <td>
                                            {{ $bp->dateCreate('H:i d.m.Y') }},

                                        </td>
                                        <td>{{ $bp->note }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- /.table -->
                        @if ($bps->count() == 0)
                            <div class="alert alert-info">
                                Поки немає жодного запису про вртеріальний тиск та пульс, <a
                                    href="{{ route('bloodPressure.create') }}">створити новий</a>.
                            </div>
                            <!-- /.alert alert-info -->
                        @endif
                    </div>
                    <!-- /.table-responsive -->
                    <div class="d-flex my-2 justify-content-center align-items-center p-1">
                        {{ $bps->links() }}
                    </div><!-- /.d-flex my-2 justify-content-center align-items-center p-1 -->
                </div>
                <!-- /.mb-1 p-1 -->

            </div>
        </div>
    </div>
@endsection
