<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\bin;
use App\Models\items;
use App\Http\Controllers\itemsController;

class binController extends Controller
{
    public function card()
    {
        $card1 = bin::select('items.img as img', 'items.name as item', 'items.price as price', 'bins.id as id', 'bins.count as count', 'cats.name as cat')->join('items', 'items.id', '=', 'bins.item')->join('users', 'users.id', '=', 'bins.user')->join('cats', 'cats.id', '=', 'items.cat')->where('user', Auth::user()->id)->get();
        $sum = $this->sumCard();
        return view('index3', ['card1' => $card1, 'sum' => $sum]);
    }

    public static function countCard()
    {
        $count = bin::selectRaw('SUM(count) as count')->where('user', Auth::user()->id)->first();
        $c = $count->count;
        if(is_null($count->count)) $c = 0;
        return $c;
    }

    public function addOrder(Request $r)
    {
        $card = bin::where('item', $r->item)->where('user', Auth::user()->id)->where('status', '0')->first();

        if (is_null($card)) {
            bin::create([
                'item' => $r->item,
                'user' => Auth::user()->id
            ]);
        } else {
            $card->count = $card->count + 1;
            $card->save();
        }
        $count = bin::selectRaw('SUM(count) as count')->where('user', Auth::user()->id)->first();
        return $count->count;
    }

    public function deleteItem($id){
        bin::where('bins.id', $id)->delete();
        return redirect()->route('card'); 
    }

    public static function sumCard()
    {
        $card = bin::selectRaw('SUM(items.price * bins.count) as sum')->join('items', 'items.id', '=', 'bins.item')->where('user', Auth::user()->id)->first();
        $sum = $card->sum;
        if(is_null($card->sum)) $sum = 0; 
        return itemsController::strg($sum);
    }

    public function countItem(Request $r)
    {
        $card = bin::find($r->item);
        if ($r->type == 'plus') {
            $card->count++;
        } else {
            if ($card->count > 1) $card->count--;
        }

        $item = items::find($card->item);

        $card->save();

        $sumItem  = $card->count * $item->price;

        $sum = $this->sumCard();

        $countCard = $this->countCard();

        return response()->json(['count' => $card->count, 'price' => itemsController::strg($sumItem), 'sum'=>$sum, 'countCard1'=>$countCard], 200);
    }
}
