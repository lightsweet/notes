<?php

use Illuminate\Support\Facades\DB;

session_start();

$email = $_POST['email'];
$pswd = $_POST['pswd'];
//ищем пользователя по емайлу и паролю
$users = DB::connection('mysql')->select('select * from users where email = ? AND password = ?', [$email, md5($pswd)]);

//если нашли, пишем его данные в сессию
$_SESSION['notes_user'] = [
    'id' => $users[0]->id,
    'name' => $users[0]->name,
    'email' => $users[0]->email
];
//если не нашли, возвращаем ошибку
if(!$users){
    echo json_encode(['error' => true, 'info' => 'Пользователь не найден.']);
    exit();
}

echo json_encode(['success' => true]);
