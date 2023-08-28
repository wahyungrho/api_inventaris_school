<?php

require '../../helpers/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id     = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : "";
  $checkID = $connection->query("SELECT id FROM products WHERE id='$id'");

  if ($checkID->num_rows > 0) {
    try {
      //code...
      $connection->begin_transaction();
      $insert = $connection->query("UPDATE products SET status='TIDAK AKTIF' WHERE id='$id'");

      if (!$connection->error) {
        # code...
        $connection->commit();
        echo response('success', 'Barang Invetaris berhasil dihapus');
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
    echo response('error', 'ID barang tidak ditemukan');
  }
} else {
  echo response('error', 'The method was not found');
}
