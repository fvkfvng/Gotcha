<?php
    require('../config/connection.php');
    require('api/check_shop.php');

    $page_name = "บัตรสะสมแต้ม";

    if (isset($_GET['type'])) {
        if ($_GET['type'] == 1 && isset($_GET['tel']) && isset($_GET['point'])) {
            $tel = $_GET['tel'];
            $total = $_GET['total'];
            $point = $_GET['point'];
        } else if ($_GET['type'] == 2 && isset($_GET['point'])) {
            header('location: qr/gen/point.php?p='.$_GET['point'].'&t='.$_GET['total']);
        }
    } else {
        header('location: points.php');
    }

    $query  = "SELECT * FROM tbl_user WHERE u_tel = '".$tel."'";
    $result = mysqli_query($conn, $query) or die(mysql_error());
    $row    = $result->fetch_assoc();

    if (mysqli_num_rows($result) > 0) {
        $query_ucard  = "SELECT * FROM tbl_user_card WHERE uc_user_id = '".$row['u_id']."' AND uc_shop_id = ".$row_shop_ap['s_id'];
        $result_ucard = mysqli_query($conn, $query_ucard) or die(mysql_error());
        $row_ucard    = $result_ucard->fetch_assoc();
    }
?>

<?php include 'include/header.php'; ?>
    
    <div class="main-container">
        <h1 class="site-title">GOTCHA!</h1>
        <?php if (mysqli_num_rows($result) < 1) { ?>
            <div class="message-box">
                <div class="message-header message-unsuccess">ขออภัย</div>
                <div class="message-detail">
                    ไม่พบรายชื่อลูกค้า
                </div>
            </div>

            <a href="index.php" class="btn btn-primary">
                หน้าแรก
            </a>
        <?php } ?>

        <?php if (mysqli_num_rows($result) > 0) { ?>
            <?php if (mysqli_num_rows($result_ucard) < 1) { ?>
                <div class="message-box">
                    <div class="message-header message-unsuccess">ขออภัย</div>
                    <div class="message-detail">
                        ลูกค้าไม่มีบัตรสะสมแต้มร้านของคุณ <br>กรุณาให้ลูกค้าเพิ่มบัตรก่อน
                    </div>
                </div>

                <a href="index.php" class="btn btn-primary">
                    หน้าแรก
                </a>
            <?php } else { ?>
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
                    จำนวน<br><br>
                    <span class="text-blue"><?php echo $point; ?></span><br><br>
                    คะแนน
                </h2>

                <a href="points.php" class="btn btn-white">แก้ไข</a>
                <form method="post" action="points-pin.php">
                    <input type="hidden" name="card_id" value="<?php echo $row_ucard['uc_id']; ?>">
                    <input type="hidden" name="total" value="<?php echo $total; ?>">
                    <input type="hidden" name="user_point" value="<?php echo $point; ?>">
                    <button type="submit" class="btn btn-primary" name="formPoint">
                        ดำเนินการต่อ
                        <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                    </button>
                </form>
            <?php } ?>
        <?php } ?>
    </div>

<?php include 'include/footer.php'; ?>