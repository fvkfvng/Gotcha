<?php
    require('../config/connection.php');
    require('api/check_shop.php');

    $page_name = "บัตรสะสมแต้ม";

    if (!isset($_GET['qr'])) {
        header('location: index.php');
    }

    $qr = $_GET['qr'];

    $query  = "SELECT * FROM tbl_point_qr WHERE pq_qr = '".$qr."'";
    $result = mysqli_query($conn, $query) or die(mysql_error());
    $row    = $result->fetch_assoc();
?>

<?php include 'include/header.php'; ?>
    
    <div class="main-container">
        <h1 class="site-title">GOTCHA!</h1>
        <br>
        <h2 class="main-title">
            “<?php echo $row_shop_ap['s_shop_name']; ?>”<br>
            มอบคะแนนให้ลูกค้า<br>
        </h2>

        <div class="text-center">
            <img src="api/gen_qrcode.php?p=<?php echo $qr; ?>" alt="" style="max-width: 150px; width: 100%;">
        </div>
        <br>
        <a href="index.php" class="btn btn-primary">
            หน้าแรก
        </a>
    </div>

<?php include 'include/footer.php'; ?>