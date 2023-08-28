<?php

require '../../helpers/config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email        = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "";
  $phone        = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : "";
  $cek_user     = $connection->query("SELECT * FROM users WHERE phone = '$phone' && email = '$email'");
  $cek_user_result = $cek_user->fetch_array();

  if ($cek_user_result) {
    # code...
    echo response('success', 'Akun ditemkan, mohon untuk masukkan password baru Anda.');
  } else {
    echo response('error', 'Maaf data tidak ditemukan, mohon periksa kembali email dan nomor telepon Anda.');
  }
} else {
  echo response('error', 'The method was not found');
}
