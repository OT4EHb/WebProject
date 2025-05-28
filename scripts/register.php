<?php
function randomPassword($length = 12) {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = '';
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < $length; $i++) {
        $n = rand(0, $alphaLength);
        $pass .= $alphabet[$n];
    }
    return $pass;
}

function register() {
    $c=db_query("SELECT MAX(user_id) FROM userss");
    $data['id']=($c?$c[0][0]:0)+1;
    $data['login']="user".$data['id'];
    $data['password']=randomPassword();
    db_set('userss',
        ['username'=>$data['login'],
        'pass'=>password_hash($data['password'],PASSWORD_DEFAULT)]);
    return $data;
}
?>