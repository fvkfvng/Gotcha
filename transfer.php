<?php
    require('config/connection.php');
    require('api/check_user.php');

    $page_name = "บัตรสะสมแต้ม";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header('location: index.php');
    }

    $query = "SELECT * FROM tbl_user_card
                INNER JOIN tbl_user ON tbl_user_card.uc_user_id = tbl_user.u_id
                INNER JOIN tbl_shop ON tbl_user_card.uc_shop_id = tbl_shop.s_id
                WHERE uc_id = '".$id."'";
    $result = mysqli_query($conn, $query) or die(mysql_error());
    $row = mysqli_fetch_assoc($result);
?>

<?php include 'include/header.php'; ?>
    
    <div class="main-container">
        <h1 class="site-title">GOTCHA!</h1>
        <br>
        <h2 class="main-title">
            คะแนนของคุณ<br>
            ( <?php echo $row['s_shop_name']; ?> )
        </h2>
        
        <h1 class="text-center" style="font-weight: bold;">
            <?php echo $row['uc_point']; ?>
            <span class="fa-stack" style="float: unset;">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-star fa-stack-1x fa-inverse"></i>
            </span>
        </h1>

        <form id="form-point" action="transfer-check.php" class="form-container" enctype="multipart/form-data">
            <input type="hidden" class="form-control" name="card_id" id="card_id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="tel">เบอร์โทรศัพท์มือถือผู้รับคะแนน</label>
                <input type="text" class="form-control" name="tel" id="tel" placeholder="เบอร์โทรศัพท์มือถือ">
                <div class="input-error input-tel"></div>
            </div>
            <div class="form-group">
                <label for="point">คะแนนที่ต้องการโอน</label>
                <input type="text" class="form-control" name="point" id="point" placeholder="คะแนน">
                <div class="input-error input-point"></div>
            </div>
            <button type="submit" class="next btn btn-primary">ดำเนินการต่อ</button>
            <a href="index.php" class="next btn btn-danger">ยกเลิก</a>
        </form>

    </div>

<?php include 'include/footer.php'; ?>