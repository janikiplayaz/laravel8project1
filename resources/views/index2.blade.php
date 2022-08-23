@extends('layouts.main')

@section('title')
    iMagazine - {{ $item->name }}
@endsection

@section('contentmain')
    <div class="container">
        <h2 class="pt-4 pb-2" style="font-weight: bold">{{ $item->name }}</h1>
    </div>
@endsection

@section('orderbuy')
    <div class="container">
        <div class="card" style="max-width: auto;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ $item->img }}" class="img-fluid rounded-start">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h4 class="card-title" style="font-weight: bold">Характеристки:</h4>
                        <hr>
                        <ul class="card-title" style="list-style-type: none; padding: 0;">
                            <li><span style="font-weight: bold">Описание:</span>
                                <span>{{ $item->desc }}</span>
                            </li>
                        </ul>
                        <ul class="card-title" style="list-style-type: none; padding: 0;">
                            <li><span style="font-weight: bold">Цена:</span>
                                <span>{{ \App\Http\Controllers\itemsController::strg($item->price) }}₽</span>
                            </li>
                        </ul>
                        <br>
                        <br>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-info">Купить</button>
                                <button class="btn btn-info ms-4" id="addOrder" data-item="{{ $item->id }}"
                                    data-csrf="{{ csrf_token() }}">В корзину</button>
                            </div>
                        </div>
                        <p class="card-text"><small class="text-muted">Ваши права сроки возврата и
                                прочий
                                словоблудный мусор, который пишется маленькими буквами и его никто не читает
                                ____)))))</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('itemComments')
    @if (Auth::check())
        <section class="commInput pt-4 pb-2">
            <div class="container">
                <form action="{{ route('newComm', ['id' => $item->id]) }}" method="POST">
                    @csrf
                    <h2 style="font-weight: bold">Ваш отзыв о купленном вами товаре :)</h2>
                    {{-- <div class="mb-3">
                    <h3>Ваш отзыв о купленном вами товаре :)</h3>
                    <label for="userName" class="form-label">Имя пользователя</label>
                    <input type="text" class="form-control" id="userName">
                </div> --}}
                    <div class="mb-3">
                        <label for="userGrade" class="form-label" style="font-weight: bold">Ваша оценка товара
                            (баллами):</label>
                        <input type="number" name="userScore" class="form-control" id="userGrade" min="1" max="10">
                    </div>
                    <div class="mb-3">
                        <label for="userComm" class="form-label" style="font-weight: bold">Ваш комментарий о
                            товаре:</label>
                        <textarea name="userComment" class="form-control" name="userComment" id="userComm" cols="60"
                            rows="10" style="resize: none" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-info">Отправить</button>
                </form>
            </div>
    @endif
    </section>
    <section class="commOutput pt-4 pb-2">
        <div class="container">
            @if (empty($comm1[0]))
                <h2 style="font-weight: bold">Отзывов пока не было</h2>
            @else
                <h2 class="pb-2 pt-2" style="font-weight: bold">Отзывы:</h2>
                @foreach ($comm1 as $c)
                    <div class="card" style="width: auto;">
                        <div class="card-body">
                            <h4 class="card-title">{{ $c->name }}</h4>
                            <hr>
                            <ul class="card-title" style="list-style-type: none; padding: 0;">
                                <li><span style="font-weight: bold">Добавлен:</span>
                                    <span>{{ $c->created_at }}</span>
                                </li>
                            </ul>
                            <ul class="card-title" style="list-style-type: none; padding: 0;">
                                <li><span style="font-weight: bold">Оценка:</span>
                                    <span>{{ $c->score }}</span>
                                </li>
                            </ul>
                            <ul class="card-title" style="list-style-type: none; padding: 0;">
                                <li><span style="font-weight: bold">Комментарий:</span>
                                    <span>{{ $c->comment }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <br>
                @endforeach
            @endif
        </div>
    </section>
@endsection
