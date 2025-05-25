<?php

global $db;
$db = new PDO('mysql:host=' . conf('db_host') . ';dbname=' . conf('db_name'), conf('db_user'), conf('db_pass'),
  array(PDO::MYSQL_ATTR_FOUND_ROWS => true, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

function db_row($stmt) {
  return $stmt->fetch(PDO::FETCH_NUM);
}

function db_error() {
  global $db;
  return $db->errorInfo();
}

function db_query($query) {
  global $db;
  $q = $db->prepare($query);
  $args = func_get_args();
  array_shift($args);
  $res = $q->execute($args);
  if ($res) {
    while ($row = db_row($q)) {
        $r[] = $row;
    }
  }
  return $r;
}

function db_result($query) {
  global $db;
  $q = $db->prepare($query);
  $args = func_get_args();
  array_shift($args);
  $res = $q->execute($args);
  if ($res) {
    return $q->fetchAll(PDO::FETCH_NUM);
  }
  else {
    return FALSE;
  }
}

function db_command($query) {
  global $db;
  $q = $db->prepare($query);
  $args = func_get_args();
  array_shift($args);
  return $res = $q->execute($args);
}

function db_insert_id() {
  global $db;
  return $db->lastInsertId();
}

function db_get($table, $columns = '*', $conditions = []) {
    $select = is_array($columns) ? implode(', ', $columns) : $columns;
    $where = [];
    $params = [];
    foreach ($conditions as $column => $value) {
        $where[] = "$column = ?";
        $params[] = $value;
    }
    $query = "SELECT $select FROM $table";
    if (!empty($where)) {
        $query .= " WHERE " . implode(' AND ', $where);
    }
    $result = db_result($query, ...$params);
    return $result;
}

function db_set($table, $data, $condition = []) {
    if (empty($data)) {
        return false;
    }
    $exists = false;
    $where = [];
    $params = [];
    foreach ($condition as $column => $value) {
        $where[] = "$column = ?";
        $params[] = $value;
    }
    if (!empty($condition)) {
        $query = "SELECT 1 FROM $table WHERE " . implode(' AND ', $where);
        $exists = (bool)db_result($query, ...$params);
    }
    if (!$exists) {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $params = array_values($data);
        return db_command($query, ...$params);
    }
    $set = [];
    $params2 = [];
    foreach ($data as $column => $value) {
        $set[] = "$column = ?";
        $params2[] = $value;
    }
    $query = "UPDATE $table SET " . implode(', ', $set) . " WHERE " . implode(' AND ', $where);
    return db_command($query, ...$params2,...$params);
}

function db_delete($table, $condition = []) {
    if (empty($condition)) {
        return false;
    }
    $where = [];
    $params = [];
    foreach ($condition as $column => $value) {
        $where[] = "$column = ?";
        $params[] = $value;
    }
    $query = "DELETE FROM $table WHERE " . implode(' AND ', $where);
    return db_command($query, ...$params);
}

function db_sort_sql() {
}

function db_pager_query() {
}

function db_array() {
  $args = func_get_args();
  $key = array_shift($args);
  $query = array_shift($args);
  $q = $db->prepare($query);
  $res = $q->execute($args);
  $r = array();
  if ($res) {
    while ($row = db_row($res)) {
      if (!empty($key) && isset($row[$key]) && !isset($r[$row[$key]])) {
        $r[$row[$key]] = $row;
      }
      else {
        $r[] = $row;
      }
    }
  }
  return $r;
}

?>