<?php
function init($request = array(), $urlconf = array()) {
  $response = array();
  $template = 'page';
  $c = array();
  $q = '';
  if (conf('clean_urls')){
      $q = isset($request['url']) ? $request['url'] : '';
  } else {
      $q=isset($_GET['q']) ? $_GET['q'] : '';
  }
  if ($q=='/') $q='';
  $method = isset($request['method']) ? $request['method'] : 'get';
  foreach ($urlconf as $url => $r) {
    $matches = array();
    if ($url == '' || $url[0] != '/') {
      if ($url != $q) {
        continue;
      }
    }
    else {
      if (!preg_match_all($url, $q, $matches)) {
        continue;
      }
    }

    // Аутентификация и инициализация $request['user'].
    if (isset($r['auth'])) {
      require_once($r['auth'] . '.php');
      $request['user'] = auth($request, $r);
    }

    // Шаблон всей страницы можно перекрыть для обрабатываемого ресурса в $urlconf.
    if (isset($r['tpl'])) {
      $template = $r['tpl'];
    }

    // Обработка запроса модулем.
    if (!isset($r['module'])) {
      continue;
    }
    require_once($r['module'] . '.php');
    // Собираем имя функции из имени модуля и метода запроса.
    $func = sprintf('%s_%s', $r['module'], $method);
    if (!function_exists($func)) {
      continue;
    }
    // Собираем параметры в массив.
    $params = array('request' => $request);
    array_shift($matches);
    foreach ($matches as $key => $match) {
      $params[$key] = $match[0];
    }
    // Вызываем обработчик запроса в модуле передавая параметры из $params.
    if ($result = call_user_func_array($func, $params)) {
      if (is_array($result)) {
        $response = array_merge($response, $result);
        // Первый модуль отработал запрос и выставил редирект или not found или forbidden.
        // Другие модули уже не отрабатывают запрос.
        // Т.е. важно в каком порядке стоят модули в массиве $res.
        if (!empty($response['headers'])) {
          return $response;
        }
      }
      else {
        $c['#content'][$r['module']] = $result;
      }
    }
  }

  // Если есть вывод модулей, то выводим его через шаблон страницы или шаблон в $urlconf.
  if (!empty($c)) {
    $c['#request'] = $request;
    $response['entity'] = theme($template, $c);
  }
  else {
    $response = not_found();
  }

  $response['headers']['Content-Type'] = 'text/html; charset=' . conf('charset');
  return $response;
}

function conf($key) {
  global $conf;
  return isset($conf[$key]) ? $conf[$key] : NULL;
}

// Формирует сокращенные URL для ссылок или для текущей страницы.
function url($addr = '', $params = array()) {
  global $conf;
  if ($addr == '' && isset($_GET['q'])) {
    $addr = strip_tags($_GET['q']);
  }
  $clean = conf('clean_urls');
  $r = $clean ? '/' : '?q=';
  $r .= strip_tags($addr);
  if (count($params) > 0) {
    $r .= $clean ? '?' : '&';
    $r .= implode('&', $params);
  }
  return $r;
}

function redirect($l = NULL) {
  if (is_null($l)) {
    $location = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  }
  else {
    $location = 'http://' . $_SERVER['HTTP_HOST'] . conf('basedir') . url($l);
  }
  return array('headers' => array('Location' => $location));
}

function access_denied() {
  return array(
    'headers' => array('HTTP/1.1 403 Forbidden'),
    'entity' => theme('403'),
  );
}

function not_found() {
  return array(
    'headers' => array('HTTP/1.1 404 Not Found'),
    'entity' => theme('404'),
  );
}

function bad_request($res) {
    return array(
        'headers'=>array('HTTP/1.1 400 Bad Request'),
        'entity' => $res,
    );
}

function theme($t, $c = array()) {
  $template = conf('theme') . '/' . str_replace('/', '_', $t) . '.tpl.php';
  if (!file_exists($template)) {
    return implode('', $c);
  }
  ob_start();
  include $template;
  $contents = ob_get_contents();
  ob_end_clean();
  return $contents;
}
