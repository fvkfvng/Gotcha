<?php
    require('../../config/connection.php');
    require('../../api/check_user.php');

    $page_name = "บัตรสะสมแต้ม";

    if (!isset($_POST['card_id'])) {
        header('location: index.php');
    }

    $card_id = $_POST['card_id'];
    $qrcode = md5($card_id.rand());
    $point = '100';

    $curr_date = date('Y-m-d');
    $curr_time = date('H:i:s');

    $new_date = date('Y-m-d', strtotime($curr_date.' '.$curr_time." +30 minutes"));
    $new_time = date('H:i:s', strtotime($curr_time." +30 minutes"));

    $query_point  = "SELECT * FROM tbl_user_card WHERE uc_id = '".$card_id."'";
    $result_point = mysqli_query($conn, $query_point) or die(mysql_error());
    $row_point    = $result_point->fetch_assoc();

    // update card point
    $curr_point = $row_point['uc_point'];
    $p = $curr_point - $point;
    
    $query    = "UPDATE tbl_user_card SET uc_point = '".$p."' WHERE uc_id = ".$card_id;
    $result   = mysqli_query($conn, $query);

    // insert to award
    $query    = "INSERT INTO tbl_award (w_qr, w_user_card, w_shop, w_point, w_date, w_time, w_edate, w_etime) VALUES ('".$qrcode."', '".$card_id."', '".$row_point['uc_shop_id']."', '".$point."', '".$curr_date."', '".$curr_time."', '".$new_date."', '".$new_time."')";
    $result   = mysqli_query($conn, $query);
    $last_id = mysqli_insert_id($conn);

    $query  = "SELECT * FROM tbl_award WHERE w_id = '".$last_id."'";
    $result = mysqli_query($conn, $query) or die(mysql_error());
    $row    = $result->fetch_assoc();

    header('location: ../../award-qr.php?qr='.$qrcode);
?>