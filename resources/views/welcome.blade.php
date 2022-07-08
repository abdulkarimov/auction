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
    <body style='margin-top: 200px; '>
        <div class='auth' >

        <h1 style="margin-left:160px">AUCTION</h1>
            <form>
                <div class="mb-3">
                    <label for="emailAuth" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="emailAuth" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="passwordAuth" class="form-label">Password</label>
                    <input type="password" class="form-control" id="passwordAuth">
                </div>
            </form>
            
            <div style='margin-top: 10px; margin-left: 25px'>
                <button id='sighIN' type="button" class="btn btn-primary">sign in</button>
                <button id='sighUP'  type="button" class="btn btn-danger">sign up</button>
            </div>

            <div style='margin-top: 10px'>
                <a class="auth" href="{{route('auth.google')}}"><img style="   max-width: 300px;" src="../icon/btn_google_signin_light_pressed_web@2x.png" alt=""></a>
            </div>
            <div style='margin-top: 10px'>
            <a class="auth" href="{{ route('facebook.login') }}"><img style="   max-width: 300px;" src="../icon/1280px-Facebook.svg.png" alt=""></a>
            </div>
        </div>


    </body>
</html>
<style>

    .auth{
        margin-left: auto;
        margin-right: auto;
        max-width: 500px;
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