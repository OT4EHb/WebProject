<?php
function cart_get($request) {
    return array(
        'headers' => array('HTTP/1.1 200 OK'),
        'entity' => theme('cart'),
    );
}

function cart_post($request) {
    $json=(json_decode(file_get_contents('php://input')));
    return array(
        'headers' => array('HTTP/1.1 200 OK'),
        'entity' => ,
    );
}
?>