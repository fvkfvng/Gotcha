<?php
    session_start();
    require_once("../line/config.php");
    require_once("../line/LineLoginLib.php");
     
    // กรณีต้องการตรวจสอบการแจ้ง error ให้เปิด 3 บรรทัดล่างนี้ให้ทำงาน กรณีไม่ ให้ comment ปิดไป
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
     
    // กรณีมีการเชื่อมต่อกับฐานข้อมูล
    //require_once("dbconnect.php");

    $LineLogin = new LineLoginLib(LINE_SHOP_LOGIN_CHANNEL_ID, LINE_SHOP_LOGIN_CHANNEL_SECRET, LINE_SHOP_LOGIN_CALLBACK_URL);
      
    if(!isset($_SESSION['line_token'])){    
        $LineLogin->authorize(); 
        exit;
    } else {
        header('location: index.php');
    }
     
    $accToken = $_SESSION['line_token'];
    // Status Token Check
    if($LineLogin->verifyToken($accToken)){
        echo $accToken."<br><hr>";
        echo "Token Status OK <br>";  
    } 
     
    echo "<pre>";
    // Status Token Check with Result 
    //$statusToken = $LineLogin->verifyToken($accToken, true);
    //print_r($statusToken);
     
    //////////////////////////
    echo "<hr>";
    // GET LINE USERID FROM USER PROFILE
    //$userID = $LineLogin->userProfile($accToken);
    //echo $userID;
     
    //////////////////////////
    echo "<hr>";
    // GET LINE USER PROFILE 
    $userInfo = $LineLogin->userProfile($accToken,true);
    if(!is_null($userInfo) && is_array($userInfo) && array_key_exists('userId',$userInfo)){
        print_r($userInfo);
    }
     
    //exit;
    echo "<hr>";
     
    if(isset($_SESSION['line_user']) && $_SESSION['line_user']!=""){
        // GET USER DATA FROM ID TOKEN
        $lineUserData = json_decode($_SESSION['line_user'],true);

        echo "<hr>";
        echo "Line UserID: ".$lineUserData['sub']."<br>";
        echo "Line Display Name: ".$lineUserData['name']."<br>";
        echo '<img style="width:100px;" src="'.$lineUserData['picture'].'" /><br>';
    }
     
    echo "<hr>";

    if(isset($_SESSION['line_refresh_token']) && $_SESSION['line_refresh_token']!=""){
        echo '
        <form method="post">
        <button type="submit" name="refreshToken">Refresh Access Token</button>
        </form>   
        ';  
    }

    if(isset($_SESSION['line_refresh_token']) && $_SESSION['line_refresh_token']!=""){
        if(isset($_POST['refreshToken'])){
            $refreshToken = $_SESSION['line_refresh_token'];
            $new_accToken = $LineLogin->refreshToken($refreshToken); 
            if(isset($new_accToken) && is_string($new_accToken)){
                $_SESSION['line_token'] = $new_accToken;
            }       
            $LineLogin->redirect("login_uselib.php");
        }
    }

    // Revoke Token
    //if($LineLogin->revokeToken($accToken)){
    //  echo "Logout Line Success<br>";   
    //}
    //
    // Revoke Token with Result
    //$statusRevoke = $LineLogin->revokeToken($accToken, true);
    //print_r($statusRevoke);

    if (isset($_POST['lineLogin'])) {
        $LineLogin->authorize(); 
        exit;   
    }

    if (isset($_POST['lineLogout'])) {
        unset(
            $_SESSION['line_token'],
            $_SESSION['line_refresh_token'],
            $_SESSION['line_user']
        );  
        echo "<hr>";

        if($LineLogin->revokeToken($accToken)){
            echo "Logout Line Success<br>";   
        }
        echo '
            <form method="post">
            <button type="submit" name="lineLogin">LINE Login</button>
            </form>   
            ';
        $LineLogin->redirect("login.php");
    }
?>

<?php echo "<hr>"; ?>

<?php if ($LineLogin->verifyToken($accToken)) { ?>
    <form method="post">
        <button type="submit" name="lineLogout">LINE Logout</button>
    </form>
<?php } else { ?>
    <form method="post">
        <button type="submit" name="lineLogin">LINE Login</button>
    </form>   
<?php } ?>