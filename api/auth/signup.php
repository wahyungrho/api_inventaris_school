<?php

require '../../helpers/config.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nip = isset($_POST['nip']) ? htmlspecialchars($_POST['nip']) : "";
  $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : "";
  $phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : "";
  $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "";
  $password = isset($_POST['password']) ? md5($_POST['password']) : "";
  $class = isset($_POST['class']) ? (int)htmlspecialchars($_POST['class']) : "";
  $index = isset($_POST['index']) ? (int)htmlspecialchars($_POST['index']) : "";
  $role_id = $index == 0 || $index == '0' ? 2 : 3;

  $cek_user        = $connection->query("SELECT * FROM users WHERE phone='$phone' || email='$email'");
  $cek_user_result = $cek_user->fetch_array();

  if ($cek_user_result) {
    # code...
    echo response('error', 'Maaf, akun tersebut sudah terdaftar');
  } else {
    try {
      //code...
      $connection->begin_transaction();
      $insert         = $connection->query("INSERT INTO users (name, phone, email, password, status, createdAt, role_id)  VALUE( '$name', '$phone', '$email', '$password', 'AKTIF', NOW(), $role_id)");

      $last_id = $connection->insert_id;

      if ($index == 0 || $index == '0') {
        $connection->query("INSERT INTO staff (user_id, npsn) VALUES ($last_id, '$nip')");
      }

      if ($index == 1 || $index == '1') {
        $connection->query("INSERT INTO student (user_id, nisn, class_id) VALUES ($last_id, '$nip', '$class')");
      }

      $connection->commit();
      echo response('success', 'Registrasi berhasil, silahkan login');
    } catch (\Throwable $th) {
      //throw $th;
      $connection->rollback();

      echo response('error', $th->getMessage());
    }
  }
} else {
  echo response('error', 'The method was not found');
}
