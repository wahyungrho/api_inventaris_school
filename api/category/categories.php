<?php

require '../../helpers/config.php';

$query = $connection->query('SELECT * FROM category WHERE status =\'AKTIF\'');
$result = [];

foreach ($query as $key => $school) {
  # code...
  $data = [
    'id' => $school['id'],
    'name' => $school['name'],
    'status' => $school['status'],
    'createdAt' => $school['createdAt'],
  ];

  array_push($result, $data);
}

echo response('success', $result);
