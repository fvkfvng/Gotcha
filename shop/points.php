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
            “<?php echo $row_shop_ap['s_shop_name']; ?>”<br>
            มอบคะแนนให้ลูกค้า<br>
        </h2>
    
        <form id="form-point" action="points-check.php" class="form-container" enctype="multipart/form-data">
            <input type="hidden" class="form-control" id="shop-price" value="<?php echo $row_shop_ap['s_shop_price']; ?>">
            <input type="hidden" class="form-control" id="shop-point" value="<?php echo $row_shop_ap['s_shop_point']; ?>">
            <div class="form-group">
                <label for="dateofbirth">รูปแบบการมอบคะแนน</label>
                <div class="row">
                    <div class="col-xs-6">
                        <input type="radio" id="type1" name="type" checked="checked" value="1">
                        <label for="type1">โอนคะแนน</label>
                    </div>
                    <div class="col-md-6">
                        <input type="radio" id="type2" name="type" value="2">
                        <label for="type2">สร้าง QR Code</label>
                        <div class="input-error input-type"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="tel">เบอร์โทรศัพท์มือถือผู้รับคะแนน</label>
                <input type="text" class="form-control" name="tel" id="tel" placeholder="เบอร์โทรศัพท์มือถือ">
                <div class="input-error input-tel"></div>
            </div>
            <div class="form-group">
                <label for="total">ยอดซื้อขาย / บริการ</label>
                <input type="text" class="form-control" name="total" id="total" placeholder="ยอดสุทธิ">
                <div class="input-error input-total"></div>
            </div>
            <div class="form-group">
                <label for="point">คะแนนที่ได้รับ</label>
                <input type="text" class="form-control" name="point" id="point" placeholder="คะแนน" readonly="">
                <div class="input-error input-point"></div>
            </div>
            <button type="button" class="next btn btn-primary" id="point-submit1">ดำเนินการต่อ</button>
            <button type="button" class="next btn btn-primary" id="point-submit2">ดำเนินการต่อ</button>
            <a href="index.php" class="next btn btn-danger">ยกเลิก</a>
        </form>

    </div>

<?php include 'include/footer.php'; ?>