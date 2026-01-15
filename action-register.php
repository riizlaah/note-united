<?php
require 'config.php';

if(has_login()) exit;


if(!isset($_POST['fullname']) or !isset($_POST['email']) or !isset($_POST['password'])) {
  return redirect('register.php');
}
if(!is_string($_POST['fullname'])) {
  http_response_code(400);
  exit;
}
if(strlen($_POST['fullname']) === 0) {
  alert("Nama lengkap tidak boleh kosong!", 'register.php');
}
if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  alert('Bukan email yang valid!', 'register.php');
}
if(!is_string($_POST['password'])) {
  http_response_code(400);
  exit;
}
if(strlen($_POST['password']) < 8) {
  alert('Password setidaknya memiliki panjang 8 karakter!', 'register.php');
}


// $db = new DB();

$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$fullname = escape($_POST['fullname']);
$email = escape($_POST['email']);

global $conn;

$email_used = $conn->query("SELECT `id` FROM `users` WHERE `email`='$email'")->fetch_assoc();

if(!is_null($email_used)) {
  alert('Email ini sudah dipakai!', 'register.php');
}

$conn->query("INSERT INTO `users` (id, fullname, email, password, remember_token) VALUES (NULL, '$fullname', '$email', '$hashed_password', NULL)");

alert("Sukses!", 'index.php');
