<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\Category;
use App\Events\ChatEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    public function addItem(Request $request){
        return view('addItem', ['categories' => Category::all()]);
    }

    public function itemStore(Request $request){
        $item = new Item;
        $item->user_id = session('user')->id;
        $item->name = $request->name;
        // $item->status = ""
        $item->category_id = $request->category_id;
        $item->start_price = $request->startPrice;
        $item->description = $request->description;
        $item->price_end = $request->priceEnd;
        // $item->grade = "";
        $item->remaining_time = $request->remainingTime;
        $item->save();

        // $response = Http::post('http://127.0.0.1:7000/api/green/', [
        //     'text' =>  'добавлен новый лот => '.$item->name
        // ]);

        return true;
    }

    public function bid(Request $request){
        $item = Item::where('id', $request->id)->first();
        $item->start_price += 10;
        if($item->start_price >= $item->price_end){
            $item->old_user = $item->user_id;
            $item->user_id = session('user')->id;
            $item->status = 'куплен'; 

            $user = User::where('id', session('user')->id)->first();
            $user->balance -= $item->start_price;
            session('user')->balance = $user->balance;
            $user->save();

            $oldUser = User::where('id', $item->old_user)->first();
            $oldUser->balance += $item->start_price;
            $oldUser->save();
        }

        $item->save();
        return to_route('index');
    }

    public function buy(Request $request){
        $item = Item::where('id', $request->id)->first();
        $item->old_user = $item->user_id;
        $item->user_id = session('user')->id;
        $item->status = 'куплен';    

        $user = User::where('id', session('user')->id)->first();
        $user->balance -= $item->price_end;

        $oldUser = User::where('id', $item->old_user)->first();
        $oldUser->balance += $item->price_end;

        $oldUser->save();        
        $user->save();        
        $item->save();
        session('user')->balance = $user->balance;
        return to_route('index');
    }

    public function deleteItem(Request $request){
        $item = Item::where('id', $request->id)->delete();
        return to_route('index');
    }

    public function showItems(Request $request){
        $items = Item::where('user_id', session('user')->id)->get();
        return view('myLots', ['items' => $items]);
    }

    public function myBuyLots(Request $request){
        $items = Item::where('user_id', session('user')->id)->where('status', 'куплен')->get();
        return view('myLots', ['items' => $items]);
    }

    public function good(Request $request){
        $item = Item::where('id', $request->id)->first();
        $user = User::where('id', $item->old_user)->first();
        $user->rating += 10;
        $item->grade = 1;
        $user->save();
        $item->save();
        return to_route('index');
    }

    public function bad(Request $request){
        $item = Item::where('id', $request->id)->first();
        $user = User::where('id', $item->old_user)->first();
        $user->rating -= 10;
        $item->grade = 1;
        $user->save();
        $item->save();
        return to_route('index');
    }

    public function searchItem(Request $request){
        return view('index',['items' => Item::where('name', 'like', '%'.$request->n.'%')->get(),'categories' => Category::all()]);
    }

    public function send(Request $request){
        $request->validate([
            'message' => 'required'
        ]);
    
        $message = [
            'name' => session('user')->name,
            'message' => $request->message
        ];
    
        ChatEvent::dispatch($message);
    }
}
