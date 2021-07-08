<?php
session_start();
require_once("../../line/config.php");
require_once("../../line/LineLoginLib.php");

// กรณีต้องการตรวจสอบการแจ้ง error ให้เปิด 3 บรรทัดล่างนี้ให้ทำงาน กรณีไม่ ให้ comment ปิดไป
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
// กรณีมีการเชื่อมต่อกับฐานข้อมูล
//require_once("dbconnect.php");

$LineLogin = new LineLoginLib(LINE_SHOP_LOGIN_CHANNEL_ID, LINE_SHOP_LOGIN_CHANNEL_SECRET, LINE_SHOP_LOGIN_CALLBACK_URL);
     
// กรณีต้องการดึงค่าเฉพาะ access token ไปใช้งาน
/*$accToken = $LineLogin->requestAccessToken($_GET);
if(isset($accToken) && is_string($accToken)){
    $_SESSION['ses_login_accToken_val'] = $accToken;
}*/
 
// กรณีต้องการดึงค่าเฉพาะ access token และค่าอื่นๆ รวมถึงข้อมูลผู้ใช้ เช่น userId ในไลน์ ไปใช้งาน
$dataToken = $LineLogin->requestAccessToken($_GET, true);

if(!is_null($dataToken) && is_array($dataToken)){
    if(array_key_exists('access_token',$dataToken)){
        $_SESSION['line_token'] = $dataToken['access_token'];
    }
    if(array_key_exists('refresh_token',$dataToken)){
        $_SESSION['line_refresh_token'] = $dataToken['refresh_token'];
    }   
    if(array_key_exists('id_token',$dataToken)){
        $_SESSION['line_user'] = $dataToken['user'];
    }       
}

$LineLogin->redirect('../login.php');
?>