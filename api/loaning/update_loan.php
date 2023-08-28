<?php

require '../../helpers/config.php';

function statusID($type)
{
  switch ($type) {
    case 'disetujui':
      # code...
      return 2;
      break;
    case 'dikembalikan':
      # code...
      return 3;
      break;
    case 'tidak_disetujui':
      # code...
      return 4;
      break;
    case 'dibatalkan':
      # code...
      return 5;
      break;

    default:
      # code...
      return 1;
      break;
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $order_id               = isset($_POST['order_id']) ? htmlspecialchars($_POST['order_id']) : "";
  $type                   = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : "";
  $status                 = statusID($type);

  $checkLoan              = $connection->query("SELECT id, quantity, productID FROM orders WHERE id='$order_id'");
  $data_loan              = $checkLoan->fetch_assoc();

  if ($checkLoan->num_rows > 0) {
    $connection->begin_transaction();
    try {
      //code...
      $connection->query("UPDATE orders SET statusID='$status' WHERE id='$order_id'");

      if ($status == 3 || $status == 5 || $status == 4) {
        $quantity     = (int)$data_loan['quantity'];
        $productID    = (int)$data_loan['productID'];

        $connection->query("UPDATE products SET stock=stock + $quantity WHERE id='$productID'");
      }

      if (!$connection->error) {
        $connection->commit();
        echo response('success', 'Status Peminjaman berhasil diubah');
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
    echo response('error', 'ID peminjaman tidak ditemukan');
  }
} else {
  echo response('error', 'The method was not found');
}
