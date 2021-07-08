<?php
    require('../config/connection.php');
    require('api/check_shop.php');

    $page_name = "บัตรสะสมแต้ม";

    if (isset($_GET['month'])) {
        $curr_month = date('m');

        $query_nuser  = "SELECT COUNT(*) as count FROM tbl_user_card WHERE uc_shop_id = '".$row_shop_ap['s_id']."' AND MONTH(uc_created) = '".$curr_month."'";
        $result_nuser = mysqli_query($conn, $query_nuser) or die(mysql_error());
        $row_nuser    = $result_nuser->fetch_assoc();

        $query_point  = "SELECT SUM(p_point) as sum FROM tbl_point WHERE p_type = '1' AND p_from = '".$row_shop_ap['s_id']."' AND MONTH(p_date) = '".$curr_month."'";
        $result_point = mysqli_query($conn, $query_point) or die(mysql_error());
        $row_point    = $result_point->fetch_assoc();

        $query_award  = "SELECT COUNT(*) as count FROM tbl_award WHERE w_shop = '".$row_shop_ap['s_id']."' AND  w_status = '2' AND MONTH(w_updated) = '".$curr_month."'";
        $result_award = mysqli_query($conn, $query_award) or die(mysql_error());
        $row_award    = $result_award->fetch_assoc();

        $query_user  = "SELECT COUNT(*) as count FROM tbl_user_card WHERE uc_shop_id = '".$row_shop_ap['s_id']."' AND MONTH(uc_created) = '".$curr_month."'";
        $result_user = mysqli_query($conn, $query_user) or die(mysql_error());
        $row_user    = $result_user->fetch_assoc();

        $query_regular  = "SELECT COUNT(*) as count FROM tbl_point WHERE p_type = '1' AND p_from = '".$row_shop_ap['s_id']."' AND MONTH(p_date) = '".$curr_month."' GROUP BY p_receive";
        $result_regular = mysqli_query($conn, $query_regular) or die(mysql_error());

        $regular = 0;
        if (mysqli_num_rows($result_regular) > 0) {
            while($row_regular = mysqli_fetch_assoc($result_regular)) {
                if ($row_regular['count'] > 3) {
                    $regular += 1;
                }
            }
        }

        $query_pay  = "SELECT SUM(p_pay) as sum FROM tbl_point WHERE p_type = '1' AND p_from = '".$row_shop_ap['s_id']."' AND MONTH(p_date) = '".$curr_month."'";
        $result_pay = mysqli_query($conn, $query_pay) or die(mysql_error());
        $row_pay    = $result_pay->fetch_assoc();
    
    } elseif (isset($_GET['year'])) {

        $curr_year = date('Y');

        $query_nuser  = "SELECT COUNT(*) as count FROM tbl_user_card WHERE uc_shop_id = '".$row_shop_ap['s_id']."' AND YEAR(uc_created) = '".$curr_year."'";
        $result_nuser = mysqli_query($conn, $query_nuser) or die(mysql_error());
        $row_nuser    = $result_nuser->fetch_assoc();

        $query_point  = "SELECT SUM(p_point) as sum FROM tbl_point WHERE p_type = '1' AND p_from = '".$row_shop_ap['s_id']."' AND YEAR(p_date) = '".$curr_year."'";
        $result_point = mysqli_query($conn, $query_point) or die(mysql_error());
        $row_point    = $result_point->fetch_assoc();

        $query_award  = "SELECT COUNT(*) as count FROM tbl_award WHERE w_shop = '".$row_shop_ap['s_id']."' AND  w_status = '2' AND YEAR(w_updated) = '".$curr_year."'";
        $result_award = mysqli_query($conn, $query_award) or die(mysql_error());
        $row_award    = $result_award->fetch_assoc();

        $query_user  = "SELECT COUNT(*) as count FROM tbl_user_card WHERE uc_shop_id = '".$row_shop_ap['s_id']."' AND YEAR(uc_created) = '".$curr_year."'";
        $result_user = mysqli_query($conn, $query_user) or die(mysql_error());
        $row_user    = $result_user->fetch_assoc();

        $query_regular  = "SELECT COUNT(*) as count FROM tbl_point WHERE p_type = '1' AND p_from = '".$row_shop_ap['s_id']."' AND YEAR(p_date) = '".$curr_year."' GROUP BY p_receive";
        $result_regular = mysqli_query($conn, $query_regular) or die(mysql_error());

        $regular = 0;
        if (mysqli_num_rows($result_regular) > 0) {
            while($row_regular = mysqli_fetch_assoc($result_regular)) {
                if ($row_regular['count'] > 3) {
                    $regular += 1;
                }
            }
        }

        $query_pay  = "SELECT SUM(p_pay) as sum FROM tbl_point WHERE p_type = '1' AND p_from = '".$row_shop_ap['s_id']."' AND YEAR(p_date) = '".$curr_year."'";
        $result_pay = mysqli_query($conn, $query_pay) or die(mysql_error());
        $row_pay    = $result_pay->fetch_assoc();

    } else {
        $curr_date = date('Y-m-d');

        $query_nuser  = "SELECT COUNT(*) as count FROM tbl_user_card WHERE uc_shop_id = '".$row_shop_ap['s_id']."' AND DATE(uc_created) = '".$curr_date."'";
        $result_nuser = mysqli_query($conn, $query_nuser) or die(mysql_error());
        $row_nuser    = $result_nuser->fetch_assoc();

        $query_point  = "SELECT SUM(p_point) as sum FROM tbl_point WHERE p_type = '1' AND p_from = '".$row_shop_ap['s_id']."' AND p_date = '".$curr_date."'";
        $result_point = mysqli_query($conn, $query_point) or die(mysql_error());
        $row_point    = $result_point->fetch_assoc();

        $query_award  = "SELECT COUNT(*) as count FROM tbl_award WHERE w_shop = '".$row_shop_ap['s_id']."' AND  w_status = '2' AND DATE(w_updated) = '".$curr_date."'";
        $result_award = mysqli_query($conn, $query_award) or die(mysql_error());
        $row_award    = $result_award->fetch_assoc();

        $query_user  = "SELECT COUNT(*) as count FROM tbl_user_card WHERE uc_shop_id = '".$row_shop_ap['s_id']."' AND DATE(uc_created) = '".$curr_date."'";
        $result_user = mysqli_query($conn, $query_user) or die(mysql_error());
        $row_user    = $result_user->fetch_assoc();

        $query_regular  = "SELECT COUNT(*) as count FROM tbl_point WHERE p_type = '1' AND p_from = '".$row_shop_ap['s_id']."' AND p_date = '".$curr_date."' GROUP BY p_receive";
        $result_regular = mysqli_query($conn, $query_regular) or die(mysql_error());

        $regular = 0;
        if (mysqli_num_rows($result_regular) > 0) {
            while($row_regular = mysqli_fetch_assoc($result_regular)) {
                if ($row_regular['count'] > 3) {
                    $regular += 1;
                }
            }
        }

        $query_pay  = "SELECT SUM(p_pay) as sum FROM tbl_point WHERE p_type = '1' AND p_from = '".$row_shop_ap['s_id']."' AND p_date = '".$curr_date."'";
        $result_pay = mysqli_query($conn, $query_pay) or die(mysql_error());
        $row_pay    = $result_pay->fetch_assoc();
    }
?>

<?php include 'include/header.php'; ?>
    
    <div class="main-container">
        <h1 class="site-title">GOTCHA!</h1>
        <br>
        <h2 class="main-title">
            รายงานผลร้าน<br>
            “<?php echo $row_shop_ap['s_shop_name']; ?>”<br>
        </h2>

        <div id="input-filter" class="text-center">
            <input type="radio" name="date" class="date-radio" value="1" <?php if (!isset($_GET['month']) || !isset($_GET['year']) || isset($_GET['day'])) { echo 'checked="checked"'; } ?>> วัน
            <input type="radio" name="date" class="date-radio" value="2" <?php if (isset($_GET['month'])) { echo 'checked="checked"'; } ?>> เดือน
            <input type="radio" name="date" class="date-radio" value="3" <?php if (isset($_GET['year'])) { echo 'checked="checked"'; } ?>> ปี
        </div>

        <div class="card">
            <div class="card-body">
                <div class="result-row">
                    <div class="result-item">
                        สมาชิกใหม่
                        <div class="result-item-number">
                            <?php echo $row_nuser['count']; ?>
                        </div>
                    </div>
                    <div class="result-item result-item-center">
                        คะแนนที่จ่าย
                        <div class="result-item-number">
                            <?php echo $row_point['sum']; ?>
                        </div>
                    </div>
                    <div class="result-item">
                        รางวัลที่จ่าย
                        <div class="result-item-number">
                            <?php echo $row_award['count']; ?>
                        </div>
                    </div>
                </div>
                <div class="result-item">
                    สมาชิกทั้งหมด
                    <div class="result-item-number">
                        <?php echo $row_user['count']; ?>
                    </div>
                </div>
                <div class="result-item result-item-center">
                    ลูกค้าประจำ
                    <div class="result-item-number">
                        <?php if ($row_shop_ap['s_pro'] == 3) { ?>
                            <?php echo $regular; ?>
                        <?php } else { ?>
                            <img src="../images/lock.png">
                        <?php } ?>
                    </div>
                </div>
                <div class="result-item">
                    รายได้
                    <div class="result-item-number">
                        <?php if ($row_shop_ap['s_pro'] == 3) { ?>
                            <?php echo $row_pay['sum']; ?>
                        <?php } else { ?>
                            <img src="../images/lock.png">
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <a href="index.php" class="btn btn-primary">หน้าแรก</a>
    </div>

    <script type="text/javascript">
        $('.date-radio').on('change', function() {
            var val = $(this).val();
            var parm = '?day';

            if (val == 2) {
                parm = '?month';
            } else if (val == 3) {
                parm = '?year';
            }

            window.location.assign(window.location.protocol+'//'+window.location.hostname+ window.location.pathname+parm);
        });
    </script>
<?php include 'include/footer.php'; ?>