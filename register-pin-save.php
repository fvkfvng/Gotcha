<?php
    require('config/connection.php');
    require('api/check_user.php');

    $page_name = "ลงทะเบียนสำหรับลูกค้า";

    if (isset($_GET['p'])) {
        $pin        = stripslashes($_GET['p']); // removes backslashes
        $pin        = mysqli_real_escape_string($conn, $pin); //escapes special characters in a string

        $query    = "UPDATE tbl_user SET u_pin = '".$pin."' WHERE u_id = ".$uc_row['u_id'];
        $result   = mysqli_query($conn, $query);

        if ($result) {
            echo "<script>window.location.replace('index.php');</script>";
        } else {
            echo "<script>alert('มีข้อผิดพลาดกรุณาลองใหม่'); window.location.replace('register-pin.php');</script>";
        }
    }
?>