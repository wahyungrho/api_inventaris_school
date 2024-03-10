<?php

function user_detail($connection, $id)
{
    try {
        //code...
        $query = $connection->query("SELECT users.*, roles.name as roleName, staff.npsn, student.nisn, class.name as className FROM users LEFT JOIN roles ON users.role_id = roles.id LEFT JOIN staff ON users.id = staff.user_id LEFT JOIN student ON users.id = student.user_id LEFT JOIN class ON student.class_id = class.id  WHERE users.id = '$id'");

        return $query;
    } catch (\Throwable $th) {
        //throw $th;
        throw new Exception($th->getMessage(), 1);
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
        throw new Exception($th->getMessage(), 1);
    }
}


function arr_report_users_borrow($connection, $limit = '')
{
    try {
        //code...
        if ($limit != '') {
            $query_report_users_borrow_list = $connection->query("SELECT users.id as user_id , orders.id as order_id , users.name, a.name as className, SUM(orders.quantity) as total FROM orders LEFT JOIN users ON orders.userID = users.id LEFT JOIN student ON users.id = student.user_id LEFT JOIN class a ON a.id = student.class_id WHERE orders.statusID = 1 OR orders.statusID = 2 GROUP BY users.id ORDER BY total DESC LIMIT $limit");
        } else {
            $query_report_users_borrow_list = $connection->query("SELECT users.id as user_id , orders.id as order_id , users.name, a.name as className, SUM(orders.quantity) as total FROM orders LEFT JOIN users ON orders.userID = users.id LEFT JOIN student ON users.id = student.user_id LEFT JOIN class a ON a.id = student.class_id WHERE orders.statusID = 1 OR orders.statusID = 2 GROUP BY users.id ORDER BY total DESC");
        }


        $arr_query_report_users_borrow = [];

        foreach ($query_report_users_borrow_list as $key => $value) {
            # code...
            array_push($arr_query_report_users_borrow, $value);
        }

        return $arr_query_report_users_borrow;
    } catch (\Throwable $th) {
        //throw $th;
        throw new Exception($th->getMessage(), 1);
    }
}

function get_role_name($connection, $userID)
{
    $roleName           = '';

    $users            = $connection->query("SELECT roles.name FROM roles LEFT JOIN users ON users.role_id = roles.id WHERE users.id = '$userID'");
    if ($users->num_rows > 0) {
        $user           = $users->fetch_assoc();
        $roleName        = $user['name'];
    }

    return $roleName;
}
