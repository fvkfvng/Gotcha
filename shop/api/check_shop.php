<?php
    if(!isset($_SESSION['line_token']) && !isset($_SESSION['line_user'])){
        header('location: login.php');
        exit;
    } else {
        $shop_ap_user = json_decode($_SESSION['line_user'],true);
        $shop_ap_id = $shop_ap_user['sub'];
        $shop_ap_picture = $shop_ap_user['picture'];

        $query_shop_ap    = "SELECT * FROM tbl_shop WHERE s_line_user = '".$shop_ap_id."'";
        $result_shop_ap = mysqli_query($conn, $query_shop_ap) or die(mysql_error());
        $row_shop_ap = mysqli_fetch_assoc($result_shop_ap);

        if ($row_shop_ap['s_pro'] == 1) {
            $shop_pro_ap = 'Begin';
        } else if ($row_shop_ap['s_pro'] == 2) {
            $shop_pro_ap = 'Premium';
        } else if ($row_shop_ap['s_pro'] == 3) {
            $shop_pro_ap = 'Premium Plus';
        }

        if ($row_shop_ap['s_card_style'] == 2) {
            $s_card_style = 'background-image: url(../images/card/2.png)';
        } elseif ($row_shop_ap['s_card_style'] == 3) {
            $s_card_style = 'background-image: url(../images/card/3.jpg)';
        } elseif ($row_shop_ap['s_card_style'] == 4) {
            $s_card_style = 'background-image: url(../images/card/4.jpg)';
        } else {
            $s_card_style = 'background-image: url(../images/card/1.jpg)';
        }

        if (mysqli_num_rows($result_shop_ap) < 1 || $row_shop_ap['s_status'] != 2) {
            header('location: register.php');
            exit;
        } else {
            if ($row_shop_ap['s_pin'] == null || $row_shop_ap['s_pin'] == '') {
                header('location: register-pin.php');
            }
        }
    }
?>