<?php
    require_once '../config/connection.php';
    
    if (!isset($_SESSION['admin'])) {
        header('Location: login.php');
    }

    $page_name = 'การเงิน / รายได้';

    if (isset($_GET['s']) && isset($_GET['pm'])) {
        $query    = "SELECT * FROM tbl_payment WHERE pm_id = ".$_GET['pm'];
        $result = mysqli_query($conn, $query) or die(mysql_error());

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            
            $query    = "UPDATE tbl_payment SET pm_status = '".$_GET['s']."' WHERE pm_id = ".$_GET['pm'];
            $result   = mysqli_query($conn, $query);
            
            if ($_GET['s'] == 2) {
                $query_shop    = "SELECT * FROM tbl_shop WHERE s_id = ".$row['pm_shop_id'];
                $result_shop = mysqli_query($conn, $query_shop) or die(mysql_error());
                $row_shop = mysqli_fetch_assoc($result_shop);

                $new_expire = date('Y-m-d',strtotime('+30 days',strtotime($row_shop['s_expire']))) . PHP_EOL;

                $query    = "UPDATE tbl_shop SET s_pro = '".$row['pm_package']."', s_expire = '".$new_expire."' WHERE s_id = ".$row['pm_shop_id'];
                $result   = mysqli_query($conn, $query);

                if ($result) {
                    echo "<script>alert('บันทึกข้อมูลแล้ว'); window.location.replace('income.php');</script>";
                } else {
                    echo "<script>alert('มีข้อผิดพลาดกรุณาลองใหม่'); window.location.replace('income.php');</script>";
                }
            } else {
                echo "<script>alert('บันทึกข้อมูลแล้ว'); window.location.replace('income.php');</script>";
            }
        } else {
            echo "<script>alert('มีข้อผิดพลาดกรุณาลองใหม่'); window.location.replace('income.php');</script>";
        }
        
    }

    $query    = "SELECT * FROM tbl_payment
                INNER JOIN tbl_shop ON tbl_payment.pm_shop_id = tbl_shop.s_id
                WHERE pm_status = '1'";
    $result = mysqli_query($conn, $query) or die(mysql_error());

    $curr_month = date('m');

    $query_sum    = "SELECT SUM(pm_total) as sum FROM tbl_payment
                        INNER JOIN tbl_shop ON tbl_payment.pm_shop_id = tbl_shop.s_id
                        WHERE MONTH(pm_date) = '".$curr_month."' AND pm_status = '2'";
    $result_sum = mysqli_query($conn, $query_sum) or die(mysql_error());
    $row_sum = mysqli_fetch_assoc($result_sum);

    $query_total    = "SELECT * FROM tbl_payment
                        INNER JOIN tbl_shop ON tbl_payment.pm_shop_id = tbl_shop.s_id
                        WHERE MONTH(pm_date) = '".$curr_month."' AND pm_status = '2'";
    $result_total = mysqli_query($conn, $query_total) or die(mysql_error());
?>

<?php include 'include/header.php'; ?>

    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor"><?php echo $page_name; ?></h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><?php echo $page_name; ?></li>
                </ol>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->

        <div class="card">
            <div class="card-header">
                รอการอนุมัติ (ใช้งานแพ็คเกจ)
                <div style="float: right; text-decoration: underline;">
                    <a href="income-history.php">ประวัติการเงิน / รายได้</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table display table-bordered table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ชื่อร้านค้า</th>
                                <th>แพ็คเกจ</th>
                                <th>ยอดเงิน</th>
                                <th>สลิป</th>
                                <th>หมายเหตุ</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                        if ($row['pm_package'] == 2) {
                                            $package = 'Premium';
                                        } elseif ($row['pm_package'] == 3) {
                                            $package = 'Premium Plus';
                                        } else {
                                            $package = 'Begin';
                                        }
                            ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $row['s_shop_name']; ?></td>
                                    <td><?php echo $package; ?></td>
                                    <td><?php echo $row['pm_total']; ?></td>
                                    <td>
                                        <img src="../uploads/slip/<?php echo $row['pm_slip']; ?>" style="width: 100px;">
                                    </td>
                                    <td><?php echo $row['pm_note']; ?></td>
                                    <td>
                                        <a href="income.php?s=2&pm=<?php echo $row['pm_id']; ?>" class="btn btn-primary">อนุมัติ</a>
                                        <a href="income.php?s=0&pm=<?php echo $row['pm_id']; ?>" class="btn btn-danger">ไม่อนุมัติ</a>
                                    </td>
                                </tr>
                            <?php }} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                รายได้ เดือนนี้ <span style="color: green; font-size: 18px;"><?php echo $row_sum['sum']; ?>฿</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table display table-bordered table-striped">
                        <tbody>
                            <?php
                                if (mysqli_num_rows($result_total) > 0) {
                                    while($row_total = mysqli_fetch_assoc($result_total)) {
                            ?>
                                <tr>
                                    <td>
                                        <div style="display: inline-block;">
                                            <?php echo $row_total['s_name']; ?><br>
                                            <div style="font-size: 13px;">
                                                <?php echo $row_total['pm_time']; ?>
                                            </div>
                                        </div>
                                        <div style="float: right; color: green; font-size: 16px;">
                                            +<?php echo $row_total['pm_total']; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php }} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->


<?php include 'include/footer.php'; ?>