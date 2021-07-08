<?php
    require('../config/connection.php');
    require('api/check_shop.php');

    $page_name = "บัตรสะสมแต้ม";

    if (isset($_POST['user_card'])) {
        $id = $_POST['user_card'];
    } else {
        header('location: index.php');
    }

    $query  = "SELECT * FROM tbl_user_card WHERE uc_id = ".$id;
    $result = mysqli_query($conn, $query) or die(mysql_error());
    $row    = $result->fetch_assoc();

    $user_id = $row['uc_user_id'];

    $point = 100;
    $curr_point = $row['uc_point'];
    $new_point = $curr_point - $point;

    $query = "INSERT INTO tbl_award (w_user_card, w_point, w_date, w_time)
             VALUES ('$id', '$point', '".date('Y-m-d')."', '".date('H:i:s')."')";
    $result   = mysqli_query($conn, $query);
    
    if ($result) {

        $query    = "UPDATE tbl_user_card SET uc_point = '".$new_point."' WHERE uc_id = ".$id;
        $result   = mysqli_query($conn, $query);

        echo "<script>window.location.replace('award-success.php');</script>";
    } else {
        echo "<script>alert('มีข้อผิดพลาดกรุณาลองใหม่'); window.location.replace('index.php');</script>";
    }
?>