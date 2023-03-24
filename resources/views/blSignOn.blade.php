<!DOCTYPE html>

<html>
    <head>
        <title>Перенаправлення</title>
    </head>
    <body>
        <p>Початок авторизації на сайті blog...</p>
        <form action="{{$redirectSignOn}}" id="signon" method="POST">
            <input type="hidden" name="email" value="{{$email}}">
            <input type="hidden" name="password" value="{{$password}}">
            <input type="hidden" name="redirect_url" value="{{url("/home")}}">
        </form>
        <script>
            document.querySelector("#signon").submit();
        </script>
    </body>
</html>
