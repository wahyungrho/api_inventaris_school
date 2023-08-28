<?php

require '../../helpers/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $user_id               = isset($_POST['user_id']) ? htmlspecialchars($_POST['user_id']) : "";
  $product_id            = isset($_POST['product_id']) ? htmlspecialchars($_POST['product_id']) : "";
  $quantity              = isset($_POST['quantity']) ? htmlspecialchars($_POST['quantity']) : "";
  $notes                 = isset($_POST['notes']) ? htmlspecialchars($_POST['notes']) : "";

  try {
    //code...
    $connection->begin_transaction();
    $checkStock            = $connection->query("SELECT stock FROM products WHERE id = '$product_id'");
    $stockResult           = $checkStock->fetch_assoc();

    if ($quantity < 1) {
      echo response('error', 'Jumlah barang yang dipinjam minimal 1 pcs');
    } else {
      if ($quantity > $stockResult['stock']) {
        echo response('error', 'Maaf jumlah barang yang dipinjam melebihi ketersediaan barang');
      } else {
        $connection->query("INSERT INTO orders (userID, productID, quantity, notes, statusID, createdAt) VALUES ($user_id, $product_id, $quantity, '$notes', 1, NOW())");
        $connection->query("UPDATE products SET stock = stock - $quantity WHERE id  = $product_id");
        $connection->commit();

        echo response('success', 'Peminjaman berhasil diajukan');
      }
    }
  } catch (\Throwable $th) {
    //throw $th;
    $connection->rollback();
    echo response('error', $th->getMessage());
  }
} else {
  echo response('error', 'The method was not found');
}
