<?php
    require('../config/connection.php');
    require('api/check_shop.php');

    $page_name = "บัตรสะสมแต้ม";

    if (isset($_POST['package'])) {
        $package = $_POST['package'];

        $query = "INSERT INTO tbl_package (pk_shop_id, pk_package, pk_date, pk_time) VALUES ('".$row_shop_ap['s_id']."', '$package', '".date('Y-m-d')."', '".date('H:i:s')."')";
        $result   = mysqli_query($conn, $query);
    }
?>

<?php include 'include/header.php'; ?>
    
    <div class="main-container">
        <h1 class="site-title">GOTCHA!</h1>
        <div class="message-box">
            <img src="../images/check.png">
            <div class="message-header message-success">ทำรายการสำเร็จ!</div>
            <div class="message-detail">
                คุณได้สั่งซื้อแพ็คเกจแล้ว เมื่อทำการชำระเงินแล้วสามารถแจ้งได้ที่หน้าแจ้งชำระเงิน
            </div>
        </div>
        <a href="payment.php" class="btn btn-primary">
            แจ้งชำระเงิน
        </a>
    </div>

<?php include 'include/footer.php'; ?>