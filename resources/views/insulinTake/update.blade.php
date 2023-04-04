@extends('layouts.app')

@section('title') Редагувати прийом інсуліну @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Редагувати прийом інсуліну</div>

                <div class="card-body">
                    {{-- <div class="p-1 mb-1">
                        <h3>Коротко про HbA1c.</h3>
                        <p><strong>HbA1c</strong> (або глікований гемоглобін А) - це тест, який використовується для оцінки середнього рівня глюкози в крові за останні 2-3 місяці. HbA1c вимірює кількість гемоглобіну, пов'язаного з глюкозою в червоних кров'яних клітинах. Цей тест часто використовується для діагностики та контролю діабету, оскільки він надає інформацію про середній рівень глюкози в крові за більш тривалий період часу, ніж звичайний крововипробування на глюкозу. Чим вищий рівень HbA1c, тим вищий ризик розвитку ускладнень діабету, таких як ураження судин, нервів та нирок.</p>
                    </div>
                    <!-- /.p-1 mb-1 --> --}}
                    <form method="POST" acyion="{{route('insulinLog.update', ['insulinTake'=>$il])}}">
                        @csrf
                        <div class="form-group col-md-8">
                            <label for="insulin_id">Оберіть припарат інсуліну</label>
                            <select name="insulin_id" id="insulin_id" class="form-control">
                                @foreach ($insulins as $in)
                                    <option @if ($il->insulin_id == $in->id) selected @endif value="{{$in->id}}">{{$in->name}}</option>
                                @endforeach
                                </select>
                            @error('insulin_id')
                                <div class="alert alert-warning">
                                    <strong>{{$message}}</strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group.col-md-4 -->

                        <div class="form-group col-md-8">
                            <label for="insulin_dose">Доза припарату</label>
                            <input
                                type="tel"
                                name="insulin_dose"
                                id="insulin_dose"
                                placeholder="в МО"
                                required
                                class="form-control p-1"
                                value="{{$il->insulin_dose}}"
                            >
                            @error('insulin_dose')
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
                            >{{$il->note}}</textarea>


                            @error('note')
                                <div class="alert alert-warning">
                                    <strong>{{$message}}</strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group.col-7 -->
                        <div class="form-group mt-2 ">
                            <date-time-field dt="{{$il->created_at}}"></date-time-field>
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group mt-2 col-7">
                            <button class="btn btn-success btn-lg">
                                <i class="fa-sharp fa-solid fa-floppy-disk"></i>
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
