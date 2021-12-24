<?php
include('config.php');
include('lib/lib.php');
include('lib/locallib.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
/** Check Session **/
if(isset($_SESSION['role'])){
  $role=$_SESSION['role'];
  $userid =  $_SESSION['userid'];
  $name = get_session_detail($userid);
  $uqid = get_uqid($userid);
  if($role==1){$roleName="Admin";}elseif($role==2){$roleName="Coordinator";}elseif($role==4){$roleName="Auditor";}else{$roleName="Student";}
}else{

  header("/");
  exit();
}
global $url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel='stylesheet' href='/path/to/font-awesome/css/font-awesome.min.css'>
    <title>Enrolment Management System</title>
    <?php
    include('style.php');
    ?>
    <style type="text/css">
        .navbar-brand-image {
        display: block;
        height: 98px;
        width: auto;
    }
        </style>
</head>

<!-- User profile icon -->
<body id="page-top">
<header class="navbar navbar-expand-md navbar-light d-print-none">
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3" style="width: auto;
    height: 98px !important;">
            <a href="..">
              <img src="../img/Optimistic-Futures-Trans-logo.png" alt="Tabler" class="navbar-brand-image">
            </a>
          </h1>
          <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item d-none d-md-flex me-3">
              <div class="btn-list">

              </div>
            </div>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
<!--                <span class="avatar avatar-sm" style="background-image: url(https://cdn4.iconfinder.com/data/icons/evil-icons-user-interface/64/avatar-512.png)"></span>-->

                  <span class="avatar">
                              <span class="badge bg-green"></span><?php echo substr($name, 0, 1);?>
                  </span>
                  <div class="">
                  <div><?php echo $name;?></div>
                  <div class="mt-1 small text-muted"><?php echo $roleName;?></div>
                    <?php if($role == 3){?>
                    <div class="mt-1 small text-muted">ID: <?php echo $uqid;?></div>
                    <?php } ?>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <a href="index.php?page=25" class="dropdown-item">Edit Profile</a>
                  <a href="logout.php" class="dropdown-item">Logout</a>
              </div>
            </div>
          </div>
        </div>
      </header>

<!-- Navigation -->
      <div class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar navbar-light">
            <div class="container-xl">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="index.php" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Home
                    </span>
                  </a>
                </li>
                <?php if ($role == 1){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=19">
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from https://tabler-icons.io/i/home -->
                        <!-- Download SVG icon from https://tabler-icons.io/i/chart-bar -->
	<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="3" y="12" width="6" height="8" rx="1" /><rect x="9" y="8" width="6" height="12" rx="1" /><rect x="15" y="4" width="6" height="16" rx="1" /><line x1="4" y1="20" x2="18" y2="20" /></svg>
                    </span>
                            <span class="nav-link-title">Students Progress Check</span>
                        </a>
                    </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from https://tabler-icons.io/i/checkbox -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                       <circle cx="9" cy="7" r="4"></circle>
                       <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                       <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                       <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path></svg>
                    </span>
                    <span class="nav-link-title">
                      Users
                    </span>
                  </a>
                  <div class="dropdown-menu">
                        <a class="dropdown-item" href="index.php?page=3">Current Users</a>
                  </div>
                </li>

                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from https://tabler-icons.io/i/checkbox -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 11 12 14 20 6" /><path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" /></svg>
                    </span>
                          <span class="nav-link-title">
                      Enrolments
                    </span>
                      </a>
                      <div class="dropdown-menu">
                          <a class="dropdown-item" href="index.php?page=12">New Enrolments/JotForm Submission</a>
                          <a class="dropdown-item" href="index.php?page=11">Approved Students</a>
                          <a class="dropdown-item" href="index.php?page=22">Upload Students</a>
                      </div>
                  </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" role="button" aria-expanded="false" >
                     <span class="nav-link-icon d-md-none d-lg-inline-block">
                          <!-- Download SVG icon from https://tabler-icons.io/i/home -->
                         <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tool" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                           <path d="M7 10h3v-3l-3.5 -3.5a6 6 0 0 1 8 8l6 6a2 2 0 0 1 -3 3l-6 -6a6 6 0 0 1 -8 -8l3.5 3.5"></path>
                         </svg>
                     </span>
                            <span class="nav-link-title">
                      Settings
                    </span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="index.php?page=2">JotForm API Setting</a>
                            <a class="dropdown-item" href="index.php?page=24">Permissions</a>
                        </div>
                    </li>
                <?php }
                elseif($role == 2 ){?>
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php?page=19">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <!-- Download SVG icon from https://tabler-icons.io/i/home -->
                        <!-- Download SVG icon from http://tabler-icons.io/i/chart-bar -->
	                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="3" y="12" width="6" height="8" rx="1" /><rect x="9" y="8" width="6" height="12" rx="1" /><rect x="15" y="4" width="6" height="16" rx="1" /><line x1="4" y1="20" x2="18" y2="20" /></svg>
                    </span>
                    <span class="nav-link-title">Students Progress Check</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                       <!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                       <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                       <circle cx="9" cy="7" r="4"></circle>
                       <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                       <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                       <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path></svg>
                    </span>
                    <span class="nav-link-title">Users</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="index.php?page=3">Current Student</a>
                        </div>
                    </li>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 11 12 14 20 6" /><path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" /></svg>
                    </span>
                          <span class="nav-link-title">Enrolments</span>
                      </a>
                      <div class="dropdown-menu">
                          <a class="dropdown-item" href="index.php?page=12">New Enrolments/JotForm Submission</a>
                          <a class="dropdown-item" href="index.php?page=11">Approved Students</a>
                      </div>
                  </li>

                  <?php }elseif($role == 4 ){  ?>
                  <li class="nav-item">
                      <a class="nav-link" href="./index.php?page=19">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <!-- Download SVG icon from https://tabler-icons.io/i/home -->
                        <!-- Download SVG icon from http://tabler-icons.io/i/chart-bar -->
	                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="3" y="12" width="6" height="8" rx="1" /><rect x="9" y="8" width="6" height="12" rx="1" /><rect x="15" y="4" width="6" height="16" rx="1" /><line x1="4" y1="20" x2="18" y2="20" /></svg>
                    </span>
                          <span class="nav-link-title">Students Progress Check</span>
                      </a>
                  </li>

                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                       <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                       <circle cx="9" cy="7" r="4"></circle>
                       <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                       <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                       <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path></svg>
                    </span>
                          <span class="nav-link-title">Users</span>
                      </a>
                      <div class="dropdown-menu">
                      <a class="dropdown-item" href="index.php?page=3">Current Student</a>
                      </div>
                  </li>
                  <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>