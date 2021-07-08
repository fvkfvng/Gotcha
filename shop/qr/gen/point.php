<?php
    require('../../../config/connection.php');
    require('../../api/check_shop.php');

    $page_name = "บัตรสะสมแต้ม";

    if (!isset($_GET['p'])) {
        header('location: index.php');
    }

    $pay = $_GET['t'];
    $point = $_GET['p'];
    $qrcode = md5(rand());

    // insert to point qr
    $query    = "INSERT INTO tbl_point_qr (pq_qr, pq_shop_id, pq_pay, pq_point, pq_date, pq_time) VALUES ('".$qrcode."', '".$row_shop_ap['s_id']."', '".$pay."', '".$point."', '".date('Y-m-d')."', '".date('H:i:s')."')";
    $result   = mysqli_query($conn, $query);
    $last_id = mysqli_insert_id($conn);

    $query  = "SELECT * FROM tbl_point_qr WHERE pq_id = '".$last_id."'";
    $result = mysqli_query($conn, $query) or die(mysql_error());
    $row    = $result->fetch_assoc();

    header('location: ../../points-qr.php?qr='.$qrcode)
?>