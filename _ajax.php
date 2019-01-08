<?php

session_start();

// echo __DIR__;
// exit;

require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/functions.php');
require_once(__DIR__ . '/Todo.php');
require_once(__DIR__ . '/Token.php');

$todoApp = new \MyAPP\Todo();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {

    $res = $todoApp->post();
    header('Content-Type: application/json');
    echo json_encode($res);
    exit;

  } catch (Exception $e) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    echo $e->getMessage();
    exit;
  }
}