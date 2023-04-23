<div class="alert alert-warning mb-3">
    <strong>Деякі параметри ще не вказані, вкажіть їх!</strong>
</div>
<!-- /.alert alert-warning -->
<form action="{{route('user.saveSetup')}}" method="POST">
    @csrf
    <div class="row mb-3">
        <label for="type_diabet" class="col-md-4 col-form-label text-md-end">
            Який у вас тип діабету?
        </label>

        <div class="col-md-6">
            <select name="type_diabet" id="type_diabet" class="form-control @error('type_diabet') is-invalid @enderror">
                <option selected disabled>Оберіть тип діабету</option>
                <option value="1">Перший тип</option>
                <option value="2">Другий тип</option>
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
                <input class="form-check-input" type="checkbox" role="switch" id="use_insulin" name="use_insulin" />
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
                <input class="form-check-input" type="checkbox" role="switch" id="use_tablet" name="use_tablet" />
                <label class="form-check-label " for="use_tablet">
                    Використовую медикаменти
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">
            Зберегти та продовжити
        </button>
        <!-- /.btn btn-primary -->
    </div>
    <!-- /.form-group -->
</form>
