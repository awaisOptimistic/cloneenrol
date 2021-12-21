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
</head>
<style>

    .info {
        padding-left: 100px;

        margin-bottom: 50px;
        padding: 4px 12px;
        background-color: #e7f3fe;
        border-left: 6px solid #2196F3;
        border-Right: 6px solid #2196F3;
    }

</style>

<body class="antialiased border-top-wide border-success d-flex flex-column" data-new-gr-c-s-check-loaded="14.1022.0" data-gr-ext-installed="">


    <div class="page page-center">
      <div class="container-tight py-4">
        <div class="text-center mb-4">
          <a href=".">
              <div class="sidebar-brand-text mx-3" style="padding: 20px;"><img src="img/Optimistic-Futures-Trans-logoLat.png" width="150px;"></div>
            </a>
        </div>
        <form class="card card-md" method="post">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Login to your account</h2>
            <div class="mb-3">
              <label class="form-label">Email address</label>
              <input type="email" class="form-control" placeholder="Enter email" id="exampleInputEmail" name="username">
            </div>
            <div class="mb-2">
              <label class="form-label">
                Password

              </label>
              <div class="input-group input-group-flat">
                <input type="password" class="form-control" placeholder="Password" name="password" id="exampleInputPassword">
                <span class="input-group-text">
                  <a href="#" class="link-secondary" title="" data-bs-toggle="tooltip" data-bs-original-title="Show password" onclick="myFunction();"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="2"></circle><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path></svg>
                  </a>
                </span>
              </div>
            </div>
            <span class="loginMsg" style="color:red;padding:10px;"><?php echo @$msg;?></span>
            <div class="mb-2" style="10px;">
              <label class="form-check">
                <input type="checkbox" class="form-check-input">
                <span class="form-check-label">Remember me on this device</span>
              </label>
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-success w-100" name="submitBtnLogin" id="submitBtnLogin">Sign in</button>
            </div>

              <div class="text-center text-muted mt-3">
                  <a href="forgot-password.php">Forgot Password</a>
              </div>

          </div>
          <div class="hr-text">or</div>

        </form>
        <div class="text-center text-muted mt-3">
          Don't have account yet? <a href="register.php">Sign up</a>
        </div>
      </div>
        <div class="flex-container info">
            <p align="center"><strong >WEBSITE MAINTENANCE</strong><br>Due to scheduled maintenance enrolment site will not be available on 29/10/2021 from 2:00 pm to 6:00 pm.</p>
        </div>
    </div>

    <script>
        function myFunction() {
        var x = document.getElementById("exampleInputPassword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        }

    </script>
</body>
</html>