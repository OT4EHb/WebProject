<?php
function login_get($request) {
    if (($request['user']))
        return redirect('/');
    return array(
        'headers' => array('HTTP/1.1 200 OK'),
        'entity' => theme('login'),
    );
}

function login_post($request) {
    $data=$request['data'];
    require_once('db.php');
    $r=db_get('users',['user_id','pass'],['username'=>$data['login']]);
    if ($r==null||!password_verify($data['pass'],$r[0][1])){
        return bad_request("Неверный логин или пароль");
    }
    session_name("Kaneki");
    session_start();
    $_SESSION['user']=$r[0][0];
    return redirect('cart');
}
?>