<?php
    require_once '../config/connection.php';
    
    if (!isset($_SESSION['admin'])) {
        header('Location: login.php');
    }

    $page_name = 'ร้านค้าในระบบ';

    if (isset($_GET['id']) && isset($_GET['s'])) {
        $query    = "UPDATE tbl_shop SET s_status = '".$_GET['s']."' WHERE s_id = ".$_GET['id'];
        $result   = mysqli_query($conn, $query);
        
        if ($result) {
            echo "<script>alert('บันทึกข้อมูลแล้ว'); window.location.replace('dashboard.php');</script>";
        } else {
            echo "<script>alert('มีข้อผิดพลาดกรุณาลองใหม่'); window.location.replace('dashboard.php');</script>";
        }
    }

    $query    = "SELECT * FROM tbl_shop
                INNER JOIN tbl_shop_file ON tbl_shop.s_id = tbl_shop_file.sf_shop
                INNER JOIN tbl_shop_image ON tbl_shop.s_id = tbl_shop_image.si_shop
                WHERE s_status = '2' OR s_status = '0'";
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
                                        <a href="shop-edit.php?id=<?php echo $row['s_id']; ?>" class="btn btn-warning">แก้ไข</a>
                                        <a href="shop.php?delete&id=<?php echo $row['s_id']; ?>" class="btn btn-danger">ลบ</a>
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