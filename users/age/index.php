<?php

header('Content-Type: application/json; charset=utf-8');
require '../config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents("php://input"));
  $firstName = $data->namaDepan;
  $lastName = $data->namaBelakang;
  $tglLahir = $data->tanggalLahir;
  // $date = date('Y-m-d H:i:s', time());
  // echo $date;

  $tglLahirFormat = strtotime($tglLahir);

  $today = new DateTime('today');
  $birthFormat = date('Y-m-d', $tglLahirFormat);
  $dateFormat = date('d-m-Y', $tglLahirFormat);
  $birthDay = new DateTime($birthFormat);

  $namaLengkap = $firstName . ' ' . $lastName;
  $umur = $today->diff($birthDay)->y . ' Tahun';
  $tanggalLahir = $dateFormat;

  $response = [
    'namaLengkap' => $namaLengkap,
    'tanggalLahir' => $tanggalLahir,
    'umur' => $umur
  ];

  echo json_encode($response);
} else {
  $response = [
    'status' => 'error',
    'message' => 'Invalid method request'
  ];
  echo json_encode($response);
}
