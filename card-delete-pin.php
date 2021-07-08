<?php
    require('config/connection.php');
    require('api/check_user.php');

    $page_name = "ลงทะเบียนสำหรับลูกค้า";

    if (!isset($_POST['deleteCard']) && !isset($_SESSION['deleteCard'])) {
        header('location: index.php');
    } else {
        $_SESSION['deleteCard'] = $_POST;
    }
?>

<?php include 'include/header.php'; ?>

    <h1 class="site-title">GOTCHA!</h1>

    <div class="registerpin">
        <p>กรอกรหัส PIN 6 หลัก</p>
        <div id="deletepin"></div>
    </div>

<?php include 'include/footer.php'; ?>