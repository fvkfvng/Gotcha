<?php
    require('../config/connection.php');
    require('../config/config.php');
    require('api/check_shop.php');

    $page_name = "บัตรสะสมแต้ม";

    $query_pdate = "SELECT p_date FROM tbl_point WHERE p_from = '".$row_shop_ap['s_id']."' AND p_type = '1' GROUP BY p_date ORDER BY p_date DESC";
    $result_pdate = mysqli_query($conn, $query_pdate) or die(mysql_error());

    $query_wdate = "SELECT w_date FROM tbl_award
                    INNER JOIN tbl_shop ON tbl_award.w_shop = tbl_shop.s_id
                    WHERE s_id = '".$row_shop_ap['s_id']."' GROUP BY w_date ORDER BY w_date DESC";
    $result_wdate = mysqli_query($conn, $query_wdate) or die(mysql_error());
?>

<?php include 'include/header.php'; ?>
    
    <div class="main-container">
        <h1 class="site-title">GOTCHA!</h1>
        <br>
        <div class="history-profile">
            <div class="history-profile-img">
                <img src="<?php echo $shop_ap_picture; ?>" style="width: 100%;">
            </div>
            <div class="history-profile-detail">
                <?php echo $row_shop_ap['s_shop_name']; ?><br>
                เบอร์โทรศัพท์ <?php echo $row_shop_ap['s_tel']; ?>
            </div>
        </div>

        <ul class="nav nav-pills">
            <li class="active"><a data-toggle="pill" href="#point">การมอบคะแนน</a></li>
            <li><a data-toggle="pill" href="#award">มอบของรางวัล</a></li>
        </ul>
        <div class="tab-content">
            <div id="point" class="tab-pane fade in active">
                <?php
                    if (mysqli_num_rows($result_pdate) > 0) {
                        while($row_pdate = mysqli_fetch_assoc($result_pdate)) {
                            $query = "SELECT * FROM tbl_point
                                    WHERE p_from = '".$row_shop_ap['s_id']."' AND p_type = '1' AND  p_date = '".$row_pdate['p_date']."' ORDER BY p_id DESC";
                            $result = mysqli_query($conn, $query) or die(mysql_error());
                ?>
                    <div class="tab-date"><?php echo dateTh($row_pdate['p_date']); ?></div>
                    <?php
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <div class="tab-list">
                            <div class="tab-list-text">
                                มอบคะแนนให้ลูกค้า<br>
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
                            $query = "SELECT * FROM tbl_award
                                    INNER JOIN tbl_shop ON tbl_award.w_shop = tbl_shop.s_id
                                    WHERE s_id = '".$row_shop_ap['s_id']."' AND w_date = '".$row_wdate['w_date']."' ORDER BY w_id DESC";
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
                                ให้สิทธิพิเศษแก่ลูกค้า<br>
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