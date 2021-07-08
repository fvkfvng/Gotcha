<?php
    require('config/connection.php');
    require('api/check_user.php');

    $page_name = "บัตรสะสมแต้ม";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header('location: index.php');
    }

    $query    = "SELECT * FROM tbl_user_card
                    INNER JOIN tbl_user ON tbl_user_card.uc_user_id = tbl_user.u_id
                    INNER JOIN tbl_shop ON tbl_user_card.uc_shop_id = tbl_shop.s_id
                    WHERE uc_id = '".$id."'";
    $result = mysqli_query($conn, $query) or die(mysql_error());
    $row = mysqli_fetch_assoc($result);
?>

<?php include 'include/header.php'; ?>
    
    <div class="main-container">
        <h1 class="site-title">GOTCHA!</h1>
        <br>
        <h2 class="main-title">
            บัตรสะสมแต้มร้าน<br>
            “<?php echo $row['s_shop_name']; ?>”<br>
        </h2>

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="text-right">
                    <a href="index.php" class="text-small">ดูบัตรทั้งหมด</a>
                </div>
                <br>
                <?php
                    if (mysqli_num_rows($result) > 0) {
                        if ($row['s_card_style'] == 2) {
                            $s_card_style = 'background-image: url(images/card/2.png)';
                        } elseif ($row['s_card_style'] == 3) {
                            $s_card_style = 'background-image: url(images/card/3.jpg)';
                        } elseif ($row['s_card_style'] == 4) {
                            $s_card_style = 'background-image: url(images/card/4.jpg)';
                        } else {
                            $s_card_style = 'background-image: url(images/card/1.jpg)';
                        }
                ?>
                    <form method="post" action="card-save.php">
                        <input type="hidden" name="shop" value="<?php echo $row['s_id']; ?>">
                        <div class="card-item">
                            <div class="card-content w-100" style="<?php echo $s_card_style; ?>">
                                <div class="card-point-logo">
                                    <img style="width:100px;" src="<?php echo $row['s_line_img']; ?>" />
                                </div>
                                <div class="card-point-detail">
                                    <div class="card-point-detail-detail">
                                        <p>ร้าน <span><?php echo $row['s_shop_name']; ?></span></p>
                                        <p>ประเภทร้าน <span><?php echo $row['s_shop_type']; ?></span></p>
                                        <p>ผู้ประกอบการ <span><?php echo $row['s_name']; ?></span></p>
                                        <p>เบอร์โทร <span><?php echo $row['s_tel']; ?></span></p>
                                        <p>สถานที่ตั้ง <span class="card-address"><?php echo $row['s_address_no']; ?> <?php echo $row['s_address_no']; ?>, ชั้น <?php echo $row['s_address_floor']; ?>, <?php echo $row['s_address_detail']; ?></span></p>
                                    </div>
                                    <div class="card-point-detail-qrcode">
                                        <h4>คะแนนในบัตร</h4>
                                        <div class="point point-big"><?php echo $row['uc_point']; ?></div><br>
                                        <div class="point">/</div><br>
                                        <div class="point">100</div>
                                        <span class="fa-stack">
                                          <i class="fa fa-circle fa-stack-2x"></i>
                                          <i class="fa fa-star fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </div>
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $row['uc_point']; ?>"
                                      aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $row['uc_point']; ?>%">
                                        <span class="sr-only"><?php echo $row['uc_point']; ?>% Complete</span>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="text-center">
                            <a href="#" class="text-small">เงื่อนไขการรับของรางวัล</a>
                        </div>
                        <br>
                        <h4>
                            คะแนนในบัตร
                            <div class="pull-right" style="font-size: 25px;">
                                <?php echo $row['uc_point']; ?>
                                <span class="fa-stack">
                                  <i class="fa fa-circle fa-stack-2x"></i>
                                  <i class="fa fa-star fa-stack-1x fa-inverse"></i>
                                </span>
                            </div>
                        </h4>
                        <hr>
                        <div class="card-point-footer">
                            <div class="row text-center">
                                <div class="card-box">
                                    <a href="qrscan.php">
                                        <img src="images/scaner.png"><br>
                                        แสกน
                                    </a>
                                </div>
                                <div class="card-box">
                                    <a href="award.php?shop=<?php echo $row['uc_shop_id']; ?>">
                                        <img src="images/gift.png" style="width: 55px;"><br>
                                        แลกของรางวัล
                                    </a>
                                </div>
                                <div class="card-box">
                                    <a href="transfer.php?id=<?php echo $id; ?>">
                                        <img src="images/sharing.png"><br>
                                        โอนคะแนน
                                    </a>
                                </div>
                                <div class="card-box">
                                    <a href="history.php?id=<?php echo $id; ?>">
                                        <img src="images/history.png"><br>
                                        ประวัติ
                                    </a>
                                </div>
                                <div class="card-box">
                                    <a href="#" data-toggle="modal" data-target="#delete-modal">
                                        <img src="images/credit-card.png"><br>
                                        จัดการบัตร
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form method="post" action="card-delete-pin.php">
                        <div class="modal fade modal-danger" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">คำเตือน</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        คุณต้องการลบบัตรสะสมคะแนนร้านนี้<br>
                                        เมื่อลบบัตรสะสมคะแนนไปแล้ว<br>
                                        คุณจะเสียคะแนนทั้งหมด
                                        <input type="hidden" name="<?php echo $row['uc_id']; ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary  btn-width-auto" name="deleteCard">ยืนยัน</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php } else { ?>
                    <div class="text-center">ไม่มีบัตรสะสมแต้ม</div>
                <?php } ?>
            </div>
        </div>
    </div>

<?php include 'include/footer.php'; ?>