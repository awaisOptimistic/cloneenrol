<?php
include('config.php');
include('lib/lib.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_POST['sentOTP'])){
    $mobile_number = $_POST['sentOTP'];
    $numbers = array($mobile_number);
    $sender = 'OPTFUTURES';
    $otp = rand(100000, 999999);
    session_start();
    $_SESSION['session_otp'] = $otp;
    $message = $otp." is your Optimistic Futures OTP. Do not share with anyone." ;

    try{
        $response=verifyPhoneNumber($mobile_number,$message);
        $abc=json_decode($response,true);
        if($abc['code']==200){
            echo 'Success';
        }else{
            echo 'Fail';
        }
        exit();
    }catch(Exception $e){
        die('Error: '.$e->getMessage());
    }

}else if (isset($_POST['verifyOTP'])){
    session_start();
    $otp = $_POST['verifyOTP'];
    if ($otp == $_SESSION['session_otp']) {
        unset($_SESSION['session_otp']);
        echo json_encode(array("type"=>"success", "message"=>"Your mobile number is verified!"));
    } else {
        echo json_encode(array("type"=>"error", "message"=>"Mobile number verification failed"));
    }
}else if(isset($_POST['FirstName']) && isset($_POST['LastName']) && isset($_POST['Email']) && isset($_POST['Password']) && isset($_POST['Role']) && isset($_POST['Phone']) ){
    $FirstName= $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    /**  Edited on 1/12/2021 **/
    $Email = strtolower($_POST['Email']);
    $Password= $_POST['Password'];
    $ReferredBy = $_POST['ReferredBy'];
    $Campus =  studentCampus($_POST['Campus']);

    if(session_status() ==  PHP_SESSION_NONE ) {
        session_start();
    }

    $verified = 1;
    $Password=md5($Password);
    $role=$_POST['Role'];
    $phone=$_POST['Phone'];
    $uqid = generateRandomString();

    if($role==3){
        $source=$_POST['source'];
        $course=$_POST['course'];
        $i=0;
    }

    $count = userCheck($Email);
    if ($count!=1) {
        if($role==3){
            //echo $_POST["govsubornot"];
            /***Insert Query***/
            $query  = "INSERT INTO `user`(`firstname`, `lastname`, `email`, `password`, `phone`, `source`, `campus`, `role`, `courses`, `referral`, `verified`, `uqid`) VALUES (:firstname, :lastname, :email, :password,:phone,:sources,:campus, :roles, :courses,:referred, :verified, :uqid)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam('firstname', $FirstName, PDO::PARAM_STR);
            $stmt->bindParam('lastname', $LastName, PDO::PARAM_STR);
            $stmt->bindParam('email', $Email, PDO::PARAM_STR);
            $stmt->bindParam('password', $Password, PDO::PARAM_STR);
            $stmt->bindParam('phone', $phone, PDO::PARAM_STR);
            $stmt->bindParam('sources', $source, PDO::PARAM_STR);
            $stmt->bindParam('campus', $Campus, PDO::PARAM_STR);
            $stmt->bindParam('roles', $role, PDO::PARAM_STR);
            $stmt->bindParam('referred', $ReferredBy, PDO::PARAM_STR);
            $stmt->bindParam('courses', $course, PDO::PARAM_STR);
            $stmt->bindParam('verified', $verified, PDO::PARAM_STR);
            $stmt->bindParam('uqid', $uqid, PDO::PARAM_STR);
            $stmt->execute();
            echo 'Success: User Added Successfully!';

            $query2 = "select id from `user` where `email`=:username";
            $stmt2 = $pdo->prepare($query2);
            $stmt2->bindParam('username', $Email, PDO::PARAM_STR);
            $stmt2->execute();
            $count2 = $stmt2->fetch();
            $name = $FirstName . " " . $LastName;
            $userId = $count2['id'];
            $verified=1;
            /**********************************************************
             *
             *
             *
             * Code changes start
             *
             *
             *
             */
            /***Insert Query***/
            $queryCourse  = "INSERT INTO `courses`( `userid`, `course`,`fundingType`) VALUES (:userid,:course,:funding)";
            $stmtCourse = $pdo->prepare($queryCourse);
            $stmtCourse->bindParam(':userid', $userId, PDO::PARAM_STR);
            $stmtCourse->bindParam(':course', $course, PDO::PARAM_STR);
            $stmtCourse->bindParam(':funding', $_POST["govsubornot"], PDO::PARAM_STR);
            $stmtCourse->execute();

            $queryGetCourseId = "select id from `courses` where `userid`=:userid";
            $stmtGetCourse = $pdo->prepare($queryGetCourseId);
            $stmtGetCourse->bindParam(':userid', $userId, PDO::PARAM_STR);
            $stmtGetCourse->execute();
            $getCourseId = $stmtGetCourse->fetch();
            $courseId = $getCourseId['id'];




            /**********************************************************
             *
             *
             *
             * Code changes end
             *
             *
             *
             ***********************************************************/

            $query2 = "Select * from `user` where id=:id";
            $stmt3 = $pdo->prepare($query2);
            $stmt3->bindParam('id', $userId, PDO::PARAM_STR);
            $stmt3->execute();
            $datanew=$stmt3->fetch();

            $query4  = "INSERT INTO `llnusers`( `firstname`, `lastname`, `email`, `password`, `uqid`)VALUES (:firstname, :lastname, :email, :password, :uqid)";
            $stmt4 = $pdo->prepare($query4);
            $stmt4->bindParam('firstname', $FirstName, PDO::PARAM_STR);
            $stmt4->bindParam('lastname', $LastName, PDO::PARAM_STR);
            $stmt4->bindParam('email', $Email, PDO::PARAM_STR);
            $stmt4->bindParam('password', $Password, PDO::PARAM_STR);
            $stmt4->bindParam('uqid', $uqid, PDO::PARAM_STR);
            $stmt4->execute();
            $name = $FirstName . " " . $LastName;

            //send_mail_tostudent($name,$uqid,$Email);

            /*** Add record in of_enrolment database ***/
            //$courseId $datanew['id'] $datanew['uqid']
            //echo $courseId.' '.$datanew['id'].' '. $datanew['uqid'];

            $query = "INSERT INTO `of_enrolment`( `usrid`, `std_id`, `enrolForm`, `skillForm`, `usiForm`, `documentForm`, `ptrForm`, `llnForm`) VALUES (:userid,:stdid, NULL,NULL,NULL,NULL,NULL,NULL)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam('userid', $userId, PDO::PARAM_STR);
            $stmt->bindParam('stdid', $datanew['uqid'], PDO::PARAM_STR);
            $stmt->execute();

            /***********
             *
             * Code changes start
             *
             */


            //Get Latest enrolment id and insert into the user
            /*** Add record in of_enrolment database ***/
            $query6  = "select id from `of_enrolment` where `usrid`=:userid";
            $stmt6 = $pdo->prepare($query6);
            $stmt6->bindParam('userid', $userId, PDO::PARAM_STR);
            $stmt6->execute();
            $result2 = $stmt6->fetch();
            $enrolId = $result2['id'];

            //////////////////////////////////////////////////////////////////////////
            /// /////////////////////////////////////////////////////////////////////
            /// /////////UPDATEEEEEEEEEEEE  NORMALIZED TABLE ///////////////////////
            /// ///////////////////////////////////////////////////////////////////////
            /// ////////////////////////////////////////////////////////////////////
            /// //////
            $query444  = "INSERT INTO `norm_users_enrol_courses`( `userid`, `enrolid`, `courseid`) VALUES (:userid,:enrolid,:courseid)";
            $stmt444 = $pdo->prepare($query444);
            $stmt444->bindParam('userid', $userId, PDO::PARAM_STR);
            $stmt444->bindParam('enrolid', $enrolId, PDO::PARAM_STR);
            $stmt444->bindParam('courseid', $courseId, PDO::PARAM_STR);
            $stmt444->execute();

            #3 get enrol id and coourse id
            $querynew = "SELECT * FROM `norm_users_enrol_courses` where userid=:userid AND enrolid=:enrolid AND courseid=:courseid";
            $stmtnew = $pdo->prepare($querynew);
            $stmtnew->bindParam('userid', $userId, PDO::PARAM_STR);
            $stmtnew->bindParam('enrolid', $enrolId, PDO::PARAM_STR);
            $stmtnew->bindParam('courseid', $courseId, PDO::PARAM_STR);
            $stmtnew->execute();
            $rownew   = $stmtnew->fetch(PDO::FETCH_ASSOC);

            $sql = "UPDATE user SET normid=? WHERE id=?";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$rownew["id"],$userId]);

            $sql = "UPDATE  `of_enrolment` SET normid=? WHERE id=?";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$rownew["id"],$enrolId]);

            $sql = "UPDATE  `courses` SET normid=? WHERE id=?";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$rownew["id"],$courseId]);


            /**********
             *
             * Code changes END
             *
             */

            //send_newaccount_mail_tostudent($name, $Email);
            //send_mail_tocoordinator($name,$uqid, $Email, $course);
            session_start();
            $_SESSION['currentSession']=1;
            $_SESSION['role']=$datanew["role"];
            $_SESSION['userid']=$datanew ["id"];
            $_SESSION['email']=$datanew["email"];
            $_SESSION['uqid']=$datanew["uqid"];
            $msg = "Log in Success!";
            session_write_close();
            //send_sms_to_coordinator($name,$uqid, $Email,$course);
            echo 'Success';
        }else{
            /***Insert Query***/
            $query  = "INSERT INTO `user`(`firstname`, `lastname`, `email`, `password`, `phone`, `role`, `verified`, `uqid`) VALUES (:firstname, :lastname, :email, :password,:phone, :roles, :verified, :uqid)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam('firstname', $FirstName, PDO::PARAM_STR);
            $stmt->bindParam('lastname', $LastName, PDO::PARAM_STR);
            $stmt->bindParam('email', $Email, PDO::PARAM_STR);
            $stmt->bindParam('password', $Password, PDO::PARAM_STR);
            $stmt->bindParam('phone', $phone, PDO::PARAM_STR);
            $stmt->bindParam('roles', $role, PDO::PARAM_STR);
            $stmt->bindParam('verified', $verified, PDO::PARAM_STR);
            $stmt->bindParam('uqid', $uqid, PDO::PARAM_STR);
            $stmt->execute();
            echo 'Success: User Added Successfully!';
            /*******************************
             * *****************************
             * Add permissions here
             * *****************************
             * */
            $query2 = "select id from `user` where `email`=:username";
            $stmt2 = $pdo->prepare($query2);
            $stmt2->bindParam('username', $Email, PDO::PARAM_STR);
            $stmt2->execute();
            $count2 = $stmt2->fetch();
            $name = $FirstName . " " . $LastName;
            $userId = $count2['id'];
            function insertPage($userId,$page,$canView,$canEdit){
                global $pdo;
                $query4  = "INSERT INTO `permissions`(`userid`, `page`, `canView`, `canEdit`) VALUES (:userid,:page,:canView,:canEdit)";
                $stmt4 = $pdo->prepare($query4);
                $stmt4->bindParam('userid',  $userId, PDO::PARAM_STR);
                $stmt4->bindParam('page', $page, PDO::PARAM_STR);
                $stmt4->bindParam('canView', $canView, PDO::PARAM_STR);
                $stmt4->bindParam('canEdit', $canEdit, PDO::PARAM_STR);
                $stmt4->execute();
            }

            if($role==2){
                // page 19(Students Progress Check): 1 1
                insertPage($userId,19,1,1);
                // page 3(Current Users): 1 0
                insertPage($userId,3,1,0);
                // page 12(List of New Students): 1 1
                insertPage($userId,12,1,1);
                // page 11 (List of Approved Students): 1 0
                insertPage($userId,11,1,0);
                // page 2 (settings): 0 0
                insertPage($userId,2,0,0);
                // pag 24 (settings): 0 0
                insertPage($userId,24,0,0);
            }elseif($role==4){
                // page 19(Students Progress Check): 1 0
                insertPage($userId,19,1,1);
                // page 3(Current Users): 0 0
                insertPage($userId,3,0,0);
                // page 12(List of New Students): 0 0
                insertPage($userId,12,0,0);
                // page 11 (List of Approved Students): 0 0
                insertPage($userId,11,0,0);
                // pag 2 (settings): 0 0
                insertPage($userId,2,0,0);
                // pag 24 (settings): 0 0
                insertPage($userId,24,0,0);
            }



            /*session_start();
            $_SESSION['currentSession']=1;
            $_SESSION['role']=$datanew["role"];
            $_SESSION['userid']=$datanew ["id"];
            $_SESSION['email']=$datanew["email"];
            $_SESSION['uqid']=$datanew["uqid"];
            $msg = "Log in Success!";*/
        }
    }else{

        echo 'Error: Email Already Registered!';
    }
}

/***Delete User ***/
elseif(isset($_POST['del_id'])){
    global $pdo;
    $del = $_POST['del_id'];
    $role = get_user_role($del);
    $uqid = get_uqid($del);
    if($role == 2 || $role == 4 && $del != 26) {
        $query = "DELETE FROM `user` WHERE id=?";
        $stmt = $pdo->prepare($query);
        $result = $stmt->execute([$del]);
        if (isset($result)) {
            echo "YES";
        } else {
            echo "NO";
        }
    }else{
        $query = "DELETE FROM `llnusers` WHERE uqid=?";
        $stmt = $pdo->prepare($query);
        $result = $stmt->execute([$uqid]);
        if ($result) {
            $query = "DELETE FROM `of_enrolment` WHERE usrid=?";
            $stmt = $pdo->prepare($query);
            $result = $stmt->execute([$del]);
            if($result && $del != 26){
                $query = "DELETE FROM `user` WHERE id=?";
                $stmt = $pdo->prepare($query);
                $result = $stmt->execute([$del]);
                if (isset($result)) {
                    echo "YES";
                } else {
                    echo "NO";
                }
            }
        }

    }
}

elseif(isset($_POST['usrdel_id'])){
    global $pdo;
    $del = $_POST['usrdel_id'];
    $query = "DELETE FROM user   
                       WHERE id=?";
    $stmt = $pdo->prepare($query);
    $result = $stmt->execute([$del]);;
    if(isset($result)) {
        echo "YES";
    } else {
        echo "NO";
    }
}

elseif(isset($_POST['usrupdt_id'])){
    global $pdo;
    $userId = $_POST['usrupdt_id'];
    $verified=1;
    $query2 = "Select * from `user` where id=:id";
    $stmt3 = $pdo->prepare($query2);
    $stmt3->bindParam('id', $userId, PDO::PARAM_STR);
    $stmt3->execute();
    $datanew=$stmt3->fetch();
    $courseid=2;
    $courserole=5;
    $FirstName=$datanew['firstname'];
    $LastName=$datanew['lastname'];
    $Email=$datanew['email'];
    $Password=$datanew['password'];
    $uqid=$datanew['uqid'];
    $acceptiondate=date("Y-m-d");

    $query4  = "INSERT INTO `llnusers`( `firstname`, `lastname`, `email`, `password`, `uqid`, `courseid`, `courserole`)VALUES (:firstname, :lastname, :email, :password, :uqid,:courseida, :courserolea )";
    $stmt4 = $pdo->prepare($query4);
    $stmt4->bindParam('firstname', $FirstName, PDO::PARAM_STR);
    $stmt4->bindParam('lastname', $LastName, PDO::PARAM_STR);
    $stmt4->bindParam('email', $Email, PDO::PARAM_STR);
    $stmt4->bindParam('password', $Password, PDO::PARAM_STR);
    $stmt4->bindParam('uqid', $uqid, PDO::PARAM_STR);
    $stmt4->bindParam('courseida', $courseid, PDO::PARAM_STR);
    $stmt4->bindParam('courserolea', $courserole, PDO::PARAM_STR);
    $stmt4->execute();

    $sql = "UPDATE user SET verified=?,acceptionDate=? WHERE id=?";
    $stmt= $pdo->prepare($sql);
    $result = $stmt->execute([$verified,$acceptiondate,$userId]);
    if(isset($result)) {
        echo "YES";
        $name = $FirstName . " " . $LastName;
        send_mail_tostudent($name,$uqid,$Email);
        /*** Add record in of_enrolment database ***/
        $query5  = " INSERT INTO `of_enrolment`(`usrid`, `std_id`)VALUES ((SELECT id FROM user WHERE uqid = '$uqid'),'$uqid' )";
        $stmt5 = $pdo->prepare($query5);
        $stmt5->bindParam('uqid', $uqid, PDO::PARAM_STR);
        $stmt5->execute();
    } else {
        echo "NO";
    }
}

if (isset($_POST['resetPassEmail'])){
    $Password=md5($_POST['Password']);
    $sql = "UPDATE user SET password=? WHERE email=?";
    $stmt= $pdo->prepare($sql);
    $result = $stmt->execute([$Password,$_POST['resetPassEmail']]);
    $sql2 = "UPDATE llnusers SET password=? WHERE email=?";
    $stmt2= $pdo->prepare($sql2);
    $result2 = $stmt2->execute([$Password,$_POST['resetPassEmail']]);
    $query = "DELETE FROM of_pass_rese   
                       WHERE email=?";
    $stmt = $pdo->prepare($query);
    $result = $stmt->execute([$_POST['resetPassEmail']]);;
    echo 'Success: Your password have been reset successfully!';
}
?>