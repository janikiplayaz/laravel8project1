@extends('layouts.main')

@section('title')
    iMagazine - Оформление заказа
@endsection

@section('contentmain')
    <div class="container">
        <h2 class="text-left my-4">Ваш заказ:</h2>
        <div class="row my-4">
            <div class="col-lg-3">
                <p style="font-weight: bold;">Наименование:</p>
            </div>
            <div class="col-lg-3">
                <p style="font-weight: bold;">Количество:</p>
            </div>
            <div class="col-lg-3">
                <p style="font-weight: bold;">Цена:</p>
            </div>
            <div class="col-lg-3">
                <p style="font-weight: bold;">Итого: </p>
            </div>
        </div>
        @foreach ($items as $i)
            <div class="row my-4">
                <div class="col-lg-3">
                    <p>{{ $i->item }}</p>
                </div>
                <div class="col-lg-3">
                    <p>{{ $i->count }}</p>
                </div>
                <div class="col-lg-3">
                    <p>{{ \App\Http\Controllers\itemsController::strg($i->price) }} ₽</p>
                </div>
                <div class="col-lg-3">
                    <p>{{ \App\Http\Controllers\itemsController::strg($i->price * $i->count) }} ₽</p>
                </div>
            </div>
            <hr>
        @endforeach
        @if (empty($bin[0]))
        <h2 class="my-4">Ваш заказ пустой!</h2>    
        @else
        <section class="my-4">
            <h2 class="my-4">Оформление заказа:</h2>
            <form action="{{ route('newOrder') }}" method="post">
                @csrf
                <input type="text" class="form-control" name="ordersAdres" placeholder="Введите ваш адрес:"><br>
                <select class="form-select" name="ordersMail" aria-label="Default select example" required>
                    <option selected>Способ доставки:</option>
                    @foreach ($mails as $m)
                        <option value="{{ $m->id }}">{{ $m->service }}</option>
                    @endforeach
                </select><br>
                <select class="form-select" name="ordersPayment" aria-label="Default select example" required>
                    <option selected>Оплата:</option>
                    @foreach ($pay as $p)
                        <option value="{{ $p->id }}">{{ $p->service }}</option>
                    @endforeach
                </select><br>
                <textarea class="form-control" name="ordersComment" cols="60" rows="10" style="resize: none"
                    required></textarea><br>
                <ul style="padding: 0;">
                    <h4>Общая сумма к оплате:
                        <span style="color: red;">{{ \App\Http\Controllers\itemsController::strg($sum) }} ₽</span>
                    </h4>
                </ul><br>
                <button type="submit" class="btn btn-info">Оплатить</button>
            </form>
        </section>
        @endif
    </div>
@endsection
