<?php
    require('../config/connection.php');
    require('api/check_shop.php');

    $page_name = "ลงทะเบียนสำหรับลูกค้า";

    if (!isset($_POST['formPoint'])) {
    	header('location: points.php');
    } else {
        $_SESSION['formPoint'] = $_POST;
    }
?>

<?php include 'include/header.php'; ?>

    <h1 class="site-title">GOTCHA!</h1>

    <div class="registerpin">
        <p>กรอกรหัส PIN 6 หลัก</p>
        <div id="pointpin"></div>
    </div>

<?php include 'include/footer.php'; ?>