<?php
    require('../../config/connection.php');
    require('../api/check_shop.php');

    $page_name = "บัตรสะสมแต้ม";

    if (isset($_GET['qr'])) {
        $qr = $_GET['qr'];

        $query  = "SELECT * FROM tbl_award WHERE w_qr = '".$qr."'";
        $result = mysqli_query($conn, $query) or die(mysql_error());
        $row    = $result->fetch_assoc();

        if (mysqli_num_rows($result) > 0) {
            $curr_time = date('Y-m-d H:i:s');
            $new_time = $row['w_edate'].' '.$row['w_etime'];

            if ($row['w_status'] == 2) {
                echo "<script>alert('QR Code นี้ถูกใช้ไปแล้ว');window.location.replace('../qrscan.php');</script>";
                exit();
            } elseif ($curr_time > $new_time) {
                echo "<script>alert('QR Code นี้หมดเวลา');window.location.replace('../qrscan.php');</script>";
                exit();
            } else {
                header('location: ../award.php?id='.$row['w_id']);
            }
        } else {
            echo "<script>alert('ไม่พบข้อมูล QR Code นี้');window.location.replace('qrscan.php');</script>";
            exit();
        }
    } else {
        header('location: ../index.php');
    }
?>