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
