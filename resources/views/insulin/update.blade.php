@extends('layouts.app')

@section('title') Редагувати {{$insulin->name}} @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Редагувати {{$insulin->name}}</div>

                <div class="card-body">
                    {{-- <div class="p-1 mb-1">
                        <h3>Коротко про HbA1c.</h3>
                        <p><strong>HbA1c</strong> (або глікований гемоглобін А) - це тест, який використовується для оцінки середнього рівня глюкози в крові за останні 2-3 місяці. HbA1c вимірює кількість гемоглобіну, пов'язаного з глюкозою в червоних кров'яних клітинах. Цей тест часто використовується для діагностики та контролю діабету, оскільки він надає інформацію про середній рівень глюкози в крові за більш тривалий період часу, ніж звичайний крововипробування на глюкозу. Чим вищий рівень HbA1c, тим вищий ризик розвитку ускладнень діабету, таких як ураження судин, нервів та нирок.</p>
                    </div>
                    <!-- /.p-1 mb-1 --> --}}
                    <form method="POST" action="{{ route('insulin.edit', ['insulin'=>$insulin]) }}">
                        @csrf
                        <h3>Заповніть форму додавання</h3>
                        <div class="form-group col-md-8">
                            <label for="name">Назва припарату</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                placeholder="Наприклад інсультар"
                                maxlength="150"
                                value="{{$insulin->name}}"
                                required
                                class="form-control p-1"
                            >
                            @error('name')
                                <div class="alert alert-warning">
                                    <strong>{{$message}}</strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group.col-md-4 -->

                        <div class="form-group col-md-8">
                            <label for="type">Тип припарату</label>
                            <select name="type" id="type" class="form-control" >
                                <option
                                    @if ($insulin->type == "Інсулін швидкої дії") selected @endif
                                    value="Інсулін швидкої дії">Інсулін швидкої дії</option>
                                <option
                                @if ($insulin->type == "Інсулін продовженої (пролонгованої) дії") selected @endif
                                    value="Інсулін продовженої (пролонгованої) дії">Інсулін продовженої (пролонгованої) дії</option>
                                <option
                                @if ($insulin->type == "Інсулін середньої тривалості") selected @endif
                                value="Інсулін середньої тривалості">Інсулін середньої тривалості</option>
                                <option
                                @if ($insulin->type == "Інсулін тривалої дії") selected @endif
                                value="Інсулін тривалої дії">Інсулін тривалої дії</option>
                                <option
                                @if ($insulin->type == "Змішані інсулінові препарати") selected @endif
                                value="Змішані інсулінові препарати">Змішані інсулінові препарати</option>
                            </select>
                            @error('type')
                                <div class="alert alert-warning">
                                    <strong>{{$message}}</strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group.col-md-4 -->

                        <div class="form-group mt-2 col-7">

                            <textarea
                            class="form-control"
                            placeholder="Кілька слів ..."
                            id="note"
                            name="note"
                            >{{$insulin->note}}</textarea>


                            @error('note')
                                <div class="alert alert-warning">
                                    <strong>{{$message}}</strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group.col-7 -->
                        <div class="form-group mt-2 col-7">
                            <button class="btn btn-primary btn-lg">
                                <i class="bi bi-save"></i>
                                Зберегти
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
