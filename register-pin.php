<?php
    require('config/connection.php');
    
    if(!isset($_SESSION['uline_token']) && !isset($_SESSION['uline_user'])){    
        header('location: login.php');
        exit;
    } else {
        $uc_line = json_decode($_SESSION['uline_user'], true);
        $uc_line_id = $uc_line['sub'];

        // check shop register
        $uc_query    = "SELECT * FROM tbl_user WHERE u_line_user = '".$uc_line_id."'";
        $uc_result = mysqli_query($conn, $uc_query) or die(mysql_error());
        $uc_row = mysqli_fetch_assoc($uc_result);

        if (mysqli_num_rows($uc_result) < 1) {
            header('location: register.php');
        } else {
            if ($uc_row['u_pin'] != null || $uc_row['u_pin'] != '') {
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
        <div id="registerpin"></div><br>
        <p style="color: red">
            โปรดจำรหัสผ่านของท่านให้ดี เพื่อป้องกันการลืมรหัสผ่าน
            <br>ขออภัยในความไม่สะดวก...ระบบจะพัฒนาให้มีประสิทธิภาพในอนาคต</p>
    </div>
    <div id="registerpinretype-block" class="registerpin">
        <p>ยืนยันรหัส PIN 6 หลัก</p>
        <div id="registerpinretype"></div>
    </div>

<?php include 'include/footer.php'; ?>