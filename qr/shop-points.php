<?php
    require('../config/connection.php');
    require('../api/check_user.php');

    $page_name = "บัตรสะสมแต้ม";

    if (isset($_GET['qr'])) {
        $qr = $_GET['qr'];

        $query  = "SELECT * FROM tbl_point_qr WHERE pq_qr = '".$qr."'";
        $result = mysqli_query($conn, $query) or die(mysql_error());
        $row    = $result->fetch_assoc();

        if (mysqli_num_rows($result) > 0) {
            if ($row['pq_status'] == 2) {
                echo "<script>alert('QR Code นี้ถูกใช้ไปแล้ว');window.location.replace('../index.php');</script>";
                exit();
            } else {
                $query_uc  = "SELECT * FROM tbl_user_card WHERE uc_user_id = ".$uc_row['u_id']." AND uc_shop_id = ".$row['pq_shop_id'];
                $result_uc = mysqli_query($conn, $query_uc) or die(mysql_error());

                if (mysqli_num_rows($result_uc) > 0) {
                    $row_uc    = $result_uc->fetch_assoc();

                    $curr_point = $row_uc['uc_point'];
                    $point = $curr_point + $row['pq_point'];

                    $query    = "UPDATE tbl_user_card SET uc_point = '".$point."' WHERE uc_id = ".$row_uc['uc_id'];
                    $result   = mysqli_query($conn, $query);

                    if ($result) {
                        $query    = "UPDATE tbl_point_qr SET pq_status = '2' WHERE pq_id = ".$row['pq_id'];
                        $result   = mysqli_query($conn, $query);

                        $query    = "INSERT INTO tbl_point (p_from, p_receive, p_pay, p_point, p_type, p_date, p_time) VALUES ('".$row['pq_shop_id']."', '".$row_uc['uc_id']."', '".$row['pq_pay']."', '".$row['pq_point']."', '1', '".date('Y-m-d')."', '".date('H:i:s')."')";
                        $result   = mysqli_query($conn, $query);
                        $last_id = mysqli_insert_id($conn);

                        header('location: ../points-success.php?id='.$last_id);
                    } else {
                        echo "<script>alert('มีข้อผิดพลาดกรุณาลองใหม่'); window.location.replace('points.php');</script>";
                        exit();
                    }
                }
            }
        } else {
            echo "<script>alert('ไม่พบข้อมูล QR Code นี้');window.location.replace('../index.php');</script>";
            exit();
        }
    } else {
        header('location: ../index.php');
    }
?>