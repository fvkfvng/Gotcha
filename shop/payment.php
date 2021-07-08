<?php
    require('../config/connection.php');
    require('api/check_shop.php');

    $page_name = "บัตรสะสมแต้ม";

    if (isset($_POST['btnSave'])) {
        $name       = stripslashes($_POST['name']); // removes backslashes
        $name       = mysqli_real_escape_string($conn, $name); //escapes special characters in a string
        $tel        = stripslashes($_POST['tel']);
        $tel        = mysqli_real_escape_string($conn, $tel);
        $package    = stripslashes($_POST['package']);
        $package    = mysqli_real_escape_string($conn, $package);
        $total      = stripslashes($_POST['total']);
        $total      = mysqli_real_escape_string($conn, $total);
        $note       = stripslashes($_POST['note']);
        $note       = mysqli_real_escape_string($conn, $note);

        $slip   = $_FILES['slip'];
        $filePath = '';

        if (isset($slip)) {
            $file      = $slip;
            $filePath  = '';
            $uploadDir = '../uploads/slip/';

            if (trim($file['tmp_name']) != '') {
                $ext = substr(strrchr($file['name'], "."), 1); 

                $filePath = md5(rand() * time()) . ".$ext";

                if (!move_uploaded_file($file['tmp_name'], $uploadDir . $filePath)) {
                    $filePath = '';
                }
            }
        }

        $query = "INSERT INTO tbl_payment (pm_shop_id, pm_name, pm_tel, pm_package, pm_total, pm_slip, pm_note, pm_date, pm_time)
                 VALUES ('".$row_shop_ap['s_id']."', '$name', '$tel', '$package', '$total', '$filePath', '$note', '".date('Y-m-d')."', '".date('H:i:s')."')";
        $result   = mysqli_query($conn, $query);
        
        if ($result) {
            echo "<script>window.location.replace('payment.php?success');</script>";
        } else {
            echo "<script>alert('มีข้อผิดพลาดกรุณาลองใหม่'); window.location.replace('payment.php');</script>";
        }
    }
?>

<?php include 'include/header.php'; ?>

    <h1 class="site-title">GOTCHA!</h1>
    <?php if (isset($_GET['success'])) { ?>
        <div id="page-success" class="form-container">
            <img src="../images/check.png">
            <div class="title-success">
                ทำรายการสำเร็จ!
            </div>
            <div class="text-success">
                กรุณารอการตรวจสอบ เมื่ออนุมัติสถานะของคุณจะเปลี่ยนอัตโนมัติ
            </div>
            <a href="index.php" class="btn btn-primary">
                หน้าแรก
            </a>
        </div>
    <?php } else { ?>
        <form class="form-container" enctype="multipart/form-data" method="post">
            <h2 class="form-title">แจ้งชำระเงิน</h2>

            <div class="form-group">
                <label for="name">ชื่อ-นามสกุล</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="ชื่อ-นามสกุล">
                <div class="input-error input-name"></div>
            </div>
            <div class="form-group">
                <label for="tel">เบอร์โทรศัพท์</label>
                <input type="text" class="form-control" name="tel" id="tel" placeholder="เบอร์โทรศัพท์">
                <div class="input-error input-tel"></div>
            </div>
            <div class="form-group">
                <label for="package">แพ็กเกจของคุณ</label>
                <select name="package" id="package" class="form-control">
                    <option value="">เลือกแพ็กเกจ</option>
                    <option value="1">Begin</option>
                    <option value="2">Premium</option>
                    <option value="3">Premium Plus</option>
                </select>
                <div class="input-error input-package"></div>
            </div>
            <div class="form-group">
                <label for="total">ยอดโอน</label>
                <input type="text" class="form-control" name="total" id="total" placeholder="ยอดโอน">
                <div class="input-error input-total"></div>
            </div>
            <div class="form-group">
                <label for="slip">สลิปการโอน</label>
                <input type="file" class="form-control" name="slip" id="slip" placeholder="สลิปการโอน">
                <div class="input-error input-slip"></div>
            </div>
            <div class="form-group">
                <label for="note">หมายเหตุ</label>
                <input type="text" class="form-control" name="note" id="note" placeholder="หมายเหตุ">
                <div class="input-error input-note"></div>
            </div>

            <button type="submit" class="next btn btn-primary" name="btnSave">ดำเนินการต่อ</button>
            <a href="index.php" class="btn btn-defalut">ยกเลิก</a>
        </form>
    <?php } ?>

<?php include 'include/footer.php'; ?>