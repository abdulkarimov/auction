<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="_token" content="<?php echo csrf_token(); ?>">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <title>Document</title>
</head>
<body>
    <div style="display:inline;">
        <button id='addItem' onclick="window.location.href='/addItem'" >add item</button>
        <button id='showItems' onclick="window.location.href='/showItems'" >show my items</button>
        <button id='myBuyLots' onclick="window.location.href='/myBuyLots'" >my Buy Lots</button>
        <span>rating: {{session('user')->rating}}</span>
        <span>balance: {{session('user')->balance}}$</span>
        <input id='itemName' type="text" class="form-control" placeholder="itemName" >
        <button id='searchItem'>search</button>
    </div>

    <div>
        @foreach($items as $key => $value)
        @if($value['status'] === 'открыт')
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{$value->name}}</h5>
                <p class="card-text">описание - {{$value->description}}</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">начальная цена -  {{$value->start_price}}$</li>
                <li class="list-group-item">цена выкупа - <a href="#" class="card-link">{{$value->price_end}}$</a></li>
                <li class="list-group-item"> окончание лота - {{$value->remaining_time}}</li>
            </ul>
            <div class="card-body">
                @if ($value->user_id != session('user')->id)
                    <a href="/bid/{{$value['id']}}" class="card-link">bid</a>
                    <a href="/buy/{{$value['id']}}" class="card-link">buy</a>
                @endif

            </div>
        </div>
        @endif
        @endforeach
    </div>
</body>
</html>

<script>

$("#searchItem").click(function(){
        window.location.href = ('/searchItem/?n='+$('#itemName').val())
    });
</script>