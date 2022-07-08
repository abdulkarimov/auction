<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta name="_token" content="<?php echo csrf_token(); ?>">
        <meta charset="utf-8">
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
        <h1 style='text-align: center;margin-bottom: 35px'>Регистрация</h1>
        <div class='register'>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">@</span>
                <input id='email' type="text" class="form-control" placeholder="email" aria-label="Username" aria-describedby="addon-wrapping">
            </div>
            <div class="input-group flex-nowrap" style='margin-top: 10px'>
                <input id='name' type="text" class="form-control" placeholder="name" aria-label="name" aria-describedby="addon-wrapping">
            </div>
            <div style='margin-top: 10px'>
                <input id='password' type="password" class="form-control" placeholder="Password" >
            </div>
            <div style='margin-top: 10px'>
                <input id='confirmPassword' type="password" class="form-control" placeholder="ConfirmPassword" >
            </div>
            <div style='margin-top: 10px;    margin-left: 50px;'>
                <button id='registerBTN' type="button" class="btn btn-primary">Done</button>
            </div>
            </div>
        </div>


    </body>
</html>
<style>
    .register{
        margin-left: auto;
        margin-right: auto;
        max-width: 400px;
    }
    
</style>

<script>
/* Куда пойдет запрос */
/* Метод передачи (post или get) */
/* Параметры передаваемые в запросе. */
/* функция которая будет выполнена после успешного запроса.  */
/* В переменной data содержится ответ от index.php. */
$('#registerBTN').click(function() {
    if($('#password').val() === $('#confirmPassword').val()) {
        $.ajax({
            url: 'register',                                                        
            method: 'post',                                                                     
            data: {
                email: $('#email').val(),
                name: $('#name').val(),
                password: $('#password').val()
            },                                                      
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},                 
            success: function(data){     
                if(data)                                               
                window.location.href = '/index';                                         
                else
                alert('email занят');
            }
        });
    }
    else alert('пароли не совпадают');
});


</script>

