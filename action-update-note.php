<?php
require 'config.php';

if(!check_login()) exit;

if(!isset($_POST['title']) or !isset($_POST['content']) or !isset($_POST['id'])) return abort();

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
$id = escape($_POST['id']);
$data = $conn->query("SELECT `user_id` FROM `notes` WHERE `id`='$id'")->fetch_assoc();

if(is_null($data)) return abort(404);

if(!is_authorized($data['user_id'])) return abort(403);

$res = $conn->query("UPDATE `notes` SET `title`='$title', `content`='$content' WHERE `notes`.`id`='$id'");

if(!$res) {
  echo "Error: ".$conn->error;
  exit;
}

alert('Berhasil!', 'main.php');