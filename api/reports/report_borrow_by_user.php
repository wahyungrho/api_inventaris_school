<?php

require '../../helpers/config.php';
require '../../helpers/query_function.php';

try {
    //code...
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    if ($id != '') {
        $query = user_detail($connection, $id);

        $query_product_borrow = $connection->query("SELECT orders.id orderID, orders.userID, orders.quantity, products.id productID, products.codeProduct, products.name productName, products.image, category.name categoryName, status.status FROM `orders` LEFT JOIN `products` ON orders.productID = products.id LEFT JOIN category ON products.categoryID = category.id LEFT JOIN status ON orders.statusID = status.id WHERE orders.statusID = 1 OR orders.statusID = 2 AND orders.userID = '$id'");

        $arr_query_product_borrow = [];

        foreach ($query_product_borrow as $key => $value) {
            # code...
            array_push($arr_query_product_borrow, $value);
        }

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
                'schoolName' => $user['schoolName'],
                'data_product' => $arr_query_product_borrow
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
