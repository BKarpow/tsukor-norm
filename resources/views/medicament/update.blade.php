@extends('layouts.app')

@section('title')
    Оновити ліки {{ $med->name }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Налаштування перпарату</div>

                    <div class="card-body">

                        <div class="my-1">
                            @if (!$med->trash)
                                <a title="Видалити" class="btn btn-danger"
                                    href="{{ route('med.delete', ['medicament' => $med]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd"
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg> В корзину
                                </a>
                            @else
                                <a title="Відновити із корзини та зробити активними."
                                class="btn btn-success"
                                    href="{{ route('med.restore', ['medicament' => $med]) }}">
                                    <i class="fa-solid fa-trash-arrow-up fa-xl"></i> &nbsp; Відновити та активувати
                                </a>
                            @endif

                        </div>
                        <!-- /.my-1 -->
                        <form method="POST" action="{{ route('med.edit', ['medicament' => $med]) }}">
                            @csrf
                            <div class="form-group col-md-8">
                                <input type="text" name="name" id="name" placeholder="Назва ліків"
                                    maxlength="150" required class="form-control p-1" value="{{ $med->name }}">
                                @error('name')
                                    <div class="alert alert-warning">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    <!-- /.alert alert-warning -->
                                @enderror
                            </div>
                            <!-- /.form-group.col-md-4 -->


                            <div class="form-group mt-2 col-5">
                                <input type="text" name="dose" id="dose" placeholder="Доза діючої речовини"
                                    title="Доза діючої речовини" maxlength="140" class="form-control "
                                    value="{{ $med->dose }}">
                                @error('dose')
                                    <div class="alert alert-warning">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    <!-- /.alert alert-warning -->
                                @enderror
                            </div>
                            <!-- /.form-group.col-5 -->

                            <div class="form-group mt-2 col-5">
                                <input type="tel" name="number" id="number"
                                    placeholder="Свільки таблеток в упаковці?" title="Свільки таблеток в упаковці?"
                                    maxlength="140" class="form-control " value="{{ $med->number }}">
                                @error('number')
                                    <div class="alert alert-warning">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    <!-- /.alert alert-warning -->
                                @enderror
                            </div>
                            <!-- /.form-group.col-5 -->

                            {{-- <div class="form-group mt-2 col-5">
                            <input
                                type="url"
                                name="url_shop"
                                id="url_shop"
                                placeholder="Посилання на tabletki.ua"
                                title="Посилання на tabletki.ua"
                                maxlength="140"
                                class="form-control "
                                value="{{$med->url_shop}}"
                            >
                            @error('url_shop')
                                <div class="alert alert-warning">
                                    <strong>{{$message}}</strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group.col-5 --> --}}


                            <div class="form-check form-switch my-2">
                                <input class="form-check-input" type="checkbox" role="switch" id="sugar_lower"
                                    name="sugar_lower" @if ((bool) $med->sugar_lower) checked @endif />
                                <label class="form-check-label" for="sugar_lower"> Це припарат для зниження цукру в крові
                                </label>
                            </div>



                            <div class="form-group mt-2 col-7">

                                <textarea class="form-control" placeholder="Кілька слів про ці ліки..." id="note" name="note">{{ $med->note }}</textarea>


                                @error('note')
                                    <div class="alert alert-warning">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    <!-- /.alert alert-warning -->
                                @enderror
                            </div>
                            <!-- /.form-group.col-7 -->
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="active" name="active"
                                    @if ((bool) $med->active) checked @endif />
                                <label class="form-check-label" for="active"> Я приймаю цей припарат </label>
                            </div>
                            <div class="form-group mt-2 col-7">
                                <button class="btn btn-primary btn-lg">
                                    <i-add :size="32"></i-add> Зберегти
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
