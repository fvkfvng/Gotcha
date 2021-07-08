<?php
    require('../config/connection.php');
    require('api/check_shop.php');

    $page_name = "บัตรสะสมแต้ม";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header('location: index.php');
    }

    $query_ucard  = "SELECT * FROM tbl_award
                INNER JOIN tbl_user_card ON tbl_award.w_user_card = tbl_user_card.uc_id
                WHERE w_id = '".$id."'";
    $result_ucard = mysqli_query($conn, $query_ucard) or die(mysql_error());
    $row_ucard    = $result_ucard->fetch_assoc();

    $query  = "SELECT * FROM tbl_user WHERE u_id = ".$row_ucard['uc_user_id'];
    $result = mysqli_query($conn, $query) or die(mysql_error());
    $row    = $result->fetch_assoc();
?>

<?php include 'include/header.php'; ?>
    
    <div class="main-container">
        <h1 class="site-title">GOTCHA!</h1>

        <br>
        <h2 class="form-title">ข้อมูลลูกค้า</h2>
        <div class="profile-picture">
            <img style="width:100px;" src="<?php echo $row['u_line_img']; ?>" />
        </div>
        <div class="text-center">
            <h4><?php echo $row['u_name']; ?></h4>
            <h4>เบอร์โทรศัพท์ <?php echo $row['u_tel']; ?></h4>
        </div>
        <br>
        <h2 class="main-title">
            ระบบสะสมแต้มร้าน<br>
            “<?php echo $row_shop_ap['s_shop_name']; ?>”<br>
        </h2>

        <div id="card">
            <div class="card-content">
                <div class="card-point-logo">
                    <img style="width:100px;" src="<?php echo $row_shop_ap['s_line_img']; ?>" />
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
                        <img src="api/gen_qrcode.php?s=<?php echo $row_shop_ap['s_id']; ?>" alt="">
                    </div>
                </div>
            </div>
        </div>

        <form method="post" action="award-success.php">
            <input type="hidden" name="award_id" value="<?php echo $id; ?>">
            <button type="submit" class="btn btn-primary">
                ดำเนินการต่อ
                <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
            </button>
        </form>
        <a href="index.php" class="btn btn-white">ยกเลิก</a>
    </div>

<?php include 'include/footer.php'; ?>