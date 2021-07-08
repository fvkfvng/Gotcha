<?php
    require('config/connection.php');
    require('config/config.php');
    require('api/check_user.php');

    $page_name = "บัตรสะสมแต้ม";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header('location: index.php');
    }

    $query = "SELECT * FROM tbl_user_card
                INNER JOIN tbl_shop ON tbl_user_card.uc_shop_id = tbl_shop.s_id
                WHERE uc_id = '".$id."'";
    $result = mysqli_query($conn, $query) or die(mysql_error());
    $row = mysqli_fetch_assoc($result);

    $query_pdate = "SELECT p_date FROM tbl_point WHERE p_receive = '".$id."' GROUP BY p_date ORDER BY p_date DESC";
    $result_pdate = mysqli_query($conn, $query_pdate) or die(mysql_error());

    $query_wdate = "SELECT w_date FROM tbl_award WHERE w_user_card = '".$id."' GROUP BY w_date ORDER BY w_date DESC";
    $result_wdate = mysqli_query($conn, $query_wdate) or die(mysql_error());
?>

<?php include 'include/header.php'; ?>
    
    <div class="main-container">
        <h1 class="site-title">GOTCHA!</h1>
        <br>
        <h2 class="main-title">
            " <?php echo $row['s_shop_name']; ?> "
        </h2>

        <div class="history-profile">
            <div class="history-profile-img">
                <img src="<?php echo $uc_picture; ?>" style="width: 100%;">
            </div>
            <div class="history-profile-detail">
                <?php echo $uc_row['u_name']; ?><br>
                เบอร์โทรศัพท์ <?php echo $uc_row['u_tel']; ?><br>
                คะแนนของคุณ <span><?php echo $row['uc_point']; ?></span> คะแนน
            </div>
        </div>

        <ul class="nav nav-pills">
            <li class="active"><a data-toggle="pill" href="#point">คะแนนที่ได้รับ</a></li>
            <li><a data-toggle="pill" href="#award">ของรางวัลที่ได้รับ</a></li>
        </ul>
        <div class="tab-content">
            <div id="point" class="tab-pane fade in active">
                <?php
                    if (mysqli_num_rows($result_pdate) > 0) {
                        while($row_pdate = mysqli_fetch_assoc($result_pdate)) {
                            $query = "SELECT * FROM tbl_point WHERE p_receive = '".$id."' AND p_date = '".$row_pdate['p_date']."' ORDER BY p_id DESC";
                            $result = mysqli_query($conn, $query) or die(mysql_error());
                ?>
                    <div class="tab-date"><?php echo dateTh($row_pdate['p_date']); ?></div>
                    <?php
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                if ($row['p_type'] == 1) {
                                    $txt = 'รับคะแนนจากร้านค้า';
                                } elseif ($row['p_type'] == 2) {
                                    $txt = 'รับคะแนนจากเพื่อน';
                                }
                    ?>
                        <div class="tab-list">
                            <div class="tab-list-text">
                                <?php echo $txt; ?><br>
                                <span>เวลา <?php echo $row['p_time']; ?> น.</span>
                            </div>
                            <div class="tab-list-point">
                                <span><?php echo $row['p_point']; ?></span> คะแนน
                            </div>
                        </div>
                        
                    <?php }} ?>
                <?php }} ?>
            </div>
            <div id="award" class="tab-pane fade">
              <?php
                    if (mysqli_num_rows($result_wdate) > 0) {
                        while($row_wdate = mysqli_fetch_assoc($result_wdate)) {
                            $query = "SELECT * FROM tbl_award WHERE w_user_card = '".$id."' AND w_date = '".$row_wdate['w_date']."' ORDER BY w_id DESC";
                            $result = mysqli_query($conn, $query) or die(mysql_error());
                ?>
                    <div class="tab-date"><?php echo dateTh($row_wdate['w_date']); ?></div>
                    <?php
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                if ($row['w_status'] == 1) {
                                    $txt = '<span style="color: red">ไม่สำเร็จ</span>';
                                } elseif ($row['w_status'] == 2) {
                                    $txt = '<span style="color: green">สำเร็จ</span>';
                                }
                    ?>
                        <div class="tab-list">
                            <div class="tab-list-text">
                                รับสิทธิพิเศษจากร้านค้า<br>
                                <span>เวลา <?php echo $row['w_time']; ?> น.</span>
                            </div>
                            <div class="tab-list-point">
                                <?php echo $txt; ?>
                            </div>
                        </div>
                        
                    <?php }} ?>
                <?php }} ?>
            </div>
            </div>
            <br>
            <a href="index.php" class="btn btn-primary">หน้าแรก</a>
        </div>
    </div>

<?php include 'include/footer.php'; ?>