<?php
    require('../config/connection.php');
    
    // Destroy session
    if(session_destroy()) {
        // Redirecting To Home Page
        header("Location: login.php");
    }
?>
