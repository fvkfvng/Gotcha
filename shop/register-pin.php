<?php
    require('../config/connection.php');

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

        if (mysqli_num_rows($result_shop_ap) < 1 || $row_shop_ap['s_status'] != 2) {
            header('location: register.php');
            exit;
        } else {
            if ($row_shop_ap['s_pin'] != null || $row_shop_ap['s_pin'] != '') {
                header('location: index.php');
            }
        }
    }

    $page_name = "ลงทะเบียนสำหรับลูกค้า";
?>

<?php include 'include/header.php'; ?>

    <h1 class="site-title">GOTCHA!</h1>

    <div id="registerpin-block" class="registerpin">
        <p>ตั้งรหัส PIN 6 หลัก โดยรหัสนี้จะใช้ในการทำรายการต่างๆ</p>
        <div id="registerpin"></div>
    </div>
    <div id="registerpinretype-block" class="registerpin">
        <p>ยืนยันรหัส PIN 6 หลัก</p>
        <div id="registerpinretype"></div>
    </div>

<?php include 'include/footer.php'; ?>