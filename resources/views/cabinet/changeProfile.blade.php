<form action="{{route('user.changeProfile')}}" method="POST">
    @csrf

    <h3>Ваш профіль</h3>

    <div class="row mb-4">
        <div class="col-md-2 col-4">
            <img src="{{auth()->user()->avatar}}" alt="Немає соц аватара" >
        </div>
        <!-- /.col-md-2 col-4 -->
        <div class="col-md-3 col-6 d-flex justify-content-center align-items-center">
            <div>
            <h4> {{auth()->user()->name}} </h4>
            <p> {{auth()->user()->email}} </p>
        </div>
        </div>
        <!-- /.col-md-3 col-6 -->
    </div>

    <div class="form-group mb-2">
        <label for="name">Змінити ім'я</label>
        <input type="text" id="name" name="name" class="form-control" value="{{auth()->user()->name}}">
    </div>
    <!-- /.form-group mb-2 -->


        <div class="alert alert-info">
            <p>
                Оновіть свій пароль для користування сайтом.
            </p>
        </div>
    <pwd-field></pwd-field>

    <div class="form-group">
        <button class="btn btn-primary">
            Зберегти зміни профілю
        </button> <!-- /.btn btn-primary -->
        </div>
    <!-- /.form-group -->
</form>
