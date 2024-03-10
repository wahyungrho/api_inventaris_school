<?php

require '../../helpers/config.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username        = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : "";
  $password        = isset($_POST['password']) ? md5($_POST['password']) : "";

  $cek_user        = $connection->query("SELECT * FROM users WHERE phone = '$username' || email = '$username'");
  $cek_user_result = $cek_user->fetch_array();

  if ($cek_user_result) {
    # code...
    $id = $cek_user_result['id'];
    $login         = $connection->query("SELECT users.*, roles.name as roleName FROM users LEFT JOIN roles ON users.role_id = roles.id  WHERE users.id = '$id' && password = '$password'");

    if ($login->num_rows > 0) {
      # code...
      $user = $login->fetch_assoc();
      echo response('success', [
        'id' => $user['id'],
        'name' => $user['name'],
        'phone' => $user['phone'],
        'email' => $user['email'],
        'status' => $user['status'],
        'createdAt' => $user['createdAt'],
        'roleID' => $user['role_id'],
        'roleName' => $user['roleName']
      ]);
    } else {
      echo response('error', 'Maaf, Mohon periksa kembali password anda');
    }
  } else {
    echo response('error', 'Akun belum terdaftar, silahkan lakukan pendaftaran');
  }
} else {
  echo response('error', 'The method was not found');
}
