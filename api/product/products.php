<?php

require '../../helpers/config.php';
require '../../helpers/query_function.php';

$category = isset($_GET['category']) ? $_GET['category'] : '';
$isPengajuan = isset($_GET['isPengajuan']) ? $_GET['isPengajuan'] : ''; // "0" or "1"

function inventarisFunction($category, $connection)
{
  if ($category == '') {
    $query = $connection->query("SELECT products.*, users.name as createdName FROM products LEFT JOIN users ON products.createdBy = users.id WHERE products.status = 'AKTIF' ORDER BY products.createdAt DESC");
  } else {

    $query = $connection->query("SELECT products.*, users.name as createdName FROM products LEFT JOIN users ON products.createdBy = users.id WHERE products.categoryID = '$category' && products.status = 'AKTIF' ORDER BY products.createdAt DESC");
  }

  return $query;
}

function pengajuanFunction($category, $connection)
{
  if ($category == '') {
    $query = $connection->query("SELECT products.*, users.name as createdName FROM products LEFT JOIN users ON products.createdBy = users.id WHERE products.status = 'MENUNGGU' ORDER BY products.createdAt DESC");
  } else {
    $query = $connection->query("SELECT products.*, users.name as createdName FROM products LEFT JOIN users ON products.createdBy = users.id WHERE products.categoryID = '$category' && products.status = 'MENUNGGU' ORDER BY products.createdAt DESC");
  }

  return $query;
}

if ($isPengajuan == '0' || $isPengajuan == '')
  $query = inventarisFunction($category, $connection);
else
  $query = pengajuanFunction($category, $connection);



$result = [];

foreach ($query as $key => $item) {
  # code...
  $data = [
    'id'          => $item['id'],
    'categoryID'  => $item['categoryID'],
    'codeProduct' => $item['codeProduct'],
    'name'        => $item['name'],
    'description' => $item['description'],
    'image'       => $item['image'],
    'stock'       => $item['stock'],
    'status'      => $item['status'],
    'createdBy'   => $item['createdBy'],
    'createdName' => $item['createdName'],
    'createdAt'   => $item['createdAt'],
  ];

  array_push($result, $data);
}

echo response('success', $result);
