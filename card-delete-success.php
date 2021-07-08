<?php
    require('config/connection.php');
    require('api/check_user.php');

    $page_name = "บัตรสะสมแต้ม";
?>

<?php include 'include/header.php'; ?>
    
    <div class="main-container">
        <h1 class="site-title">GOTCHA!</h1>
        <?php if (isset($_GET['success'])) { ?>
            <div class="message-box">
                <img src="images/check.png">
                <div class="message-header message-success">ทำรายการสำเร็จ!</div>
                <div class="message-detail">
                    คุณได้ทำการลบบัตรสะสมคะแนน<br>
                    หากคุณต้องการสะสมคะแนนกับร้านเดิมอีกครั้ง<br>
                    สามารถทำตามขั้นตอนการรับบัตรสะสมแต้มได้ปกติ
                </div>
            </div>
        <?php } else { ?>
            <div class="message-box">
                <img src="images/check.png">
                <div class="message-header message-danger">ทำรายการไม่สำเร็จ!</div>
                <div class="message-detail">
                    คุณไม่สามารถลบรายการนี้ได้<br>
                    โปรดตรวจสอบสัญญาณอินเตอร์เน็ต หรือ WIFI<br>
                    หากพบว่าไม่ใช่ปัญหาดังกล่าวโปรดติดต่อเรา<br>
                    022-222-222
                </div>
            </div>
        <?php } ?>
        <a href="index.php" class="btn btn-primary">
            หน้าแรก
        </a>
    </div>

<?php include 'include/footer.php'; ?>