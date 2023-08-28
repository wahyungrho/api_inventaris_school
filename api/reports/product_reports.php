<?php

require '../../helpers/config.php';
require '../../helpers/query_function.php';

try {
    //code...
    $query_all_product = $connection->query("SELECT SUM(stock) as product_existing FROM products WHERE status = 'AKTIF'");

    $query_product_borrow = $connection->query("SELECT SUM(quantity) as product_borrow FROM orders WHERE statusID = 2 OR statusID = 1");

    $arr_query_report_product_borrow = arr_report_product_borrow($connection, '5');

    $arr_query_report_users_borrow = arr_report_users_borrow($connection, '5');


    $result_all_product = $query_all_product->fetch_assoc();

    $result_borrow_product = $query_product_borrow->fetch_assoc();

    $product_existing = (int)$result_all_product['product_existing'];

    $product_borrow = (int)$result_borrow_product['product_borrow'];

    $product_all = $product_existing + $product_borrow;

    echo response('success', [
        'product_all' => $product_all ?? 0,
        'product_borrow' => $product_borrow ?? 0,
        'product_existing' => $product_existing ?? 0,
        'report_data_product' => $arr_query_report_product_borrow,
        'report_users_borrow' => $arr_query_report_users_borrow
    ]);
} catch (\Throwable $th) {
    //throw $th;
    echo response('error', $th->getMessage());
}
