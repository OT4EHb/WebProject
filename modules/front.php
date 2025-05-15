<?php
function front_get($request) {
    return array(
    'headers' => array('HTTP/1.1 200 OK'),
    'entity' => theme('index'),
  );
}

function front_post($request) {
    return access_denied();
}
?>