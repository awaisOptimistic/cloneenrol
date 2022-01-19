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
        # -- add new course and get the course id
            $queryCourse  = "INSERT INTO `courses`( `userid`, `course`,`fundingType`) VALUES (:userid,:course,:funding)";
            $stmtCourse = $pdo->prepare($queryCourse);
            $stmtCourse->bindParam(':userid', $userId, PDO::PARAM_STR);
            $stmtCourse->bindParam(':course', $_POST["newcourse"], PDO::PARAM_STR);
            $stmtCourse->bindParam(':funding', $_POST["govsubornot"], PDO::PARAM_STR);
            $stmtCourse->execute();

        # -- add new enrolment and get the enrol id

            $query = "INSERT INTO `of_enrolment`( `usrid`, `std_id`, `enrolForm`, `skillForm`, `usiForm`, `documentForm`, `ptrForm`, `llnForm`) VALUES (:userid,:stdid, NULL,NULL,NULL,NULL,NULL,NULL)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam('userid', $userId, PDO::PARAM_STR);
            $stmt->bindParam('stdid', $rownew2["std_id"], PDO::PARAM_STR);
            $stmt->execute();

        # -- add both ids and user id into norm table
            /*** Add record in of_enrolment database ***/
            $query6  = "select * from `of_enrolment` where `usrid`=:userid order by id desc limit 1";
            $stmt6 = $pdo->prepare($query6);
            $stmt6->bindParam('userid', $userId, PDO::PARAM_STR);
            $stmt6->execute();
            $result2 = $stmt6->fetch(PDO::FETCH_ASSOC);
            $enrolId = $result2['id'];



            $query6  = "select * from `courses` where `userid`=:userid order by id desc limit 1";
            $stmt6 = $pdo->prepare($query6);
            $stmt6->bindParam('userid', $userId, PDO::PARAM_STR);
            $stmt6->execute();
            $result2 = $stmt6->fetch(PDO::FETCH_ASSOC);
            $courseId = $result2['id'];

        # --update all tables with new norm id
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

            var_dump($rownew);

            $sql = "UPDATE user SET normid=?,courses=? WHERE id=?";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$rownew["id"],$_POST["newcourse"],$userId]);

            $sql = "UPDATE  `of_enrolment` SET normid=? WHERE id=?";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$rownew["id"],$enrolId]);

            $sql = "UPDATE  `courses` SET normid=? WHERE id=?";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$rownew["id"],$courseId]);

        }
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