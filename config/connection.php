<?php
    ob_start();
    session_start();

    date_default_timezone_set("Asia/Bangkok");

    ini_set('display_errors', 'On');
    error_reporting(E_ALL ^ E_DEPRECATED);

    define('SITETITLE', 'GOTCHA!');
    
    $database_host = 'localhost';
    if ($_SERVER['HTTP_HOST'] == 'localhost') {
        $db_username = 'root';
        $db_password = '';
        $db_name = 'gotcha1';
    } else {
        $db_username = 'gotchael_db';
        $db_password = 'Pnl2lW4xG9';
        $db_name = 'gotchael_db';
    }

    $conn = mysqli_connect($database_host, $db_username, $db_password, $db_name);
    if ( mysqli_connect_errno() ) {
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }

    mysqli_set_charset($conn,"utf8");
?>
