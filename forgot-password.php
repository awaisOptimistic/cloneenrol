<?php
session_start();
if(isset($_SESSION['currentSession'])){
    header("Location: /");
}
require 'loginlogic.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <noscript><h1 style="text-align:center; font-size:2em; padding-bottom:100000px; color:black; background:white; padding-top:400px;">JavaScript is off. Please enable to view full site.</h1></noscript>
    <title>Enrolment Management System</title>
    <!-- NEEEEEEEEEEEEEEEEEEEEEEEEEEEEEWWWWWWWWWWWWWWWWWWW -->
    <link href="css/tabler.min.css" rel="stylesheet"/>
    <link href="css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="css/demo.min.css" rel="stylesheet"/>
    <!-- Custom fonts for this template-->
    <!-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet"> -->

    <!-- Custom styles for this template-->
    <!-- <link href="css/sb-admin-2.min.css" rel="stylesheet"> -->
</head>
<body class="antialiased border-top-wide border-success d-flex flex-column" data-new-gr-c-s-check-loaded="14.1022.0" data-gr-ext-installed="">
<div class="page page-center">
    <div class="container-tight py-4">
        <div class="text-center mb-4">
            <a href=".">
                <div class="sidebar-brand-text mx-3" style="padding: 20px;"><img src="img/Optimistic-Futures-Trans-logoLat.png" width="150px;"></div>
            </a>
        </div>
        <form class="card card-md"  method="post">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Forgot password</h2>
                <p class="text-muted mb-4">Enter your email address and password link will be emailed to you.</p>
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" class="form-control" placeholder="Enter email"name="email">
                </div>
                <div class="form-footer">
                    <button class="btn btn-primary w-100" type="submit"  name="submitBtnRegister" id="submitBtnRegister">
                        <!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="5" width="18" height="14" rx="2"></rect><polyline points="3 7 12 13 21 7"></polyline></svg>
                        Send a link
                    </button>
                    <span class="loginMsg" style="text-align:center;color:red;padding:10px;">
                        <?php echo @$msg;?></span>
                </div>
            </div>
        </form>
        <div class="text-center text-muted mt-3">
           Already have account? <a href="login.php">Log in</a>
        </div>
    </div>
</div>



</body>


</html>
