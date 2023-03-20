@extends('layouts.app')

@section('title') Експорт в PDF @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Мої експорти</h2>
            <div class="my-1">
                <form action="{{route('pdfExport.store')}}" method="POST">
                    @csrf
                    <dt-diapason></dt-diapason>
                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-primary">
                            Згенерувати звіт PDF
                        </button> <!-- /.btn btn-primary -->
                    </div>
                    <!-- /.form-group mt-2 -->
                </form>

            </div>
            <!-- /.my-1 -->
            <ul class="list-group">
                @foreach ($pdfList as $pdf)
                <li class="list-group-item">
                    {{ $pdf }} &nbsp; <i class="fa-solid fa-file-pdf"></i> &nbsp;
                    <div class="d-flex justify-content-center">
                        <a title="Завантажити файл" href="{{ route('pdfExport.download', ['pdfName'=>$pdf]) }}" class="btn btn-success d-block mr-1">
                            <i class="fa-solid fa-download"></i>
                        </a> <!-- /.btn btn-success -->

                        <delete-btn delete-url="{{ route('pdfExport.delete', ['pdfName'=>$pdf]) }}">
                            <button title="Видалити файл" class="btn btn-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button> <!-- /.btn btn-danger -->
                        </delete-btn> <!-- /.btn btn-success -->
                    </div>
                    <!-- /.btn-group -->

                </li>
                <!-- /.list-group-item -->
                @endforeach

            </ul>
            <!-- /.list-group -->

        </div>
    </div>
 </div>

@endsection
