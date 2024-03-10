<?php

require '../../helpers/config.php';
require '../../helpers/query_function.php';

try {
  //code...
  $id = isset($_GET['id']) ? $_GET['id'] : '';

  if ($id != '') {
    $query = user_detail($connection, $id);
    if ($query->num_rows > 0) {
      $user = $query->fetch_assoc();

      echo response('success', [
        'id' => $user['id'],
        'roleID' => $user['role_id'],
        'roleName' => $user['roleName'],
        'data' => [
          'npsn' => $user['npsn'],
          'nisn' => $user['nisn'],
          'name' => $user['name'],
          'phone' => $user['phone'],
          'email' => $user['email'],
          'status' => $user['status'],
          'createdAt' => $user['createdAt'],
          'className' => $user['className'],
        ]
      ]);
    } else {
      echo response('error', 'ID user tidak ditemukan');
    }
  } else {
    echo response('error', 'ID user tidak ditemukan');
  }
} catch (\Throwable $th) {
  //throw $th;
  echo response('error', $th->getMessage());
}
