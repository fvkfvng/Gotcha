<?php
    require('../config/connection.php');

    if(!isset($_SESSION['line_token']) && !isset($_SESSION['line_user'])){    
        header('location: login.php');
        exit;
    }

    $lineUserData = json_decode($_SESSION['line_user'], true);

    $line_id = $lineUserData['sub'];
    $line_picture = $lineUserData['picture'];

    // check shop register
    $query    = "SELECT * FROM tbl_shop WHERE s_line_user = '".$line_id."'";
    $result = mysqli_query($conn, $query) or die(mysql_error());

    $message = '';

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            if ($row['s_status'] == 2) {
                header('location: index.php');
            } elseif ($row['s_status'] == 1) {
                $message = 'success';
            } else {
                $message = 'error';
            }
            
        }
    }

    $page_name = "ลงทะเบียน";
    
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

        $shop_name      = stripslashes($_POST['shop_name']); // removes backslashes
        $shop_name      = mysqli_real_escape_string($conn, $shop_name); //escapes special characters in a string
        $shop_type      = stripslashes($_POST['shop_type']);
        $shop_type      = mysqli_real_escape_string($conn, $shop_type);
        $shop_branch    = stripslashes($_POST['shop_branch']);
        $shop_branch    = mysqli_real_escape_string($conn, $shop_branch);
        $shop_point     = stripslashes($_POST['shop_point']);
        $shop_point     = mysqli_real_escape_string($conn, $shop_point);
        $shop_price     = stripslashes($_POST['shop_price']);
        $shop_price     = mysqli_real_escape_string($conn, $shop_price);
        $shop_detail    = stripslashes($_POST['shop_detail']);
        $shop_detail    = mysqli_real_escape_string($conn, $shop_detail);

        $latitude    = stripslashes($_POST['latitude']);
        $latitude    = mysqli_real_escape_string($conn, $latitude);
        $longitude    = stripslashes($_POST['longitude']);
        $longitude    = mysqli_real_escape_string($conn, $longitude);
        $address_no    = stripslashes($_POST['address_no']);
        $address_no    = mysqli_real_escape_string($conn, $address_no);
        $address_floor    = stripslashes($_POST['address_floor']);
        $address_floor    = mysqli_real_escape_string($conn, $address_floor);
        $address_company    = stripslashes($_POST['address_company']);
        $address_company    = mysqli_real_escape_string($conn, $address_company);
        $address_detail    = stripslashes($_POST['address_detail']);
        $address_detail    = mysqli_real_escape_string($conn, $address_detail);

        $file_account   = $_FILES['account'];
        $shop_image     = $_FILES['image'];

        $date = date('Y-m-d');
        $new_expire = date('Y-m-d',strtotime('+30 days',strtotime($date))) . PHP_EOL;

        $query = "INSERT INTO tbl_shop (s_line_user, s_line_img, s_name, s_email, s_tel, s_day, s_month, s_year, s_shop_name, s_shop_type, s_shop_branch, s_shop_point, s_shop_price, s_shop_detail, s_latitude, s_longitude, s_address_no, s_address_floor, s_address_company, s_address_detail, s_date, s_expire)
                 VALUES ('$line_id', '$line_picture', '$name', '$email', '$tel', '$dayofbirth', '$monthofbirth', '$yearofbirth', '$shop_name', '$shop_type', '$shop_branch', '$shop_point', '$shop_price', '$shop_detail', '$latitude', '$longitude', '$address_no', '$address_floor', '$address_company', '$address_detail', '".$date."', '".$new_expire."')";
        $result   = mysqli_query($conn, $query);

        if ($result) {

            $last_id = mysqli_insert_id($conn);

            if (isset($file_account)) {
                foreach($file_account['tmp_name'] as $key => $val) {

                    $file     = $file_account;
                    $filePath = '';
                    $uploadDir = '../uploads/account/';

                    if (trim($file['tmp_name'][$key]) != '') {
                        $ext = substr(strrchr($file['name'][$key], "."), 1); 

                        $filePath = md5(rand() * time()) . ".$ext";

                        if (!move_uploaded_file($file['tmp_name'][$key], $uploadDir . $filePath)) {
                            $filePath = '';
                        }
                    }

                    $query = "INSERT INTO tbl_shop_file (sf_shop, sf_file) VALUES ('$last_id', '$filePath')";
                    $result   = mysqli_query($conn, $query);
                }
            }

            if (isset($shop_image)) {
                $img     = $shop_image;
                $imgPath = '';
                $uploadDir = '../uploads/shop/';

                if (trim($img['tmp_name']) != '') {
                    $ext = substr(strrchr($img['name'], "."), 1); 

                    $imgPath = md5(rand() * time()) . ".$ext";

                    if (!move_uploaded_file($img['tmp_name'], $uploadDir . $imgPath)) {
                        $imgPath = '';
                    }
                }

                $query = "INSERT INTO tbl_shop_image (si_shop, si_image) VALUES ('$last_id', '$imgPath')";
                $result   = mysqli_query($conn, $query);
            }

            echo "<script>window.location.replace('register.php');</script>";
        } else {
            echo "<script>alert('มีข้อผิดพลาดกรุณาลองใหม่'); window.location.replace('register.php');</script>";
        }
    }

    $curr_year = date('Y') + 543;
?>

<?php include 'include/header.php'; ?>

    <h1 class="site-title">GOTCHA!</h1>
    <?php if ($message == 'success') { ?>
        <div id="page-success" class="form-container">
            <img src="../images/check.png">
            <div class="title-success">
                ทำรายการสำเร็จ!
            </div>
            <div class="text-success">
                โปรดรอการดำเนินการตรวจสอบร้านค้าของคุณ เมื่อผ่านการอนุมัติจะแจ้งข้อความไปยังอีเมลของคุณ ขอบคุณและยินดีต้อนรับสมาชิกใหม่
            </div>
        </div>
    <?php } else { ?>
        <form id="form-register" class="form-container" enctype="multipart/form-data" method="post">
            <fieldset id="profile">
                <h2 class="form-title">ข้อมูลส่วนตัว</h2>
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
                <button type="button" class="next btn btn-primary" id="next1" disabled>ดำเนินการต่อ</button>
                <a href="index.php" class="next btn btn-danger">ยกเลิก</a>
            </fieldset>
            
            <fieldset id="shop">
                <h2 class="form-title">ข้อมูลร้านค้า / บัตร</h2>
                <div class="form-group">
                    <label for="shop_name">ชื่อร้านค้า</label>
                    <input type="text" class="form-control" name="shop_name" id="shop_name" placeholder="ชื่อร้านค้า">
                    <div class="input-error input-shop-name"></div>
                </div>
                <div class="form-group">
                    <label for="shop_type">ประเภทร้านค้า</label>
                    <input type="text" class="form-control" name="shop_type" id="shop_type" placeholder="ประเภทร้านค้า">
                    <div class="input-error input-shop-type"></div>
                </div>
                <div class="form-group">
                    <label for="shop_branch">สาขา</label><br>
                    <input type="radio" name="shop_branch" id="shop_branch1" value="1"> 1 สาขา
                    <input type="radio" name="shop_branch" id="shop_branch2" value="2" style="margin-left: 10px;"> มากกว่า 1 สาขา<br>
                    <div class="input-error input-shop-branch"></div>
                </div>
                <div class="form-group">
                    <label for="shop_point">เงื่อนไขการให้ ราคา : คะแนน</label>
                    <div class="row">
                        <div class="col-xs-6"><input type="text" class="form-control" name="shop_price" id="shop_price" placeholder="ราคา"></div>
                        <div class="col-xs-6"><input type="text" class="form-control" name="shop_point" id="shop_point" placeholder="คะแนน"></div>
                        <div class="col-md-12">
                            <div class="input-error input-shop-price"></div>
                        </div>
                    </div>
                    <div class="input-note">ตัวอย่าง : 100฿ / 10P เช่นลูกค้าซื้อสินค้าและบริการ 500฿ ลูกค้าจะได้รับ 50 คะแนน<br>**คะแนนเต็ม 100 คะแนน โปรดพิจารณาตามความเหมาะสมของสินค้าและบริการของคุณ**</div>
                </div>
                <div class="form-group">
                    <label for="detail">รายละเอียดหรือเงื่อนไขรับของรางวัล</label>
                    <textarea class="form-control" name="shop_detail" id="shop_detail" placeholder="เช่น ซื้อเครื่องดื่มสะสมครบ 100 คะแนน รับฟรี! 2 แก้ว" rows="5"></textarea>
                    <div class="input-error input-shop-detail"></div>
                </div>
                <button type="button" class="next btn btn-primary" id="next2">ดำเนินการต่อ</button>
                <a href="index.php" class="next btn btn-danger">ยกเลิก</a>
            </fieldset>
            
            <fieldset id="shop-address">
                <h2 class="form-title">ข้อมูลเพื่อตรวจสอบ</h2>
                <div class="form-group">
                    <label for="map">ปักตำแหน่งร้านค้า</label><br>
                    <div class="row">
                        <div class="col-xs-6">
                            <input type="text" class="form-control" id="latitude" name="latitude" placeholder="ละติจูด">
                        </div>
                        <div class="col-xs-6">
                            <input type="text" class="form-control" id="longitude" name="longitude" placeholder="ลองจิจูด">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">ที่อยู่ร้านค้า</label>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="address_no" id="address_no" placeholder="เลขที่">
                                <div class="input-error input-address-no"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="address_floor" id="address_floor" placeholder="ชั้นที่">
                                <div class="input-error input-address-floor"></div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="address_company" id="address_company" placeholder="ชื่อบริษัท (ถ้ามี)">
                                <div class="input-error input-address-company"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control" placeholder="รายละเอียดเพิ่มเติม เช่นจุดสังเกตุ" name="address_detail" id="address_detail" rows="5"></textarea>
                                <div class="input-error input-address-detail"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="account">รายการเดินบัญชีร้านค้า</label>
                    <div class="label-note">รายการเดินบัญชีสามารถยื่นขอได้ใน Mobile banking หรือกับธนาคาร โดยจะต้องใช้รายการเดินบัญชีย้อนหลังอย่างน้อย 6 เดือน รูปแบบไฟล์ .pdf เท่านั้น</div>
                    <input type="file" class="form-control" name="account[]" multiple accept=".pdf">
                </div>
                <div class="form-group">
                    <label for="image">ภาพถ่าย</label>
                    <div class="label-note">ตัวอย่าง : ถาพถ่ายควรถ่ายให้เห็นภาพรวมทั้งหมดของร้านค้า เพื่อง่ายต่อการอนุมัติจากแอดมิน เพื่อยืนยันว่าร้านค้าของคุณเป็นขนาดเล็ก - ขนาดกลาง เท่านั้น</div>
                    <input type="file" class="form-control" name="image" accept="image/*">
                </div>
                <button type="button" class="next btn btn-primary" id="next3">ดำเนินการต่อ</button>
                <a href="index.php" class="next btn btn-danger">ยกเลิก</a>
            </fieldset>

            <fieldset id="privacy">
                <h2 class="form-title">นโยบายความเป็นส่วนตัว</h2>
                <div class="form-text">
                    สืบเนื่องจาก พ.ร.บ.คุ้มครองข้อมูลส่วนบุคคล พ.ศ.2562 (Personal Data Protection Act) ถูกบังคับใช้สำหรับคุ้มครองข้อมูลส่วนบุคคล ดังนั้น บริษัท ก็อต ชา (ประเทศไทย) (“บริษัท”) จึงขอความยินยอมการปฏิบัติต่อข้อมูลส่วนบุคคลของท่าน เช่น การเก็บรวบรวม การใช้ข้อมูล การประมวลผลข้อมูล เป็นต้น บริษัทจึงประกาศนโยบายการคุ้มข้อมูลส่วนบุคคล
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" id="agree3"> ฉันยินยอมให้ข้อมูลส่วนตัวตามนโยบายส่วนตัวของบริษัท</label>
                </div>
                <button type="submit" class="btn btn-primary" id="btn-submit" name="btnRegister" disabled>ดำเนินการต่อ</button>
                <a href="index.php" class="next btn btn-danger">ยกเลิก</a>
            </fieldset>
        </form>
    <?php } ?>

<?php include 'include/footer.php'; ?>