<?php
    require('../config/connection.php');
    require('api/check_shop.php');

    $page_name = "บัตรสะสมแต้ม";

    if (isset($_SESSION['formPoint'])) {
        $card_id = $_SESSION['formPoint']['card_id'];
        $user_pay = $_SESSION['formPoint']['total'];
        $user_point = $_SESSION['formPoint']['user_point'];

        $query  = "SELECT * FROM tbl_user_card WHERE uc_id = '".$card_id."'";
        $result = mysqli_query($conn, $query) or die(mysql_error());
        $row    = $result->fetch_assoc();

        $curr_point = $row['uc_point'];
        $point = $curr_point + $user_point;

        if ($point > 100) {
            $point = 100;
        }
        
        $query    = "UPDATE tbl_user_card SET uc_point = '".$point."' WHERE uc_id = ".$card_id;
        $result   = mysqli_query($conn, $query);

        if ($result) {
            $query    = "INSERT INTO tbl_point (p_from, p_receive, p_pay, p_point, p_date, p_time) VALUES ('".$row_shop_ap['s_id']."', '".$card_id."', '$user_pay', '$user_point', '".date('Y-m-d')."', '".date('H:i:s')."')";
            $result   = mysqli_query($conn, $query);
            $last_id = mysqli_insert_id($conn);

            echo "<script>window.location.replace('points-success.php?id=".$last_id."');</script>";
        } else {
            echo "<script>alert('มีข้อผิดพลาดกรุณาลองใหม่'); window.location.replace('points.php');</script>";
        }
    }
?>