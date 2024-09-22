<?php
use Illuminate\Support\Facades\DB;

session_start();

if(!$_SESSION['notes']['id']){
    echo json_encode(['error' => true, 'info' => 'Пользователь не авторизован!']);
    exit();
}

$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];

$upd = DB::connection('mysql')->update("UPDATE notes SET title = ?, content = ?, updated_at = NOW() WHERE id = ?", [$title, $content, $id]);
//возвращаем htmlspecialchars для избежания xss атак
if($upd){
    echo json_encode(['success' => true, 'title' => htmlspecialchars($title), 'content' => htmlspecialchars($content)]);
}
    else {
        echo json_encode(['error' => true, 'info' => 'Редактирование не удалось.']);
    }
