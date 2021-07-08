<?php
    require('config/connection.php');
    require('api/check_user.php');

    $page_name = "บัตรสะสมแต้ม";

    $query_card    = "SELECT * FROM tbl_user_card
                    INNER JOIN tbl_user ON tbl_user_card.uc_user_id = tbl_user.u_id
                    INNER JOIN tbl_shop ON tbl_user_card.uc_shop_id = tbl_shop.s_id
                    WHERE uc_user_id = '".$uc_row['u_id']."'";
    $result_card = mysqli_query($conn, $query_card) or die(mysql_error());
?>

<?php include 'include/header.php'; ?>
    
    <div class="main-container">
        <h1 class="site-title">GOTCHA!</h1>
        <br>
        <h2 class="main-title">
            บัตรสะสมแต้มทั้งหมด
        </h2>
        <?php if (mysqli_num_rows($result_card) > 0) { ?>
            <form method="post" action="card-delete-pin.php">
                <div style="margin-bottom: 20px;">
                    <div style="display: inline-block;">
                        <a href="qrscan.php">
                            <img src="images/scaner.png" width="45px;">
                        </a>
                    </div>
                    <div class="pull-right">
                        <div class="enabled">
                            <button type="button" id="card-selected" class="btn btn-default btn-width-auto">แก้ไข</button>
                        </div>
                        <div class="disabled">
                            <button type="button" id="card-unselected" class="btn btn-default btn-width-auto">ยกเลิก</button>
                            <button type="button" class="btn btn-danger btn-width-auto" id="delete-card" data-toggle="modal" data-target="#delete-modal">ลบ</button>
                        </div>
                    </div>
                </div>
                <?php
                    while($row = mysqli_fetch_assoc($result_card)) {
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
                    
                    <div class="card-item">
                        <a href="shop-card.php?id=<?php echo $row['uc_id']; ?>">
                            <label class="disabled el-radio">
                                <input type="checkbox" name="<?php echo $row['uc_id']; ?>">
                                <span class="el-radio-style"></span>
                            </label>
                            <div class="card-content" style="<?php echo $s_card_style; ?>">
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
                        </a>
                    </div>
                    
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
                                    คุณต้องการลบบัตรสะสมคะแนนทั้งหมดจำนวน<br>
                                    <span id="delete-count">0</span> รายการ<br>
                                    เมื่อลบบัตรสะสมคะแนนไปแล้ว<br>
                                    คุณจะเสียคะแนนทั้งหมด
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary  btn-width-auto" name="deleteCard">ยืนยัน</button>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            </form>
        <?php } else { ?>
            <div class="text-center">
                ไม่มีบัตรสะสมแต้ม<br><br>
                <a href="qrscan.php">
                    <img src="images/scaner.png" width="100px;">
                </a>
            </div>
        <?php } ?>
    </div>

<?php include 'include/footer.php'; ?>
