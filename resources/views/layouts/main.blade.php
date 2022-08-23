<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">
    <title>@yield('title')</title>
</head>

<body>
    <div class="modal fade" id="auth" tabindex="-1" style="z-index: 99999;" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: rgb(33 37 41); color: white;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Авторизация</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="auth">
                        @csrf
                        <input type="email" name="email" placeholder="Логин" class="form-control" required><br>
                        <input type="password" name="password" placeholder="Пароль" class="form-control" required><br>
                        <button type="submit" name="auth" class="btn btn-info">Войти</button>
                    </form>
                </div>
                <div id="errorAuth" style="display: none">
                    <div class="alert alert-danger" role="alert">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="reg" tabindex="-1" style="z-index: 99999;" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: rgb(33 37 41); color: white;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Регистрация</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="register">
                        @csrf
                        <input type="text" name="name" placeholder="Имя" pattern="^[А-Яа-яЁё-\s]+$"
                            class="form-control" required><br>
                        <input type="email" name="email" placeholder="Email" class="form-control" required><br>
                        <input type="password" name="pass1" placeholder="Пароль" class="form-control" required><br>
                        <input type="password" name="pass2" placeholder="Повторите пароль" class="form-control"
                            required><br>
                        <button type="submit" name="reg" class="btn btn-info">Зарегистрироваться</button>
                    </form>
                </div>
                <br>
                <div id="success" style="display: none">
                    <div class="alert alert-success" role="alert">
                        Вы успешно зарегистрировались
                    </div>
                </div>
                <div id="error" style="display: none">
                    <div class="alert alert-danger" role="alert">
                        Пароли не совпадают
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">iMagazine</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active me-3" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active me-3" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active me-3" href="#">Bio</a>
                    </li>
                </ul>
                <form>
                    @if (Auth::check())
                        <a href="/bin" class="btn btn-outline-info position-relative me-3">Корзина
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <span id="addOrder" class="countCard">{{\App\Http\Controllers\binController::countCard()}}</span>
                                </span></a>
                        <div class="btn-group">
                            <button class="btn btn-info dropdown-toggle me-3" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{Auth::user()->name}}(id:{{Auth::user()->id}})
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="#">Личный кабинет</a></li>
                                <li><a class="dropdown-item pt-2" href="#">Тестовая ссылка</a></li>
                                <li><a href="{{ route('logout') }}"
                                        class="btn btn-info ms-lg-3 me-sm-5 mt-2">Выйти</a>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="#" class="btn btn-outline-info me-3" data-bs-toggle="modal"
                            data-bs-target="#auth">Вход</a>
                        <a href="#" class="btn btn-info me-3" data-bs-toggle="modal"
                            data-bs-target="#reg">Регистрация</a>
                    @endif
                </form>
            </div>
        </div>
    </nav>
    <main>
        @yield('contentmain')
        @yield('orderbuy')
        @yield('itemComments')
    </main>
    <footer>
        <h5 class="footertext p-2">iMagazine&copy;Все права успешно разворованы ::), 2022.</h5>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
