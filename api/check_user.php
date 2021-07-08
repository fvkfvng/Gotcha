<?php
    if(!isset($_SESSION['uline_token']) && !isset($_SESSION['uline_user'])){    
        header('location: login.php');
        exit;
    } else {
        $uc_line = json_decode($_SESSION['uline_user'], true);
        $uc_line_id = $uc_line['sub'];
        $uc_picture = $uc_line['picture'];

        // check shop register
        $uc_query    = "SELECT * FROM tbl_user WHERE u_line_user = '".$uc_line_id."'";
        $uc_result = mysqli_query($conn, $uc_query) or die(mysql_error());
        $uc_row = mysqli_fetch_assoc($uc_result);

        if (mysqli_num_rows($uc_result) < 1) {
            header('location: register.php');
        } else {
            if ($uc_row['u_pin'] == null || $uc_row['u_pin'] == '') {
                header('location: register-pin.php');
            }
        }
    }
?>