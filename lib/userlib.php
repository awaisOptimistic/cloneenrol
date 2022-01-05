<?php
require_once ('lib.php');
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
    session_start();
    if (isset($_POST["newcourse"])){
        include '../config.php';
        $userId=$_SESSION['userid'];
        /***Insert Query***/
        $queryCourse  = "INSERT INTO `courses`( `userid`, `course`) VALUES (:userid,:course)";
        $stmtCourse = $pdo->prepare($queryCourse);
        $stmtCourse->bindParam('userid', $userId, PDO::PARAM_STR);
        $stmtCourse->bindParam('course', $_POST["newcourse"], PDO::PARAM_STR);
        $stmtCourse->execute();

        $uqid = get_uqid($userId);
        $query5  = "INSERT INTO `of_enrolment`(`usrid`, `std_id`)VALUES ((SELECT id FROM user WHERE uqid = '$uqid'),'$uqid' )";
        $stmt5 = $pdo->prepare($query5);
        $stmt5->bindParam('uqid', $uqid, PDO::PARAM_STR);
        $stmt5->execute();

        $sql = "UPDATE `user` SET `courses`=? WHERE id=?";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$_POST["newcourse"],$userId]);
        echo ("YES");
    }

if (isset($_POST["oldpass"])){

    //echo ("NO");
}


?>