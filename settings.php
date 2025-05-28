<?php
define('DISPLAY_ERRORS', 1);
define('INCLUDE_PATH', './scripts' . PATH_SEPARATOR . './modules');
$conf = array(
  'sitename' => 'Планктон-ЮГ',
  'theme' => './theme',
  'charset' => 'UTF-8',
  'display_errors' => DISPLAY_ERRORS,
  'clean_urls' => FALSE,
  'date_format' => 'd.m.Y',
  'basedir' => '/',
  'db_host'=>'localhost',
  'db_name'=>'project',
  'db_user'=>'projecter',
  'db_pass'=>'projecter'
);

$urlconf = array(
  '' => array('module' => 'front', 'auth'=>'user'),
  '/^\/$/' => array('module' => 'front', 'auth'=>'user'),
  '/^cart$/'=>array('module'=>'cart', 'auth'=>'user'),
  '/^login$/'=>array('module'=>'login', 'auth'=>'user'),
  '/^logout$/'=>array('module'=>'logout', 'auth'=>'user'),
  '/^add$/'=>array('module'=>'add', 'auth'=>'user'),
);

header('Cache-Control: no-cache, must-revalidate');
header('Content-Type: text/html; charset=' . $conf['charset']);