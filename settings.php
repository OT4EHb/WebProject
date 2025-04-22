<?php
define('DISPLAY_ERRORS', 1);
define('INCLUDE_PATH', './scripts' . PATH_SEPARATOR . './modules');
$conf = array(
  'charset' => 'UTF-8',
  'display_errors' => DISPLAY_ERRORS,
  'date_format' => 'd.m.Y',
  'basedir' => '/',
  'db_host'=>'localhost',
  'db_name'=>'dbname',
  'db_user'=>'user',
  'db_pass'=>'2As4o5dfe3Fqw2'
);

$urlconf = array(
  '/' => array('module' => 'front'),
  '/^admin$/' => array('module' => 'admin', 'auth' => 'auth_basic'),
  '/^admin\/(\d+)$/' => array('module' => 'admin', 'auth' => 'auth_basic'),
  '/^order\/(\d+)$/' => array('module' => 'order', 'auth' => 'auth_db_basic'),
  '/^order\/(\d+)\/add$/' => array('module' => 'order_add', 'auth' => 'auth_db_basic'),
  '/^order\/(\d+)\/add\/(\d+)$/' => array('module' => 'order_add', 'auth' => 'auth_db_basic')
);

header('Cache-Control: no-cache, must-revalidate');
header('Content-Type: text/html; charset=' . $conf['charset']);
