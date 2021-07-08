<?php
    require('../config/connection.php');
    require('api/check_shop.php');

    $page_name = "บัตรสะสมแต้ม";
?>

<?php include 'include/header.php'; ?>
    
    <div class="main-container">
        <h1 class="site-title">GOTCHA!</h1>
        <br>
        <h2 class="main-title">
            ระบบสะสมแต้มร้าน<br>
            “<?php echo $row_shop_ap['s_shop_name']; ?>”<br>
        </h2>

        <div id="card-point">
            <div class="card-content" style="<?php echo $s_card_style; ?>">
                <div class="card-point-logo">
                    <img style="width:100px;" src="<?php echo $shop_ap_picture; ?>" />
                </div>
                <div class="card-point-detail">
                    <div class="card-point-detail-detail">
                        <p>ร้าน <span><?php echo $row_shop_ap['s_shop_name']; ?></span></p>
                        <p>ประเภทร้าน <span><?php echo $row_shop_ap['s_shop_type']; ?></span></p>
                        <p>ผู้ประกอบการ <span><?php echo $row_shop_ap['s_name']; ?></span></p>
                        <p>เบอร์โทร <span><?php echo $row_shop_ap['s_tel']; ?></span></p>
                        <p>สถานที่ตั้ง <span class="card-address"><?php echo $row_shop_ap['s_address_no']; ?> <?php echo $row_shop_ap['s_address_no']; ?>, ชั้น <?php echo $row_shop_ap['s_address_floor']; ?>, <?php echo $row_shop_ap['s_address_detail']; ?></span></p>
                    </div>
                    <div class="card-point-detail-qrcode">
                        ระดับ: <span style="color: red"><?php echo $shop_pro_ap; ?></span><br>
                        <img src="api/gen_qrcode.php?s=<?php echo $row_shop_ap['s_id']; ?>" alt="" style="width: 100px;">
                    </div>
                </div>
            </div>
            <div class="card-point-footer">
                <h3 class="sub-title">การทำงาน</h3>
                <hr>
                <div class="row">
                    <div class="col-xs-6">
                        <a href="points.php">
                            <img src="../images/point.png"><br>
                            มอบคะแนน
                        </a>
                    </div>
                    <div class="col-xs-6">
                        <a href="qrscan.php">
                            <img src="../images/award.png"><br>
                            มอบของรางวัล
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <a href="promotion.php" class="btn btn-primary">
            สร้างโปรโมชัน
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
        </a>
        <a href="card-style.php" class="btn btn-white">แก้ไขรูปแบบบัตร</a>
        <a href="history.php" class="btn btn-white">ประวัติการมอบคะแนน/ของรางวัล</a>
        <a href="result.php" class="btn btn-white">ดูรายงานผลร้านฉัน</a>
        <a href="package.php" class="btn btn-white">เลือกซื้อแพ็กเกจ</a>
        <a href="payment.php" class="btn btn-white">แจ้งชำระเงิน</a>
    </div>

<?php include 'include/footer.php'; ?>
