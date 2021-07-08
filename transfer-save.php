<?php
    require('config/connection.php');
    require('api/check_user.php');

    $page_name = "ลงทะเบียนสำหรับลูกค้า";

    if (isset($_POST['user_id'])) {
        $card_id = $_POST['user_id'];
        $card_transfer_id = $_POST['user_transfer_id'];
        $point = $_POST['user_point'];

        $query_ucard  = "SELECT * FROM tbl_user_card WHERE uc_id = '".$card_id."'";
        $result_ucard = mysqli_query($conn, $query_ucard) or die(mysql_error());
        $row_ucard    = $result_ucard->fetch_assoc();

        $query_trcard  = "SELECT * FROM tbl_user_card WHERE uc_id = '".$card_transfer_id."'";
        $result_trcard = mysqli_query($conn, $query_trcard) or die(mysql_error());
        $row_trcard    = $result_trcard->fetch_assoc();

        if (mysqli_num_rows($result_trcard) < 1) {
            echo "<script>alert('ผู้รับไม่มีบัตรสะสมแต้มของร้านนี้'); window.location.replace('transfer.php');</script>";
            exit();
        }

        // for user from
        $curr_point = $row_ucard['uc_point'];
        $new_point = $curr_point - $point;

        $query    = "UPDATE tbl_user_card SET uc_point = '".$new_point."' WHERE uc_id = ".$card_id;
        $result   = mysqli_query($conn, $query);

        // user transfer
        $curr_point_tr = $row_trcard['uc_point'];
        $new_point_tr = $curr_point_tr + $point;

        $query    = "UPDATE tbl_user_card SET uc_point = '".$new_point_tr."' WHERE uc_id = ".$card_transfer_id;
        $result   = mysqli_query($conn, $query);
        
        if ($result) {
            $query    = "INSERT INTO tbl_point (p_from, p_receive, p_point, p_type, p_date, p_time) VALUES ('".$card_id."', '".$card_transfer_id."', '".$point."', '2', '".date('Y-m-d')."', '".date('H:i:s')."')";
            $result   = mysqli_query($conn, $query);
            $last_id = mysqli_insert_id($conn);

            echo "<script>window.location.replace('transfer-success.php?id=".$last_id."');</script>";
        } else {
            echo "<script>alert('มีข้อผิดพลาดกรุณาลองใหม่'); window.location.replace('transfer.php');</script>";
        }
    } else {
        header('location: transfer.php');
    }
?>