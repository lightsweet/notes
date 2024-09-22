<?php
use Illuminate\Support\Facades\DB;

session_start();

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

 ?><?php /**PATH C:\OSPanel\domains\l\lar-app\resources\views/createNote.blade.php ENDPATH**/ ?>