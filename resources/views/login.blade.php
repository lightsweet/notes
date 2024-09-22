<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Вход/Регистрация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script>
        function checkEmail() {
            $.ajax({
                url: '/checkEmail',
                method: 'post',
                dataType: 'json',
                data: {
                    'email': $('#email-reg').val(),
                    '_token': '{{ csrf_token() }}'
                },
                success: function (data) {
                    if (data.error) {
                        show('email-reg-info', 'block');
                        $('#email-reg-info').html(data.info);
                        hide('reg-button');
                    }
                        else {
                        $('#email-reg-info').html('');
                        show('reg-button', 'block');
                    }
                }
            });
        }
        function register(){
            $.ajax({
                url: '/register',
                method: 'post',
                dataType: 'json',
                data: {
                    'email': $('#email-reg').val(),
                    'name': $('#name-reg').val(),
                    'pswd': $('#pswd-reg').val(),
                    'pswd1': $('#pswd-reg1').val(),
                    '_token': '{{ csrf_token() }}'
                },
                success: function (data) {
                    if (data.error) {
                        show('reg-info', 'block');
                        $('#reg-info').html(data.info);
                    }
                    else {
                        $('#reg-info').html('');
                        show('form-auth', 'flex');
                        hide('form-reg');
                    }
                }
            });
        }
        function enter(){
            $.ajax({
                url: '/enter',
                method: 'post',
                dataType: 'json',
                data: {
                    'email': $('#email-auth').val(),
                    'pswd': $('#pswd-auth').val(),
                    '_token': '{{ csrf_token() }}'
                },
                success: function (data) {
                    if (data.error) {
                        show('auth-info', 'block');
                        $('#auth-info').html(data.info);
                    }
                    else {
                        $('#auth-info').html('');
                        window.location.href = '/notes';
                    }
                }
            });
        }
    </script>
</head>
<body>
<div class="container">

    <div style="width: 100%; height: 300px">
    </div>
    <div class="center-all">
        <h3 id = "title-auth">Вход</h3>
        <h3 id = "title-reg">Регистрация</h3>
    </div>
    <div class="center-all" id="form-auth">

        <div class="col-6 login-wrap">
            <div class="col p-sm">
                <input class="form-control" id="email-auth" type="email" placeholder="Введите email">
            </div>
            <div class="col p-sm">
                <input class="form-control" id="pswd-auth" type="password" placeholder="Введите пароль">
            </div>

            <div class="bflex">
                <div class="col p-sm">
                    <button class="btn btn-link btn-sm align-self-start"
                            onclick="show('form-reg', 'flex'); show('title-reg', 'block'); hide('form-auth'); hide('title-auth'); ">Регистрация
                    </button>
                </div>
                <div class="col bflex p-sm">
                    <button class="btn btn-info btn-sm align-self-end" onclick = "enter();">Вход</button>
                </div>

            </div>
            <div id="auth-info"></div>
        </div>
    </div>

    <div class="center-all" id="form-reg">

        <div class="col-6 align-self-center reg-wrap">
            <div class="col p-sm">
                <input class="form-control" id="email-reg" type="email" placeholder="Введите Ваш email"
                       onchange="checkEmail();">
            </div>
            <div id="email-reg-info"></div>
            <div class="col p-sm">
                <input class="form-control" id="name-reg" placeholder="Введите Ваше имя">
            </div>
            <div class="col p-sm">
                <input class="form-control" id="pswd-reg" type="password" placeholder="Введите пароль" onchange = "checkPswds();">
            </div>
            <div class="col p-sm">
                <input class="form-control" id="pswd-reg1" type="password" placeholder="Повторите пароль" onchange = "checkPswds();">
            </div>
            <div class="bflex">
                <div class="col p-sm">
                    <button class="btn btn-link btn-sm align-self-start"
                            onclick="show('form-auth', 'flex'); show('title-auth', 'block'); hide('form-reg'); hide('title-reg');">Вход
                    </button>
                </div>
                <div class="col bflex p-sm">
                    <button class="btn btn-success btn-sm align-self-end" id = "reg-button" onclick = "register();">Регистрация</button>
                </div>
            </div>
            <div id="reg-info"></div>
        </div>
    </div>
</div>

</body>
</html>
