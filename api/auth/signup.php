<?php

require '../../helpers/config.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nip = isset($_POST['nip']) ? htmlspecialchars($_POST['nip']) : "";
  $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : "";
  $phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : "";
  $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "";
  $password = isset($_POST['password']) ? md5($_POST['password']) : "";
  $school = isset($_POST['school']) ? (int)htmlspecialchars($_POST['school']) : "";

  $cek_user        = $connection->query("SELECT * FROM users WHERE phone='$phone' || email='$email'");
  $cek_user_result = $cek_user->fetch_array();

  if ($cek_user_result) {
    # code...
    echo response('error', 'Maaf, akun tersebut sudah terdaftar');
  } else {
    try {
      //code...
      $connection->begin_transaction();
      $insert         = $connection->query("INSERT INTO users (nip, name, phone, email, password, status, createdAt, roleID, schoolID)  VALUE('$nip', '$name', '$phone', '$email', '$password', 'AKTIF', NOW(), 2, $school)");
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
