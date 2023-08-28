<?php

require '../../helpers/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  # code... 
  $categoryID       = isset($_POST['categoryID']) ? htmlspecialchars($_POST['categoryID']) : "";
  $codeProduct      = isset($_POST['codeProduct']) ? htmlspecialchars($_POST['codeProduct']) : "";
  $name             = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : "";
  $description      = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : "";
  $stock            = isset($_POST['stock']) ? htmlspecialchars($_POST['stock']) : "";

  // namefile image frome File image name
  $image            = date('dmYHis') . "_" . str_replace(" ", "_", $name) . "." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

  $mime_type = mime_content_type($_FILES['image']['tmp_name']);
  // If you want to allow certain files
  $allowed_file_types = ['image/png', 'image/jpeg'];

  if (in_array($mime_type, $allowed_file_types)) {
    # code...
    // move image to path
    $imagePath        = '../../assets/' . $image;
    move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);

    try {
      //code...
      $connection->begin_transaction();
      $insert = $connection->query("INSERT INTO products (categoryID, codeProduct, name, image, description, stock, status, createdAt) VALUES ('$categoryID', '$codeProduct', '$name', '$image', '$description', '$stock', 'AKTIF', NOW())");

      if (!$connection->error) {
        # code...
        $connection->commit();
        echo response('success', 'Barang Invetaris berhasil ditambahkan');
      } else {
        $connection->rollback();
        echo response('error', $connection->error);
      }
    } catch (\Throwable $th) {
      //throw $th;
      $connection->rollback();
      echo response('error', $th->getMessage());
    }
  } else {
    echo response('error', 'Error uploading image file type not supported');
  }
} else {
  echo response('error', 'The method was not found');
}
