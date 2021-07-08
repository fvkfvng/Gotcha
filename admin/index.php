<?php
    require_once '../config/connection.php';
    
    if (!isset($_SESSION['admin'])) {
        header('Location: login.php');
    }

    $page_name = 'แผงควบคุม';

    if (isset($_GET['id']) && isset($_GET['s'])) {
        $query    = "UPDATE tbl_shop SET s_status = '".$_GET['s']."' WHERE s_id = ".$_GET['id'];
        $result   = mysqli_query($conn, $query);
        
        if ($result) {
            echo "<script>alert('บันทึกข้อมูลแล้ว'); window.location.replace('index.php');</script>";
        } else {
            echo "<script>alert('มีข้อผิดพลาดกรุณาลองใหม่'); window.location.replace('index.php');</script>";
        }
    }

    $date = date('Y-m-d');

    $query_cshop    = "SELECT COUNT(*) as count_shop FROM tbl_shop WHERE s_status = '2'";
    $result_cshop = mysqli_query($conn, $query_cshop) or die(mysql_error());
    $row_cshop = mysqli_fetch_assoc($result_cshop);

    $query_cshop_today    = "SELECT COUNT(*) as count_shop FROM tbl_shop WHERE s_status = '2' AND s_date = '".$date."'";
    $result_cshop_today = mysqli_query($conn, $query_cshop_today) or die(mysql_error());
    $row_cshop_today = mysqli_fetch_assoc($result_cshop_today);

    $query_cuser    = "SELECT COUNT(*) as count_user FROM tbl_user";
    $result_cuser = mysqli_query($conn, $query_cuser) or die(mysql_error());
    $row_cuser = mysqli_fetch_assoc($result_cuser);

    $query_cuser_today    = "SELECT COUNT(*) as count_user FROM tbl_user WHERE u_date = '".$date."'";
    $result_cuser_today = mysqli_query($conn, $query_cuser_today) or die(mysql_error());
    $row_cuser_today = mysqli_fetch_assoc($result_cuser_today);

    $query    = "SELECT * FROM tbl_shop
                INNER JOIN tbl_shop_file ON tbl_shop.s_id = tbl_shop_file.sf_shop
                INNER JOIN tbl_shop_image ON tbl_shop.s_id = tbl_shop_image.si_shop
                WHERE s_status = '1'";
    $result = mysqli_query($conn, $query) or die(mysql_error());
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
        <!-- ============================================================== -->
        <!-- Info box -->
        <!-- ============================================================== -->
        
        
        <div class="row counter">
            <!-- Column -->
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-header">สมาชิก</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <h6 class="text-muted mb-0 text-uppercase">ผู้ประกอบการ</h6>
                                <h2 class="counter"><span class="counter-count"><?php echo $row_cshop['count_shop']; ?></h2>
                                <h6 class="text-muted mb-0 text-uppercase">คน</h6>

                                <br><br>
                                <?php if ($row_cshop_today['count_shop'] > 0) { ?>
                                    <h2 class="counter"><span class="counter-count">
                                        <i class="fa fa-arrow-up" aria-hidden="true"></i>
                                        + <?php echo $row_cshop_today['count_shop']; ?>
                                    </h2>
                                <?php } ?>
                                <a href="index.php">ดูเพิ่มเติม</a>
                            </div>
                            <div class="col-md-6 text-center">
                                <h6 class="text-muted mb-0 text-uppercase">ลูกค้าทั่วไป</h6>
                                <h2 class="counter"><span class="counter-count"><?php echo $row_cuser['count_user']; ?></h2>
                                <h6 class="text-muted mb-0 text-uppercase">คน</h6>

                                <?php if ($row_cuser_today['count_user'] > 0) { ?>
                                    <br><br>
                                    <h2 class="counter"><span class="counter-count">
                                        <i class="fa fa-arrow-up" aria-hidden="true"></i>
                                        + <?php echo $row_cuser_today['count_user']; ?>
                                    </h2>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-header">ออนไลน์</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <h6 class="text-muted mb-0 text-uppercase">ผู้ประกอบการ</h6>
                                <h2 class="counter"><span class="counter-count"><?php echo $row_cshop['count_shop']; ?></h2>
                                <h6 class="text-muted mb-0 text-uppercase">คน</h6>
                            </div>
                            <div class="col-md-6 text-center">
                                <h6 class="text-muted mb-0 text-uppercase">ลูกค้าทั่วไป</h6>
                                <h2 class="counter"><span class="counter-count"><?php echo $row_cuser['count_user']; ?></h2>
                                <h6 class="text-muted mb-0 text-uppercase">คน</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Info box -->
        <!-- ============================================================== -->

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">รอการอนุมัติ</h4>
                <div class="table-responsive mt-40">
                    <table id="example" class="table display table-bordered table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ชื่อร้านค้า</th>
                                <th>ประเภทร้านค้า</th>
                                <th>ราคา : คะแนน</th>
                                <th>ภาพถ่าย</th>
                                <th>โลเคชั่นร้าน</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $row['s_shop_name']; ?></td>
                                    <td><?php echo $row['s_shop_type']; ?></td>
                                    <td><?php echo $row['s_shop_price']; ?>B : <?php echo $row['s_shop_point']; ?>P</td>
                                    <td>
                                        <img src="../uploads/shop/<?php echo $row['si_image']; ?>" style="width: 120px;">
                                    </td>
                                    <td><?php echo $row['s_latitude']; ?>, <?php echo $row['s_longitude']; ?></td>
                                    <td>
                                        <a href="index.php?id=<?php echo $row['s_id']; ?>&s=2" class="btn btn-success" onclick="return confirm('อนุมัติร้านค้า ?')">อนุมัติ</a>
                                        <a href="index.php?id=<?php echo $row['s_id']; ?>&s=0" class="btn btn-danger" onclick="return confirm('ไม่อนุมัติร้านค้า ?')">ไม่</a>
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