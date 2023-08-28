<?php

require '../../helpers/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id             = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : "";
  $name           = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : "";
  try {
    //code...
    $connection->begin_transaction();
    if ($id != '') {
      $connection->query("UPDATE category SET name = '$name' WHERE id = '$id'");
    } else {
      $connection->query("INSERT INTO category (name, status, createdAt) VALUES ('$name', 'AKTIF', NOW())");
    }

    if (!$connection->error) {
      # code...
      $message = 'Kategori Barang berhasil ditambahkan';
      if ($id != '') {
        $message = 'Kategori Barang berhasil diubah';
      }
      $connection->commit();
      echo response('success', $message);
    } else {
      $connection->rollback();
      echo response('error', $connection->error);
    }
  } catch (\Throwable $th) {
    //throw $th;
    $connection->rollback();
    echo response('error', $th->getMessage());
  }
} else {
  echo response('error', 'The method was not found');
}
