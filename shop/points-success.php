<?php
    require('../config/connection.php');
    require('../config/config.php');
    require('api/check_shop.php');

    $page_name = "บัตรสะสมแต้ม";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query  = "SELECT * FROM tbl_point
                    INNER JOIN tbl_user_card ON tbl_point.p_receive = tbl_user_card.uc_id
                    INNER JOIN tbl_user ON tbl_user_card.uc_user_id = tbl_user.u_id
                    INNER JOIN tbl_shop ON tbl_user_card.uc_shop_id = tbl_shop.s_id
                    WHERE p_id = '".$id."'";
        $result = mysqli_query($conn, $query) or die(mysql_error());
        $row    = $result->fetch_assoc();
    } else {
        header('location: points.php');
    }
?>

<?php include 'include/header.php'; ?>
    
    <div class="main-container">
        <h1 class="site-title">GOTCHA!</h1>

        <div id="page-success" class="form-container">
            <img src="../images/check.png">
            <div class="title-success">
                ทำรายการสำเร็จ!
            </div>

            <div class="block-success block-success-white">
                <div class="block-success-header">
                    <div class="text-gray">บันทึกเมื่อ <?php echo dateTh($row['p_date']); ?></div>
                    <div class="text-gray">เวลา <?php echo $row['p_time']; ?> น.</div>
                </div>
                <div class="block-success-body">
                    <div class="block-success-row">
                        <div class="block-success-left">
                            <div class="profile-picture">
                                <img src="<?php echo $row['s_line_img']; ?>" />
                            </div>
                        </div>
                        <div class="block-success-right">
                            <?php echo $row['s_shop_name']; ?><br>
                            <?php echo $row['s_tel']; ?>
                        </div>
                    </div>
                    <div class="block-success-row">
                        <div class="block-success-left">
                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </div>
                        <div class="block-success-right block-success-point">
                            <h3 style="font-weight: bold; margin-top: 0px;">จำนวน</h3>
                            <h2 style="font-weight: bold;"><?php echo $row['p_point']; ?></h2>
                            <span class="fa-stack">
                              <i class="fa fa-circle fa-stack-2x"></i>
                              <i class="fa fa-star fa-stack-1x fa-inverse"></i>
                            </span>
                        </div>
                    </div>
                    <div class="block-success-row">
                        <div class="block-success-left">
                            <div class="profile-picture">
                                <img src="<?php echo $row['u_line_img']; ?>" />
                            </div>
                        </div>
                        <div class="block-success-right">
                            <?php echo $row['u_name']; ?><br>
                            <?php echo $row['u_tel']; ?>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <a href="index.php" class="btn btn-primary">หน้าแรก</a>
        </div>
    </div>

<?php include 'include/footer.php'; ?>