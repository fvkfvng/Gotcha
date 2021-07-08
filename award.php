<?php
    require('config/connection.php');
    require('api/check_user.php');

    $page_name = "บัตรสะสมแต้ม";

    if (isset($_GET['shop'])) {
        $id = $_GET['shop'];
    } else {
        header('location: index.php');
    }

    $query_ucard  = "SELECT * FROM tbl_user_card
                    INNER JOIN tbl_user ON tbl_user_card.uc_user_id = tbl_user.u_id
                    INNER JOIN tbl_shop ON tbl_user_card.uc_shop_id = tbl_shop.s_id
                    WHERE uc_user_id = ".$uc_row['u_id']." AND uc_shop_id = ".$id;
    $result_ucard = mysqli_query($conn, $query_ucard) or die(mysql_error());
    $row_ucard    = $result_ucard->fetch_assoc();

    if ($row_ucard['s_card_style'] == 2) {
        $s_card_style = 'background-image: url(images/card/2.png)';
    } elseif ($row_ucard['s_card_style'] == 3) {
        $s_card_style = 'background-image: url(images/card/3.jpg)';
    } elseif ($row_ucard['s_card_style'] == 4) {
        $s_card_style = 'background-image: url(images/card/4.jpg)';
    } else {
        $s_card_style = 'background-image: url(images/card/1.jpg)';
    }

    $curr_date = date('Y-m-d');
    $curr_time = date('H:i:s');

    $query_award  = "SELECT * FROM tbl_award WHERE w_user_card = ".$row_ucard['uc_id']." AND w_status = '1' AND (w_edate > '".$curr_date."' OR (w_edate = '".$curr_date."' AND w_etime >= '".$curr_time."'))";
    $result_award = mysqli_query($conn, $query_award) or die(mysql_error());

    if (mysqli_num_rows($result_award) > 0) {
        $row_award = mysqli_fetch_assoc($result_award);

        header('location: award-qr.php?qr='.$row_award['w_qr']);
    }
?>

<?php include 'include/header.php'; ?>
    
    <div class="main-container">
        <h1 class="site-title">GOTCHA!</h1>
        <br>
        <h2 class="form-title">
            บัตรสะสมคะแนนร้าน<br>
            <?php echo $row_ucard['s_name']; ?>
        </h2>

        <div class="text-center">
            <img src="images/gift.png">
        </div>

        <?php if ($row_ucard['uc_point'] < 100) { ?>
            <div class="message-box">
                <div class="message-header message-unsuccess">ขออภัย</div>
                <div class="message-detail">
                    คุณยังไม่สามารถรับของรางวัลได้ <br>
                    กรุณาทำตามเงื่อนไขที่ทางร้านกำหนด
                </div>
            </div>
        <?php } else { ?>
            <div class="message-box">
                <div class="message-header message-success">ยินดีด้วย</div>
                <div class="message-detail">   
                    คุณสามารถรับรางวัลได้ที่ร้าน<br>
                    และหัน QR CODE ให้พนักงานสแกน
                </div>
            </div>
        <?php } ?>
        <br>

        <div id="card">
            <div class="card-content" style="<?php echo $s_card_style; ?>">
                <div class="card-point-logo">
                    <img style="width:100px;" src="<?php echo $row_ucard['s_line_img']; ?>" />
                </div>
                <div class="card-point-detail">
                    <div class="card-point-detail-detail">
                        <p>ร้าน <span><?php echo $row_ucard['s_shop_name']; ?></span></p>
                        <p>ประเภทร้าน <span><?php echo $row_ucard['s_shop_type']; ?></span></p>
                        <p>ผู้ประกอบการ <span><?php echo $row_ucard['s_name']; ?></span></p>
                        <p>เบอร์โทร <span><?php echo $row_ucard['s_tel']; ?></span></p>
                        <p>สถานที่ตั้ง <span class="card-address"><?php echo $row_ucard['s_address_no']; ?> <?php echo $row_ucard['s_address_no']; ?>, ชั้น <?php echo $row_ucard['s_address_floor']; ?>, <?php echo $row_ucard['s_address_detail']; ?></span></p>
                    </div>
                    <div class="card-point-detail-qrcode">
                        <h4>คะแนนในบัตร</h4>
                        <div class="point point-big"><?php echo $row_ucard['uc_point']; ?></div><br>
                        <div class="point">/</div><br>
                        <div class="point">100</div>
                        <span class="fa-stack">
                          <i class="fa fa-circle fa-stack-2x"></i>
                          <i class="fa fa-star fa-stack-1x fa-inverse"></i>
                        </span>
                    </div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $row_ucard['uc_point']; ?>"
                      aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $row_ucard['uc_point']; ?>%">
                        <span class="sr-only"><?php echo $row_ucard['uc_point']; ?>% Complete</span>
                      </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($row_ucard['uc_point'] < 100) { ?>
            <a href="index.php" class="btn btn-primary">
                หน้าแรก
            </a>
        <?php } else { ?>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#award-modal">
                รับรางวัล
            </button>
            <div class="modal fade modal-danger" id="award-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">คำเตือน</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            หากคุณกดรับรางวัลแล้วโปรดนำ Qrcode<br>เพื่อไปยืนยันสิทธิ์ของคุณภายใน 30 นาที
                        </div>
                        <div class="modal-footer">
                            <form method="post" action="qr/gen/award.php">
                                <button type="button" class="btn btn-secondary btn-width-auto" data-dismiss="modal">ยกเลิก</button>
                                <input type="hidden" name="card_id" value="<?php echo $row_ucard['uc_id']; ?>">
                                <button type="submit" class="btn btn-primary  btn-width-auto">ยืนยัน</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
<?php include 'include/footer.php'; ?>