<?php

require '../../helpers/config.php';

$query = $connection->query('SELECT * FROM class');
$result = [];

foreach ($query as $key => $school) {
  # code...
  $data = [
    'id' => $school['id'],
    'name' => $school['name']
  ];

  array_push($result, $data);
}

echo response('success', $result);
