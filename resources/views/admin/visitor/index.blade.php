@extends('layouts.app')

@section('title')
    Користувачі
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">

                @include('cabinet.buttons')

                <div class="mb-1 p-1">
                    <h3>Ip та агенти користувачів</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-dark">
                            <thead>
                                <tr>
                                    <th>IP</th>
                                    <th>UserAgent</th>
                                    <th>Переглядів</th>
                                    <th>First</th>
                                    <th>last</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vs as $v)
                                    <tr>
                                        <td>{{$v->ip}} &nbsp;
                                            @if ($v->trust)
                                                <i style="color: var(--green-bg);" class="bi bi-bookmark-check-fill"></i>
                                            @else
                                                <i style="color: var(--red-bg);" class="bi bi-sign-stop-fill"></i>
                                            @endif
                                        </td>
                                        <td>{{$v->user_agent}}</td>
                                        <td>{{$v->visits}}</td>
                                        <td>{{$v->created_at}}</td>
                                        <td>{{$v->updated_at}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- /.table -->

                    </div>
                    <!-- /.table-responsive -->
                    <div class="d-flex my-2 justify-content-center align-items-center p-1">
                        {{ $vs->links() }}
                    </div><!-- /.d-flex my-2 justify-content-center align-items-center p-1 -->
                </div>
                <!-- /.mb-1 p-1 -->

            </div>
        </div>
    </div>
@endsection
