<?php
include('./settings.php');
ini_set('display_errors', DISPLAY_ERRORS);
ini_set('include_path', INCLUDE_PATH);
include('init.php');

$request = array(
  'url' => $_SERVER['REQUEST_URI'],
  'method' => isset($_POST['method']) && in_array($_POST['method'], array('get', 'post', 'put', 'delete')) ? $_POST['method'] : $_SERVER['REQUEST_METHOD'],
  'Accept' => $_SERVER['HTTP_ACCEPT'],
  'data'=>$_SERVER['REQUEST_METHOD']=='POST'?
    ($_SERVER['HTTP_ACCEPT']=='application/json'?
        json_decode(file_get_contents('php://input'), true)
        :$_POST)
    :$_GET,
);

$response = init($request, $urlconf);

if (!empty($response['headers'])) {
  foreach ($response['headers'] as $key => $value) {
    if (is_string($key)) {
      header(sprintf('%s: %s', $key, $value));
    }
    else {
      header($value);
    }
  }
}

if (!empty($response['entity'])) {
  print($response['entity']);
}
