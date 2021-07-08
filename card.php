<?php
    require('config/connection.php');
    require('api/check_user.php');

    $page_name = "บัตรสะสมแต้ม";

    if (isset($_GET['shop'])) {
        $sid = $_GET['shop'];

        $query    = "SELECT * FROM tbl_shop WHERE s_id = '".$sid."'";
        $result = mysqli_query($conn, $query) or die(mysql_error());
        $row = mysqli_fetch_assoc($result);
    }
?>

<?php include 'include/header.php'; ?>
    
    <div class="main-container">
        <h1 class="site-title">GOTCHA!</h1>
        <br>
        <h2 class="main-title">
            บัตรสะสมแต้มร้าน<br>
            “<?php echo $row['s_shop_name']; ?>”<br>
        </h2>
        <?php
            if (mysqli_num_rows($result) > 0) {
                $query_ucard    = "SELECT * FROM tbl_user_card WHERE uc_shop_id = '".$sid."' AND uc_user_id = ".$uc_row['u_id'];
                $result_ucard = mysqli_query($conn, $query_ucard) or die(mysql_error());
        ?>
            <?php
                if (mysqli_num_rows($result_ucard) > 0) {
            ?>
                <div class="message-box">
                    <div class="message-header message-success">มีบัตรสะสมแต้มร้านนี้แล้ว!</div>
                    <div class="message-detail">
                        สามารถดูได้จากหน้า "บัตรสะสมแต้มทั้งหมด"
                    </div>
                </div>
                <a href="index" class="btn btn-primary">
                    บัตรสะสมแต้มทั้งหมด
                </a>
            <?php } else { ?>
                <form method="post" action="card-save.php">
                    <input type="hidden" name="shop" value="<?php echo $row['s_id']; ?>">
                    <div class="card-item">
                        <div class="card-content w-100">
                            <div class="card-point-logo">
                                <img style="width:100px;" src="<?php echo $shop_ap_picture; ?>" />
                            </div>
                            <div class="card-point-detail">
                                <div class="card-point-detail-detail">
                                    <p>ร้าน <span><?php echo $row['s_shop_name']; ?></span></p>
                                    <p>ประเภทร้าน <span><?php echo $row['s_shop_type']; ?></span></p>
                                    <p>ผู้ประกอบการ <span><?php echo $row['s_name']; ?></span></p>
                                    <p>เบอร์โทร <span><?php echo $row['s_tel']; ?></span></p>
                                    <p>สถานที่ตั้ง <span class="card-address"><?php echo $row['s_address_no']; ?> <?php echo $row['s_address_no']; ?>, ชั้น <?php echo $row['s_address_floor']; ?>, <?php echo $row['s_address_detail']; ?></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">
                        เพิ่มบัตร
                        <i class="fa fa-plus-o" aria-hidden="true"></i>
                    </button>
                <?php } ?>
            </form>
        <?php } else { ?>
            <div class="text-center">ไม่มีบัตรสะสมแต้ม</div>
        <?php } ?>
    </div>

<?php include 'include/footer.php'; ?>