<?php
use Illuminate\Support\Facades\DB;

session_start();

if(!$_SESSION['notes']['id']){
    echo json_encode(['error' => true, 'info' => 'Пользователь не авторизован!']);
    exit();
}

$title = $_POST['title'];
$content = $_POST['content'];
$user_id = $_POST['user'];

$res = DB::connection('mysql')->insert('INSERT INTO notes (user_id, title, content, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())', [$user_id, $title, $content]);
if($res){
    echo json_encode(['success' => true]);
}
    else{
        echo json_encode(['error' => true, 'info' => 'Заметка не создана.']);
    }

