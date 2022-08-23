<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\orders;
use App\Models\items;
use App\Models\bin;
use App\Models\mails;
use App\Models\payments;

class ordersController extends Controller
{
    public function ordersView()
    {
        $bin = bin::all()->where('user', Auth::user()->id);
        $payments = payments::all();
        $mails = mails::all();
        $items = bin::select('items.img as img', 'items.name as item', 'items.price as price', 'bins.id as id', 'bins.count as count')->join('items', 'items.id', '=', 'bins.item')->join('users', 'users.id', '=', 'bins.user')->where('user', Auth::user()->id)->get();
        $sum = $this->sumcard();
        return view('index4', ['items' => $items, 'sum' => $sum, 'mails' => $mails, 'pay' => $payments, 'bin' => $bin]);
    }

    public function newOrder(Request $r)
    {
        $order = new orders;

        $order->address = $r->ordersAdres;
        $order->delivery = $r->ordersMail;
        $order->payment = $r->ordersPayment;
        $order->user = Auth::user()->id;
        $order->status = 1;
        $order->sum = $this->sumcard();
        $order->comments = $r->ordersComment;

        $order->save();
        $deletecard = $this->deleteItem();
        return redirect()->route('home');
    }

    public function sumcard()
    {
        $card = bin::selectRaw('SUM(items.price * bins.count) as sum')->join('items', 'items.id', '=', 'bins.item')->where('user', Auth::user()->id)->first();
        $sum = $card->sum;
        return $sum;
    }

    public function deleteItem()
    {
        bin::where('bins.user', Auth::user()->id)->delete();
    }
}
