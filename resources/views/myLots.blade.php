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
<body >
<div>
    @if($items == '[]')
        <h1>pusto</h1>
    @endif

        @foreach($items as $key => $value)
        <div class="card" style="width: 18rem;margin: 0 auto;">
            <div class="card-body">
                <h5 class="card-title">{{$value->name}}</h5>
                <p class="card-text">описание - {{$value->description}}</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">начальная цена -  {{$value->start_price}}$</li>
                <li class="list-group-item">цена выкупа - <a href="#" class="card-link">{{$value->price_end}}$</a></li>
                <li class="list-group-item"> окончание лота - {{$value->remaining_time}}</li>
                <li class="list-group-item"> status -> {{$value->status}}</li>

            </ul>
            <div class="card-body">
                @if($items[0]['status'] === 'куплен' && $items[0]['grade'] != 1)
                    <a href="good/{{$value['id']}}" class="card-link">good</a>
                    <a href="bad/{{$value['id']}}" class="card-link">bad</a>
                @endif
                @if($items[0]['status'] === 'открыт')
                    <a href="delete/{{$value['id']}}" class="card-link">delete</a>
                @endif
            </div>
        </div>
        @endforeach
    </div>

</body>
</html>
