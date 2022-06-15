<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
    <meta name="_token" content="<?php echo csrf_token(); ?>">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    </head>
    <body style='margin-top: 200px'>
        <h1 style='text-align: center'>Авторизация</h1>
        <div class='auth' >
            <div class="input-group flex-nowrap">
                <input id='emailAuth' type="text" class="form-control" placeholder="email" aria-label="Username" aria-describedby="addon-wrapping">
            </div>
            <div style='margin-top: 10px'>
                <input id='passwordAuth' type="password" class="form-control" placeholder="Password" >
            </div>
            <div style='margin-top: 10px; margin-left: 25px'>
                <button id='sighIN' type="button" class="btn btn-primary">sign in</button>
                <button id='sighUP'  type="button" class="btn btn-danger">sign up</button>
            </div>

            <div style='margin-top: 10px'>
                <a class="auth" href="{{route('auth.google')}}"><img style="   max-width: 200px;" src="../icon/btn_google_signin_light_pressed_web@2x.png" alt=""></a>
            </div>
        </div>


    </body>
</html>
<style>
    .auth{
        margin-left: auto;
        margin-right: auto;
        max-width: 200px;
    }
    
</style>

<script>
    $('#sighUP').click(function() {
        window.location.href = 'registerIndex';
     });


     $('#sighIN').click(function() {
        $.ajax({
            url: 'auth/signIn',                                                        
            method: 'post',                                                                     
            data: {
                email: $('#emailAuth').val(),
                password: $('#passwordAuth').val()
            },                                                      
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},                 
            success: function(data){     
                if(data)                                               
                    window.location.href = '/index';                                         
                else
                    alert('ошибка');
            }
        });
});
</script>