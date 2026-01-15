<?php
require 'config.php';


if(!check_login()) exit;


if(!isset($_GET['id'])) abort();
if(!is_numeric($_GET['id'])) return abort();

$user_id = intval($_GET['id']);

if(!is_authorized($user_id)) return abort(403);

$query = "SELECT * FROM `notes` WHERE `user_id`='$user_id'";

if(isset($_GET['s'])) {
  if(is_string($_GET['s'])) {
    $search = escape($_GET['s']);
    $query .= " AND `title`='$search'";
  }
}

$datas = $conn->query($query)->fetch_all(MYSQLI_ASSOC);

$new_datas = array_map(function($row) {
  $leading_trail = strlen($row['content']) > 48 ? '...' : '';
  return [
    'id' => $row['id'],
    'title' => $row['title'],
    'content' => substr($row['content'], 0, 48) . $leading_trail,
    'created_at' => date_create($row['created_at'])->format('M d, Y')
  ];
}, $datas);

header('Content-Type: application/json');
echo json_encode($new_datas);

