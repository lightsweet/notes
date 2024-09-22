<?php
use Illuminate\Support\Facades\DB;
session_start();

$id = $_POST['id'];

$upd = DB::connection('mysql')->delete("delete from notes where id = ?", [$id]);
if($upd){
    echo json_encode(['success' => true]);
}
else {
    echo json_encode(['error' => true, 'info' => 'Заметка не удалена.']);
}
 ?><?php /**PATH C:\OSPanel\domains\l\lar-app\resources\views/deleteNote.blade.php ENDPATH**/ ?>