<?php

require '../../helpers/config.php';

$query = $connection->query('SELECT users.*, roles.name as roleName, school.name  as schoolName FROM users LEFT JOIN roles ON users.roleID = roles.id LEFT JOIN school ON users.schoolID = school.id  WHERE users.roleID = 2');
$result = [];

foreach ($query as $key => $user) {
  # code...
  $data = [
    'id' => $user['id'],
    'nip' => $user['nip'],
    'name' => $user['name'],
    'phone' => $user['phone'],
    'email' => $user['email'],
    'status' => $user['status'],
    'createdAt' => $user['createdAt'],
    'roleID' => $user['roleID'],
    'roleName' => $user['roleName'],
    'schoolID' => $user['schoolID'],
    'schoolName' => $user['schoolName']
  ];

  array_push($result, $data);
}

echo response('success', $result);
