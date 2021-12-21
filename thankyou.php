<?php

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
include('config.php');
global  $url, $enrolmentForm, $usiForm, $skillForm, $documentForm, $usitransForm,$seclln;
//if record doesn't exist

/**
-----------------------For Online Submissions----------------
 **/
if(isset($_POST['email'])){
    include('style.php');
    include "lib/apilib.php";

    global $pdo;
    $std_id=$_POST['std_id'];
    $email=$_POST['email'];
    $studentId=get_user_id($std_id,$email);
    check_for_record($std_id,$studentId);

    echo '<div class="container-fluid">';
    if ($_POST['formID']== $seclln){
        $data = json_encode($_POST);
        $sql = "UPDATE `of_enrolment` SET `llnForm`= ? , `llnReview` = 0 WHERE usrid = ?";
        $stmt= $pdo->prepare($sql);
        $result = $stmt->execute([$data,$studentId]);
        $sql = "UPDATE `of_enrolment` SET `ptrForm`= ? , `ptrReview` = 0 WHERE usrid = ?";
        $stmt= $pdo->prepare($sql);
        $result = $stmt->execute([$data,$studentId]);

        if($result){
            /** Edited By Inam 15/11/2021 */
            send_formcompletion_mail_tocoordinator($std_id,$_POST['formID'] );
        }
    }elseif($_POST['formID']== $enrolmentForm){
        $data= json_encode($_POST);
        //$data = convertToWisenet($_POST);
        $sql = "UPDATE `of_enrolment` SET `enrolForm`= ? , `enrolReview` = 0 WHERE usrid = ?";
        $stmt= $pdo->prepare($sql);
        $result = $stmt->execute([$data,$studentId]);
        $sql1 = "UPDATE `of_enrolment` SET `documentForm`= ? , `documentReview` = 0 WHERE usrid = ?";
        $stmt1= $pdo->prepare($sql1);
        $result1= $stmt1->execute([$data,$studentId]);

        if($result){
            /** Edited By Inam 03/12/2021 */
            /**************************
             **** DOCUMENTS UPLOAD ****
             **************************/
            checkDocument($_POST, $std_id);
            send_formcompletion_mail_tocoordinator($std_id,$_POST['formID'] );
        }
    }elseif ($_POST['formID']==$skillForm){
        $data = json_encode($_POST);
        $sql = "UPDATE `of_enrolment` SET `skillForm`= ? , `skillReview` = 0 WHERE usrid = ?";
        $stmt= $pdo->prepare($sql);
        $result = $stmt->execute([$data,$studentId]);
        if($result){
            /** Edited By Inam 15/11/2021 **/
            send_formcompletion_mail_tocoordinator($std_id,$_POST['formID'] );
        }
    }
    /** Edited By Inam 12/11/2021 */
    elseif ($_POST['formID']==$usiForm || $_POST['formID']== $usitransForm){
        $data = json_encode($_POST);
        $sql  = "UPDATE `of_enrolment` SET `usiForm`= ? , `usiReview` = 0 WHERE usrid = ?";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$data,$studentId]);
        if($result){
          /** Edited By Inam 15/11/2021 */
          send_formcompletion_mail_tocoordinator($std_id,$_POST['formID'] );
          send_usiCompletionSMS($std_id);
        }
    }

   echo '<div class="row">
         <div class="col-sm-12">
            <div class="card shadow mb-4">

                <div class="card-body border-bottom-success">
                    <div style="text-align: center !important; ">
                        <img src="img/Thankyou-iconV2.png" style="width: 20% !important" alt="">
                    </div>
                    <h1 style="text-align: center !important; ">Thank You!</h1>
                    <h4 style="text-align: center !important; ">Your submission has been received.</h4>
                    <div style="text-align: center !important; ">
                        <a href="'.$url.'/index.php" class="btn btn-success w-30">
                            Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
   </div>
    </body>
</html>';
/* container-fluid */
}
/** For Manual ticks */
if (isset($_POST['formvalue']) && isset($_POST['userId'])){
    session_start();
    global $pdo;
    if($_POST['formvalue']=='ptrForm'){
        $update=$_SESSION['userid'];
        $sql = "UPDATE `of_enrolment` SET `ptrForm`= ? , `ptrReview` = 0 WHERE `usrid` = ?";
        $stmt= $pdo->prepare($sql);
        $result = $stmt->execute([$update,$_POST['userId']]);
        if(isset($result)) {
            echo "YES";
        }
        else{
            echo "NO";
        }
    }elseif($_POST['formvalue']=='llnForm'){
        session_start();
        $update=$_SESSION['userid'];
        $sql1 = "UPDATE `of_enrolment` SET `llnForm`= ? , `llnReview` = 0 WHERE usrid = ?";
        $stmt1= $pdo->prepare($sql1);
        $result1 = $stmt1->execute([$update,$_POST['userId']]);
        if(isset($result1)) {
            echo "YES";
        }
        else{
            echo "NO";
        }
    }elseif($_POST['formvalue']=='enrolForm'){
        session_start();
        $update=$_SESSION['userid'];
        $sql1 = "UPDATE `of_enrolment` SET `enrolForm`= ? , `enrolReview` = 0 WHERE usrid = ?";
        $stmt1= $pdo->prepare($sql1);
        $result1 = $stmt1->execute([$update,$_POST['userId']]);
        if(isset($result1)) {
            echo "YES";
        }
        else{
            echo "NO";
        }
    }elseif($_POST['formvalue']=='documentForm'){
        session_start();
        $update=$_SESSION['userid'];
        $sql1 = "UPDATE `of_enrolment` SET `documentForm`= ? WHERE usrid = ?";
        $stmt1= $pdo->prepare($sql1);
        $result1 = $stmt1->execute([$update,$_POST['userId']]);
        if(isset($result1)) {
            echo "YES";
        }
        else{
            echo "NO";
        }
    }elseif($_POST['formvalue']=='usiForm'){
        session_start();
        $update=$_SESSION['userid'];
        $sql1 = "UPDATE `of_enrolment` SET `usiForm`= ? , `usiReview` = 0 WHERE usrid = ?";
        $stmt1= $pdo->prepare($sql1);
        $result1 = $stmt1->execute([$update,$_POST['userId']]);
        if(isset($result1)) {
            echo "YES";
        }
        else{
            echo "NO";
        }
    }elseif($_POST['formvalue']=='skillForm'){
        session_start();
        $update=$_SESSION['userid'];
        $sql1 = "UPDATE `of_enrolment` SET `skillForm`= ? , `skillReview` = 0 WHERE usrid = ?";
        $stmt1= $pdo->prepare($sql1);
        $result1 = $stmt1->execute([$update,$_POST['userId']]);
        if(isset($result1)) {
            echo "YES";
        }
        else{
            echo "NO";
        }
    }elseif($_POST['formvalue']=='enrolFormReview'){
        session_start();
        date_default_timezone_set("Australia/Melbourne");
        $myObj = new stdClass();
        $myObj->userid = $_SESSION['userid'];
        $myObj->time = date("l d/m/Y h:i:sa");
        $update = json_encode($myObj);
        $sql1 = "UPDATE `of_enrolment` SET `enrolReview`= ? WHERE usrid = ?";
        $stmt1= $pdo->prepare($sql1);
        $result1 = $stmt1->execute([$update,$_POST['userId']]);
        if(isset($result1)) {
            echo "YES";
        }
        else{
            echo "NO";
        }
    }elseif($_POST['formvalue']=='documentFormReview'){
        session_start();
        date_default_timezone_set("Australia/Melbourne");
        $myObj = new stdClass();
        $myObj->userid = $_SESSION['userid'];
        $myObj->time = date("l d/m/Y h:i:sa");
        $update = json_encode($myObj);
        $sql1 = "UPDATE `of_enrolment` SET `documentReview`= ? WHERE usrid = ?";
        $stmt1= $pdo->prepare($sql1);
        $result1 = $stmt1->execute([$update,$_POST['userId']]);
        if(isset($result1)) {
            echo "YES";
        }
        else{
            echo "NO";
        }
    }elseif($_POST['formvalue']=='usiFormReview'){
        session_start();
        date_default_timezone_set("Australia/Melbourne");
        $myObj = new stdClass();
        $myObj->userid = $_SESSION['userid'];
        $myObj->time = date("l d/m/Y h:i:sa");
        $update = json_encode($myObj);
        $sql1 = "UPDATE `of_enrolment` SET `usiReview`= ? WHERE usrid = ?";
        $stmt1= $pdo->prepare($sql1);
        $result1 = $stmt1->execute([$update,$_POST['userId']]);
        if(isset($result1)) {
            echo "YES";
        }
        else{
            echo "NO";
        }
    }elseif($_POST['formvalue']=='llnFormReview'){
        session_start();
        date_default_timezone_set("Australia/Melbourne");
        $myObj = new stdClass();
        $myObj->userid = $_SESSION['userid'];
        $myObj->time = date("l d/m/Y h:i:sa");
        $update = json_encode($myObj);
        $sql1 = "UPDATE `of_enrolment` SET `llnReview`= ? WHERE usrid = ?";
        $stmt1= $pdo->prepare($sql1);
        $result1 = $stmt1->execute([$update,$_POST['userId']]);
        if(isset($result1)) {
            echo "YES";
        }
        else{
            echo "NO";
        }
    }elseif($_POST['formvalue']=='skillFormReview'){
        session_start();
        date_default_timezone_set("Australia/Melbourne");
        $myObj = new stdClass();
        $myObj->userid = $_SESSION['userid'];
        $myObj->time = date("l d/m/Y h:i:sa");
        $update = json_encode($myObj);
        $sql1 = "UPDATE `of_enrolment` SET `skillReview`= ? WHERE usrid = ?";
        $stmt1= $pdo->prepare($sql1);
        $result1 = $stmt1->execute([$update,$_POST['userId']]);
        if(isset($result1)) {
            echo "YES";
        }
        else{
            echo "NO";
        }
    }elseif($_POST['formvalue']=='ptrFormReview'){
        session_start();
        date_default_timezone_set("Australia/Melbourne");
        $myObj = new stdClass();
        $myObj->userid = $_SESSION['userid'];
        $myObj->time = date("l d/m/Y h:i:sa");
        $update = json_encode($myObj);
        $sql1 = "UPDATE `of_enrolment` SET `ptrReview`= ? WHERE usrid = ?";
        $stmt1= $pdo->prepare($sql1);
        $result1 = $stmt1->execute([$update,$_POST['userId']]);
        if(isset($result1)) {
            echo "YES";
        }
        else{
            echo "NO";
        }
    }
}