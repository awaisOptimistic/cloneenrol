<?php
session_start();
include('session/sessionCheck.php');
if($exists==1 && $role==1){
    $userId=$_GET[user];
    try {
        $query = "SELECT * FROM `student_detail` where std_id=:std_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('std_id', $userId, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);

        $query2 = "SELECT * FROM `qualification` where std_id=:std_id";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->bindParam('std_id', $userId, PDO::PARAM_STR);
        $stmt2->execute();
        $qualification  = $stmt2->fetchAll(PDO::FETCH_ASSOC);


        $query3 = "SELECT * FROM `short_qualification` where std_id=:std_id";
        $stmt3 = $pdo->prepare($query3);
        $stmt3->bindParam('std_id', $userId, PDO::PARAM_STR);
        $stmt3->execute();
        $short_qualification  = $stmt3->fetchAll(PDO::FETCH_ASSOC);

        $query4 = "SELECT * FROM `usi` where std_id=:std_id";
        $stmt4 = $pdo->prepare($query4);
        $stmt4->bindParam('std_id', $userId, PDO::PARAM_STR);
        $stmt4->execute();
        $usi  = $stmt4->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        echo "Error : ".$e->getMessage();
    }


    ?>
    <?php /*
print_r("<pre>");
print_r($qualification);
print_r("</pre>");*/
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Enrolment Management System</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
                href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
                rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <!-- Custom styles for this page -->
        <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
        <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/4.4.95/css/materialdesignicons.css">
        <style>
            html *{
                -webkit-font-smoothing: antialiased;
            }
            h3{
                font-size: 25px !important;
                margin-top: 20px;
                margin-bottom: 10px;
                line-height: 1.4em !important;
            }

            p {
                font-size: 14px;
                margin: 0 0 10px !important;
                font-weight: 300;
            }

            small {
                font-size: 75%;
                color: #777;
                font-weight: 400;
            }

            .container .title{
                color: #3c4858;
                text-decoration: none;
                margin-top: 30px;
                margin-bottom: 25px;
                min-height: 32px;
            }

            .container .title h3{
                font-size: 25px;
                font-weight: 300;
            }

            div.card {
                border: 0;
                margin-bottom: 30px;
                margin-top: 30px;
                border-radius: 6px;
                color: rgba(0,0,0,.87);
                background: #fff;
                width: 100%;
                box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);
            }

            div.card.card-plain {
                background: transparent;
                box-shadow: none;
            }
            div.card .card-header {
                border-radius: 3px;
                padding: 1rem 15px;
                margin-left: 15px;
                margin-right: 15px;
                margin-top: -30px;
                border: 0;
                background: linear-gradient(60deg,#eee,#bdbdbd);
            }

            .card-plain .card-header:not(.card-avatar) {
                margin-left: 0;
                margin-right: 0;
            }

            .div.card .card-body{
                padding: 15px 30px;
            }

            div.card .card-header-primary {
                background: linear-gradient(60deg,#1abc9c,#14c44f);
                box-shadow: 0 5px 20px 0 rgba(0,0,0,.2), 0 13px 24px -11px rgba(156,39,176,.6);
            }

            div.card .card-header-danger {
                background: linear-gradient(60deg,#ef5350,#d32f2f);
                box-shadow: 0 5px 20px 0 rgba(0,0,0,.2), 0 13px 24px -11px rgba(244,67,54,.6);
            }


            .card-nav-tabs .card-header {
                margin-top: -30px!important;
            }

            .card .card-header .nav-tabs {
                padding: 0;
            }

            .nav-tabs {
                border: 0;
                border-radius: 3px;
                padding: 0 15px;
            }

            .nav {
                display: flex;
                flex-wrap: wrap;
                padding-left: 0;
                margin-bottom: 0;
                list-style: none;
            }

            .nav-tabs .nav-item {
                margin-bottom: -1px;
            }

            .nav-tabs .nav-item .nav-link.active {
                background-color: hsla(0,0%,100%,.2);
                transition: background-color .3s .2s;
            }

            .nav-tabs .nav-item .nav-link{
                border: 0!important;
                color: #fff!important;
                font-weight: 500;
            }

            .nav-tabs .nav-item .nav-link {
                color: #fff;
                border: 0;
                margin: 0;
                border-radius: 3px;
                line-height: 24px;
                text-transform: uppercase;
                font-size: 12px;
                padding: 10px 15px;
                background-color: transparent;
                transition: background-color .3s 0s;
            }

            .nav-link{
                display: block;
            }

            .nav-tabs .nav-item .material-icons {
                margin: -1px 5px 0 0;
                vertical-align: middle;
            }

            .nav .nav-item {
                position: relative;
            }
            footer{
                margin-top:100px;
                color: #555;
                background: #fff;
                padding: 25px;
                font-weight: 300;

            }
            .footer p{
                margin-bottom: 0;
                font-size: 14px;
                margin: 0 0 10px;
                font-weight: 300;
            }
            footer p a{
                color: #555;
                font-weight: 400;
            }

            footer p a:hover {
                color: #9f26aa;
                text-decoration: none;
            }
            p {
                font-size: 0.875rem;
                margin-bottom: .5rem;
                line-height: 1.3rem;
            }


            .card {
                position: relative;
                display: flex;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-color: #fff;
                background-clip: border-box;
                border: 1px solid #e7eaed;
                border-radius: 0;
            }
            .card .card-description {
                margin-bottom: .875rem;
                font-weight: 400;
                color: #76838f;
            }






            .profile-header {
                height: 150px;
                width: 100%;
                position: relative;
            }

            .cover-image {
                height: 150px;
                width: 100%;
                overflow: hidden;
            }



            .user-image {
                position: absolute;
                height: 80px;
                width: 80px;
                border-radius: 50%;
                bottom: -50%;
                left: 50%;
                /* top: 50%; */
                transform: translate(-50%, -50%);
                z-index: 5;
            }

            .user-image img {
                height: 80px;
                width: 80px;
                border-radius: 50%;
                top: -40px;
                border: 5px solid #777;
            }

            .profile-card .profile-content {
                padding: 50px 20px 30px 20px;
            }



            .profile-card .profile-name {
                font-size: 1.2rem;
                color: #3249b9;
                font-weight: 600;
                text-align: center;
            }

            .profile-card .profile-designation {
                font-size: 13px;
                color: #777;
                text-align: center;
            }

            .profile-card .profile-description {
                padding: 10px;
                font-size: 13px;
                color: #777;
                margin: 5px 0px;
                background-color: #F1F2F3;
                border-radius: 5px;
            }

            .profile-card ul.profile-info-list {
                padding: 0;
                margin: 10px 0;
                list-style: none;
                font-size: 1rem;
                font-weight: 500;
                color: #777;
            }




            .profile-card ul.profile-info-list a {
                text-decoration: none;
                color:inherit;
            }



            .profile-card a.profile-info-list-item {
                margin: 10px 0;
                padding:15px;
                background-color: #F1F2F3;
                display: block;
                -webkit-transition: all .5s ease-in-out;
                -o-transition: all .5s ease-in-out;
                transition: all .5s ease-in-out;

            }

            .profile-card a.profile-info-list-item:hover {
                background-color: #9E9E9E;
                color: white;
                -webkit-transition: all .5s ease-in-out;
                -o-transition: all .5s ease-in-out;
                transition: all .5s ease-in-out;

            }


            .profile-card a.profile-info-list-item  i {
                padding: 10px;

            }

            ul.about {
                list-style: none;
                color: black;
                padding: 0;
            }
            li.about-items {
                margin: 10px;
                font-size: 0.9rem;
                /* font-family: sans-serif; */
                /* font-weight: 400; */
            }



            li.about-items i {
                color:#607d8b;
            }

            span.about-item-name {
                width: 100px;
                display: inline-flex;
                margin-left: 10px;
            }


            span.about-item-detail {
                display: inline-flex;
                width: calc(100% - 160px);
            }
            span.about-item-detail > button{
                margin-right: 10px;
            }

            .btn.btn-icon {
                width: 40px;
                height: 40px;
                padding: 0;
            }
            .btn.btn-rounded {
                border-radius: 50px;
            }

            a.about-item-edit {
                float: right;
            }
        </style>
    </head>

    <body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">


            <!-- Nav Item - Dashboard -->
            <?php require 'menu.php'?>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <?php require 'notifications.php'?>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <?php require 'userOptions.php';?>

                    </ul>
                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3" style="text-align:Center;">
                                    <h6 class="m-0 font-weight-bold text-primary"> ENROLMENT AGREEMENT FORM </h6>
                                </div>

                                <div class="card-body border-bottom-success">
                                    <!--NEW CODE-->
                                    <div class="container">
                                        <div class="title">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">

                                                <!-- Tabs with icons on Card -->
                                                <div class="card card-nav-tabs">
                                                    <div class="card-header card-header-primary">
                                                        <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                                                        <div class="nav-tabs-navigation">
                                                            <div class="nav-tabs-wrapper">
                                                                <ul class="nav nav-tabs" data-tabs="tabs">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active" href="#A1" data-toggle="tab">
                                                                            <i class="material-icons">face</i>
                                                                            1. Qualification and Short Courses  Information
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#A2" data-toggle="tab">
                                                                            <i class="material-icons">fingerprint</i>
                                                                            PART A : PERSONAL AND STATISTICAL DETAILS
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#A3" data-toggle="tab">
                                                                            <i class="material-icons"> verified</i>
                                                                            USI & VSN
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#A4" data-toggle="tab">
                                                                            <i class="material-icons">build</i>
                                                                            EMPLOYMENT DETAILS
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#A5" data-toggle="tab">
                                                                            <i class="material-icons">card_membership</i>
                                                                            Education details
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#A6" data-toggle="tab">
                                                                            <i class="material-icons">favorite_border</i>
                                                                            Background & Health State
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#A7" data-toggle="tab">
                                                                            <i class="material-icons">school</i>
                                                                            STUDY REASON
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#A9" data-toggle="tab">
                                                                            <i class="material-icons">fact_check</i>
                                                                            IDENTIFICATION
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#A8" data-toggle="tab">
                                                                            <i class="material-icons">credit_card</i>
                                                                            TUITION,PAYMENT Details </i>
                                                                            STUDY REASON
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#A10" data-toggle="tab">
                                                                            <i class="material-icons">credit_card</i>
                                                                            Student Deceleration
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div><div class="card-body ">
                                                        <div class="tab-content text-center">
                                                            <div class="tab-pane active" id="A1">
                                                                <div class="col-md-12">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <p class="card-title font-weight-bold"><?php echo $row['firstname'].' '.$row['lastname'];?></p>
                                                                            <hr>
                                                                            <p class="card-description">Qualification and Short Courses  Information</p>
                                                                            <ul class="about">
                                                                                <li>
                                                                                    <table class="table table-striped">
                                                                                        <thead>
                                                                                        <tr>
                                                                                            <th scope="col">Fee for Service</th>
                                                                                            <th scope="col">Government Subsidised</th>
                                                                                            <th scope="col">Course</th>
                                                                                        </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                        <?php

                                                                                        foreach ($qualification as $value) {
                                                                                            ?>
                                                                                            <tr>
                                                                                                <th scope="row">
                                                                                                    <?php
                                                                                                    if($value['qualificationCost']=='["Fee for Service"]'){
                                                                                                        ?>
                                                                                                        <i class="material-icons">done</i>
                                                                                                    <?php } else{ ?>
                                                                                                        <i class="material-icons">close</i>
                                                                                                    <?php }?>
                                                                                                </th>
                                                                                                <td>
                                                                                                    <?php
                                                                                                    if($value['qualificationCost']=='["Government Subsidised"]'){
                                                                                                        ?>
                                                                                                        <i class="material-icons">done</i>
                                                                                                    <?php } else{ ?>
                                                                                                        <i class="material-icons">close</i>
                                                                                                    <?php }?>
                                                                                                </td>
                                                                                                <td><?php echo $value['qualificationTitle'];?></td>
                                                                                            </tr>
                                                                                        <?php } ?>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </li>
                                                                            </ul>

                                                                            <p class="card-description" style="background:black;color:white;">Short Courses and Skills Set</p>
                                                                            <ul class="about">
                                                                                <li>
                                                                                    <table class="table table-striped">
                                                                                        <thead>
                                                                                        <tr>
                                                                                            <th scope="col">Fee for Service</th>
                                                                                            <th scope="col">Title</th>
                                                                                        </tr>
                                                                                        </thead>
                                                                                        <?php/*
                                                                                print_r("<pre>");
                                                                                print_r($short_qualification);
                                                                                print_r("</pre>");*/
                                                                                        ?>
                                                                                        <tbody>
                                                                                        <?php

                                                                                        foreach ($short_qualification as $value) {
                                                                                            ?>
                                                                                            <tr>
                                                                                                <th scope="row">

                                                                                                    <i class="material-icons">done</i>

                                                                                                </th>
                                                                                                <td><?php echo $value['shortCourse'];?></td>
                                                                                            </tr>
                                                                                        <?php } ?>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane" id="A2">
                                                                <div class="col-md-12">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <ul class="about">
                                                                                <li class="about-items"><i class="mdi mdi-account icon-sm "></i><span class="about-item-name">Mode of Study:</span><span class="about-item-detail"><?php echo $qualification[0]['modeOfstudy'];?></span></li>
                                                                            </ul>
                                                                            <p class="card-description" style="color:white; background:black;">PERSONAL DETAILS</p>
                                                                            <?php var_dump($row);?>
                                                                            <ul class="about">
                                                                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                                    <span class="about-item-name">Title</span>
                                                                                    <span class="about-item-detail">
                                                                                        <?php echo $row["title"];?>
                                                                            </span>
                                                                                </li>
                                                                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                                    <span class="about-item-name">Gender</span>
                                                                                    <span class="about-item-detail">
                                                                                        <?php echo $row["genderDetails"];?>
                                                                            </span>
                                                                                </li>

                                                                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                                    <span class="about-item-name">First Name</span>
                                                                                    <span class="about-item-detail">
                                                                                        <?php echo $row ["firstname"];?>
                                                                            </span>
                                                                                </li>
                                                                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                                    <span class="about-item-name">Middle Name</span>
                                                                                    <span class="about-item-detail">
                                                                                        <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                                        }else{
                                                                                            echo "-";
                                                                                        }?>
                                                                            </span>
                                                                                </li>
                                                                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                                    <span class="about-item-name">Last Name</span>
                                                                                    <span class="about-item-detail">
                                                                            <?php if(!empty($row   ["lastname"])){echo $row   ["lastname"];
                                                                            }else{
                                                                                echo "-";
                                                                            }?>
                                                                            </span>
                                                                                </li>
                                                                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                                    <span class="about-item-name">Date of Birth:</span>
                                                                                    <span class="about-item-detail">
                                                                            <?php if(!empty($row  ["dob"])){echo $row  ["dob"];
                                                                            }else{
                                                                                echo "-";
                                                                            }?>
                                                                            </span>
                                                                                </li>
                                                                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                                    <span class="about-item-name">Residential Address:</span>
                                                                                    <span class="about-item-detail">
                                                                            <?php if(!empty($row  ["residentialAddress"])){echo $row  ["residentialAddress"];
                                                                            }else{
                                                                                echo "-";
                                                                            }?>
                                                                            </span>
                                                                                </li>
                                                                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                                    <span class="about-item-name">Suburb/Town:  </span>
                                                                                    <span class="about-item-detail">
                                                                            <?php if(!empty($row  ["suburbtown"])){echo $row  ["suburbtown"];
                                                                            }else{
                                                                                echo "-";
                                                                            }?>
                                                                            </span>
                                                                                </li>
                                                                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                                    <span class="about-item-name">State:  </span>
                                                                                    <span class="about-item-detail">
                                                                            <?php if(!empty($row  ["states"])){echo $row  ["states"];
                                                                            }else{
                                                                                echo "-";
                                                                            }?>
                                                                            </span>
                                                                                </li>
                                                                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                                    <span class="about-item-name">Postcode:  </span>
                                                                                    <span class="about-item-detail">
                                                                            <?php if(!empty($row  ["postcode"])){echo $row  ["postcode"];
                                                                            }else{
                                                                                echo "-";
                                                                            }?>
                                                                            </span>
                                                                                </li>
                                                                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                                    <span class="about-item-name">Postal Address:</span>
                                                                                    <span class="about-item-detail">
                                                                            <?php if(!empty($row  ["postalAddress"])){echo $row  ["postalAddress"];
                                                                            }else{
                                                                                echo "-";
                                                                            }?>
                                                                            </span>
                                                                                </li>
                                                                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                                    <span class="about-item-name">Home phone:</span>
                                                                                    <span class="about-item-detail">
                                                                            <?php if(!empty($row  ["homePhone"])){echo $row  ["homePhone"];
                                                                            }else{
                                                                                echo "-";
                                                                            }?>
                                                                            </span>
                                                                                </li>
                                                                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                                    <span class="about-item-name">Mobile: </span>
                                                                                    <span class="about-item-detail">
                                                                            <?php if(!empty($row  ["mobile"])){echo $row  ["mobile"];
                                                                            }else{
                                                                                echo "-";
                                                                            }?>
                                                                            </span>
                                                                                </li>
                                                                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                                    <span class="about-item-name">Fax: </span>
                                                                                    <span class="about-item-detail">
                                                                            <?php if(!empty($row  ["fax"])){echo $row  ["fax"];
                                                                            }else{
                                                                                echo "-";
                                                                            }?>
                                                                            </span>
                                                                                </li>
                                                                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                                    <span class="about-item-name">Email: </span>
                                                                                    <span class="about-item-detail">
                                                                            <?php if(!empty($row  ["email"])){echo $row  ["email"];
                                                                            }else{
                                                                                echo "-";
                                                                            }?>
                                                                            </span>
                                                                                </li>
                                                                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                                    <span class="about-item-name">Preferred method of contact:  </span>
                                                                                    <span class="about-item-detail">
                                                                            <?php if(!empty($row  ["preferredMethod"])){echo $row  ["preferredMethod"];
                                                                            }else{
                                                                                echo "-";
                                                                            }?>
                                                                            </span>
                                                                                </li>
                                                                            </ul>


                                                                            <p class="card-description" style="color:white; background:black;">EMERGENCY CONTACT DETAILS</p>
                                                                            <ul class="about">
                                                                                <li class="about-items">
                                                                                    <i class="mdi mdi-format-align-left icon-sm "></i>
                                                                                    <span class="about-item-name">Name:</span>
                                                                                    <span class="about-item-detail">
                                                                            <?php if(!empty($row  ["relationname"])){echo $row  ["relationname"];
                                                                            }else{
                                                                                echo "-";
                                                                            }?>
                                                                            </span>
                                                                                </li>
                                                                                <li class="about-items">
                                                                                    <i class="mdi mdi-format-align-left icon-sm "></i>
                                                                                    <span class="about-item-name">Relationship:</span>
                                                                                    <span class="about-item-detail">
                                                                            <?php if(!empty($row  ["relationship"])){echo $row  ["relationship"];
                                                                            }else{
                                                                                echo "-";
                                                                            }?>
                                                                            </span>
                                                                                </li>
                                                                                <li class="about-items">
                                                                                    <i class="mdi mdi-format-align-left icon-sm "></i>
                                                                                    <span class="about-item-name">Home Number:  </span>
                                                                                    <span class="about-item-detail">
                                                                            <?php if(!empty($row  ["relationhomeNumber"])){echo $row  ["relationhomeNumber"];
                                                                            }else{
                                                                                echo "-";
                                                                            }?>
                                                                            </span>
                                                                                </li>
                                                                                <li class="about-items">
                                                                                    <i class="mdi mdi-format-align-left icon-sm "></i>
                                                                                    <span class="about-item-name">Mobile:</span>
                                                                                    <span class="about-item-detail">
                                                                            <?php if(!empty($row  ["relationmobile"])){echo $row  ["relationmobile"];
                                                                            }else{
                                                                                echo "-";
                                                                            }?>
                                                                            </span>
                                                                                </li>
                                                                                <li class="about-items">
                                                                                    <i class="mdi mdi-format-align-left icon-sm "></i> <br>
                                                                                    <span class="">In the event of an emergency, do you give the RTO permission to organise emergency transport and treatment and
                                                                            agree to pay all costs related to the emergency?</span>
                                                                                </li>
                                                                                <li class="about-items" style="text-align:center;">
                                                                            <span class="" >
                                                                            <?php if(!empty($row  ["emergencyPrefernce"])){echo $row  ["emergencyPrefernce"];
                                                                            }else{
                                                                                echo "-";
                                                                            }?>
                                                                            </span>
                                                                                </li>
                                                                            </ul>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane" id="A3">
                                                                <p class="card-description" style="color:white; background:black;">UNIQUE STUDENT IDENTIFIER (USI)</p>
                                                                <ul class="about">
                                                                    <li class="about-items">
                                                                        <i class="mdi mdi-format-align-left icon-sm "></i> <br>
                                                                        <span class="">I give permission for Optimistic Futures Pty Ltd to access my Unique Student Identifier (USI) for the purpose of recording my results.</span>
                                                                    </li>
                                                                    <li class="about-items" style="text-align:center;">
                                                                                <span class="" >
                                                                                <?php if(!empty($usi  ["usi"])){echo $usi  ["usi"];
                                                                                }else{
                                                                                    echo "-";
                                                                                }?>
                                                                                </span>
                                                                    </li>
                                                                    <li class="about-items">
                                                                        <i class="mdi mdi-format-align-left icon-sm "></i> <br>
                                                                        <span class="">If I do not have a USI in place, I am willing for Optimistic Futures Pty Ltd to set up my USI on my behalf.</span>
                                                                    </li>
                                                                    <li class="about-items" style="text-align:center;">
                                                                                <span class="" >
                                                                                <?php if(!empty($usi ["usisignature"])){echo "<img src='<?php echo $usi ['usisignature'];?>'/>";
                                                                                }else{
                                                                                    echo "-";
                                                                                }?>
                                                                                </span>
                                                                    </li>
                                                                </ul>

                                                                <p class="card-description" style="color:white; background:black;">VICTORIAN STUDENT NUMBER (VSN)</p>
                                                                <ul class="about">
                                                                    <li class="about-items">
                                                                        <i class="mdi mdi-format-align-left icon-sm "></i> <br>
                                                                        <span class="">If you are under 25 years of age – you may have a VSN from pervious enrolment</span>
                                                                    </li>
                                                                    <li class="about-items" style="text-align:center;">
                                                                                <span class="" >
                                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                                }else{
                                                                                    echo "-";
                                                                                }?>
                                                                                </span>
                                                                    </li>
                                                                    <li class="about-items">
                                                                        <i class="mdi mdi-format-align-left icon-sm "></i> <br>
                                                                        <span class="">If you do not know your VSN number, then please state your Previous School:  </span>
                                                                    </li>
                                                                    <li class="about-items" style="text-align:center;">
                                                                                <span class="" >
                                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                                }else{
                                                                                    echo "-";
                                                                                }?>
                                                                                </span>
                                                                    </li>

                                                                    <li class="about-items">
                                                                        <i class="mdi mdi-format-align-left icon-sm "></i> <br>
                                                                        <span class="">If new to the education sector – tick the ‘new’ box </span>
                                                                    </li>
                                                                    <li class="about-items" style="text-align:center;">
                                                                                <span class="" >
                                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                                }else{
                                                                                    echo "-";
                                                                                }?>
                                                                                </span>
                                                                    </li>
                                                                    <li class="about-items">
                                                                        <span class="">This means you have never attended a Victorian School, TAFE or other Training Provider and are over the age of 25 at the time of enrolment. </span>
                                                                    </li>
                                                                </ul>

                                                            </div>
                                                            <div class="tab-pane" id="A4">
                                                                <p class="card-description" style="color:white; background:black;">EMPLOYMENT</p>
                                                                <ul class="about">
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Employment status</span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Occupation</span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Industry</span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                </ul>
                                                                <p class="card-description" style="color:white; background:black;">EMPLOYMENT DETAILS (if applicable)</p>
                                                                <ul class="about">
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Organisation: </span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Position:</span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li> <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Address:</span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                    </li>
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Telephone: </span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">ABN: </span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="tab-pane" id="A5">
                                                                <p class="card-description" style="color:white; background:black;">SCHOOLING</p>
                                                                <ul class="about">
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Highest COMPLETED school Level: </span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Year:</span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li> <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Currently Attending School:</span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                    </li>
                                                                </ul>
                                                                <p class="card-description" style="color:white; background:black;">PREVIOUS QUALIFICATIONS ACHIEVED</p>
                                                                <ul class="about">
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">SUCCESSFULLY Completed any Qualification: </span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                    <li>
                                                                        <table class="table table-striped">
                                                                            <thead>
                                                                            <tr>
                                                                                <th scope="col">Australia</th>
                                                                                <th scope="col">Australian equivalent</th>
                                                                                <th scope="col">International (Overseas</th>
                                                                                <th scope="col">Course</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <?php /*
                                                                    print_r("<pre>");
                                                                    print_r($qualification);
                                                                    print_r("</pre>");*/
                                                                            ?>
                                                                            <tbody>
                                                                            <?php

                                                                            foreach ($qualification as $value) {
                                                                                ?>
                                                                                <tr>
                                                                                    <th scope="row">
                                                                                        <?php
                                                                                        if($value['qualificationCost']=='["Fee for Service"]'){
                                                                                            ?>
                                                                                            <i class="material-icons">done</i>
                                                                                        <?php } else{ ?>
                                                                                            <i class="material-icons">close</i>
                                                                                        <?php }?>
                                                                                    </th>
                                                                                    <td>
                                                                                        <?php
                                                                                        if($value['qualificationCost']=='["Government Subsidised"]'){
                                                                                            ?>
                                                                                            <i class="material-icons">done</i>
                                                                                        <?php } else{ ?>
                                                                                            <i class="material-icons">close</i>
                                                                                        <?php }?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <?php
                                                                                        if($value['qualificationCost']=='["Government Subsidised"]'){
                                                                                            ?>
                                                                                            <i class="material-icons">done</i>
                                                                                        <?php } else{ ?>
                                                                                            <i class="material-icons">close</i>
                                                                                        <?php }?>
                                                                                    </td>
                                                                                    <td><?php echo $value['qualificationTitle'];?></td>
                                                                                </tr>
                                                                            <?php } ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="tab-pane" id="A6">
                                                                <p class="card-description" style="color:white; background:black;">LANGUAGE & CULTURAL DIVERSITY</p>
                                                                <ul class="about">
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Country of Birth: </span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">City of birth:</span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li> <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Citizenship Status:</span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Language:</span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">English speaking level:</span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Aboriginal or Torres Strait Islander origin:</span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                </ul>
                                                                <p class="card-description" style="color:white; background:black;">DISABILITY</p>
                                                                <ul class="about">
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Any Disability:</span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Type:</span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                </ul>


                                                            </div>
                                                            <div class="tab-pane" id="A7">
                                                                <ul class="about">
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Reason: </span>
                                                                        <span class="about-item-detail">
                                                                    <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                    }else{
                                                                        echo "-";
                                                                    }?>
                                                                    </span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="tab-pane" id="A9">
                                                                <ul class="about">
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Reason: </span>
                                                                        <span class="about-item-detail">
                                                                    <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                    }else{
                                                                        echo "-";
                                                                    }?>
                                                                    </span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="tab-pane" id="A8">
                                                                <p class="card-description" style="color:white; background:black;">TUITION FEES</p>
                                                                <span>Fee Concession or Fee Waivers</span>
                                                                <ul class="about">
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Have concession card: </span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Type: </span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Referral: </span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                </ul>

                                                                <p class="card-description" style="color:white; background:black;">PAYMENT METHOD</p>
                                                                <ul class="about">
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Method: </span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="tab-pane" id="A10">
                                                                <p class="card-description" style="color:white; background:black;">Student Declaration and Consent</p>
                                                                <span>Fee Concession or Fee Waivers</span>
                                                                <ul class="about">
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Consent for displaying testimonials: </span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Consent for displaying photo: </span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Signature: </span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Date: </span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Parent Signature: </span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                        <span class="about-item-name">Date: </span>
                                                                        <span class="about-item-detail">
                                                                <?php if(!empty($row  ["middlename"])){echo $row  ["middlename"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Tabs with icons on Card -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy;  Optimistic Futures Enrolment Management System</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php require 'logoutmodal.php';?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
    </body>

    </html>
    <?php
}else{
    header("Location: /login.php");
    exit();
}
?>