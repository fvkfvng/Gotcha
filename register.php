<?php
    require('config/connection.php');

    if(!isset($_SESSION['uline_token']) && !isset($_SESSION['uline_user'])){    
        header('location: login.php');
        exit;
    }

    $lineUserData = json_decode($_SESSION['uline_user'], true);

    $line_id = $lineUserData['sub'];
    $line_picture = $lineUserData['picture'];

    $page_name = "ลงทะเบียนสำหรับลูกค้า";

    $query    = "SELECT * FROM tbl_user WHERE u_line_user = '".$line_id."'";
    $result = mysqli_query($conn, $query) or die(mysql_error());
    if (mysqli_num_rows($result) > 0) {
        header('location: index.php');
    }

    if (isset($_POST['btnRegister'])) {
        $line_id        = stripslashes($_POST['line_id']); // removes backslashes
        $line_id        = mysqli_real_escape_string($conn, $line_id); //escapes special characters in a string
        $name           = stripslashes($_POST['name']); // removes backslashes
        $name           = mysqli_real_escape_string($conn, $name); //escapes special characters in a string
        $email          = stripslashes($_POST['email']);
        $email          = mysqli_real_escape_string($conn, $email);
        $tel            = stripslashes($_POST['tel']);
        $tel            = mysqli_real_escape_string($conn, $tel);
        $dayofbirth     = stripslashes($_POST['dayofbirth']);
        $dayofbirth     = mysqli_real_escape_string($conn, $dayofbirth);
        $monthofbirth   = stripslashes($_POST['monthofbirth']);
        $monthofbirth   = mysqli_real_escape_string($conn, $monthofbirth);
        $yearofbirth    = stripslashes($_POST['yearofbirth']);
        $yearofbirth    = mysqli_real_escape_string($conn, $yearofbirth);

        $date = date('Y-m-d');

        $query = "INSERT INTO tbl_user (u_line_user, u_line_img, u_name, u_email, u_tel, u_day, u_month, u_year, u_date)
                 VALUES ('$line_id', '$line_picture', '$name', '$email', '$tel', '$dayofbirth', '$monthofbirth', '$yearofbirth', '".$date."')";
        $result   = mysqli_query($conn, $query);
        
        if ($result) {
            echo "<script>window.location.replace('index.php');</script>";
        } else {
            echo "<script>alert('มีข้อผิดพลาดกรุณาลองใหม่'); window.location.replace('register.php');</script>";
        }
    }

    $curr_year = date('Y') + 543;
?>

<?php include 'include/header.php'; ?>

    <h1 class="site-title">GOTCHA!</h1>
    <?php if (isset($_GET['success'])) { ?>
        <div id="page-success" class="form-container">
            <img src="images/check.png">
            <div class="title-success">
                ทำรายการสำเร็จ!
            </div>
            <div class="text-success">
                สมัครสมาชิกสำเร็จ !!
            </div>
            <a href="index.php" class="btn btn-primary">หน้าแรก</a>
        </div>
    <?php } else { ?>
        <form id="form-register" class="form-container" enctype="multipart/form-data" method="post">
            <h2 class="form-title">สมัครสมาชิก</h2>
            <div class="profile-picture">
                <img style="width:100px;" src="<?php echo $line_picture; ?>" />
            </div>
            <input type="hidden" name="line_id" id="line_id" value="<?php echo $line_id; ?>">
            <div class="form-group">
                <label for="name">ชื่อ-นามสกุล</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="ชื่อ-นามสกุล">
                <div class="input-error input-name"></div>
            </div>
            <div class="form-group">
                <label for="email">อีเมล</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="อีเมล">
                <div class="input-error input-email"></div>
            </div>
            <div class="form-group">
                <label for="tel">เบอร์โทรศัพท์</label>
                <input type="text" class="form-control" name="tel" id="tel" placeholder="เบอร์โทรศัพท์">
                <div class="input-error input-tel"></div>
            </div>
            <div class="form-group">
                <label for="dateofbirth">วัน เดือน ปีเกิด</label>
                <div class="row">
                    <div class="col-xs-4">
                        <select name="dayofbirth" id="dayofbirth" class="form-control">
                            <option value="">วัน</option>
                            <?php for ($d = 1; $d <= 31; $d++) { ?>
                                <option value="<?php echo $d; ?>"><?php echo $d; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-xs-4">
                        <select name="monthofbirth" id="monthofbirth" class="form-control">
                            <option value="">เดือน</option>
                            <option value="มกราคม">มกราคม</option>
                            <option value="กุมภาพันธ์">กุมภาพันธ์</option>
                            <option value="มีนาคม">มีนาคม</option>
                            <option value="เมษายน">เมษายน</option>
                            <option value="พฤษภาคม">พฤษภาคม</option>
                            <option value="มิถุนายน">มิถุนายน</option>
                            <option value="กรกฎาคม">กรกฎาคม</option>
                            <option value="สิงหาคม">สิงหาคม</option>
                            <option value="กันยายน">กันยายน</option>
                            <option value="ตุลาคม">ตุลาคม</option>
                            <option value="พฤศจิกายน">พฤศจิกายน</option>
                            <option value="ธันวาคม">ธันวาคม</option>
                        </select>
                    </div>
                    <div class="col-xs-4">
                        <select name="yearofbirth" id="yearofbirth" class="form-control">
                            <option value="">ปี</option>
                            <?php for ($y = $curr_year-100; $y <= $curr_year; $y++) { ?>
                                <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <div class="input-error input-date"></div>
                    </div>
                </div>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" id="agree1"> ฉันยอมรับข้อตกลง และนโยบายความเป็นส่วนตัว</label>
                <label><input type="checkbox" id="agree2"> ฉันยินยอมรับข้อมูลข่าวสาร กิจกรรมส่งเสริมการขายต่างๆ จาก Gotcha โดยเราจะเก็บข้อมูลของท่านไว้เป็นความลับ สามารถศึกษาเงื่อนไข/ข้อตกลง <a href="#">นโยบายความเป็นส่วนตัว</a></label>
            </div>
            <button type="submit" class="btn btn-primary" id="btn-submit" name="btnRegister" disabled>สมัครสมาชิก</button>
            <a href="index.php" class="next btn btn-danger">ยกเลิก</a>
        </form>
    <?php } ?>
    
<?php include 'include/footer.php'; ?>