<?php
use Illuminate\Support\Facades\DB;
session_start();

if(!$_SESSION['notes']['id']){
    echo json_encode(['error' => true, 'info' => 'Пользователь не авторизован!']);
    exit();
}

$id = $_POST['id'];

$upd = DB::connection('mysql')->delete("delete from notes where id = ?", [$id]);
if($upd){
    echo json_encode(['success' => true]);
}
else {
    echo json_encode(['error' => true, 'info' => 'Заметка не удалена.']);
}
