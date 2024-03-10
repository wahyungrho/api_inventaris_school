<?php


require '../../helpers/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name   = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';

  try {
    $insert = $connection->query("INSERT INTO class (name) VALUES ('$name')");

    if ($insert)
      echo response('success', 'Class berhasil ditambahkan');
    else
      echo response('error', $connection->error);
  } catch (\Throwable $e) {
    echo response('error', $th->getMessage());
  }
} else echo response('error', 'The method was not found');
