<?php
    require('config/connection.php');
    require('api/check_user.php');

    $page_name = "บัตรสะสมแต้ม";

    if (isset($_SESSION['deleteCard'])) {
        foreach ($_SESSION['deleteCard'] as $key => $value) {
            if ($key != 'deleteCard') {
                $query    = "DELETE FROM tbl_user_card WHERE uc_id = ".$key;
                $result = mysqli_query($conn, $query) or die(mysql_error());

                if ($result) {
                    header('location: card-delete-success.php?success');
                } else {
                    header('location: card-delete-success.php?error');
                }

                unset($_SESSION['deleteCard']);
            }
        }
    } else {
        header('index.php');
    }
?>