<?php
    require('config/connection.php');
    require('config/config.php');
    require('api/check_user.php');

    $page_name = "บัตรสะสมแต้ม";

    if (!isset($_GET['qr'])) {
        header('location: index.php');
    }

    $qr = $_GET['qr'];

    $query  = "SELECT * FROM tbl_award WHERE w_qr = '".$qr."'";
    $result = mysqli_query($conn, $query) or die(mysql_error());
    $row    = $result->fetch_assoc();

    if ($row['w_status'] == '2' || $row['w_status'] == '0') {
        header('location: index.php');
    }

    if (isset($_GET['s'])) {
        $query_award  = "SELECT * FROM tbl_award WHERE w_qr = '".$qr."'";
        $result_award = mysqli_query($conn, $query_award) or die(mysql_error());
        $row_award    = $result_award->fetch_assoc();

        if ($row_award['w_status'] == 1) {
            $query    = "UPDATE tbl_award SET w_status = '".$_GET['s']."' WHERE w_id = ".$row['w_id'];
            $result   = mysqli_query($conn, $query);

            $query    = "UPDATE tbl_user_card SET uc_point = '100' WHERE uc_id = ".$row['w_user_card'];
            $result   = mysqli_query($conn, $query);

            header('location: index.php');
        } else {
            echo "<script>alert('มีการรับของรางวัลแล้ว ไม่สามารถยกเลิกได้'); window.location.replace('index.php');</script>";
            exit();
        }
    }
?>

<?php include 'include/header.php'; ?>
    
    <div class="main-container">
        <h1 class="site-title">GOTCHA!</h1>
        <br>
        <h2 id="time-count" class="main-time"></h2>

        <div class="block-success">
            <div class="block-success-header">
                <div class="text-gray">บันทึกเมื่อ <?php echo dateTh($row['w_date']); ?></div>
                <div class="text-gray">เวลา <?php echo $row['w_time']; ?> น.</div>
            </div>
            <div class="block-success-body">
                <div class="text-center">
                <img src="shop/api/gen_qrcode.php?w=<?php echo $qr; ?>" alt="" class="qrcode">
                </div>
            </div>
        </div>
        <br>
        <a href="index.php" class="btn btn-primary">หน้าแรก</a>
        <a href="award-qr.php?qr=<?php echo $qr; ?>&s=0" class="btn btn-default" onclick="return confirm('ยืนยันการยกเลิก ?')">ยกเลิก</a>
    </div>

    <script>
        var countDownDate = new Date("<?php echo $row['w_edate']; ?> <?php echo $row['w_etime']; ?>").getTime();
        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = countDownDate - now;

            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            if (minutes < 10) {
                minutes = '0'+minutes;
            }
            if (seconds < 10) {
                seconds = '0'+seconds;
            }

            document.getElementById("time-count").innerHTML = minutes + ":" + seconds;
            
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("time-count").innerHTML = "หมดเวลา !!";
            }
        }, 500);
    </script>
<?php include 'include/footer.php'; ?>