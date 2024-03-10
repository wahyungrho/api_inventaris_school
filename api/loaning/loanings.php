<?php

require '../../helpers/config.php';

$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
$status  = isset($_GET['status']) ? $_GET['status'] : '';

if ($user_id == '') {
  # code...
  if ($status == '') {
    $query = $connection->query("SELECT  users.name, users.phone, users.email, class.name as className, student.nisn, staff.npsn, roles.name as roleName, products.codeProduct, products.name as productName, products.image, products.description, products.stock,  category.name as categoryName, orders.quantity, orders.notes, orders.createdAt as createLoan, orders.id as orderID, status.status as statusName FROM users LEFT JOIN student ON users.id = student.user_id  LEFT JOIN staff ON users.id = staff.user_id LEFT JOIN class ON student.class_id = class.id LEFT JOIN roles ON users.role_id = roles.id  RIGHT JOIN orders ON orders.userID = users.id LEFT JOIN products ON products.id = orders.productID LEFT JOIN category ON  category.id = products.categoryID LEFT JOIN status ON orders.statusID = status.id ORDER BY orders.id DESC");
  } else {
    $query = $connection->query("SELECT  users.name, users.phone, users.email, class.name as className, student.nisn, staff.npsn, roles.name as roleName, products.codeProduct, products.name as productName, products.image, products.description, products.stock, category.name as categoryName, orders.quantity, orders.notes, orders.createdAt as createLoan, orders.id as orderID, status.status as statusName FROM users LEFT JOIN student ON users.id = student.user_id  LEFT JOIN staff ON users.id = staff.user_id LEFT JOIN class ON student.class_id = class.id LEFT JOIN roles ON users.role_id = roles.id  RIGHT JOIN orders ON orders.userID = users.id LEFT JOIN products ON products.id = orders.productID LEFT JOIN category ON  category.id = products.categoryID LEFT JOIN status ON orders.statusID = status.id WHERE status.status = '$status' ORDER BY orders.id DESC");
  }
} else {
  if ($status == '') {
    $query = $connection->query("SELECT  users.name, users.phone, users.email, class.name as className, student.nisn, staff.npsn, roles.name as roleName, products.codeProduct, products.name as productName, products.image, products.description, products.stock, category.name as categoryName, orders.quantity, orders.notes, orders.createdAt as createLoan, orders.id as orderID, status.status as statusName FROM users LEFT JOIN student ON users.id = student.user_id  LEFT JOIN staff ON users.id = staff.user_id LEFT JOIN class ON student.class_id = class.id LEFT JOIN roles ON users.role_id = roles.id  RIGHT JOIN orders ON orders.userID = users.id LEFT JOIN products ON products.id = orders.productID LEFT JOIN category ON  category.id = products.categoryID LEFT JOIN status ON orders.statusID = status.id WHERE orders.userID = '$user_id' ORDER BY orders.id DESC");
  } else {
    $query = $connection->query("SELECT  users.name, users.phone, users.email, class.name as className, student.nisn, staff.npsn, roles.name as roleName, products.codeProduct, products.name as productName, products.image, products.description, products.stock, category.name as categoryName, orders.quantity, orders.notes, orders.createdAt as createLoan, orders.id as orderID, status.status as statusName FROM users LEFT JOIN student ON users.id = student.user_id  LEFT JOIN staff ON users.id = staff.user_id LEFT JOIN class ON student.class_id = class.id LEFT JOIN roles ON users.role_id = roles.id  RIGHT JOIN orders ON orders.userID = users.id LEFT JOIN products ON products.id = orders.productID LEFT JOIN category ON  category.id = products.categoryID LEFT JOIN status ON orders.statusID = status.id WHERE orders.userID = '$user_id' AND status.status = '$status' ORDER BY orders.id DESC");
  }
}

$result = [];

foreach ($query as $key => $value) {
  # code...
  $date = strtotime($value['createLoan']);
  $data = $value;

  array_push($result, $data);
}

echo response('success', $result);
