<?php
use Illuminate\Support\Facades\DB;
session_start();
?>
    <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Заметки</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function edit(id) {
            $.ajax({
                url: '/editNote',
                method: 'post',
                dataType: 'json',
                data: {
                    'id': id,
                    'title': $('#edittitle_' + id).val(),
                    'content': $('#editcontent_' + id).val(),
                    '_token': '{{ csrf_token() }}'
                },
                success: function (data) {
                    if (data.error) {
                        show('edit-info-' + id, 'block');
                        $('#edit-info-' + id).css('color', 'red');
                        $('#edit-info-' + id).html(data.info);
                    } else {
                        $('#edit-info-' + id).css('color', '#198754');
                        $('#edit-info-' + id).html('Заметка отредактирована');
                        noteFromEdit(id);
                        $('#title_' + id).html(data.title);
                        $('#content_' + id).html(data.content);
                    }
                }
            });
        }

        function deleteNote(id) {
            $.ajax({
                url: '/deleteNote',
                method: 'post',
                dataType: 'json',
                data: {
                    'id': id,
                    '_token': '{{ csrf_token() }}'
                },
                success: function (data) {
                    if (data.error) {
                        show('delete-info', 'block');
                        $('#delete-info-').css('color', 'red');
                        $('#delete-info-').html(data.info);
                    } else {
                        $('#delete-info').css('color', '#198754');
                        $('#delete-info').html('Заметка удалена');
                        $('#row_' + id).css('display', 'none');
                    }
                }
            });
        }
    </script>
</head>
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

    <div class="center-all p-sm">
        <h3>Здравствуйте, {{ $_SESSION['notes_user']['name'] }}!</h3>
    </div>
    <?php
    $notes = DB::connection('mysql')->select("SELECT * FROM notes WHERE user_id = ? ORDER BY updated_at DESC", [$_SESSION['notes_user']['id']]);
    if(!$notes){
    ?>
    <div class="center-all p-sm">
        У Вас еще нет ни одной заметки.
    </div>
    <?php
    }
    else {
    ?>
    <div id="delete-info" onclick="hide('delete-info');"></div>
    <table class="table table-bordered table-sm">
        <tr>
            <th class="col-2">Заголовок</th>
            <th class="col-9">Текст</th>
            <th class="col-1"></th>
        </tr>

        <?php
        foreach($notes as $note){
        ?>
        <tr id="row_{{ $note->id }}">
            <td>
                <div id="title_{{ $note->id }}">
                    {!! htmlspecialchars($note->title) !!}
                </div>
                <input id="edittitle_{{ $note->id }}" class="form-control" value="{{ $note->title }}"
                       style="display: none;">
            </td>
            <td>
                <div id="content_{{ $note->id }}">
                    {!! htmlspecialchars($note->content) !!}
                </div>
                <textarea id="editcontent_{{ $note->id }}" class="form-control" style="display: none; width: 100%;">
                        {{ $note->content }}
                    </textarea>
            </td>
            <td>
                <button id="edit0-btn-{{ $note->id }}" class="btn btn-outline-success btn-sm"
                        onclick="noteToEdit({{ $note->id }})">Редактировать
                </button>
                <button id="edit-btn-{{ $note->id }}" class="btn btn-warning btn-sm" style="display: none;"
                        onclick="edit({{ $note->id }});">
                    Отправить
                </button>
                <button class="btn btn-outline-danger btn-sm" onclick="deleteNote({{ $note->id }});">Удалить</button>
                <div id="edit-info-{{ $note->id }}" onclick="hide('edit-info-{{ $note->id }}');"></div>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>


    <?php
    }
    ?>
    <div class="center-all p-sm">
        <a href="/create">
            <div class="btn btn-info btn-sm">Создать новую заметку</div>
        </a>
        <div class="center-all">
        </div>
    </div>
</div>
</body>
</html>
