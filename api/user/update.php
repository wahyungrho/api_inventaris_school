<?php

require '../../helpers/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id               = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : "";
  $name             = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : "";
  $phone            = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : "";
  $email            = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "";
  $nip              = isset($_POST['nip']) ? htmlspecialchars($_POST['nip']) : "";

  $checkID = $connection->query("SELECT id, role_id FROM users WHERE id='$id'");
  $result  = $checkID->fetch_assoc();

  if ($checkID->num_rows > 0) {
    try {
      //code...
      $connection->begin_transaction();
      if ($result['role_id'] == '3' || $result['role_id'] == 3) {
        # code...
        $connection->query("UPDATE users SET name='$name', phone='$phone', email = '$email' WHERE id='$id'");
        $connection->query("UPDATE student SET nisn='$nip' WHERE user_id='$id'");
      } else {

        $connection->query("UPDATE users SET name='$name', phone='$phone', email = '$email' WHERE id='$id'");
        $connection->query("UPDATE staff SET npsn='$nip' WHERE user_id='$id'");
      }

      if (!$connection->error) {
        # code...
        $connection->commit();
        echo response('success', 'Data berhasil diubah');
      } else {
        # code...
        $connection->rollback();
        echo response('error', $connection->error);
      }
    } catch (\Throwable $th) {
      //throw $th;
      $connection->rollback();
      echo response('error', $th->getMessage());
    }
  } else {
    echo response('error', 'ID user tidak ditemukan');
  }
} else {
  echo response('error', 'The method was not found');
}
