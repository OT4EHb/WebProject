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
    if (empty($_COOKIE['card']))
        return not_found();
    $data=$request['data'];
    return array(
        'headers' => array('HTTP/1.1 200 OK'),
        'entity' => json_encode($data),
    );
}
?>