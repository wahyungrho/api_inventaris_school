<?php

require '../../helpers/config.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($id != '') {
  $query = $connection->query("SELECT products.*, roles.name roleName, users.role_id, category.id as category_id, category.name as category_name FROM products LEFT JOIN category ON products.categoryID = category.id LEFT JOIN users ON products.createdBy = users.id LEFT JOIN roles ON users.role_id = roles.id WHERE products.id = '$id'");

  if ($query->num_rows > 0) {
    $product = $query->fetch_assoc();

    echo response('success', [
      'id' => $product['id'],
      'codeProduct' => $product['codeProduct'],
      'name' => $product['name'],
      'image' => $product['image'],
      'description' => $product['description'],
      'stock' => $product['stock'],
      'status' => $product['status'],
      'createdBy' => $product['createdBy'],
      'categoryID' => $product['category_id'],
      'categoryName' => $product['category_name'],
      'roleID' => $product['role_id'],
      'roleName' => $product['roleName'],
    ]);
  } else {
    echo response('error', 'ID user tidak ditemukan');
  }
} else {
  echo response('error', 'ID user tidak ditemukan');
}
