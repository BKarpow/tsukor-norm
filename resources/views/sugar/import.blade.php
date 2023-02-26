@extends('layouts.app')

@section('title') Імпортуваня показників @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Мій цукор зараз</div>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" id="upload-file" action="{{ route('sugar.import.file.store') }}" >
                        @csrf
                        <div class="row">

                            <div class="col-md-12">
                                <h2>Імпортувати показники глюкози з мобільного застосунку
                                    <a href="https://play.google.com/store/apps/details?id=com.axel_stein.glucose_tracker" target="_blank">"Трекер Діабету"</a>
                                </h2>

                                <div class="form-check form-switch mt-2">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        role="switch"
                                        id="uniq_glu"
                                        name="uniq_glu"
                                        checked
                                    />
                                    <label class="form-check-label" for="uniq_glu">
                                        Імпортувати тільки неіснуючі показники.
                                    </label>
                                </div>

                                {{-- <div class="form-check form-switch mt-2">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        role="switch"
                                        id="clear_old"
                                        name="clear_old"
                                    />
                                    <label class="form-check-label" for="clear_old">
                                        Видалити попередні записи вимірів глюкози?
                                    </label>
                                </div> --}}
                                <div class="form-group my-2">
                                        <label for="file" class="form-label">Оберіть файл backup.json</label>
                                        <input class="form-control form-control-lg" id="file" name="file" type="file">

                                        @error('file')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" id="submit">Імпортувати -> </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
