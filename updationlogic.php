<?php
include ('config.php');
try {
    if(isset($_POST['page2'])){
        $id = $_POST['userId'];
        $FirstName = $_POST['FirstName'];
        $LastName = $_POST['LastName'];
        $Email = $_POST['Email'];
        $phone = $_POST['Phone'];
        $Password = $_POST['Password'];
        if($Password!="keepthesame"){
            $Password=md5($Password);
                $data = [
                    'firstname'=>$FirstName,
                    'lastname'=>$LastName,
                    'email'=>$Email,
                    'password'=>$Password,
                    'phone'=>$phone,
                    'id'=>$id
                ];
                $queryNew  = "UPDATE user SET  `first name`= :firstname, `last name`= :lastname, `email`= :email, `password`= :password,`phone`=:phone Where id=:id ";
                $stmtNew = $pdo->prepare($queryNew );
                $stmtNew->execute($data);
                echo 'Updated Successfully';
        }else{
            $data = [
                'firstname'=>$FirstName,
                'lastname'=>$LastName,
                'email'=>$Email,
                'phone'=>$phone,
                'id'=>$id
            ];
            $queryNew  = "UPDATE user SET  `first name`= :firstname, `last name`= :lastname, `email`= :email,`phone`=:phone Where id=:id ";
            $stmtNew = $pdo->prepare($queryNew);
            $stmtNew->execute($data);
            echo 'Updated Successfully';
        }
    }else if(isset($_POST['phoneUpdate'])){
        $phone=$_POST['Phone'];
        $id=$_POST['userid'];
        $data = [
            'phone'=>$phone,
            'id'=>$id
        ];
        $queryNew  = "UPDATE user SET  `phone`=:phone Where id=:id ";
        $stmtNew = $pdo->prepare($queryNew);
        $stmtNew->execute($data);
        echo 'Updated Successfully';
    }else if(isset($_POST['updatePassword1'])){
        $id = $_POST['userId'];
        $Password = $_POST['Password'];
        $oldPassword=md5(trim($_POST['oldPass']));
        //echo $oldPassword;
        $Password=md5($Password);
        $data = [
            'password'=>$Password,
            'id'=>$id
        ];
        $query = "select * from `user` where `password`=:password and id=:id";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue('password', $oldPassword, PDO::PARAM_STR);
        $stmt->bindValue('id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);

        $count = $stmt->rowCount();
        if($count!=0){
            $queryNew  = "UPDATE user SET   `password`= :password Where id=:id ";
            $stmtNew = $pdo->prepare($queryNew );
            $stmtNew->execute($data);
            echo 'Updated Successfully';
        }else{
            echo "Password doesn't match. Please try again!";
        }

    }else{
        $id = $_POST['userId'];
        $FirstName = $_POST['FirstName'];
        $LastName = $_POST['LastName'];
        $Email = $_POST['Email'];
        $phone = $_POST['Phone'];
        $Password = $_POST['Password'];
        $role = $_POST['Role'];
        $govsubornot=$_POST['govsubornot'];
        if ($role == 3) {
            $source = $_POST['source'];
            $courseDraft = $_POST['course'];
            $i = 0;
            if ($courseDraft == "keepthesamecourses") {
                $course =NULL;
            } else if ($courseDraft != "keepthesamecourses") {
                $course =$courseDraft ;
            }
        }

        #get norm id from user tabl;e
        $query = "select normid from `user` where `id`=:userid";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('userid', $id , PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        $normId=$row['normid'];
        //var_dump($row);
        //echo $normId;

        # get course id from norm in basis of userid
        $querynew = "SELECT * FROM `norm_users_enrol_courses` where `id`=:normId";
        $stmtnew = $pdo->prepare($querynew);
        $stmtnew->bindParam('normId', $normId, PDO::PARAM_STR);
        $stmtnew->execute();
        $rownew   = $stmtnew->fetch();


        if($role==3 && $courseDraft!=NULL){
            $data = $courseDraft;
            if ($courseDraft == "keepthesamecourses") {
                $sql = "UPDATE `courses` SET `fundingType`=? WHERE id=? ";
                $stmt= $pdo->prepare($sql);
                $stmt->execute([$govsubornot,$rownew["courseid"]]);
            } else{
                $sql = "UPDATE `courses` SET `course`=?,`fundingType`=? WHERE id=? ";
                $stmt= $pdo->prepare($sql);
                $stmt->execute([$data,$govsubornot,$rownew["courseid"]]);

                $query  = "UPDATE user SET  `courses`=:courses Where id=:id ";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$data, $rownew["userid"]]);

                //echo $data.' ' .$govsubornot.' ' .$rownew["courseid"];
            }
        }
        if($Password!="keepthesame"){
            $Password=md5($Password);
            $data = [
                    'firstname'=>$FirstName,
                    'lastname'=>$LastName,
                    'email'=>$Email,
                    'password'=>$Password,
                    'phone'=>$phone,
                    'sources'=>$source,
                    'role'=>$role,
                    'id'=>$id
            ];
            $query  = "UPDATE user SET  `firstname`= :firstname, `lastname`= :lastname, `email`= :email, `password`= :password,`phone`=:phone,`source`=:sources, `role`= :role Where id=:id ";
            $stmt = $pdo->prepare($query);
            $stmt->execute($data);
            echo 'Updated Successfully';

        }else if($Password=="keepthesame"){
            $data = [
                    'firstname'=>$FirstName,
                    'lastname'=>$LastName,
                    'email'=>$Email,
                    'phone'=>$phone,
                    'sources'=>$source,
                    'role'=>$role,
                    'id'=>$id
            ];
            $query  = "UPDATE user SET  `firstname`= :firstname, `lastname`= :lastname, `email`= :email, `phone`=:phone,`source`=:sources, `role`= :role Where id=:id ";
            $stmt = $pdo->prepare($query);
            $stmt->execute($data);
            echo 'Updated Successfully';
        }
    }

}catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage();
}

?>