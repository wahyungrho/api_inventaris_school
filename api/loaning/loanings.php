<?php

require '../../helpers/config.php';

$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
$status  = isset($_GET['status']) ? $_GET['status'] : '';

if ($user_id == '') {
  # code...
  if ($status == '') {
    $query = $connection->query("SELECT users.nip, users.name, users.phone, users.email, school.name as schoolName, roles.name as roleName, products.codeProduct, products.name as productName, products.image, products.description, products.stock, category.name as categoryName, orders.quantity, orders.notes, orders.createdAt as createLoan, orders.id as orderID, status.status as statusName FROM users LEFT JOIN school ON users.schoolID = school.id LEFT JOIN roles ON users.roleID = roles.id  RIGHT JOIN orders ON orders.userID = users.id LEFT JOIN products ON products.id = orders.productID LEFT JOIN category ON  category.id = products.categoryID LEFT JOIN status ON orders.statusID = status.id");
  } else {
    $query = $connection->query("SELECT users.nip, users.name, users.phone, users.email, school.name as schoolName, roles.name as roleName, products.codeProduct, products.name as productName, products.image, products.description, products.stock, category.name as categoryName, orders.quantity, orders.notes, orders.createdAt as createLoan, orders.id as orderID, status.status as statusName FROM users LEFT JOIN school ON users.schoolID = school.id LEFT JOIN roles ON users.roleID = roles.id  RIGHT JOIN orders ON orders.userID = users.id LEFT JOIN products ON products.id = orders.productID LEFT JOIN category ON  category.id = products.categoryID LEFT JOIN status ON orders.statusID = status.id WHERE status.status = '$status'");
  }
} else {
  if ($status == '') {
    $query = $connection->query("SELECT users.nip, users.name, users.phone, users.email, school.name as schoolName, roles.name as roleName, products.codeProduct, products.name as productName, products.image, products.description, products.stock, category.name as categoryName, orders.quantity, orders.notes, orders.createdAt as createLoan, orders.id as orderID, status.status as statusName FROM users LEFT JOIN school ON users.schoolID = school.id LEFT JOIN roles ON users.roleID = roles.id  LEFT JOIN orders ON orders.userID = users.id LEFT JOIN products ON products.id = orders.productID LEFT JOIN category ON  category.id = products.categoryID LEFT JOIN status ON orders.statusID = status.id WHERE orders.userID = '$user_id'");
  } else {
    $query = $connection->query("SELECT users.nip, users.name, users.phone, users.email, school.name as schoolName, roles.name as roleName, products.codeProduct, products.name as productName, products.image, products.description, products.stock, category.name as categoryName, orders.quantity, orders.notes, orders.createdAt as createLoan, orders.id as orderID, status.status as statusName FROM users LEFT JOIN school ON users.schoolID = school.id LEFT JOIN roles ON users.roleID = roles.id  LEFT JOIN orders ON orders.userID = users.id LEFT JOIN products ON products.id = orders.productID LEFT JOIN category ON  category.id = products.categoryID LEFT JOIN status ON orders.statusID = status.id WHERE orders.userID = '$user_id' AND status.status = '$status'");
  }
}

$result = [];

foreach ($query as $key => $value) {
  # code...
  $date = strtotime($value['createLoan']);
  $data = [
    'orderID' => $value['orderID'],
    'nip' => $value['nip'],
    'name' => $value['name'],
    'phone' => $value['phone'],
    'email' => $value['email'],
    'schoolName' => $value['schoolName'],
    'roleName' => $value['roleName'],
    'codeProduct' => $value['codeProduct'],
    'productName' => $value['productName'],
    'image' => $value['image'],
    'description' => $value['description'],
    'stock' => $value['stock'],
    'categoryName' => $value['categoryName'],
    'quantity' => $value['quantity'],
    'notes' => $value['notes'],
    'createLoan' => date('d M Y H:i', $date),
    'statusName' => $value['statusName'],
  ];

  array_push($result, $data);
}

echo response('success', $result);
