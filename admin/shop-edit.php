<?php
    require_once '../config/connection.php';
    
    if (!isset($_SESSION['admin'])) {
        header('Location: login.php');
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header('Location: shop.php');
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

    $query    = "SELECT * FROM tbl_shop WHERE s_id = ".$id;
    $result = mysqli_query($conn, $query) or die(mysql_error());
    $row    = $result->fetch_assoc();

    $curr_year = date('Y') + 543;
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
                ?>
                    <form method="post">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div class="profile-picture">
                                    <img style="width:100px;" src="<?php echo $row['s_line_img']; ?>" />
                                </div>
                            </div>
                        </div>
                        <br>
                        <h3 class="form-title">ข้อมูลส่วนตัว</h3>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">ชื่อ-นามสกุล</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="ชื่อ-นามสกุล" value="<?php echo $row['s_name']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">อีเมล</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="อีเมล" value="<?php echo $row['s_email']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tel">เบอร์โทรศัพท์</label>
                                    <input type="text" class="form-control" name="tel" id="tel" placeholder="เบอร์โทรศัพท์" value="<?php echo $row['s_tel']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="dateofbirth">วัน เดือน ปีเกิด</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select name="dayofbirth" id="dayofbirth" class="form-control">
                                                <option value="">วัน</option>
                                                <?php for ($d = 1; $d <= 31; $d++) { ?>
                                                    <option value="<?php echo $d; ?>" <?php if ($d == $row['s_day']) { echo 'selected'; } ?>><?php echo $d; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="monthofbirth" id="monthofbirth" class="form-control">
                                                <option value="">เดือน</option>
                                                <option value="มกราคม" <?php if ($row['s_month'] == 'มกราคม') { echo 'selected'; } ?>>มกราคม</option>
                                                <option value="กุมภาพันธ์" <?php if ($row['s_month'] == 'กุมภาพันธ์') { echo 'selected'; } ?>>กุมภาพันธ์</option>
                                                <option value="มีนาคม" <?php if ($row['s_month'] == 'มีนาคม') { echo 'selected'; } ?>>มีนาคม</option>
                                                <option value="เมษายน" <?php if ($row['s_month'] == 'เมษายน') { echo 'selected'; } ?>>เมษายน</option>
                                                <option value="พฤษภาคม" <?php if ($row['s_month'] == 'พฤษภาคม') { echo 'selected'; } ?>>พฤษภาคม</option>
                                                <option value="มิถุนายน" <?php if ($row['s_month'] == 'มิถุนายน') { echo 'selected'; } ?>>มิถุนายน</option>
                                                <option value="กรกฎาคม" <?php if ($row['s_month'] == 'กรกฎาคม') { echo 'selected'; } ?>>กรกฎาคม</option>
                                                <option value="สิงหาคม" <?php if ($row['s_month'] == 'สิงหาคม') { echo 'selected'; } ?>>สิงหาคม</option>
                                                <option value="กันยายน" <?php if ($row['s_month'] == 'กันยายน') { echo 'selected'; } ?>>กันยายน</option>
                                                <option value="ตุลาคม" <?php if ($row['s_month'] == 'ตุลาคม') { echo 'selected'; } ?>>ตุลาคม</option>
                                                <option value="พฤศจิกายน" <?php if ($row['s_month'] == 'พฤศจิกายน') { echo 'selected'; } ?>>พฤศจิกายน</option>
                                                <option value="ธันวาคม" <?php if ($row['s_month'] == 'ธันวาคม') { echo 'selected'; } ?>>ธันวาคม</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="yearofbirth" id="yearofbirth" class="form-control">
                                                <option value="">ปี</option>
                                                <?php for ($y = $curr_year-100; $y <= $curr_year; $y++) { ?>
                                                    <option value="<?php echo $y; ?>" <?php if ($y == $row['s_year']) { echo 'selected'; } ?>><?php echo $y; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>
                        <h3 class="form-title">ข้อมูลร้านค้า / บัตร</h3>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shop_name">ชื่อร้านค้า</label>
                                    <input type="text" class="form-control" name="shop_name" id="shop_name" placeholder="ชื่อร้านค้า"  value="<?php echo $row['s_shop_name']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="shop_type">ประเภทร้านค้า</label>
                                    <input type="text" class="form-control" name="shop_type" id="shop_type" placeholder="ประเภทร้านค้า"  value="<?php echo $row['s_shop_type']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="shop_branch">สาขา</label><br>
                                    <input type="radio" name="shop_branch" id="shop_branch1" value="1" <?php if ($row['s_shop_branch'] == '1') { echo 'checked'; } ?>> 1 สาขา
                                    <input type="radio" name="shop_branch" id="shop_branch2" value="2" <?php if ($row['s_shop_branch'] == '2') { echo 'checked'; } ?> style="margin-left: 10px;"> มากกว่า 1 สาขา<br>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shop_point">เงื่อนไขการให้ ราคา : คะแนน</label>
                                    <div class="row">
                                        <div class="col-md-6"><input type="text" class="form-control" name="shop_price" id="shop_price" placeholder="ราคา" value="<?php echo $row['s_shop_price']; ?>"></div>
                                        <div class="col-md-6"><input type="text" class="form-control" name="shop_point" id="shop_point" placeholder="คะแนน" value="<?php echo $row['s_shop_point']; ?>"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="detail">รายละเอียดหรือเงื่อนไขรับของรางวัล</label>
                                    <textarea class="form-control" name="shop_detail" id="shop_detail" placeholder="เช่น ซื้อเครื่องดื่มสะสมครบ 100 คะแนน รับฟรี! 2 แก้ว" rows="5"></textarea>
                                    <div class="input-error input-shop-detail"><?php echo $row['s_shop_detail']; ?></div>
                                </div>
                            </div>
                        </div>
                        
                        <br>
                        <h3 class="form-title">ข้อมูลเพื่อตรวจสอบ</h3>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="map">ปักตำแหน่งร้านค้า</label><br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="latitude" name="latitude" placeholder="ละติจูด" value="<?php echo $row['s_latitude']; ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="longitude" name="longitude" placeholder="ลองจิจูด" value="<?php echo $row['s_longitude']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">ที่อยู่ร้านค้า</label>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="address_no" id="address_no" placeholder="เลขที่" value="<?php echo $row['s_address_no']; ?>">
                                                <div class="input-error input-address-no"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="address_floor" id="address_floor" placeholder="ชั้นที่" value="<?php echo $row['s_address_floor']; ?>">
                                                <div class="input-error input-address-floor"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="address_company" id="address_company" placeholder="ชื่อบริษัท (ถ้ามี)" value="<?php echo $row['s_address_company']; ?>">
                                                <div class="input-error input-address-company"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea class="form-control" placeholder="รายละเอียดเพิ่มเติม เช่นจุดสังเกตุ" name="address_detail" id="address_detail" rows="5"><?php echo $row['s_address_detail']; ?></textarea>
                                                <div class="input-error input-address-detail"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="account">รายการเดินบัญชีร้านค้า</label>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                                $query    = "SELECT * FROM tbl_shop_file WHERE sf_shop = ".$row['s_id'];
                                                $result = mysqli_query($conn, $query) or die(mysql_error());
                                                 if (mysqli_num_rows($result) > 0) {
                                                    while($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <a href="../uploads/account/<?php echo $row['sf_file']; ?>" target="_blank"><?php echo $row['sf_file']; ?></a><br>
                                            <?php }} ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image">ภาพถ่าย</label>
                                    <div class="row">
                                        <?php
                                            $query    = "SELECT * FROM tbl_shop_image WHERE si_shop = ".$row['s_id'];
                                            $result = mysqli_query($conn, $query) or die(mysql_error());
                                             if (mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <div class="col-md-12">
                                                <img src="../uploads/shop/<?php echo $row['si_image']; ?>" width='100%'>
                                            </div>
                                        <?php }} ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info" name="btnSave">แก้ไข</button>
                    </form>
                <?php } ?>
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