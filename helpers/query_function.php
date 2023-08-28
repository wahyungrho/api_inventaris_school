<?php

function user_detail($connection, $id)
{
    try {
        //code...
        $query = $connection->query("SELECT users.*, roles.name as roleName, school.name  as schoolName FROM users LEFT JOIN roles ON users.roleID = roles.id LEFT JOIN school ON users.schoolID = school.id  WHERE users.id = '$id'");

        return $query;
    } catch (\Throwable $th) {
        //throw $th;
        throw new Exception("Error Processing Request", 1);
    }
}

function arr_report_product_borrow($connection, $limit = '')
{
    try {
        //code...
        if ($limit != '') {
            $query_report_product_borrow_list = $connection->query("SELECT products.id as product_id, orders.id as order_id, products.codeProduct, products.name, SUM(orders.quantity) as total FROM orders LEFT JOIN products ON orders.productID = products.id WHERE orders.statusID = 1 OR orders.statusID = 2 GROUP BY orders.productID ORDER BY total DESC LIMIT $limit");
        } else {
            $query_report_product_borrow_list = $connection->query("SELECT products.id as product_id, orders.id as order_id, products.codeProduct, products.name, SUM(orders.quantity) as total FROM orders LEFT JOIN products ON orders.productID = products.id WHERE orders.statusID = 1 OR orders.statusID = 2 GROUP BY orders.productID ORDER BY total DESC");
        }


        $arr_query_report_product_borrow = [];

        foreach ($query_report_product_borrow_list as $key => $value) {
            # code...
            array_push($arr_query_report_product_borrow, $value);
        }

        return $arr_query_report_product_borrow;
    } catch (\Throwable $th) {
        //throw $th;
        throw new Exception("Error Processing Request", 1);
    }
}


function arr_report_users_borrow($connection, $limit = '')
{
    try {
        //code...
        if ($limit != '') {
            $query_report_users_borrow_list = $connection->query("SELECT users.id as user_id , orders.id as order_id , users.name, school.name as schoolName, SUM(orders.quantity) as total FROM orders LEFT JOIN users ON orders.userID = users.id LEFT JOIN school ON users.schoolID = school.id WHERE orders.statusID = 1 OR orders.statusID = 2 GROUP BY users.id ORDER BY total DESC LIMIT $limit");
        } else {
            $query_report_users_borrow_list = $connection->query("SELECT users.id as user_id , orders.id as order_id , users.name, school.name as schoolName, SUM(orders.quantity) as total FROM orders LEFT JOIN users ON orders.userID = users.id LEFT JOIN school ON users.schoolID = school.id WHERE orders.statusID = 1 OR orders.statusID = 2 GROUP BY users.id ORDER BY total DESC");
        }


        $arr_query_report_users_borrow = [];

        foreach ($query_report_users_borrow_list as $key => $value) {
            # code...
            array_push($arr_query_report_users_borrow, $value);
        }

        return $arr_query_report_users_borrow;
    } catch (\Throwable $th) {
        //throw $th;
        throw new Exception("Error Processing Request", 1);
    }
}
