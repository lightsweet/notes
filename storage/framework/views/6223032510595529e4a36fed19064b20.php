<?php
use Illuminate\Support\Facades\DB;
$email = $_POST['email'];
$users = DB::connection('mysql')->select('select * from users where email = :email', ['email' => $email]);
if(count($users)){
    echo json_encode(['error' => true, 'info' => 'Пользователь с таким адресом уже существует.']);
}
    else {
        echo json_encode(['success' => true]);
    }


 ?><?php /**PATH C:\OSPanel\domains\l\lar-app\resources\views/checkEmail.blade.php ENDPATH**/ ?>