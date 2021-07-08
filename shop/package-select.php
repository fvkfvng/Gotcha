<?php
    require('../config/connection.php');
    require('api/check_shop.php');

    $page_name = "บัตรสะสมแต้ม";

    if (!isset($_GET['p'])) {
        header('location: package.php');
    }
?>

<?php include 'include/header.php'; ?>
    
    <div class="main-container">
        <h1 class="site-title">GOTCHA!</h1>
        <br>
        <h2 class="main-title">
            แพ็กเกจที่เลือกคือ
        </h2>

        <form method="post" action="package-success.php">
            <?php if ($_GET['p'] == 'begin') { ?>
                <div class="card-package">
                    <div class="card-package-title">
                        Begin <span class="right">300฿/เดือน</span>
                    </div>
                    <div class="card-package-content">
                        <div class="card-package-item">จำนวนสมาชิก <span class="right">100 คน</span></div>
                        <div class="card-package-item">สร้างธีมสะสมคะแนน <span class="right"></span></div>
                    </div>
                </div>
                <div class="package-total">
                    <div class="card-package-item">ราคาแพ็กเกจ <span class="right">300 ฿</span></div>
                    <div class="card-package-item">ภาษีมูลค่าเพิ่ม 7% <span class="right">21 ฿</span></div>
                    <div class="card-package-item">รวม <span class="right">321 ฿</span></div>
                </div>
                <input type="hidden" name="package" value="1">
            <?php } elseif ($_GET['p'] == 'premium') { ?>
                <div class="card-package">
                    <div class="card-package-title">
                        Premium <span class="right">400฿/เดือน</span>
                    </div>
                    <div class="card-package-content">
                        <div class="card-package-item">จำนวนสมาชิก <span class="right">300 คน</span></div>
                        <div class="card-package-item">สร้างธีมสะสมคะแนน <span class="right"></span></div>
                        <div class="card-package-item">ส่ง SMS ให้ลูกค้า <span class="right"></span></div>
                        <div class="card-package-item">จำนวนการจ่ายคะแนนและของรางวัล <span class="right"></span></div>
                    </div>
                </div>
                <div class="package-total">
                    <div class="card-package-item">ราคาแพ็กเกจ <span class="right">400 ฿</span></div>
                    <div class="card-package-item">ภาษีมูลค่าเพิ่ม 7% <span class="right">28 ฿</span></div>
                    <div class="card-package-item">รวม <span class="right">428 ฿</span></div>
                </div>
                <input type="hidden" name="package" value="2">
            <?php } elseif ($_GET['p'] == 'premiumplus') { ?>
                <div class="card-package">
                    <div class="card-package-title">
                        Premium Plus <span class="right">500฿/เดือน</span>
                    </div>
                    <div class="card-package-content">
                        <div class="card-package-item">จำนวนสมาชิก <span class="right">600 คน</span></div>
                        <div class="card-package-item">สร้างธีมสะสมคะแนน <span class="right"></span></div>
                        <div class="card-package-item">ส่ง SMS ให้ลูกค้า <span class="right"></span></div>
                        <div class="card-package-item">จำนวนการจ่ายคะแนนและของรางวัล <span class="right"></span></div>
                        <div class="card-package-item">ลูกค้าประจำ <span class="right"></span></div>
                        <div class="card-package-item">รายได้ <span class="right"></span></div>
                    </div>
                </div>
                <div class="package-total">
                    <div class="card-package-item">ราคาแพ็กเกจ <span class="right">500 ฿</span></div>
                    <div class="card-package-item">ภาษีมูลค่าเพิ่ม 7% <span class="right">35 ฿</span></div>
                    <div class="card-package-item">รวม <span class="right">535 ฿</span></div>
                </div>
                <input type="hidden" name="package" value="3">
            <?php } ?>
            <br>
        
            <button type="submit" class="btn btn-primary">
                ดำเนินการต่อ
                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
            </button>
        </form>
        <a href="index.php" class="btn btn-white">ยกเลิก</a>
    </div>

<?php include 'include/footer.php'; ?>
