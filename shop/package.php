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
            เลือกซื้อแพ็กเกจที่ต้องการ
        </h2>

        <div class="card-package">
            <div class="card-package-title">
                Begin <span class="right">300฿/เดือน</span>
            </div>
            <div class="card-package-content">
                <div class="card-package-item">จำนวนสมาชิก <span class="right">100 คน</span></div>
                <div class="card-package-item">สร้างธีมสะสมคะแนน <span class="right"><i class="fa fa-circle-o" aria-hidden="true"></i></span></div>
            </div>
            <a href="package-select.php?p=begin" class="btn btn-primary">เลือก</a>
        </div>

        <div class="card-package">
            <div class="card-package-title">
                Premium <span class="right">400฿/เดือน</span>
            </div>
            <div class="card-package-content">
                <div class="card-package-item">จำนวนสมาชิก <span class="right">300 คน</span></div>
                <div class="card-package-item">สร้างธีมสะสมคะแนน <span class="right"><i class="fa fa-circle-o" aria-hidden="true"></i></span></div>
                <div class="card-package-item">ส่ง SMS ให้ลูกค้า <span class="right"><i class="fa fa-circle-o" aria-hidden="true"></i></span></div>
                <div class="card-package-item">จำนวนการจ่ายคะแนนและของรางวัล <span class="right"><i class="fa fa-circle-o" aria-hidden="true"></i></span></div>
            </div>
            <a href="package-select.php?p=premium" class="btn btn-primary">เลือก</a>
        </div>

        <div class="card-package">
            <div class="card-package-title">
                Premium Plus <span class="right">500฿/เดือน</span>
            </div>
            <div class="card-package-content">
                <div class="card-package-item">จำนวนสมาชิก <span class="right">600 คน</span></div>
                <div class="card-package-item">สร้างธีมสะสมคะแนน <span class="right"><i class="fa fa-circle-o" aria-hidden="true"></i></span></div>
                <div class="card-package-item">ส่ง SMS ให้ลูกค้า <span class="right"><i class="fa fa-circle-o" aria-hidden="true"></i></span></div>
                <div class="card-package-item">จำนวนการจ่ายคะแนนและของรางวัล <span class="right"><i class="fa fa-circle-o" aria-hidden="true"></i></span></div>
                <div class="card-package-item">ลูกค้าประจำ <span class="right"><i class="fa fa-circle-o" aria-hidden="true"></i></span></div>
                <div class="card-package-item">รายได้ <span class="right"><i class="fa fa-circle-o" aria-hidden="true"></i></span></div>
            </div>
            <a href="package-select.php?p=premiumplus" class="btn btn-primary">เลือก</a>
        </div>
        <a href="index.php" class="btn btn-default">หน้าแรก</a>
    </div>

<?php include 'include/footer.php'; ?>
