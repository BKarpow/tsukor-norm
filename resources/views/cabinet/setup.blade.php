<div class="my-2">
    @include('cabinet.changeProfile')
</div>
<!-- /.my-2 -->

<a href="{{route('sugar.import')}}" class="m-1 btn btn-success">
    Імортувати показники
</a><!-- /.btn btn-success -->
<div class="my-1">
    <sugar-tr></sugar-tr>
</div><!-- /.my-1 -->

<form action="{{route('user.saveSetup')}}" class="mt-3" method="POST">
    @csrf
    <h3>Параметри діабету</h3>
    <div class="row mb-3">
        <label for="type_diabet" class="col-md-4 col-form-label text-md-end">
            Який у вас тип діабету?
        </label>

        <div class="col-md-6">
            <select name="type_diabet" id="type_diabet" class="form-control @error('type_diabet') is-invalid @enderror">

                <option @if(auth()->user()->type_diabet == 1) selected @endif value="1">Перший тип</option>
                <option @if(auth()->user()->type_diabet == 2) selected @endif value="2">Другий тип</option>
            </select> <!-- /#.form-control -->
            @error('type_diabet')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            @error('use_insulin')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-md-6">
            <div class=" form-check form-switch mb-3">
                <input @if(auth()->user()->use_insulin) checked @endif class="form-check-input" type="checkbox" role="switch" id="use_insulin" name="use_insulin" />
                <label class="form-check-label " for="use_insulin">
                    Використовую інсулін
                </label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            @error('use_tablet')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-md-6">
            <div class=" form-check form-switch mb-3">
                <input @if(auth()->user()->use_tablet) checked @endif class="form-check-input" type="checkbox" role="switch" id="use_tablet" name="use_tablet" />
                <label class="form-check-label " for="use_tablet">
                    Використовую медикаменти
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">
            Зберегти
        </button>
        <!-- /.btn btn-primary -->
    </div>
    <!-- /.form-group -->
</form>
