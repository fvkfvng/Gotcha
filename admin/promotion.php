<?php
    require_once '../config/connection.php';
    
    if (!isset($_SESSION['admin'])) {
        header('Location: login.php');
    }

    $page_name = 'โปรโมชั่น';

    $query    = "SELECT * FROM tbl_promotion ORDER BY p_id DESC";
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

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table display table-bordered table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th>รูปภาพโปรโมท</th>
                                <th>ข้อความบรรยาย</th>
                                <th>วันและเวลาปล่อยข่าวสาร</th>
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
                                    <td></td>
                                    <td><?php echo $row['p_detail']; ?></td>
                                    <td><?php echo $row['p_date']; ?> <?php echo $row['p_time']; ?></td>
                                    <td></td>
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