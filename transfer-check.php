<?php
    require('config/connection.php');
    require('api/check_user.php');

    $page_name = "บัตรสะสมแต้ม";

    if (isset($_GET['tel']) && isset($_GET['point'])) {
        $card_id = $_GET['card_id'];
        $tel = $_GET['tel'];
        $point = $_GET['point'];
    } else {
        header('location: transfer.php');
    }

    $query  = "SELECT * FROM tbl_user WHERE u_tel = '".$tel."'";
    $result = mysqli_query($conn, $query) or die(mysql_error());
    $row    = $result->fetch_assoc();

    // check user
    if (mysqli_num_rows($result) > 0) {
        if ($row['u_id'] != $uc_row['u_id']) {
            $query_ucard  = "SELECT * FROM tbl_user_card WHERE uc_id = '".$card_id."'";
            $result_ucard = mysqli_query($conn, $query_ucard) or die(mysql_error());
            $row_ucard    = $result_ucard->fetch_assoc();

            if ($row_ucard['uc_point'] >= $point) {
                $query_trcard  = "SELECT * FROM tbl_user_card WHERE uc_user_id = '".$row['u_id']."' AND uc_shop_id = ".$row_ucard['uc_shop_id'];
                $result_trcard = mysqli_query($conn, $query_trcard) or die(mysql_error());
                $row_trcard    = $result_trcard->fetch_assoc();

                if (mysqli_num_rows($result_trcard) < 1) {
                    echo "<script>alert('ผู้รับไม่มีบัตรสะสมแต้มของร้านนี้'); window.location.replace('transfer.php?id=".$card_id."');</script>";
                    exit();
                }
            } else {
                echo "<script>alert('คะแนนของคุณไม่เพียงพอสำหรับการโอน'); window.location.replace('transfer.php?id=".$card_id."');</script>";
                exit();
            }
        } else {
            echo "<script>alert('ไม่สามารถโอนเข้าบัญชีตัวเองได้'); window.location.replace('transfer.php?id=".$card_id."');</script>";
            exit();
        }
    } else {
        echo "<script>alert('ไม่พบรายชื่อผู้รับ'); window.location.replace('transfer.php?id=".$card_id."');</script>";
        exit();
    }
?>

<?php include 'include/header.php'; ?>
    
    <div class="main-container">
        <h1 class="site-title">GOTCHA!</h1>

        <?php if (mysqli_num_rows($result) < 1) { ?>
            <div class="message-box">
                <div class="message-header message-unsuccess">ขออภัย</div>
                <div class="message-detail">
                    ไม่พบรายชื่อ
                </div>
            </div>

            <a href="index.php" class="btn btn-primary">
                หน้าแรก
            </a>
        <?php } else { ?>
            <br>
            <h2 class="form-title">โอนคะแนนไปยัง</h2>
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
            <div class="text-center">
                คงเหลือ <?php echo $row_ucard['uc_point'] - $point; ?> คะแนน<br>
                หมดอายุวันที่ 31 ธันวาคม 2564
            </div>
            <br>
            <a href="transfer.php?id=<?php echo $card_id; ?>" class="btn btn-white">แก้ไข</a>
            <form method="get" action="transfer-pin.php">
                <input type="hidden" name="card_id" value="<?php echo $card_id; ?>">
                <input type="hidden" name="transfer_id" value="<?php echo $row_trcard['uc_id']; ?>">
                <input type="hidden" name="point" value="<?php echo $point; ?>">
                <button type="submit" class="btn btn-primary">
                    ดำเนินการต่อ
                    <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                </button>
            </form>
        <?php } ?>
    </div>

<?php include 'include/footer.php'; ?>