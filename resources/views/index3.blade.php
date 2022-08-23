@extends('layouts.main')

@section('title')
    iMagazine - Корзина
@endsection

@section('contentmain')
    <div class="container">
        <h2 class="pt-4 pb-2" style="font-weight: bold">Коризна товаров: <span
                class="badge bg-info countCard">{{ \App\Http\Controllers\binController::countCard() }}</span></h2>
        <hr>
        <div class="row">
            <div class="col-1 text-center">
                <p style="font-weight: bold">№</p>
            </div>
            <div class="col-2 text-center">
                <p style="font-weight: bold">Фото</p>
            </div>
            <div class="col-2 text-center">
                <p style="font-weight: bold">Наименование</p>
            </div>
            <div class="col-2 text-center">
                <p style="font-weight: bold">Количество</p>
            </div>
            <div class="col-2 text-center">
                <p style="font-weight: bold">Цена</p>
            </div>
            <div class="col-3">
                <p style="font-weight: bold">Сумма</p>
            </div>
        </div>
        {{-- Товар который поступает в корзину --}}
        <div class="asf pt-4">
            @if(!$card1->isEmpty())
            @foreach ($card1 as $c)
                <div class="row">
                    <div class="col-1 text-center">
                        <p style="font-weight: bold">{{ $c->id }}</p>
                    </div>
                    <div class="col-2 text-center">
                        <img src="{{ $c->img }}" style="height: 50px;">
                    </div>
                    <div class="col-2 text-center">
                        <p style="font-weight: bold">{{ $c->item }}</p>
                    </div>
                    <div class="col-2 text-center">
                        <button type="button" class="count" onclick="count(this, 'minus', '{{ csrf_token() }}')"
                            data-id="{{ $c->id }}">-</button>
                        <span id="count{{ $c->id }}" style="font-weight: bold;">{{ $c->count }}</span>
                        <button type="button" class="count" onclick="count(this, 'plus', '{{ csrf_token() }}')"
                            data-id="{{ $c->id }}">+</button>
                    </div>
                    <div class="col-2 text-center">
                        <p style="font-weight: bold">{{ \App\Http\Controllers\itemsController::strg($c->price) }} ₽</p>
                    </div>
                    <div class="col-2">
                        <span id="sum{{ $c->id }}" style="font-weight: bold;">{{ \App\Http\Controllers\itemsController::strg($c->price * $c->count) }} ₽</span>
                    </div>
                    <div class="col-1 text-center">
                        <a href="{{route('deleteItem', $c->id)}}" style="font-weight: bold; color: red;">Удалить</a>
                    </div>
                </div>
                <br>
            @endforeach
            @else
            <div class="row">
                <div class="col-12 my-4 text-center">
                    <h2 style="font-weight: bold;">Товар в корзину не был добавлен</h2>
                </div>
            </div>
        </div>
        @endif
        <hr>
        <div class="itog my-4 text-center">
            <h2 style="font-weight: bold;">Итоговая сумма покупки: <span
                    style="color: red" id="suma">{{$sum }} ₽</span></h2>
            <a href="/ordering" class="btn btn-info">Оформить (:</a>
        </div>
    </div>
@endsection
