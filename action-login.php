<?php
require "config.php";

if(has_login()) exit;

global $conn;

$email = escape($_POST['input_email']);
$pass = $_POST['input_password'];

$data = $conn->query("SELECT `id`,`password` FROM `users` WHERE `email`='$email'")->fetch_assoc();

if(is_null($data)) alert('Akun tidak ada!', 'index.php');

if(!password_verify($pass, $data['password'])) alert('Kredensial salah!', 'index.php');

$_SESSION['login'] = $data['id'];

redirect('main.php');