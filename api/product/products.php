<?php

require '../../helpers/config.php';

$category = isset($_GET['category']) ? $_GET['category'] : '';

if ($category == '') {
  $query = $connection->query("SELECT * FROM products WHERE status = 'AKTIF'");
} else {
  $query = $connection->query("SELECT * FROM products WHERE categoryID = '$category' && status = 'AKTIF'");
}
$result = [];

foreach ($query as $key => $school) {
  # code...
  $data = [
    'id'          => $school['id'],
    'categoryID'  => $school['categoryID'],
    'codeProduct' => $school['codeProduct'],
    'name'        => $school['name'],
    'description' => $school['description'],
    'image'       => $school['image'],
    'stock'       => $school['stock'],
    'createdAt'   => $school['createdAt'],
  ];

  array_push($result, $data);
}

echo response('success', $result);
