@extends('layouts.app')

@section('title')
    Продукти
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">

                @include('cabinet.buttons')

                <div class="mb-1 p-1">
                    <h3>Продукти</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-dark">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Продукт</th>
                                    <th>ГІ</th>
                                    <th>Вуглеводи</th>
                                    <th>Калорійність</th>
                                    <th>Public</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            @if ($product->public)
                                                <i style="color: var(--green-bg);" class="fa-solid fa-circle-check fa-lg"></i>
                                            @else
                                                <i style="color: var(--red-bg);" class="fa-solid fa-lock fa-lg"></i>
                                            @endif
                                            {{ $product->id }}
                                        </td>
                                        <td>{{ $product->food }}</td>
                                        <td>{{ $product->ig }}</td>
                                        <td>{{ $product->carbohydrates }}</td>
                                        <td>{{ $product->calories }}</td>
                                        <td>
                                            @if ($product->public)
                                                <a href="{{ route('admin.product.public.trigger', ['indexGlucose' => $product->id]) }}"
                                                    class="btn btn-dark">
                                                    Відмінити публікацію
                                                </a> <!-- /.btn btn-dark -->
                                            @else
                                                <a href="{{ route('admin.product.public.trigger', ['indexGlucose' => $product->id]) }}"
                                                    class="btn btn-success">
                                                    Дозволити публікацію
                                                </a> <!-- /.btn btn-dark -->
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- /.table -->

                    </div>
                    <!-- /.table-responsive -->
                    <div class="d-flex my-2 justify-content-center align-items-center p-1">
                        {{ $products->links() }}
                    </div><!-- /.d-flex my-2 justify-content-center align-items-center p-1 -->
                </div>
                <!-- /.mb-1 p-1 -->

            </div>
        </div>
    </div>
@endsection
