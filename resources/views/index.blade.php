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
        <script src="{{url('js/app.js')}}"></script>
        <script>$(function(){
            const Http = window.axios;
            const Echo = window.Echo;
            const message = $('#message');

            $('#sendMessage').click(function(){
                    Http.post("{{url('send')}}", {
                        'name' : 'name',
                        'message' : message.val()
                    }).then(()=>{
                        message.val('');
                    });
            });

            let channel = Echo.channel('channel-chat');
            channel.listen('ChatEvent', function(data){
                $('#data-message').append(`<strong>${data.message.name}</strong> : ${data.message.message} <br>`);
            })

   
        })</script>
    <title>Document</title>
</head>
<body>


    <div style="    margin-left: 350px;
    max-width: 860px;">
        <button id='addItem' class="btn btn-info" onclick="window.location.href='/addItem'" >add item</button>
        <button id='showItems' class="btn btn-info" onclick="window.location.href='/showItems'" >show my items</button>
        <button id='myBuyLots' class="btn btn-info" onclick="window.location.href='/myBuyLots'" >my Buy Lots</button>
        <span style="    margin-left: 121px;">rating: {{session('user')->rating}}</span>
        <span>balance: {{session('user')->balance}}$</span>
        <button id='searchItem'  class="btn btn-info" style=" float: right;">search </button>
        <input id='itemName' type="text" class="form-control" style="margin-bottom: 20px; margin-top:15px" placeholder="itemName" >
    </div>
    

    @foreach($items as $key => $value)
        @if($value['status'] === 'открыт')
    <div style="margin-left:600px">

        <div class="card" style="width: 28rem; margin-left: 40px; margin-top:30px">
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

                @if (session('user')->is_admin == 1)
                    <a href="/delete?item_id={{$value['id']}}" class="card-link">delete</a>
                @endif

            </div>
        </div>
    </div>
    @endif
    @endforeach

    <body>

    <div class="sidebar">
        <h4 style='margin-left: 40px; margin-bottom:10px'>Categories</h4>
        @foreach($categories as $category)
            <a href="index?category_id={{$category['id']}}" style='margin-left: 60px;'>{{$category['name']}}</a>
            <br>
            <br>
        @endforeach

    </div>

    <div class="sidebar2">
        <div id="wrapper">
            <div id="menu">
                <div style="clear:both"></div>
            </div>
            
            <div id="chatbox">
                <div id='data-message'></div>
            </div>

            <div style="margin-left:35px">
                <textarea id="message"rows="4" cols="50"></textarea>
                <button id='sendMessage' class="btn btn-info" style='position: absolute;margin-top: 30px;margin-left: 5px;'> send</button>
            </div>


        </div>    
    </div>



</body>

</body>
</html>
<style>
    
   /* CSS */
   #chatbox {
    text-align:left;
    margin:0 auto;
    margin-bottom:25px;
    padding:10px;
    background:#fff;
    height:670px;
    width:430px;
    border:1px solid #ACD8F0;
    overflow:auto; 
    overflow-x:hidden;  /*для горизонтального*/
}

.sidebar {
height: 100%;
width: 200px;
position: fixed;
top: 0;
left: 0;
padding-top: 40px;
background-color: lightblue;
}

.sidebar2 {
height: 100%;
width: 500px;
position: fixed;
top: 0;
right: 0;
padding-top: 40px;
background-color: lightblue;
}


</style>
<script>

$("#searchItem").click(function(){
        window.location.href = ('/searchItem/?n='+$('#itemName').val())
    });
</script>