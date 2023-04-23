<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Видалити акаунт та всі мої дані</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>

    <div id="app">
        <div class="container">
            <div class="row justify-content-center align-items-center ">
                <div class="col-md-6 mt-4">
                    <h1>Для пітвердження видалення - вкажіть свій пароль!</h1>
                    <form action="{{route('user.delete')}}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <pwd-field></pwd-field>
                        </div>
                        <!-- /.form-group mb-2 -->
                        <div class="form-group my-2">
                            <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHAV2_SITEKEY') }}"></div>
                            @error('g-recaptcha-response')
                                <div class="alert alert-warning">
                                    <strong>{{ $message }}</strong>
                                </div>
                                <!-- /.alert alert-warning -->
                            @enderror
                        </div>
                        <!-- /.form-group mt-2 -->
                        <div class="form-group">
                            <button class="btn btn-danger">ТАК, ВИДАЛИТИ АКАУНТ ТА ВСІ ДАНІ!</button>
                            <!-- /.btn btn-danger -->
                        </div>
                        <!-- /.form-group -->
                    </form>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /#app -->

</body>
</html>
