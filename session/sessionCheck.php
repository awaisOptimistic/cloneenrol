<?php
//error_reporting(0);
session_start();
//error_reporting(0);

if(isset($_SESSION['currentSession']) && isset($_SESSION['sessionSec'])){
    $currentSession=$_SESSION['currentSession'];
    $sessionSec= $_SESSION['sessionSec'];
    $query = "select * from `bbfdccAppSessions` where sessId=:sessId AND sesstimestamp = :tp ";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam('sessId', $sessionSec, PDO::PARAM_STR);
    $stmt->bindParam('tp', $currentSession, PDO::PARAM_STR);
    $stmt->execute();
    $sessiondata= $stmt->fetch(PDO::FETCH_ASSOC);
    $sesscount= $stmt->rowCount();
    if($sesscount == 1 && !empty($sessiondata)){
        $query = "SELECT * FROM `user` where id=:userId";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('userId', $sessiondata["userId"], PDO::PARAM_STR);
        $stmt->execute();
        $userdata= $stmt->fetch(PDO::FETCH_ASSOC);
        if($userdata["role"]=="Admin"){
            $role=1;
        }else{
            $role=0;
        }
        $exists=1;
    }else{
        $exists=0;
    }
}else{
    $exists=0;
    
}
?>