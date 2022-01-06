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
        if ($role == 3) {
            $source = $_POST['source'];
            $courseDraft = $_POST['course'];
            $i = 0;
            if ($courseDraft == "keepthesamecourses") {
                $course =NULL;
            } else if ($courseDraft != "keepthesamecourses") {
                foreach ($courseDraft as $value) {
                    if ($i == 0) {
                        $course = $value;
                        $i++;
                    } else {
                        $course = $course . ',' . $value;
                    }
                }
            }
        }

        if($Password!="keepthesame"){
            $Password=md5($Password);

            if($role==3 && $course!=NULL){
                $data = [
                    'firstname'=>$FirstName,
                    'lastname'=>$LastName,
                    'email'=>$Email,
                    'password'=>$Password,
                    'phone'=>$phone,
                    'courses'=>$course,
                    'sources'=>$source,
                    'role'=>$role,
                    'id'=>$id
                ];
                $query  = "UPDATE user SET  `first name`= :firstname, `last name`= :lastname, `email`= :email, `password`= :password,`phone`=:phone,`courses`=:courses,`source`=:sources, `role`= :role Where id=:id ";
                $stmt = $pdo->prepare($query);
                $stmt->execute($data);
                echo 'Updated Successfully';
            }
            elseif ($role==3 && $course==NULL){
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
            }else{
                $data = [
                    'firstname'=>$FirstName,
                    'lastname'=>$LastName,
                    'email'=>$Email,
                    'password'=>$Password,
                    'phone'=>$phone,
                    'role'=>$role,
                    'id'=>$id
                ];
                $query  = "UPDATE user SET  `firstname`= :firstname, `lastname`= :lastname, `email`= :email, `password`= :password,`phone`=:phone, `role`= :role Where id=:id ";
                $stmt = $pdo->prepare($query);
                $stmt->execute($data);
                echo 'Updated Successfully';
            }
        }else{
            if($role==3 && $course!=NULL){
                $data = [
                    'firstname'=>$FirstName,
                    'lastname'=>$LastName,
                    'email'=>$Email,
                    'phone'=>$phone,
                    'courses'=>$course,
                    'sources'=>$source,
                    'role'=>$role,
                    'id'=>$id
                ];
                $query  = "UPDATE user SET  `firstname`= :firstname, `lastname`= :lastname, `email`= :email,`phone`=:phone,`courses`=:courses,`source`=:sources, `role`= :role Where id=:id ";
                $stmt = $pdo->prepare($query);
                $stmt->execute($data);

                //get course id from enrolment
                $query23 = "select enrolmentId from `user` where id=:id";
                $stmt23 = $pdo->prepare($query23);
                $stmt23->bindValue('id', $id, PDO::PARAM_STR);
                $stmt23->execute();
                $enrolmentId   = $stmt23->fetch();


                //get course id
                $query234 = "select courseid  FROM `of_enrolment` where id=:id";
                $stmt234 = $pdo->prepare($query234);
                $stmt234->bindValue('id',$enrolmentId[0], PDO::PARAM_STR);
                $stmt234->execute();
                $courseId   = $stmt234->fetch();
                //update courses table as well
                $sql = "UPDATE `courses` SET `course`=? WHERE id=? ";
                $stmt= $pdo->prepare($sql);
                $stmt->execute([$course,$courseId[0]]);
                echo 'Updated Successfully';

            }elseif ($role==3 && $course==NULL){
                $data = [
                    'firstname'=>$FirstName,
                    'lastname'=>$LastName,
                    'email'=>$Email,
                    'phone'=>$phone,
                    'sources'=>$source,
                    'role'=>$role,
                    'id'=>$id
                ];
                $query  = "UPDATE user SET  `first name`= :firstname, `last name`= :lastname, `email`= :email, `phone`=:phone,`source`=:sources, `role`= :role Where id=:id ";
                $stmt = $pdo->prepare($query);
                $stmt->execute($data);
                echo 'Updated Successfully';
            }else{
                $data = [
                    'firstname'=>$FirstName,
                    'lastname'=>$LastName,
                    'email'=>$Email,
                    'phone'=>$phone,
                    'role'=>$role,
                    'id'=>$id
                ];
                $query  = "UPDATE user SET  `first name`= :firstname, `last name`= :lastname, `email`= :email,`phone`=:phone, `role`= :role Where id=:id ";
                $stmt = $pdo->prepare($query);
                $stmt->execute($data);
                echo 'Updated Successfully';
            }
        }

    }
}catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

?>