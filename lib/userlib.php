<?php
require_once ('lib.php');
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
include '../config.php';
    session_start();
    if (isset($_POST["newcourse"])){

        #1 get user id
        $userId=$_SESSION['userid'];
        #2 get norm id from user table
        $query = "select normid from `user` where `id`=:userid";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('userid', $userId, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        $normId=$row['normid'];

        #3 get enrol id and coourse id
        $querynew = "SELECT * FROM `norm_users_enrol_courses` where `id`=:normId";
        $stmtnew = $pdo->prepare($querynew);
        $stmtnew->bindParam('normId', $normId, PDO::PARAM_STR);
        $stmtnew->execute();
        $rownew   = $stmtnew->fetch();

        //print_r($rownew);
        //echo "USERID: ".$rownew["userid"]." Enrolid: ".$rownew["enrolid"]." courseid: ".$rownew["courseid"];

        #4 check if enrolForm is null
        $querynew = "SELECT * FROM `of_enrolment` where `id`=:enrolid";
        $stmtnew = $pdo->prepare($querynew);
        $stmtnew->bindParam('enrolid', $rownew["enrolid"], PDO::PARAM_STR);
        $stmtnew->execute();
        $rownew2   = $stmtnew->fetch(PDO::FETCH_ASSOC);

        #if Null then do the following
        if($rownew2['enrolForm']==NULL) {

            #--Update course name in course table
            $sql = "UPDATE `courses` SET `course`=?,`fundingType`=? WHERE id=?";
                $stmt= $pdo->prepare($sql);
                $stmt->execute([$_POST["newcourse"],$_POST["govsubornot"],$rownew["courseid"]]);

            #--Update course name in user table
                $sql = "UPDATE `user` SET `courses`=? WHERE id=?";
                $stmt= $pdo->prepare($sql);
                $stmt->execute([$_POST["newcourse"],$rownew["userid"]]);
        }
        #else do the following
        else{
            var_dump($rownew);
        # -- add new course and get the course id
        # -- add new enrolment and get the enrol id
        # -- add both ids and user id into norm table
        # --update all tables with new norm id

        }


        //Check if current enrolment is empty





        //if($rownew['enrolForm']==NULL){
        //    //update course name in course table
        //    $sql = "UPDATE `courses` SET `course`=?,`fundingType`=? WHERE id=?";
        //    $stmt= $pdo->prepare($sql);
        //    $stmt->execute([$_POST["newcourse"],$_POST["govsubornot"],$rownew["courseid"]]);
        //
        //    //update course name in user table
        //    $sql = "UPDATE `user` SET `courses`=? WHERE id=?";
        //    $stmt= $pdo->prepare($sql);
        //    $stmt->execute([$_POST["newcourse"],$userId]);
        //
        //}else{
        //    // need userid,uqid
        //    $uqid = get_uqid($userId);
        //    $userId=$_SESSION['userid'];
        //
        //    //add in course table
        //    $queryCourse  = "INSERT INTO `courses`( `userid`, `course`) VALUES (:userid,:course)";
        //    $stmtCourse = $pdo->prepare($queryCourse);
        //    $stmtCourse->bindParam('userid', $userId, PDO::PARAM_STR);
        //    $stmtCourse->bindParam('course', $_POST["newcourse"], PDO::PARAM_STR);
        //    $stmtCourse->execute();
        //
        //    ////get course id
        //    $querynew = "SELECT id FROM `courses` where `userid`=:userid order by id desc limit 1";
        //    $stmtnew = $pdo->prepare($querynew);
        //    $stmtnew->bindParam('userid', $userId, PDO::PARAM_STR);
        //    $stmtnew->execute();
        //    $rownew   = $stmtnew->fetch();
        //    $courseId=$rownew["id"];
        //
        //
        //    //add new enrolment record
        //    $query5  = "INSERT INTO `of_enrolment`(`usrid`, `std_id`,`courseid`)VALUES (:usrid,:uqid,:courseid )";
        //    $stmt5 = $pdo->prepare($query5);
        //    $stmt5->bindParam('usrid', $userId, PDO::PARAM_STR);
        //    $stmt5->bindParam('uqid', $uqid, PDO::PARAM_STR);
        //    $stmt5->bindParam('courseid', $courseId, PDO::PARAM_STR);
        //    $stmt5->execute();
        //
        //    //get enrolment id
        //    $querynew1 = "SELECT id FROM `of_enrolment` where `usrid`=:userid AND `courseid`=:courseid ";
        //    $stmtnew1 = $pdo->prepare($querynew1);
        //    $stmtnew1->bindParam('userid', $userId, PDO::PARAM_STR);
        //    $stmtnew1->bindParam('courseid', $courseId, PDO::PARAM_STR);
        //    $stmtnew1->execute();
        //    $rownew1   = $stmtnew1->fetch();
        //    $enrolmentId=$rownew1["id"];
        //
        //    //update user table
        //    $sql = "UPDATE `user` SET `courses`=?,`enrolmentId`=?,`courseid`=? WHERE id=?";
        //    $stmt= $pdo->prepare($sql);
        //    $stmt->execute([$_POST["newcourse"],$enrolmentId,$courseId,$userId]);
        //
        //}


       // echo ("YES");
    }

if (isset($_POST["oldpass"])){

    $userId=$_SESSION['userid'];
    try {
        $query = "select * from `user` where `id`=:userid AND password= :passa";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('userid', $userId, PDO::PARAM_STR);
        $stmt->bindValue('passa', md5($_POST["oldpass"]), PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);

        $count = $stmt->rowCount();
         //echo var_dump($row);
        //echo $_POST["oldpass"];
        if($count == 1 && !empty($row)) {
            $sql = "UPDATE `user` SET password= :passa WHERE `id`=:userid";
            $stmt= $pdo->prepare($sql);
            $stmt->bindParam('userid', $userId, PDO::PARAM_STR);
            $stmt->bindValue('passa', md5($_POST["newpassword"]), PDO::PARAM_STR);
            $stmt->execute();
        } else {
            echo ("NO");
        }
    } catch (PDOException $e) {
        echo "Error : ".$e->getMessage();
    }

}
if (isset($_POST["phone"])){
    $phone=$_POST["phone"];
    $userId=$_SESSION['userid'];
    $sql = "UPDATE `user` SET `phone` = :phone  WHERE `user`.`id` = :userid";
    $stmt= $pdo->prepare($sql);
    $stmt->bindParam('phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam('userid', $userId, PDO::PARAM_STR);
    $stmt->execute();
}


?>