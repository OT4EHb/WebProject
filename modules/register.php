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

function register_get($request) {
    if($request['user'])    
        return redirect('/');
    require_once('db.php');
    $c=db_query("SELECT 'id',MAX(user_id) FROM users")['id'][1];
    $data['login']="user".($c?$c:0);
    $data['password']=randomPassword();
    db_set('users',
        ['username'=>$data['login'],
        'pass'=>password_hash($data['password'],PASSWORD_DEFAULT)]);
    return array(
        'headers' => array('HTTP/1.1 200 OK'),
        'entity' => json_encode($data),
    );
}
?>