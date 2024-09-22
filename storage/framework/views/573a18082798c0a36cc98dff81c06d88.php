<?php
use Illuminate\Support\Facades\DB;

$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];

$upd = DB::connection('mysql')->update("UPDATE notes SET title = ?, content = ?, updated_at = NOW() WHERE id = ?", [$title, $content, $id]);
if($upd){
    echo json_encode(['success' => true, 'title' => htmlspecialchars($title), 'content' => htmlspecialchars($content)]);
}
    else {
        echo json_encode(['error' => true, 'info' => 'Редактирование не удалось.']);
    }
 ?><?php /**PATH C:\OSPanel\domains\l\lar-app\resources\views/editNote.blade.php ENDPATH**/ ?>