<?php

use Illuminate\Support\Facades\DB;

session_start();

$email = $_POST['email'];
$pswd = $_POST['pswd'];

$users = DB::connection('mysql')->select('select * from users where email = ? AND password = ?', [$email, md5($pswd)]);

$_SESSION['notes_user'] = [
    'id' => $users[0]->id,
    'name' => $users[0]->name,
    'email' => $users[0]->email
];

if(!$users){
    echo json_encode(['error' => true, 'info' => 'Пользователь не найден.']);
    exit();
}

echo json_encode(['success' => true]);
 ?><?php /**PATH C:\OSPanel\domains\l\lar-app\resources\views/enter.blade.php ENDPATH**/ ?>