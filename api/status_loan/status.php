<?php

require '../../helpers/config.php';

$query = $connection->query('SELECT * FROM status');
$result = [];

foreach ($query as $key => $status) {
  # code...
  $data = [
    'id' => $status['id'],
    'status' => $status['status']
  ];

  array_push($result, $data);
}

echo response('success', $result);
