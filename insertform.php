<?php
include('config.php');
include('lib/locallib.php');
include('detail.php');
global $pdo;
/**
 *
 *
 * Insert a new recipient
 *
 */
if(isset($_POST['recipientPage'])){
    include "config.php";
//    ini_set('display_errors', 1);
//    ini_set('display_startup_errors', 1);
//    error_reporting(E_ALL);
    //INSERT INTO `smsrecipients`(`id`, `fullName`, `phone`) VALUES ([value-1],[value-2],[value-3])
    $query  = "INSERT INTO `smsrecipients`( `fullName`, `phone`) VALUES (:fullname,:phone)";
    $stmt3 = $pdo->prepare($query);
    $stmt3->bindParam('fullname', $_POST['FullName'], PDO::PARAM_STR);
    $stmt3->bindParam('phone', $_POST['Phone'], PDO::PARAM_STR);
    //$stmt->bindParam('link', $Link, PDO::PARAM_STR);
    $stmt3->execute();
    echo 'Success:  Added Successfully!';
    //var_dump($_POST);
}
/**
 *
 *
 * Delete a  recipient
 *
 */
if (isset($_POST['recdel_id'])){
    //  echo $del;
    include "config.php";
    $query = "DELETE FROM `smsrecipients`   
                       WHERE id=?";
    $stmt = $pdo->prepare($query);
    $result = $stmt->execute([$_POST['recdel_id']]);
    if(isset($result)) {
        echo "YES";
    } else {
        echo "NO";
    }
}

if (isset($_POST['form'])  && isset($_POST['stdid'])  && isset($_POST['cdrid']) ) {
    $FormId= $_POST['form'];
    $StdId= $_POST['stdid'];
    $CdrId= $_POST['cdrid'];
    $FormAccess= 1;

  //  $form = explode(",", $FormId);
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
        $stmt3->bindParam('formname', $FormId, PDO::PARAM_STR);
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

elseif(isset($_POST['del_rcrd'])){
    $del = $_POST['del_rcrd'];
    $query = "SELECT id FROM personal   
                       WHERE std_id=?";
    $stmt = $pdo->prepare($query);
    $result = $stmt->execute([$del]);

    $usrid = $result['id'];

    $query1 = "DELETE FROM `demographics` WHERE usrid = ?;
               DELETE FROM `localnextofkin` WHERE usrid = ?;
               DELETE FROM `disability` WHERE usrid = ?;
               DELETE FROM `previousqualification` WHERE usrid = ?;
               DELETE FROM `userFormSubmission` WHERE usrid = ?;
               DELETE FROM `personal` WHERE id = ?;";

    $stmt1 = $pdo->prepare($query1);
    $result1 = $stmt1->execute([$del,$del, $del, $del,$del,$del]);;
    if(isset($result1)) {
        echo "YES";
    } else {
        echo "NO";
    }
}

elseif(isset($_POST['formacces_del'])){

    $del = $_POST['formacces_del'];
    $query = "DELETE FROM formaccess WHERE user_id = ?";
    $stmt = $pdo->prepare($query);
    $result = $stmt->execute([$del]);

    if(isset($result)) {
        echo "YES";
    } else {
        echo "NO";
    }

}
elseif (isset($_POST['userid'])) {
    $userids = $_POST['userid'];
    //$userids=126;
  /*  echo '<h1> Personal Details </h1>';*/
    $sql = "SELECT * FROM personal WHERE id =:userids ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam('userids',  $userids, PDO::PARAM_STR);
    $stmt->execute();
    $row= $stmt->fetch();
   // var_dump($row);

    $sql2 = "SELECT * FROM localnextofkin WHERE usrid =:userids ";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->bindParam('userids',  $userids, PDO::PARAM_STR);
    $stmt2->execute();
    $row2 = $stmt2->fetch();

    $sql3 = "SELECT * FROM demographics WHERE usrid =:userids ";
    $stmt3 = $pdo->prepare($sql3);
    $stmt3->bindParam('userids',  $userids, PDO::PARAM_STR);
    $stmt3->execute();
    $row3 = $stmt3->fetch();

    $query74 = "SELECT * FROM `previousqualification` where usrid=:userids";
    $stmt74 = $pdo->prepare($query74);
    $stmt74->bindParam('userids',  $userids, PDO::PARAM_STR);
    $stmt74->execute();
    $previous_qualification = $stmt74->fetchall();


    $sql5 = "SELECT * FROM disability WHERE usrid =:userids ";
    $stmt5 = $pdo->prepare($sql5);
    $stmt5->bindParam('userids',  $userids, PDO::PARAM_STR);
    $stmt5->execute();
    $row5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);



    echo ' 
   <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">                                                                                                                                                                                                                                 <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/4.4.95/css/materialdesignicons.css">     <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
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
                                                <span class="about-item-detail">'.$row["title"].'</span>
                                            </li>
                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                <span class="about-item-name">Gender</span>
                                                <span class="about-item-detail">'.get_wisenetGender($row["genderDetails"]).'</span>
                                            </li>
                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                <span class="about-item-name">First Name</span>
                                                <span class="about-item-detail">'.$row["firstname"].'</span>
                                            </li>
                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                <span class="about-item-name">Middle Name</span>
                                                <span class="about-item-detail">'.$row["middlename"].'</span>
                                            </li>
                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                <span class="about-item-name">Last Name</span>
                                                <span class="about-item-detail">'.$row["lastname"].'</span>
                                            </li>
                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                <span class="about-item-name">Date of Birth:</span>
                                                <span class="about-item-detail">'.$row["dob"].'</span>
                                            </li>
                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                <span class="about-item-name">Residential Address:</span>
                                                <span class="about-item-detail">'.$row["residentialAddress"].'</span>
                                            </li>
                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                <span class="about-item-name">Suburb/Town:  </span>
                                                <span class="about-item-detail">'.$row["suburbtown"].'</span>
                                            </li>
                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                <span class="about-item-name">State:  </span>
                                                <span class="about-item-detail">'.get_wisenetState($row["state"]).'</span>
                                            </li>
                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                <span class="about-item-name">Postcode:  </span>
                                                <span class="about-item-detail">'.$row["postcode"].'</span>
                                            </li>
                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                <span class="about-item-name">Postal Address:</span>
                                                 <span class="about-item-detail"> '.$row["postalAddress"].'</span>
                                            </li>
                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                <span class="about-item-name">Home phone:</span>
                                                <span class="about-item-detail">'.$row["homePhone"].'</span>
                                            </li>
                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                <span class="about-item-name">Mobile: </span>
                                                <span class="about-item-detail">'.$row["mobile"].'</span>
                                            </li>
                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                <span class="about-item-name">Fax: </span>
                                                <span class="about-item-detail">'.$row["fax"].'</span>
                                            </li>
                                            <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                                <span class="about-item-name">Email: </span>
                                                <span class="about-item-detail">'.$row["email"].'</span>
                                            </li>
                                        </ul>


                                        <p class="card-description" style="color:white; background:black;">EMERGENCY CONTACT DETAILS</p>
                                        <ul class="about">
                                            <li class="about-items">
                                                <i class="mdi mdi-format-align-left icon-sm "></i>
                                                <span class="about-item-name">Name:</span>
                                                <span class="about-item-detail">'.$row2["relationname"].'</span>
                                            </li>
                                            <li class="about-items">
                                                <i class="mdi mdi-format-align-left icon-sm "></i>
                                                <span class="about-item-name">Relationship:</span>
                                                <span class="about-item-detail">'.get_wisenetRelation($row2['relationship']).'</span>
                                            </li>
                                            <li class="about-items">
                                                <i class="mdi mdi-format-align-left icon-sm "></i>
                                                <span class="about-item-name">Home Number:  </span>'.$row2["relationhomeNumber"].'</span>
                                            </li>
                                            <li class="about-items">
                                                <i class="mdi mdi-format-align-left icon-sm "></i>
                                                <span class="about-item-name">Mobile:</span>
                                                <span class="about-item-detail">'.$row2["relationmobile"].'</span>
                                            </li>
                                        </ul>
                                        <p class="card-description" style="color:white; background:black;">Concession Details</Details></p>
                                        <ul class="about">
                                            <li class="about-items">
                                                <i class="mdi mdi-format-align-left icon-sm "></i>
                                                <span class="about-item-name">Concession Card: </span>
                                                <span class="about-item-detail">'.$row  ['concessionCard'].'</span>
                                            </li>
                                            <li class="about-items">
                                                <i class="mdi mdi-format-align-left icon-sm "></i>
                                                <span class="about-item-name">Concession Expiry:</span>
                                                <span class="about-item-detail">'.$row  ['concessionExpiry'].' </span>
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
                                    <span class="about-item-detail">'.$row  ['usi'].'</span>
                                </li>
                            </ul>

                            <p class="card-description" style="color:white; background:black;">VICTORIAN STUDENT NUMBER (VSN)</p>
                            <ul class="about">
                                <li class="about-items">
                                    <i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name">VSN:</span>
                                    <span class="about-item-detail">'.$row  ['noVSN'].'</span>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-pane" id="A4" role="tabpanel">
                            <p class="card-description" style="color:white; background:black;">EMPLOYMENT</p>
                            <ul class="about">
                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name">Employment status</span>
                                    <span class="about-item-detail">'.get_wisenetEmploymentstatus($row3  ["employmentStatus"]).'</span>
                                </li>
                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name">Occupation</span>
                                    <span class="about-item-detail">'.get_wisenetEmploymentrole($row3  ["employmentRole"]).'</span>
                                </li>
                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name">Industry</span>
                                    <span class="about-item-detail">'.get_wisenetEmploymentsector($row3  ["employmentSector"]).'</span>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-pane" id="A5" role="tabpanel">
                            <p class="card-description" style="color:white; background:black;">SCHOOLING</p>
                            <ul class="about">
                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name">Highest COMPLETED school Level: </span>
                                    <span class="about-item-detail">'.get_wisenetSchoolinglevel($row3["schoolingLevel"]).'</span>
                                </li>
                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name">Year:</span>
                                    <span class="about-item-detail">'.$row3  ["schoolingLevelYear"].'</span>
                                </li> <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name">Currently Attending School:</span>
                                    <span class="about-item-detail">'.$row3  ["schoolingStatus"].'</span>
                                </li>
                                </li>
                            </ul>';

                        echo '<p class="card-description" style="color:white; background:black;">PREVIOUS QUALIFICATIONS ACHIEVED</p>
                         <ul class="about">
                             <li>
                              <span ><b>Qualification Name: </b></span>
                              <span ><b>Qualification Type: </b></span>
                             </li>
                        ';
                        foreach ($previous_qualification as $rs){
                        echo '<li>
                                    <span >'.get_wisenetQualificationname($rs ["qualificationName"]).'  </span>
                                    <span >'.get_wisenetDisabilities($rs ["qualificationType"]).'  </span>
                                </li>';
                         }

                echo    '    </ul>
                        </div>
                        <div class="tab-pane" id="A6" role="tabpanel">
                            <p class="card-description" style="color:white; background:black;">LANGUAGE & CULTURAL DIVERSITY</p>
                            <ul class="about">
                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name">Country of Birth: </span>
                                    <span class="about-item-detail">'.get_wisenetCountry($row3["birthCountry"]).'</span>
                                </li>
                               
                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name">Language:</span>
                                    <span class="about-item-detail"> '.get_wisenetLanguage($row3["speakEnglish"]).'</span>
                                </li>
                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name">English speaking level:</span>
                                    <span class="about-item-detail">'.get_wisenetSpeakstatus($row3["speakStatus"]).'</span>
                                </li>
                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name">Aboriginal or Torres Strait Islander origin:</span>
                                    <span class="about-item-detail">'.get_wisenetTSIorigin($row3 ["TSIorigin"]).'</span>
                                </li>
                            </ul>
                            <p class="card-description" style="color:white; background:black;">DISABILITY</p>
                            <ul class="about">
                                <li class="about-items"><i class="mdi mdi-format-align-left icon-sm "></i>
                                    <span class="about-item-name"> Disability Flag:</span>
                                    <span class="about-item-detail"> '.get_wisenetDisabilityflag($row3  ["disability"]).'</span>
                                </li>
                            </ul>';
                echo       '<ul class="about">
                                 <li>
                                     <span ><b>Disability: </b></span>   
                                 </li>';
                foreach ($row5 as $rs1){
                        echo '   <li>
                                     <span>'.get_wisenetQualificationtype($rs1 ["disabilityCondition"]).'</span>
                                 </li>';
                }

                echo         '</ul></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </div>
        </div>
    </div>
</div>';
}


else {
    header("Location: index.php");
}