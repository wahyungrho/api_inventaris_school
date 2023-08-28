<?php

require '../../helpers/config.php';

$query = $connection->query('SELECT * FROM school');
$result = [];

foreach ($query as $key => $school) {
  # code...
  $data = [
    'id' => $school['id'],
    'name' => $school['name'],
    'phone' => $school['phone'],
    'email' => $school['email'],
    'address' => $school['address'],
  ];

  array_push($result, $data);
}

echo response('success', $result);
