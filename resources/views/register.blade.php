<?php
use Illuminate\Support\Facades\DB;

$email = $_POST['email'];
$name = $_POST['name'];
$pswd = $_POST['pswd'];
$pswd1 = $_POST['pswd1'];

if($pswd != $pswd1){
    echo json_encode(['error' => true, 'info' => 'Пароли не совпадают.']);
    exit();
}
$users = DB::connection('mysql')->select('select * from users where email = :email', ['email' => $email]);
if(count($users)){
    echo json_encode(['error' => true, 'info' => 'Пользователь с таким адресом уже существует.']);
    exit();
}
$res = DB::connection('mysql')->insert('insert into `users` (name, password, email, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())', [$name, md5($pswd), $email]);
if($res){
    echo json_encode(['success' => true]);
}
