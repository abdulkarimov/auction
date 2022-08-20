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
    <body>
        <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">name</th> 
            </tr>
        </thead>
        <tbody >
            @foreach ($users as $user)
                <tr class="user-row" >
                <td>{{$user['name']}} <button style="position: absolute; right: 0;" onclick="deleteUser('{{$user['id']}}')"> delete</button></td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </body>
</html>

<script>
    function deleteUser(id){
        $.ajax({
            url: 'userDelete',                                                        
            method: 'post',                                                                     
            data: {
                user_id: id
            },                                                      
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},                 
            success: function(data){     
                if(data){
                    location.reload();
                }
            }
        });
    }
</script>
