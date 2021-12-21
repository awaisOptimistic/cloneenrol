<?php
$userId=$_GET['user'];
try {
    include ('config.php');
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
    $usi  = $stmt4->fetch(PDO::FETCH_ASSOC);

    $query5 = "SELECT * FROM `employment` where std_id=:std_id";
    $stmt5 = $pdo->prepare($query5);
    $stmt5->bindParam('std_id', $userId, PDO::PARAM_STR);
    $stmt5->execute();
    $employment  = $stmt5->fetch(PDO::FETCH_ASSOC);

    $query6 = "SELECT * FROM `schooling` where std_id=:std_id";
    $stmt6 = $pdo->prepare($query6);
    $stmt6->bindParam('std_id', $userId, PDO::PARAM_STR);
    $stmt6->execute();
    $schooling  = $stmt6->fetch(PDO::FETCH_ASSOC);
    
    $query7 = "SELECT * FROM `previous_qualification` where std_id=:std_id";
    $stmt7 = $pdo->prepare($query7);
    $stmt7->bindParam('std_id', $userId, PDO::PARAM_STR);
    $stmt7->execute();
    $previous_qualification = $stmt7->fetchAll(PDO::FETCH_ASSOC);

    $query8 = "SELECT * FROM `concession_detail` where std_id=:std_id";
    $stmt8 = $pdo->prepare($query8);
    $stmt8->bindParam('std_id', $userId, PDO::PARAM_STR);
    $stmt8->execute();
    $concession_detail = $stmt8->fetch(PDO::FETCH_ASSOC);

  } catch (PDOException $e) {
    echo "Error : ".$e->getMessage();
  }


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


    <Style>
    button,
input {
    font-family: "Montserrat", "Helvetica Neue", Arial, sans-serif;
}

a {
    color: #f96332;
}

a:hover,
a:focus {
    color: #f96332;
}

p {
    line-height: 1.61em;
    font-weight: 300;
    font-size: 1.2em;
}

.category {
    text-transform: capitalize;
    font-weight: 700;
    color: #9A9A9A;
}

body {
    color: #2c2c2c;
    font-size: 14px;
    font-family: "Montserrat", "Helvetica Neue", Arial, sans-serif;
    overflow-x: hidden;
    -moz-osx-font-smoothing: grayscale;
    -webkit-font-smoothing: antialiased;
}

.nav-item .nav-link,
.nav-tabs .nav-link {
    -webkit-transition: all 300ms ease 0s;
    -moz-transition: all 300ms ease 0s;
    -o-transition: all 300ms ease 0s;
    -ms-transition: all 300ms ease 0s;
    transition: all 300ms ease 0s;
}

.card a {
    -webkit-transition: all 150ms ease 0s;
    -moz-transition: all 150ms ease 0s;
    -o-transition: all 150ms ease 0s;
    -ms-transition: all 150ms ease 0s;
    transition: all 150ms ease 0s;
}

[data-toggle="collapse"][data-parent="#accordion"] i {
    -webkit-transition: transform 150ms ease 0s;
    -moz-transition: transform 150ms ease 0s;
    -o-transition: transform 150ms ease 0s;
    -ms-transition: all 150ms ease 0s;
    transition: transform 150ms ease 0s;
}

[data-toggle="collapse"][data-parent="#accordion"][aria-expanded="true"] i {
    filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=2);
    -webkit-transform: rotate(180deg);
    -ms-transform: rotate(180deg);
    transform: rotate(180deg);
}


.now-ui-icons {
    display: inline-block;
    font: normal normal normal 14px/1 'Nucleo Outline';
    font-size: inherit;
    speak: none;
    text-transform: none;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

@-webkit-keyframes nc-icon-spin {
    0% {
        -webkit-transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
    }
}

@-moz-keyframes nc-icon-spin {
    0% {
        -moz-transform: rotate(0deg);
    }

    100% {
        -moz-transform: rotate(360deg);
    }
}

@keyframes nc-icon-spin {
    0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}

.now-ui-icons.objects_umbrella-13:before {
    content: "\ea5f";
}

.now-ui-icons.shopping_cart-simple:before {
    content: "\ea1d";
}

.now-ui-icons.shopping_shop:before {
    content: "\ea50";
}

.now-ui-icons.ui-2_settings-90:before {
    content: "\ea4b";
}

.nav-tabs {
    border: 0;
    padding: 15px 0.7rem;
}

.nav-tabs:not(.nav-tabs-neutral)>.nav-item>.nav-link.active {
    box-shadow: 0px 5px 35px 0px rgba(0, 0, 0, 0.3);
}

.card .nav-tabs {
    border-top-right-radius: 0.1875rem;
    border-top-left-radius: 0.1875rem;
}

.nav-tabs>.nav-item>.nav-link {
    color: #888888;
    margin: 0;
    margin-right: 5px;
    background-color: transparent;
    border: 1px solid transparent;
    border-radius: 30px;
    font-size: 14px;
    padding: 11px 23px;
    line-height: 1.5;
}

.nav-tabs>.nav-item>.nav-link:hover {
    background-color: transparent;
}

.nav-tabs>.nav-item>.nav-link.active {
    background-color: #444;
    border-radius: 30px;
    color: #FFFFFF;
}

.nav-tabs>.nav-item>.nav-link i.now-ui-icons {
    font-size: 14px;
    position: relative;
    top: 1px;
    margin-right: 3px;
}

.nav-tabs.nav-tabs-neutral>.nav-item>.nav-link {
    color: #FFFFFF;
}

.nav-tabs.nav-tabs-neutral>.nav-item>.nav-link.active {
    background-color: rgba(255, 255, 255, 0.2);
    color: #FFFFFF;
}

.card {
    border: 0;
    border-radius: 0.1875rem;
    display: inline-block;
    position: relative;
    width: 100%;
    margin-bottom: 30px;
    box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
}

.card .card-header {
    background-color: transparent;
    border-bottom: 0;
    background-color: transparent;
    border-radius: 0;
    padding: 0;
}

.card[data-background-color="orange"] {
    background-color: #f96332;
}

.card[data-background-color="red"] {
    background-color: #FF3636;
}

.card[data-background-color="yellow"] {
    background-color: #FFB236;
}

.card[data-background-color="blue"] {
    background-color: #2CA8FF;
}

.card[data-background-color="green"] {
    background-color: #15b60d;
}

[data-background-color="orange"] {
    background-color: #e95e38;
}

[data-background-color="black"] {
    background-color: #2c2c2c;
}

[data-background-color]:not([data-background-color="gray"]) {
    color: #FFFFFF;
}

[data-background-color]:not([data-background-color="gray"]) p {
    color: #FFFFFF;
}

[data-background-color]:not([data-background-color="gray"]) a:not(.btn):not(.dropdown-item) {
    color: #FFFFFF;
}

[data-background-color]:not([data-background-color="gray"]) .nav-tabs>.nav-item>.nav-link i.now-ui-icons {
    color: #FFFFFF;
}


@font-face {
  font-family: 'Nucleo Outline';
  src: url("https://github.com/creativetimofficial/now-ui-kit/blob/master/assets/fonts/nucleo-outline.eot");
  src: url("https://github.com/creativetimofficial/now-ui-kit/blob/master/assets/fonts/nucleo-outline.eot") format("embedded-opentype");
  src: url("https://raw.githack.com/creativetimofficial/now-ui-kit/master/assets/fonts/nucleo-outline.woff2");
  font-weight: normal;
  font-style: normal;
        
}

.now-ui-icons {
  display: inline-block;
  font: normal normal normal 14px/1 'Nucleo Outline';
  font-size: inherit;
  speak: none;
  text-transform: none;
  /* Better Font Rendering */
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}


footer{
    margin-top:50px;
    color: #555;
    background: #fff;
    padding: 25px;
    font-weight: 300;
    background: #f7f7f7;
    
}
.footer p{
    margin-bottom: 0;
}
footer p a{
    color: #555;
    font-weight: 400;
}

footer p a:hover{
    color: #e86c42;
}

@media screen and (max-width: 768px) {

    .nav-tabs {
        display: inline-block;
        width: 100%;
        padding-left: 100px;
        padding-right: 100px;
        text-align: center;
    }

    .nav-tabs .nav-item>.nav-link {
        margin-bottom: 5px;
    }
}
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
    background: linear-gradient( 
60deg
 ,#1abc9c,#14c44f);
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

<div class="row">
    <div class="col-md-10 ml-auto col-xl-6 mr-auto">
      <!-- Nav tabs -->
      <div class="card">
        <div class="card-header">
          <ul class="nav nav-tabs justify-content-center" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#A1" role="tab">
              <i class="material-icons">face</i> 1. Qualification and Short Courses  Information
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#A2" role="tab">
              <i class="material-icons">fingerprint</i> PART A : PERSONAL AND STATISTICAL DETAILS
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#A11" role="tab">
              <i class="material-icons">card</i> CONCESSION DETAILS
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#A3" role="tab">
              <i class="material-icons"> verified</i>
               USI & VSN
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#A4" role="tab">
              <i class="material-icons">build</i>
                                                                    EMPLOYMENT DETAILS
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#A5" role="tab">
              <i class="material-icons">card_membership</i>
                                                                    Education details
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#A6" role="tab">
              <i class="material-icons">favorite_border</i>
                                                                    Background & Health State
              </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#A7" role="tab">
            <i class="material-icons">school</i>
            STUDY REASON
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#A8" role="tab">
              <i class="material-icons">credit_card</i>
                                                                    TUITION,PAYMENT Details </i>
                                                                    STUDY REASON
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#A9" role="tab">
              <i class="material-icons">fact_check</i>
                                                                    IDENTIFICATION
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#A10" role="tab">
              <i class="material-icons">credit_card</i>
                                                                    Student Deceleration
              </a>
            </li>

          </ul>
        </div>
        <div class="card-body">
          <!-- Tab panes -->
          <div class="tab-content text-center">

            <div class="tab-pane active" id="A1" role="tabpanel">
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
                                        <?php
                                        /* 
                                        print_r("<pre>");
                                        print_r($short_qualification); 
                                        print_r("</pre>");
                                        */
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
            <div class="tab-pane" id="A2" role="tabpanel">
                <div class="col-md-12">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <ul class="about">
                                                                        <li class="about-items"><i class="mdi mdi-account icon-sm "></i><span class="about-item-name">Mode of Study:</span><span class="about-item-detail"><?php echo $qualification[0]['modeOfstudy'];?></span></li>
                                                                    </ul>
                                                                    <p class="card-description" style="color:white; background:black;">PERSONAL DETAILS</p>
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
            <div class="tab-pane" id="A3" role="tabpanel">
                <p class="card-description" style="color:white; background:black;">UNIQUE STUDENT IDENTIFIER (USI)</p>
                                                    <ul class="about">
                                                        <li class="about-items">
                                                        <i class="mdi mdi-format-align-left icon-sm "></i> <br>
                                                        <span class="">I give permission for Optimistic Futures Pty Ltd to access my Unique Student Identifier (USI) for the purpose of recording my results.</span> 
                                                        </li>        
                                                        <li class="about-items" style="text-align:center;">
                                                            <span class="" >
                                                            <?php if(!empty($usi ["usi"])){echo $usi  ["usi"];
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
                                                            <?php if(!empty($usi ["usisignature"])){echo "<img src='".$usi ['usisignature']."'/>";
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
                                                            <?php if(!empty($row  ["vsn"])){echo $row  ["vsn"];
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
                                                            <?php if(!empty($row  ["noVSN"])){echo $row  ["noVSN"];
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
                                                            <?php if(!empty($row  ["newEducationSector"])){echo $row  ["newEducationSector"];
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

            <div class="tab-pane" id="A4" role="tabpanel">
              
                <p class="card-description" style="color:white; background:black;">EMPLOYMENT</p>
                                                        <ul class="about"> 
                                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                <span class="about-item-name">Employment status</span>
                                                                <span class="about-item-detail">
                                                                <?php if(!empty($employment  ["employmentStatus"])){echo $employment  ["employmentStatus"];
                                                                                            }else{
                                                                                                echo "-";
                                                                                        }?>
                                                                </span> 
                                                            </li> 
                                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                <span class="about-item-name">Occupation</span>
                                                                <span class="about-item-detail">
                                                                <?php if(!empty($employment  ["employmentRole"])){echo $employment  ["employmentRole"];
                                                                                            }else{
                                                                                                echo "-";
                                                                                        }?>
                                                                </span> 
                                                            </li> 
                                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                <span class="about-item-name">Industry</span>
                                                                <span class="about-item-detail">
                                                                <?php if(!empty($employment  ["employmentSector"])){echo $employment  ["employmentSector"];
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
                                                                <?php if(!empty($employment  ["organisation"])){echo $employment  ["organisation"];
                                                                                            }else{
                                                                                                echo "-";
                                                                                        }?>
                                                                </span> 
                                                            </li> 
                                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                <span class="about-item-name">Position:</span>
                                                                <span class="about-item-detail">
                                                                <?php if(!empty($employment  ["organisationPosition"])){echo $employment  ["organisationPosition"];
                                                                                            }else{
                                                                                                echo "-";
                                                                                        }?>
                                                                </span> 
                                                            </li> <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                <span class="about-item-name">Address:</span>
                                                                <span class="about-item-detail">
                                                                <?php if(!empty($employment  ["organisationAddress"])){echo $employment  ["organisationAddress"];
                                                                                            }else{
                                                                                                echo "-";
                                                                                        }?>
                                                                </span> 
                                                            </li> 
                                                            </li> 
                                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                <span class="about-item-name">Telephone: </span>
                                                                <span class="about-item-detail">
                                                                <?php if(!empty($employment  ["organisationTelephone"])){echo $employment  ["organisationTelephone"];
                                                                                            }else{
                                                                                                echo "-";
                                                                                        }?>
                                                                </span>
                                                            </li>
                                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                <span class="about-item-name">ABN: </span>
                                                                <span class="about-item-detail">
                                                                <?php if(!empty($employment  ["abn"])){echo $employment  ["abn"];
                                                                                            }else{
                                                                                                echo "-";
                                                                                        }?>
                                                                </span> 
                                                            </li>
                                                        </ul>
                                                    
            </div>
            
            <div class="tab-pane" id="A5" role="tabpanel">
              
                <p class="card-description" style="color:white; background:black;">SCHOOLING</p>
                                                        <ul class="about"> 
                                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                <span class="about-item-name">Highest COMPLETED school Level: </span>
                                                                <span class="about-item-detail">
                                                                <?php if(!empty($schooling  ["schoolingLevel"])){echo $schooling  ["schoolingLevel"];
                                                                                            }else{
                                                                                                echo "-";
                                                                                        }?>
                                                                </span> 
                                                            </li> 
                                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                <span class="about-item-name">Year:</span>
                                                                <span class="about-item-detail">
                                                                <?php if(!empty($schooling  ["schoolingLevelYear"])){echo $schooling  ["schoolingLevelYear"];
                                                                                            }else{
                                                                                                echo "-";
                                                                                        }?>
                                                                </span> 
                                                            </li> <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                <span class="about-item-name">Currently Attending School:</span>
                                                                <span class="about-item-detail">
                                                                <?php if(!empty($schooling  ["schoolingStatus"])){echo $schooling  ["schoolingStatus"];
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
                                                                <?php if(!empty($previous_qualification  [0]["qualificationStatus"])){echo $previous_qualification [0]["qualificationStatus"];
                                                                                            }else{
                                                                                                echo "-";
                                                                                        }?>
                                                                </span> 
                                                            </li> 
                                                            <?php if($previous_qualification[0]["qualificationStatus"]!='No'){?>
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
                                                                            //var_dump($previous_qualification);
                                                                            foreach ($previous_qualification as $value) {
                                                                        ?>
                                                                        <tr>
                                                                        <th scope="row">
                                                                                <?php
                                                                                if($value['qualificationType']=='["Australia"]'){
                                                                                ?>
                                                                                    <i class="material-icons">done</i>
                                                                                <?php } else{ ?>
                                                                                    <i class="material-icons">close</i>
                                                                                    <?php }?>
                                                                        </th>
                                                                        <td>
                                                                            <?php
                                                                                if($value['qualificationType']=='["Australian equivalent"]'){
                                                                                ?>
                                                                                    <i class="material-icons">done</i>
                                                                                <?php } else{ ?>
                                                                                    <i class="material-icons">close</i>
                                                                                    <?php }?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                if($value['qualificationType']=='["International (Overseas)"]'){
                                                                                ?>
                                                                                    <i class="material-icons">done</i>
                                                                                <?php } else{ ?>
                                                                                    <i class="material-icons">close</i>
                                                                                    <?php }?>
                                                                        </td>
                                                                        <td><?php echo $value['qualificationName'];?></td>
                                                                        </tr>
                                                                        <?php } ?>
                                                                    </tbody>
                                                                </table>
                                                             </li>
                                                             <?php }?>
                                                            </ul>
                                                    
            </div>

            <div class="tab-pane" id="A6" role="tabpanel">
              
                                                        <p class="card-description" style="color:white; background:black;">LANGUAGE & CULTURAL DIVERSITY</p>
                                                        <ul class="about"> 
                                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                <span class="about-item-name">Country of Birth: </span>
                                                                <span class="about-item-detail">
                                                                <?php if(!empty($row  ["birthCountry"])){echo $row  ["birthCountry"];
                                                                                            }else{
                                                                                                echo "-";
                                                                                        }?>
                                                                </span> 
                                                            </li> 
                                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                <span class="about-item-name">City of birth:</span>
                                                                <span class="about-item-detail">
                                                                <?php if(!empty($row  ["birthCity"])){echo $row  ["birthCity"];
                                                                                            }else{
                                                                                                echo "-";
                                                                                        }?>
                                                                </span> 
                                                            </li> 
                                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                <span class="about-item-name">Citizenship Status:</span>
                                                                <span class="about-item-detail">
                                                                <?php if(!empty($row  ["citizenshipStatus"])){echo $row  ["citizenshipStatus"];
                                                                                            }else{
                                                                                                echo "-";
                                                                                        }?>
                                                                </span> 
                                                            </li> 
                                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                <span class="about-item-name">Visa Number(if applicable):</span>
                                                                <span class="about-item-detail">
                                                                <?php if(!empty($row  ["VisaNumber"])){echo $row  ["VisaNumber"];
                                                                                            }else{
                                                                                                echo "-";
                                                                                        }?>
                                                                </span> 
                                                            </li> 
                                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                <span class="about-item-name">Language:</span>
                                                                <span class="about-item-detail">
                                                                <?php if(!empty($row  ["speakEnglish"])){echo $row  ["speakEnglish"];
                                                                                            }else{
                                                                                                echo "-";
                                                                                        }?>
                                                                </span> 
                                                            </li>
                                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                <span class="about-item-name">English speaking level:</span>
                                                                <span class="about-item-detail">
                                                                <?php if(!empty($row  ["speakStatus"])){echo $row  ["speakStatus"];
                                                                                            }else{
                                                                                                echo "-";
                                                                                        }?>
                                                                </span> 
                                                            </li>
                                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                <span class="about-item-name">Aboriginal or Torres Strait Islander origin:</span>
                                                                <span class="about-item-detail">
                                                                <?php if(!empty($row  ["TSIorigin"])){echo $row  ["TSIorigin"];
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
                                                                <?php if(!empty($row  ["disability"])){echo $row  ["disability"];
                                                                                            }else{
                                                                                                echo "-";
                                                                                        }?>
                                                                </span> 
                                                            </li>
                                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                <span class="about-item-name">Type:</span>
                                                                <span class="about-item-detail">
                                                                <?php if(!empty($row  ["disabilityCondition"])){echo $row  ["disabilityCondition"];
                                                                                            }else{
                                                                                                echo "-";
                                                                                        }?>
                                                                </span> 
                                                            </li>
                                                        </ul>

                                                        
                                                    
            </div>

            <div class="tab-pane" id="A7" role="tabpanel">
              <ul class="about"> 
                                                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                                    <span class="about-item-name">Reason: </span>
                                                                    <span class="about-item-detail">
                                                                    <?php if(!empty($row  ["studyReason"])){echo $row  ["studyReason"];
                                                                                            }else{
                                                                                                echo "-";
                                                                                        }?>
                                                                    </span> 
                                                                </li> 
                                                        </ul>
            </div>

            <div class="tab-pane" id="A8" role="tabpanel">
              
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

            <div class="tab-pane" id="A9" role="tabpanel">
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
            <div class="tab-pane" id="A10" role="tabpanel">
              
                <p class="card-description" style="color:white; background:black;">Student Declaration and Consent</p>
                <span>Fee Concession or Fee Waivers</span>
                <ul class="about"> 
                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                        <span class="about-item-name">Consent for displaying testimonials: </span>
                        <span class="about-item-detail">
                        <?php if(!empty($concession_detail  ["middlename"])){echo $concession_detail  ["middlename"];
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
            <div class="tab-pane" id="A11" role="tabpanel">
            <p class="card-description" style="color:white; background:black;">CONCESSION DETAILS</p>
                                        
                <ul class="about"> 
                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                        <span class="about-item-name">Medicare No: </span>
                        <span class="about-item-detail">
                        <?php if(!empty($concession_detail  ["medicareNo"])){echo $concession_detail  ["medicareNo"];
                                                    }else{
                                                        echo "-";
                                                }?>
                        </span> 
                    </li> 
                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                        <span class="about-item-name">Expiry Date: </span>
                        <span class="about-item-detail">
                        <?php if(!empty($concession_detail  ["medicareExpiry"])){echo $concession_detail  ["medicareExpiry"];
                                                    }else{
                                                        echo "-";
                                                }?>
                        </span> 
                    </li> 
                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                        <span class="about-item-name">Concession Card No: </span>
                        <span class="about-item-detail">
                        <?php if(!empty($concession_detail  ["concessionCard"])){echo $concession_detail  ["concessionCard"];
                                                    }else{
                                                        echo "-";
                                                }?>
                        </span> 
                    </li> 
                    <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                        <span class="about-item-name">Expiry Date: </span>
                        <span class="about-item-detail">
                        <?php if(!empty($concession_detail ["concessionExpiry"])){echo $concession_detail  ["concessionExpiry"];
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
    </div>
  </div>


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