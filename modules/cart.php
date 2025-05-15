<?php
function cart_get($request) {
    return array(
    'headers' => array('HTTP/1.1 200 OK'),
    'entity' => theme('cart'),
  );
}
?>