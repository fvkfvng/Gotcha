<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title><?php echo $page_name; ?> | <?php echo SITETITLE; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="assets/vendors/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <!-- <link href="assets/vendors/morrisjs/morris.css" rel="stylesheet"> -->
    <!--c3 CSS -->
    <link href="assets/vendors/c3-master/c3.min.css" rel="stylesheet">
    
    <!-- flot css -->
    <link href="css/pages/float-chart.css" rel="stylesheet">

    <!--Toaster Popup message CSS -->
    <link href="assets/vendors/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/master-stylesheet.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/default.css" id="theme" rel="stylesheet">
    <link href="css/custom.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->


</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
      <div class="lds-roller">
      <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">
                        GOTCHA!
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="sl-icon-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="sl-icon-menu"></i></a> </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown u-pro">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="hidden-md-down"><?php echo $_SESSION['adminname']; ?></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li>
                            <a class="waves-effect waves-dark" href="index.php" aria-expanded="false">
                                <i class="mdi mdi-microsoft mr-10"></i><span class="hide-menu">แผงควบคุม</span>
                            </a>
                        </li>
                        <li>
                            <a class="waves-effect waves-dark" href="shop.php" aria-expanded="false">
                                <i class="mdi mdi-microsoft mr-10"></i><span class="hide-menu">ร้านค้าในระบบ</span>
                            </a>
                        </li>
                        <li>
                            <a class="waves-effect waves-dark" href="promotion.php" aria-expanded="false">
                                <i class="mdi mdi-microsoft mr-10"></i><span class="hide-menu">โปรโมชั่น</span>
                            </a>
                        </li>
                        <li>
                            <a class="waves-effect waves-dark" href="income.php" aria-expanded="false">
                                <i class="mdi mdi-credit-card mr-10"></i><span class="hide-menu">การเงิน / รายได้</span>
                            </a>
                        </li>
                        <li>
                            <a class="waves-effect waves-dark" href="profile.php" aria-expanded="false">
                                <i class="mdi mdi-account mr-10"></i><span class="hide-menu">แก้ไขข้อมูลส่วนตัว</span>
                            </a>
                        </li>
                        <li>
                            <a class="waves-effect waves-dark" href="logout.php" aria-expanded="false">
                                <i class="mdi mdi-logout mr-10"></i><span class="hide-menu">ออกจากระบบ</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">