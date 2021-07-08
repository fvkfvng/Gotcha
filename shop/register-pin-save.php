<?php
    require('../config/connection.php');
    require('api/check_shop.php');

    $page_name = "ลงทะเบียนสำหรับลูกค้า";

    if (isset($_GET['p'])) {
        $pin        = stripslashes($_GET['p']); // removes backslashes
        $pin        = mysqli_real_escape_string($conn, $pin); //escapes special characters in a string

        $query    = "UPDATE tbl_shop SET s_pin = '".$pin."' WHERE s_id = ".$row_shop_ap['s_id'];
        $result   = mysqli_query($conn, $query);

        if ($result) {
            echo "<script>window.location.replace('index.php');</script>";
        } else {
            echo "<script>alert('มีข้อผิดพลาดกรุณาลองใหม่'); window.location.replace('register-pin.php');</script>";
        }
    }
?>