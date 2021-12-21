<?php
include ('config.php');

try {
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $Email = $_POST['Email'];
    $phone = $_POST['Phone'];
    $Password = md5($_POST['Password']);
    $role = $_POST['Role'];
    $verified=0;
        $role=$_POST['Role'];
        $query = "select * from `user` where `email`=:username";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('username', $Email, PDO::PARAM_STR);
        $stmt->execute();
        $dataa=$stmt->fetchAll();
        $count = $stmt->rowCount();
        
            // var_dump($role);
            // exit();
        if ($count!=1) { 
            if ($role == 3) {
                $source = $_POST['source'];
                $courseDraft = $_POST['course'];
                $i = 0;
                foreach ($courseDraft as $value) {
                    if ($i == 0) {
                        $course = $value;
                        $i++;
                    } else {
                        $course = $course . ',' . $value;
                    }
                }
               
                $data = [
                    'firstname'=>$FirstName,
                    'lastname'=>$LastName,
                    'email'=>$Email,
                    'passworda'=>$Password,
                    'phone'=>$phone,
                    'courses'=>$course,
                    'sources'=>$source,
                    'rolea'=>$role,
                    'verified'=>$verified
                ];$query="INSERT INTO `user` ( `first name`, `last name`, `email`, `password`,`phone`,`courses`,`source`, `role`, `verified`) VALUES (:firstname, :lastname, :email, :passworda,:phone,:courses,:sources, :rolea, :verified)";
                $stmt = $pdo->prepare($query);
                $stmt->execute($data);
                echo 'Success: Please contact your admin to approve your account';
            }else{
                $data = [
                    'firstname'=>$FirstName,
                    'lastname'=>$LastName,
                    'email'=>$Email,
                    'passworda'=>$Password,
                    'phone'=>$phone,
                    'rolea'=>$role,
                    'verified'=>$verified
                ];$query="INSERT INTO `user` ( `first name`, `last name`, `email`, `password`,`phone`, `role`, `verified`) VALUES (:firstname, :lastname, :email, :passworda,:phone, :rolea, :verified)";
                $stmt = $pdo->prepare($query);
                $stmt->execute($data);
                echo 'Success: Please contact your admin to approve your account';
            }
        }else{
            echo 'Error: Email Already Registered!';
        }
}catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

?>