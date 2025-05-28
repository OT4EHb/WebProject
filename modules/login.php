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
    $r=db_get('userss',['user_id','pass'],['username'=>$data['login']]);
    if ($r==null||!password_verify($data['pass'],$r[0][1])){
        $request['error']=true;
        return bad_request($request['js']?"":
            theme('login',$request)
        );
    }
    session_name("Kaneki");
    session_start();
    $_SESSION['user']=$r[0][0];
    return redirect('cart');
}
?>