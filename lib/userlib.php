<?php
require_once ('lib.php');
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
include '../config.php';
    session_start();
    if (isset($_POST["newcourse"])){
        $userId=$_SESSION['userid'];
        //Check if current enrolment is empty

        $query = "select enrolmentId from `user` where `id`=:userid";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('userid', $userId, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        $enrolmentId=$row['enrolmentId'];

        $querynew = "SELECT * FROM `of_enrolment` where `id`=:enrolid";
        $stmtnew = $pdo->prepare($querynew);
        $stmtnew->bindParam('enrolid', $enrolmentId, PDO::PARAM_STR);
        $stmtnew->execute();
        $rownew   = $stmtnew->fetch(PDO::FETCH_ASSOC);

        if($rownew['enrolForm']==NULL){
        //    //update course name in course table
            $sql = "UPDATE `courses` SET `course`=? WHERE id=?";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$_POST["newcourse"],$rownew["courseid"]]);
            //update course name in user table
            $sql = "UPDATE `user` SET `courses`=? WHERE id=?";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$_POST["newcourse"],$userId]);
        }else{
            /***Insert Query***/
            $queryCourse  = "INSERT INTO `courses`( `userid`, `course`) VALUES (:userid,:course)";
            $stmtCourse = $pdo->prepare($queryCourse);
            $stmtCourse->bindParam('userid', $userId, PDO::PARAM_STR);
            $stmtCourse->bindParam('course', $_POST["newcourse"], PDO::PARAM_STR);
            $stmtCourse->execute();

            $sql = "UPDATE `user` SET `courses`=? WHERE id=?";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$_POST["newcourse"],$userId]);

            $uqid = get_uqid($userId);
            $query5  = "INSERT INTO `of_enrolment`(`usrid`, `std_id`)VALUES (:usrid,:uqid )";
            $stmt5 = $pdo->prepare($query5);
            $stmt5->bindParam('usrid', $userId, PDO::PARAM_STR);
            $stmt5->bindParam('uqid', $uqid, PDO::PARAM_STR);
            $stmt5->execute();
        }


        echo ("YES");
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