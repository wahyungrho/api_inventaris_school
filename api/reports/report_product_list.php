<?php

require '../../helpers/config.php';
require '../../helpers/query_function.php';


try {
    //code...
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : '';

    $arr_query_report_product_borrow = arr_report_product_borrow($connection, $limit);

    echo response('success', $arr_query_report_product_borrow);
} catch (\Throwable $th) {
    //throw $th;
    echo response('error', $th->getMessage());
}
