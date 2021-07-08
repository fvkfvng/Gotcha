<?php
    require('../../config/connection.php');
    require('check_shop.php');

    if (isset($_POST['pin'])) {
        $pin = $_POST['pin'];
    } else {
        header('location: ../index.php');
    }

    $query  = "SELECT * FROM tbl_shop WHERE s_id = '".$row_shop_ap['s_id']."'";
    $result = mysqli_query($conn, $query) or die(mysql_error());
    $row    = mysqli_fetch_assoc($result);

    if ($row['s_pin'] == $pin) {
        echo 'match';
    } else {
        echo 'notmatch';
    }
?>