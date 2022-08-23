@extends('layouts.main')

@section('title')
    iMagazine
@endsection

@section('contentmain')
    <div class="container p-5">
        <div class="photo__back">
        </div>
    </div>
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-3">
                <h3 style="font-weight: bold">Список брендов:</h3>
                <div class="card" style="width: 18rem;">
                    <ul class="list-group list-group-flush">
                        <a href="/" class="brands">
                            <li class="list-group-item">Все товары</li>
                        </a>
                        @foreach ($cats as $c)
                            <a href="/cat/{{ $c->id }}" class="brands">
                                <li class="list-group-item">{{ $c->name }}</li>
                            </a>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                @if (empty($items[0]))
                    <h3 style="font-weight: bold">Данный товар закончился или его нет на складе</h3>
                @else
                    <h3 style="font-weight: bold">Ассортимент товара:</h3><br>
                    <div class="row">
                        @foreach ($items as $i)
                            <div class="col-4 pb-2">
                                <div class="card" style="width: 18rem;">
                                    <img src="{{ $i->img }}" class="card-img-top"
                                        style="height: 200px; object-fit: contain; padding-top: 20px" alt="...">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $i->name }}</h4>
                                        <h5 class="card-title" style="color: red">
                                            {{ \App\Http\Controllers\itemsController::strg($i->price) }}₽</h5>
                                        <a href="/item/{{ $i->id }}" class="btn btn-info">Подробней</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection
