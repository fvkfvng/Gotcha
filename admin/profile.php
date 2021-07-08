<?php
    require_once '../config/connection.php';
    
    if (!isset($_SESSION['admin'])) {
        header('Location: login.php');
    }

    $page_name = 'แก้ไขข้อมูลส่วนตัว';

    if (isset($_POST['btnSave'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query    = "UPDATE tbl_admin SET a_username = '".$username."', a_password = '".$password."' WHERE a_id = ".$_SESSION['admin'];
        $result   = mysqli_query($conn, $query);
        
        if ($result) {
            echo "<script>alert('บันทึกข้อมูลแล้ว'); window.location.replace('profile.php');</script>";
        } else {
            echo "<script>alert('มีข้อผิดพลาดกรุณาลองใหม่'); window.location.replace('profile.php');</script>";
        }
    }

    $query    = "SELECT * FROM tbl_admin WHERE a_id = ".$_SESSION['admin'];
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
                <?php
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                ?>
                    <form method="post" style="max-width: 300px;">
                        <div class="form-group">
                            <label for="username">ชื่อผู้ใช้:</label>
                            <input type="username" class="form-control" id="username" name="username" value="<?php echo $row['a_username']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">รหัสผ่าน:</label>
                            <input type="password" class="form-control" id="password" name="password" value="<?php echo $row['a_password']; ?>">
                        </div>
                        <button type="submit" class="btn btn-info" name="btnSave">แก้ไข</button>
                    </form>
                <?php }} ?>
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