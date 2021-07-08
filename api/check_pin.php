<?php
    require('../config/connection.php');
    require('check_user.php');

    if (isset($_POST['pin'])) {
        $pin = $_POST['pin'];
    } else {
        header('location: ../index.php');
    }

    $query  = "SELECT * FROM tbl_user WHERE u_id = '".$uc_row['u_id']."'";
    $result = mysqli_query($conn, $query) or die(mysql_error());
    $row    = mysqli_fetch_assoc($result);

    if ($row['u_pin'] == $pin) {
        echo 'match';
    } else {
        echo 'notmatch';
    }
?>