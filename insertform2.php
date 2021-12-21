<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
<!-- <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/4.4.95/css/materialdesignicons.css"> -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
<Style>
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
<?php
include('config.php');
global $pdo;

if (isset($_POST['form'])  && isset($_POST['stdid'])  && isset($_POST['cdrid']) ) {
    $FormId= $_POST['form'];
    $StdId= $_POST['stdid'];
    $CdrId= $_POST['cdrid'];
    $FormAccess= 1;
    $query = "select * from `formaccess` where `user_id`=:userid";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam('userid', $StdId, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->rowCount();

    if($count > 0){
        $query2 = "UPDATE formaccess   
                       SET cdr_id='$CdrId',  form_id='$FormId',  access='$FormAccess' 
                       WHERE user_id=?";
        $stmt1= $pdo->prepare($query2);
        $stmt1->execute([$StdId]);
        $message = 'Data Updated';
        header("Location: index.php?page=8");
    }
    else{
        $query  = "INSERT INTO `formaccess` (`user_id`, `cdr_id`, `form_id`, `access`) VALUES (:stdid, :cdrid, :formname, :formaccess)";
        $stmt3 = $pdo->prepare($query);
        $stmt3->bindParam('stdid', $StdId, PDO::PARAM_STR);
        $stmt3->bindParam('cdrid', $CdrId, PDO::PARAM_STR);
        $stmt3->bindParam('formname', $course, PDO::PARAM_STR);
        $stmt3->bindParam('formaccess', $FormAccess, PDO::PARAM_STR);
        //$stmt->bindParam('link', $Link, PDO::PARAM_STR);
        $stmt3->execute();
        echo 'Success: Form Added Successfully!';
        header("Location: index.php?page=8");
    }
}
elseif(isset($_POST['form'])  && isset($_POST['formlink'])) {
    $FormName= $_POST['form'];
    $FormLink= $_POST['formlink'];
    $query = "INSERT INTO `form`(`formname`, `iframe`) 
                    VALUES (:form,:link)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam('form', $FormName, PDO::PARAM_STR);
    $stmt->bindParam('link', $FormLink, PDO::PARAM_STR);
    $stmt->execute();
    echo 'Success: Form Added Successfully!';
    header("Location: index.php?page=8");
}
elseif(isset($_POST['api'])){
    $apikey = $_POST['api'];
    $query = "UPDATE api   
                       SET api='$apikey'
                       WHERE id=1";
    $stmt= $pdo->prepare($query);
    $stmt->execute();
    $message = 'Data Updated';
    header("Location: index.php?page=2");
}
elseif(isset($_POST['del_id'])){
    $del = $_POST['del_id'];

    //  echo $del;
    $query = "DELETE FROM form   
                       WHERE id=?";
    $stmt = $pdo->prepare($query);
    $result = $stmt->execute([$del]);;
    if(isset($result)) {
        echo "YES";
    } else {
        echo "NO";
    }
}
if (isset($_POST['userid'])) {
    $userids = $_POST['userid'];
    /*$sql = "SELECT per.id as ids, per.title as title, per.genderDetails as gender, per.firstname as firstname, per.middlename as middlename, per.lastname, per.dob, per.residentialAddress, per.suburbtown, per.state, per.postcode, per.postalAddress, per.homePhone, per.mobile,
                    per.fax, per.email, per.noVSN, per.usi, per.concessionCard, per.concessionExpiry, per.std_id, dem.id, dem.employmentStatus, dem.employmentRole, dem.employmentSector, dem.schoolingStatus, dem.schoolingLevel,
                    dem.schoolingLevelYear, dem.birthCountry, dem.speakEnglish, dem.speakStatus, dem.TSIorigin, dem.disability, dem.usrid, lnk.id, lnk.relationname, lnk.relationship, lnk.relationhomeNumber, lnk.relationmobile,
                    lnk.usrid FROM personal as per, demographics as dem, localnextofkin as lnk WHERE per.id = dem.usrid AND per.id = lnk.usrid AND per.status != 1 AND per.std_id = :userids";*/


    echo '<h1> Personal Details </h1>';
    $sql = "SELECT * FROM personal WHERE id =:userids ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam('userids',  $userids, PDO::PARAM_STR);
    $stmt->execute();
    $row= $stmt->fetch();
    if ($value) {
        echo "Student ID: " . $value['std_id'] . "<br>";
        echo "Title: " . $value['title'] . "<br>";
        echo "Gender: " . $value['genderDetails'] . "<br>";
        echo "First: " . $value['firstname'] . "<br>";
        echo "Middle: " . $value['middlename'] . "<br>";
        echo "Last: " . $value['lastname'] . "<br>";
        echo "DOB: " . $value['dob'] . "<br>";
        echo "Resendential: " . $value['residentialAddress'] . "<br>";
        echo "Suburb: " . $value['suburbtown'] . "<br>";
        echo "State: " . $value['state'] . "<br>";
        echo "Postcode: " . $value['postcode'] . "<br>";
        echo "Postalcode: " . $value['postalAddress'] . "<br>";
        echo "Home: " . $value['homePhone'] . "<br>";
        echo "Mob: " . $value['mobile'] . "<br>";
        echo "Fax: " . $value['fax'] . "<br>";
        echo "Email: " . $value['email'] . "<br>";
        echo "VSN: " . $value['noVSN'] . "<br>";
        echo "USI: " . $value['usi'] . "<br>";
        echo "Wisenet ID: " . $value['wisenetId'] . "<br>";
        echo "Concession Card: " . $value['concessionCard'] . "<br>";
        echo "Concession Expiry: " . $value['concessionExpiry'] . "<br>";

    }

    echo '<br><h1> Relationship Contact Details </h1>';
    $sql2 = "SELECT * FROM localnextofkin WHERE usrid =:userids ";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->bindParam('userids',  $userids, PDO::PARAM_STR);
    $stmt2->execute();
    $row2 = $stmt2->fetch();

    echo '<br><h1> Demographics </h1>';
    $sql3 = "SELECT * FROM demographics WHERE usrid =:userids ";
    $stmt3 = $pdo->prepare($sql3);
    $stmt3->bindParam('userids',  $userids, PDO::PARAM_STR);
    $stmt3->execute();
    $row3 = $stmt3->fetch();

    echo '<br><h1> Previous Qualification </h1>';
    $sql4 = "SELECT * FROM previousqualification WHERE usrid =:userids ";
    $stmt4 = $pdo->prepare($sql4);
    $stmt4->bindParam('userids',  $userids, PDO::PARAM_STR);
    $stmt4->execute();
    $row4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);
    //print_r($row4);
    if ($row4) {
        foreach ($row4 as $value) {
            echo "Qualification Name: ".$value['qualificationName']."<br>";
            echo "Qualification Type: ".$value['qualificationType']."<br>";

        }
    }

    echo '<br><h1> Disability </h1>';
    $sql5 = "SELECT * FROM disability WHERE usrid =:userids ";
    $stmt5 = $pdo->prepare($sql5);
    $stmt5->bindParam('userids',  $userids, PDO::PARAM_STR);
    $stmt5->execute();
    $row5 = $stmt4->fetchAll(PDO::FETCH_ASSOC);
    if ($row5) {
        foreach ($row5 as $value) {
            echo "Qualification Name: ".$value['disabilityCondition']."<br>";
        }
    }


    /*




     // echo $disabilityCondition."<br>";
     echo "Qulatification Status:  ".$qualificationStatus."<br>";

     echo "Concession : ".$concessionCard."<br>";
     echo "Expiry: ".$concessionExpiry."<br>";
     echo "School level: ".$schoolingLevel."<br>";
     echo "year: ".$schoolingLevelYear."<br>";
     echo "status: ".$schoolingStatus."<br>";


     foreach($previousqualification as $key=>$value){
         $PriorEducationId = get_PriorEducationId($key);
         $PriorEducationTypeId= get_PriorEducationTypeId($value);
         echo $PriorEducationId." ";
         echo $PriorEducationTypeId. "<br>";
     }



     foreach($disabilityid as $value){
         $DisabilityFlagId = get_DisabilityIds($value);
         echo $DisabilityFlagId;
     }
*/
    $query74 = "SELECT * FROM `previousqualification` where usrid=:userids";
    $stmt74 = $pdo->prepare($query74);
    $stmt74->bindParam('userids',  $userids, PDO::PARAM_STR);
    $stmt74->execute();
    $previous_qualification = $stmt74->fetch();
    ?>

    <div class="row">
        <div class="col-md-12 ml-auto col-xl-12 mr-auto">
            <!-- Nav tabs -->
            <div class="card">
              <div class="card-header">
                    <ul class="nav nav-tabs justify-content-center" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#A2" role="tab">
                                <i class="material-icons">fingerprint</i> PART A : PERSONAL AND STATISTICAL DETAILS
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

                    </ul>
                </div>
                <div class="card-body">
                    <!-- Tab panes -->
                    <div class="tab-content text-center">

                        <div class="tab-pane active" id="A2" role="tabpanel">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">

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
                                                <span class="about-item-name">Gender</span>
                                                <span class="about-item-detail">
                                                <?php echo $row["genderDetails"];?>
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
                                    <?php if(!empty($row  ["state"])){echo $row  ["state"];
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
                                    </ul>


                                        <p class="card-description" style="color:white; background:black;">EMERGENCY CONTACT DETAILS</p>
                                        <ul class="about">
                                            <li class="about-items">
                                                <i class="mdi mdi-format-align-left icon-sm "></i>
                                                <span class="about-item-name">Name:</span>
                                                <span class="about-item-detail">
                                    <?php if(!empty($row2  ["relationname"])){echo $row2  ["relationname"];
                                    }else{
                                        echo "-";
                                    }?>
                                    </span>
                                            </li>
                                            <li class="about-items">
                                                <i class="mdi mdi-format-align-left icon-sm "></i>
                                                <span class="about-item-name">Relationship:</span>
                                                <span class="about-item-detail">
                                    <?php if(!empty($row2  ["relationship"])){echo $row2  ["relationship"];
                                    }else{
                                        echo "-";
                                    }?>
                                    </span>
                                            </li>
                                            <li class="about-items">
                                                <i class="mdi mdi-format-align-left icon-sm "></i>
                                                <span class="about-item-name">Home Number:  </span>
                                                <span class="about-item-detail">
                                    <?php if(!empty($row2  ["relationhomeNumber"])){echo $row2  ["relationhomeNumber"];
                                    }else{
                                        echo "-";
                                    }?>
                                    </span>
                                            </li>
                                            <li class="about-items">
                                                <i class="mdi mdi-format-align-left icon-sm "></i>
                                                <span class="about-item-name">Mobile:</span>
                                                <span class="about-item-detail">
                                    <?php if(!empty($row2  ["relationmobile"])){echo $row2  ["relationmobile"];
                                    }else{
                                        echo "-";
                                    }?>
                                    </span>
                                            </li>
                                        </ul>
                                        <p class="card-description" style="color:white; background:black;">Concession Details</Details></p>
                                        <ul class="about">
                                            <li class="about-items">
                                                <i class="mdi mdi-format-align-left icon-sm "></i>
                                                <span class="about-item-name">Concession Card: </span>
                                                <span class="about-item-detail">
                                    <?php if(!empty($row  ['concessionCard'])){echo $row  ['concessionCard'];
                                    }else{
                                        echo "-";
                                    }?>
                                    </span>
                                            </li>
                                            <li class="about-items">
                                                <i class="mdi mdi-format-align-left icon-sm "></i>
                                                <span class="about-item-name">Concession Expiry:</span>
                                                <span class="about-item-detail">
                                    <?php if(!empty($row  ['concessionExpiry'])){echo $row  ['concessionExpiry'];
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
                                    <i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name">USI:</span>
                                    <span class="about-item-detail">
                                                                <?php if(!empty($row  ['usi'])){echo $row  ['usi'];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                </li>

                            </ul>

                            <p class="card-description" style="color:white; background:black;">VICTORIAN STUDENT NUMBER (VSN)</p>
                            <ul class="about">
                                <li class="about-items">
                                    <i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name">VSN:</span>
                                    <span class="about-item-detail">
                                                                <?php if(!empty($row  ['noVSN'])){echo $row  ['noVSN'];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-pane" id="A4" role="tabpanel">

                            <p class="card-description" style="color:white; background:black;">EMPLOYMENT</p>
                            <ul class="about">
                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name">Employment status</span>
                                    <span class="about-item-detail">
                                                                <?php if(!empty($row3  ["employmentStatus"])){echo $row3   ["employmentStatus"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                </li>
                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name">Occupation</span>
                                    <span class="about-item-detail">
                                                                <?php if(!empty($row3   ["employmentRole"])){echo $row3   ["employmentRole"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                </li>
                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name">Industry</span>
                                    <span class="about-item-detail">
                                                                <?php if(!empty($row3   ["employmentSector"])){echo $row3   ["employmentSector"];
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
                                                                <?php if(!empty($row3  ["schoolingLevel"])){echo $row3  ["schoolingLevel"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                </li>
                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name">Year:</span>
                                    <span class="about-item-detail">
                                                                <?php if(!empty($row3  ["schoolingLevelYear"])){echo $row3 ["schoolingLevelYear"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                </li> <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name">Currently Attending School:</span>
                                    <span class="about-item-detail">
                                                                <?php if(!empty($row3  ["schoolingStatus"])){echo $row3  ["schoolingStatus"];
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
                                    <span class="about-item-name">Qualification Name: </span>
                                    <span class="about-item-detail">
                                                                <?php if(!empty($previous_qualification ["qualificationName"])){echo $previous_qualification ["qualificationName"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                </li>
                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name">Qualification Type: </span>
                                    <span class="about-item-detail">
                                                                <?php if(!empty($previous_qualification ["qualificationType"])){echo $previous_qualification ["qualificationType"];
                                                                }else{
                                                                    echo "-";
                                                                }?>
                                                                </span>
                                </li>

                            </ul>

                        </div>

                        <div class="tab-pane" id="A6" role="tabpanel">

                            <p class="card-description" style="color:white; background:black;">LANGUAGE & CULTURAL DIVERSITY</p>
                            <ul class="about">
                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name">Country of Birth: </span>
                                    <span class="about-item-detail">
                        <?php if(!empty($row3  ["birthCountry"])){echo $row3  ["birthCountry"];
                        }else{
                            echo "-";
                        }?>
                        </span>
                                </li>
                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name">City of birth:</span>
                                    <span class="about-item-detail">
                        <?php if(!empty($row3  ["birthCity"])){echo $row3  ["birthCity"];
                        }else{
                            echo "-";
                        }?>
                        </span>
                                </li>
                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name">Citizenship Status:</span>
                                    <span class="about-item-detail">
                        <?php if(!empty($row3  ["citizenshipStatus"])){echo $row3  ["citizenshipStatus"];
                        }else{
                            echo "-";
                        }?>
                        </span>
                                </li>
                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name">Visa Number(if applicable):</span>
                                    <span class="about-item-detail">
                        <?php if(!empty($row3  ["VisaNumber"])){echo $row3  ["VisaNumber"];
                        }else{
                            echo "-";
                        }?>
                        </span>
                                </li>
                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name">Language:</span>
                                    <span class="about-item-detail">
                        <?php if(!empty($row3  ["speakEnglish"])){echo $row3  ["speakEnglish"];
                        }else{
                            echo "-";
                        }?>
                        </span>
                                </li>
                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name">English speaking level:</span>
                                    <span class="about-item-detail">
                        <?php if(!empty($row3  ["speakStatus"])){echo $row3  ["speakStatus"];
                        }else{
                            echo "-";
                        }?>
                        </span>
                                </li>
                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name">Aboriginal or Torres Strait Islander origin:</span>
                                    <span class="about-item-detail">
                        <?php if(!empty($row3  ["TSIorigin"])){echo $row3  ["TSIorigin"];
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
                        <?php if(!empty($row3  ["disability"])){echo $row3  ["disability"];
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


    <?php

}


else {
    header("Location: index.php");
}
?>