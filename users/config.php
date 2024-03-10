<?php

$host = "localhost";
$username = "root";
$password = "root";
$db_name = "db_inventaris_school";
$connection = mysqli_connect($host, $username, $password, $db_name);

if (!$connection) {
  # code...
  echo "Connection Failed";
}

header('Content-Type: application/json; charset=utf-8');
