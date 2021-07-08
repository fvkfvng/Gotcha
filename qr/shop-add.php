<?php
    require('../config/connection.php');
    require('../api/check_user.php');

    $page_name = "บัตรสะสมแต้ม";

    if (isset($_GET['shop'])) {
        $sid = $_GET['shop'];

        $query  = "SELECT * FROM tbl_user_card WHERE uc_user_id = ".$uc_row['u_id']." AND uc_shop_id = ".$sid;
        $result = mysqli_query($conn, $query) or die(mysql_error());

        if (mysqli_num_rows($result) <= 0) {
            $query = "INSERT INTO tbl_user_card (uc_user_id, uc_shop_id)
             VALUES ('".$uc_row['u_id']."', '$sid')";
            $result   = mysqli_query($conn, $query);
            $last_id = mysqli_insert_id($conn);
        }

        header('location: ../index.php');
    } else {
    	header('location: ../index.php');
    }
?>