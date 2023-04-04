@extends('layouts.app')

@section('title') Препарати інсуліну @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
                    <div class="p-1 mb-1">
                        <a href="https://blog.tsukor-norm.pp.ua/vymiriuvannia/46-hlikovanyj-hemohlobin-hba1c-sho-tse-take-ta-iaki-joho-normy.html" class="btn btn-info">
                            Про інсулін?
                        </a> <!-- /.btn btn-info -->
                    </div>
                    <!-- /.p-1 mb-1 -->
                    @include('cabinet.buttons')

                    <div class="mb-1 p-1">
                        <h3>Прийом інсуліну</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-dark">
                                <thead>
                                    <tr>
                                        <th>Дата</th>
                                        <th>Інсулін</th>
                                        <th>Доза МО</th>
                                        <th>Коментар</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($insulins as $insulin)
                                        <tr>
                                            <td>{{$insulin->dateCreate('H:i')}}, <br>
                                                {{$insulin->dateCreate('d.m.Y')}}
                                            </td>
                                            <td>
                                                {{$insulin->insulin->name}}
                                                <div class="mt-1 d-flex justify-content-beetwen flex-wrap">
<a class="m-1 btn btn-dark btn-sm" href="{{ route('insulinLog.update', ['insulinTake'=>$insulin->id]) }}">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <delete-btn
                                                        delete-url="{{route('insulin.delete', ['insulin'=>$insulin])}}">
                                                        <button type="button" class="m-1 btn btn-dark btn-sm">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </delete-btn>
                                                </div>
                                                <!-- /.mt-1 -->

                                            </td>
                                            <td>
                                                {{$insulin->insulin_dose}}
                                            </td>
                                            <td>{{$insulin->note}}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- /.table -->
                            @if ($insulins->count() == 0)
                                <div class="alert alert-info">
                                    Ви ще не робили записи про прийом інсуліну,
                                    <a href="{{route('insulinLog.create')}}">Новий прийом</a>.
                                </div>
                                <!-- /.alert alert-info -->
                            @endif
                        </div>
                        <!-- /.table-responsive -->
                        <div class="d-flex flex-wrap my-2 justify-content-center align-items-center p-1">
                            {{$insulins->links()}}
                        </div><!-- /.d-flex my-2 justify-content-center align-items-center p-1 -->
                    </div>
                    <!-- /.mb-1 p-1 -->

        </div>
    </div>
 </div>

@endsection
