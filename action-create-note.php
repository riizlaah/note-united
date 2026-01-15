<?php
require 'config.php';

if(!check_login()) exit;


if(!isset($_POST['title']) or !isset($_POST['content'])) return abort();

if(!is_string($_POST['title'])) return abort();
if(!is_string($_POST['content'])) return abort();
if(strlen($_POST['title']) === 0) {
  alert('Judul tidak boleh kosong!', 'create.php');
  exit;
}
if(strlen($_POST['content']) === 0) {
  alert('Isi tidak boleh kosong!', 'create.php');
  exit;
}

$title = escape($_POST['title']);
$content = escape($_POST['content']);
$user_id = $_SESSION['login'];


$res = $conn->query("INSERT INTO `notes` (`id`, `user_id`, `title`, `content`, `created_at`) VALUES (NULL, '$user_id', '$title', '$content', current_timestamp())");

if(!$res) {
  echo "Error: ".$conn->error;
  exit;
}

alert('Berhasil!', 'main.php');
