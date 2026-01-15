<?php
session_start();

$host = "localhost";
$user = "nafan";
$pass = "Heks137?";
$db_name = "noteUnited";


$conn = new mysqli($host, $user, $pass, $db_name);

if($conn->connect_error) {
  die("Koneksi gagal: ".$conn->connect_error);
}

function escape($val) {
  global $conn;
  return mysqli_real_escape_string($conn, $val);
}

function redirect($to, $wait = 0) {
  if($wait > 0) {
    return header("refresh:$wait;url=$to");
  }
  return header("location:$to");
}

function alert($msg, $redirect = null) {
  if(!is_null($redirect)) {
    $redirect = "document.location.href = '$redirect';";
    echo "<script>alert('$msg');$redirect</script>";
    exit;
  }
  echo "<script>alert('$msg');</script>";
}

function check_login() {
  if(!isset($_SESSION['login'])) {
    redirect('index.php');
    return false;
  }
  return true;
}

function has_login() {
  if(isset($_SESSION['login'])) {
    redirect('main.php');
    return true;
  }
  return false;
}

function abort($code = 400) {
  return http_response_code($code);
}

function is_authorized(int $id) {
  return $id === intval($_SESSION['login']);
}
