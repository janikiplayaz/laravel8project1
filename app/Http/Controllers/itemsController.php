<?php

namespace App\Http\Controllers;

use App\Http\Requests\commentsRequest;
use Illuminate\Http\Request;
use App\Models\cats;
use App\Models\items;
use App\Models\comments;
use Illuminate\Support\Facades\Auth;

class itemsController extends Controller
{
    private $cats;

    public function __construct()
    {
        $this->cats = cats::all();
    }

    public function items(Request $r)
    {

        if (is_null($r->id)) {
            $item = items::all();
        } else {
            $item = items::where('cat', $r->id)->get();
        }

        return view('index1', ['cats' => $this->cats, 'items' => $item]);
    }


    public function about($id)
    {
        $item = items::select('items.id as id', 'items.name as name', 'items.price as price', 'items.img as img', 'items.desc as desc', 'cats.name as cat')->join('cats', 'cats.id', 'items.cat')->where('items.id', $id)->first();
        $comm1 = comments::select('users.name as name', 'comments.comment as comment', 'comments.score as score', 'comments.created_at as created_at')->join('users', 'users.id', '=', 'comments.user')->where('comments.item', $id)->orderBy('comments.created_at', 'desc')->get();
        return view('index2', ['cats' => $this->cats, 'item' => $item, 'comm1'=>$comm1]);
    }

    static function strg($price)
    {
        $len = strlen($price);

        if ($len == 4) {
            $price = substr($price, 0, 1) . ' ' . substr($price, 1, 3);
        } elseif ($len == 5) {
            $price = substr($price, 0, 2) . ' ' . substr($price, 2, 3);
        } elseif ($len == 6) {
            $price = substr($price, 0, 3) . ' ' . substr($price, 3, 3);
        } elseif ($len == 7) {
            $price = substr($price, 0, 1) . ' ' . substr($price, 1, 3);
        }
        return $price;
    }

    public function newComm($id, commentsRequest $r){
        $comm = new comments;

        $comm->score=$r->userScore;
        $comm->comment=$r->userComment;
        $comm->item=$id;
        $comm->user = Auth::user()->id;

        $comm->save();

        return redirect()->route('item', $id);
    }

}
