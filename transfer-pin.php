<?php
    require('config/connection.php');
    require('api/check_user.php');

    $page_name = "ลงทะเบียนสำหรับลูกค้า";

    if (!isset($_GET['card_id']) && !isset($_GET['transfer_id']) && !isset($_GET['point'])) {
    	header('location: transfer.php');
    }
?>

<?php include 'include/header.php'; ?>

    <h1 class="site-title">GOTCHA!</h1>

    <div class="registerpin">
        <p>กรอกรหัส PIN 6 หลัก</p>
        <div id="transferpin"></div>
    </div>

    <form method="post" id="form-transfer" name="form-transfer" action="transfer-save.php">
        <input type="hidden" name="user_id" value="<?php echo $_GET['card_id']; ?>">
        <input type="hidden" name="user_transfer_id" value="<?php echo $_GET['transfer_id']; ?>">
        <input type="hidden" name="user_point" value="<?php echo $_GET['point']; ?>">
    </form>
<?php include 'include/footer.php'; ?>