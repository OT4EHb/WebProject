<?php
define('DISPLAY_ERRORS', 1);
define('INCLUDE_PATH', './scripts' . PATH_SEPARATOR . './modules');
$conf = array(
  'sitename' => 'Планктон-ЮГ',
  'theme' => './theme',
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
  '' => array('module' => 'front'),
  '/^admin$/' => array('module' => 'admin', 'auth' => 'auth_basic'),
  '/^cart$/'=>array('module'=>'cart','auth'=>'auth_db'),
);

header('Cache-Control: no-cache, must-revalidate');
header('Content-Type: text/html; charset=' . $conf['charset']);
