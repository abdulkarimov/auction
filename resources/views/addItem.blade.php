<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="_token" content="<?php echo csrf_token(); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <title>Document</title>
    </head>
    <body style="width: 300px; margin: 0 auto;">
        <div class="input-group flex-nowrap" style='margin-top: 10px'>
            <input id='name' type="text" class="form-control" placeholder="name" >
        </div>
        <div class="input-group flex-nowrap" style='margin-top: 10px'>
            <!-- <input id='category' type="text" class="form-control" placeholder="category" > -->
            <select name="" id="category">
            @foreach($categories as $category)
                <option value="{{$category['id']}}">{{$category['name']}}</option>
            @endforeach
            </select>
        </div>
        <div class="input-group flex-nowrap" style='margin-top: 10px'>
            <input id='startPrice' type="number" class="form-control" placeholder="start price" >
        </div>
        <div class="input-group flex-nowrap" style='margin-top: 10px'>
            <input id='priceEnd' type="number" class="form-control" placeholder="price end" >
        </div>
        <div class="input-group flex-nowrap" style='margin-top: 10px'>
            <input id='remainingTime' type="date" class="form-control" placeholder="remaining time"  min="<?php echo  date('Y-m-d',strtotime(date('Y-m-d') . "+1 days")); ?>">
        </div>
        <div class="input-group flex-nowrap" style='margin-top: 10px'>
            <input id='description' type="text" class="form-control" placeholder="description" >
        </div>
        <div style='margin-top: 10px;    margin-left: 50px;'>
            <button id='itemStore' type="button" class="btn btn-primary">Done</button>
        </div>
    </body>
</html>

<script>

$('#itemStore').click(function() {
        $.ajax({
            url: 'itemStore',                                                        
            method: 'post',                                                                     
            data: {
                name: $('#name').val(),
                category_id: $('#category').val(),
                startPrice: $('#startPrice').val(),
                priceEnd: $('#priceEnd').val(),
                remainingTime: $('#remainingTime').val(),
                description: $('#description').val(),
            },                                                      
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},                 
            success: function(data){     
                window.location.href = '/index';                                         
            }
        });
});

</script>