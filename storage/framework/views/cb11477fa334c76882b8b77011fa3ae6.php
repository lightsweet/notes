<?php
use Illuminate\Support\Facades\DB;
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Создание заметки</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<script>
    function createNote() {
        $.ajax({
            url: '/createNote',
            method: 'post',
            dataType: 'json',
            data: {
                'title': $('#title').val(),
                'content': $('#content').val(),
                'user': <?php echo e($_SESSION['notes_user']['id']); ?>,
                '_token': '<?php echo e(csrf_token()); ?>'
            },
            success: function (data) {
                if (data.error) {
                    show('create-info', 'block');
                    $('#create-info').css('color', 'red');
                    $('#create-info').html(data.info);
                }
                else {
                    $('#create-info').html('');
                    $('#create-info').css('color', '#198754');
                    $('#create-info').html('Заметка успешно создана!');
                    $('#title').val('');
                    $('#content').val('');
                }
            }
        });
    }
</script>
<body>
<div class="container">

    <div class = "bumper">
        <div class="p-sm">
            <a href="/login">На главную</a>
        </div>
        <?php

        if(!$_SESSION['notes_user']['id']){
        ?>

        <h4>Пожалуйста, авторизуйтесь!</h4><br>

        <?php
        exit();
        }

        ?>
    </div>
    <div class="center-all">
        <h3>Создание заметки</h3>
    </div>
    <div class="center-all">
            <div class="col-8 login-wrap">
                <div class="col p-sm">
                    <input class="form-control" id = "title" placeholder="Заголовок">
                </div>
                <div class="col p-sm">
                    <textarea class="form-control htxt" id="content" placeholder="Текст заметки"></textarea>
                </div>

                <div class="bflex">

                    <div class="col p-sm">
                        <a class="btn btn-link btn-sm align-self-start"
                                href="/notes">На страницу заметок
                        </a>
                    </div>
                    <div class="col bflex p-sm">
                        <button class="btn btn-info btn-sm align-self-end" onclick="createNote();">Создать</button>
                    </div>

                </div>
                <div id="create-info"></div>
            </div>
    </div>

</div>
</body>
</html>
<?php /**PATH C:\OSPanel\domains\l\lar-app\resources\views/create.blade.php ENDPATH**/ ?>