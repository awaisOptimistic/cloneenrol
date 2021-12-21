<?php
include('config.php');
include('lib.php');

if(isset($_POST['FirstName']) && isset($_POST['LastName']) && isset($_POST['Email']) && isset($_POST['Password']) && isset($_POST['Role']) && isset($_POST['Phone']) ){
    $FirstName= $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $Email = $_POST['Email'];
    $Password= $_POST['Password'];
    $ReferredBy = $_POST['ReferredBy'];
    if($_POST['Campus'] == 0){
        $Campus = "Colaroo/Roxburgh Park";
    }
    else if($_POST['Campus'] == 1){
        $Campus = "Broadmeadows/Campbellfield";
    }
    else if($_POST['Campus'] == 2){
        $Campus = "Greater Shepparton";
    }

    else{
        $Campus = "NULL";
    }


    if(session_status() ==  PHP_SESSION_NONE ) {
        session_start();
    }
        if ($_SESSION['role'] == 1) {
            $verified = 1;
        }
    else {
            $verified = 0;
        }

    $Password=md5($Password);
    $role=$_POST['Role'];
    $phone=$_POST['Phone'];
    $uqid = generateRandomString();
    if($role==3){
        $source=$_POST['source'];
        $courseDraft=$_POST['course'];
        $i=0;
        foreach ($courseDraft as $value){
            if($i==0){
                $course=$value;
                $i++;
            }else{
                $course=$course.','.$value;
            }
        }
    }

    $query = "select * from `user` where `email`=:username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam('username', $Email, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($count!=1) {
        if($role==3){
            /***Insert Query***/
            $query  = "INSERT INTO `user`(`first name`, `last name`, `email`, `password`, `phone`, `courses`, `source`, `campus`, `role`, `referral`, `verified`, `uqid`) VALUES (:firstname, :lastname, :email, :password,:phone, :course,:sources,:campus, :roles, :referred, :verified, :uqid)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam('firstname', $FirstName, PDO::PARAM_STR);
            $stmt->bindParam('lastname', $LastName, PDO::PARAM_STR);
            $stmt->bindParam('email', $Email, PDO::PARAM_STR);
            $stmt->bindParam('password', $Password, PDO::PARAM_STR);
            $stmt->bindParam('phone', $phone, PDO::PARAM_STR);
            $stmt->bindParam('course', $course, PDO::PARAM_STR);
            $stmt->bindParam('sources', $source, PDO::PARAM_STR);
            $stmt->bindParam('campus', $Campus, PDO::PARAM_STR);
            $stmt->bindParam('roles', $role, PDO::PARAM_STR);
            $stmt->bindParam('referred', $ReferredBy, PDO::PARAM_STR);
            $stmt->bindParam('verified', $verified, PDO::PARAM_STR);
            $stmt->bindParam('uqid', $uqid, PDO::PARAM_STR);
            $stmt->execute();

            $query2 = "select id from `user` where `email`=:username";
            $stmt2 = $pdo->prepare($query2);
            $stmt2->bindParam('username', $Email, PDO::PARAM_STR);
            $stmt2->execute();
            $count2 = $stmt2->fetch();
            echo 'Success: User Added Successfully!';
            send_newaccount_mail_tostudent($Email);
            send_mail_tocoordinator();
        }else{
            //echo 'Im here';
            //exit();
            /***Insert Query***/
            $query  = "INSERT INTO `user`(`first name`, `last name`, `email`, `password`, `phone`, `role`, `verified`, `uqid`) VALUES (:firstname, :lastname, :email, :password,:phone, :roles, :verified, :uqid)";
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

        }
    }else{
        echo 'Error: Email Already Registered!';
    }

}

elseif(isset($_POST['del_id'])){
    global $pdo;
    $del = $_POST['del_id'];
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
    $FirstName=$datanew['first name'];
    $LastName=$datanew['last name'];
    $Email=$datanew['email'];
    $Password=$datanew['password'];
    $uqid=$datanew['uqid'];
    $acceptiondate=date("Y-m-d");

    //var_dump($datanew);
    //echo  'course id '.$courseid. ' course role '. $courserole. ' first name'.$FirstName. ' lastname '.$LastName. ' email'.$Email. 'password '. $Password. 'uqid '. $uqid;
    //exit();

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
        send_mail_tostudent($Email);
            /*** Add record in of_enrolment database ***/
        $query5  = " INSERT INTO `of_enrolment`(`usrid`, `std_id`)VALUES ((SELECT id FROM user WHERE uqid = '$uqid'),'$uqid' )";
        $stmt5 = $pdo->prepare($query5);
        $stmt5->bindParam('uqid', $uqid, PDO::PARAM_STR);
        $stmt5->execute();

    } else {
        echo "NO";
    }
}elseif (isset($_POST['resetPassEmail'])){

    //echo "yes";

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


else{

}

?>