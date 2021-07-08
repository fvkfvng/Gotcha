<?php
    require('../config/connection.php');
    require('api/check_shop.php');

    if (isset($_POST['award_id'])) {
        $award_id = $_POST['award_id'];

        $query    = "UPDATE tbl_award SET w_status = '2' WHERE w_id = ".$award_id;
        $result   = mysqli_query($conn, $query);
    } else {
        echo "<script>alert('มีข้อผิดพลาด กรุณาลองใหม่');window.location.replace('../index.php');</script>";
        exit();
    }

    $page_name = "บัตรสะสมแต้ม";
?>

<?php include 'include/header.php'; ?>
    
    <div class="main-container">
        <h1 class="site-title">GOTCHA!</h1>
        
        <div class="icon-box">
            <img src="../images/gift.png">
            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
            <img src="../images/user.png">
        </div>
        
        <div class="message-box">
            <div class="message-header message-success">ทำรายการสำเร็จ!</div>
            <div class="message-detail">
                ขอบคุณที่ไว้วางใจใช้งานระบบสะสมแแต้ม<br>
                ระบบได้ทำการเก็บข้อมูลการมอบของรางวัลให้คุณแล้ว<br>
                สามารถดูได้ที่เมนู “ดูรายงานผลร้านฉัน”<br>
                ขอบคุณครับ
            </div>
        </div>

        <a href="index.php" class="btn btn-primary">
            หน้าแรก
        </a>
    </div>

<?php include 'include/footer.php'; ?>