<?php

require '../../helpers/config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email        = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "";
  $phone        = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : "";
  $old_password        = isset($_POST['old_password']) ? htmlspecialchars(md5($_POST['old_password'])) : "";
  $new_password        = isset($_POST['new_password']) ? htmlspecialchars(md5($_POST['new_password'])) : "";
  $confirm_password        = isset($_POST['confirm_password']) ? htmlspecialchars(md5($_POST['confirm_password'])) : "";

  try {
    //code...
    $cek_user        = $connection->query("SELECT * FROM users WHERE email='$email' && phone='$phone'&& password = '$old_password'");
    $cek_user_result = $cek_user->fetch_array();

    $connection->begin_transaction();

    if (!$cek_user_result) {
      echo response('error', 'Maaf, password lama Anda tidak sesuai.');
    } else {
      if ($new_password != $confirm_password) {
        echo response('error', 'Maaf, konfirmasi password baru tidak sesuai.');
      } else {
        $connection->query("UPDATE users SET password='$new_password' WHERE phone='$phone'");

        $connection->commit();
        echo response('success', 'Password berhasil disimpan, silahkan login dengan password baru.');
      }
    }
  } catch (\Throwable $th) {
    //throw $th;
    echo response('error', $th->getMessage());
  }
} else {
  echo response('error', 'The method was not found');
}
