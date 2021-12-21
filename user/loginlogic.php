<?php

global $pdo, $url;
$msg = ""; 
if(isset($_POST['submitBtnLogin'])) {
  $username = trim($_POST['username']);
  $password = md5(trim($_POST['password']));

  if($username != "" && $password != "") {
    try {
        include 'config.php';
      $query = "select * from `user` where `email`=:username and `password`=:password";
      $stmt = $pdo->prepare($query);
      $stmt->bindParam('username', $username, PDO::PARAM_STR);
      $stmt->bindValue('password', $password, PDO::PARAM_STR);
      $stmt->execute();
      $row   = $stmt->fetch(PDO::FETCH_ASSOC);

      $count = $stmt->rowCount();
     // echo var_dump($row);
      if($count == 1 && !empty($row)) {
        if($row['verified']==0){
          $msg = "Your account is not approved by admin. Please contact your admin to get it approved!";
        }else{
            $userId=$row["id"];
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['currentSession']=1;
            $_SESSION['role']=$row ["role"];
            $_SESSION['userid']=$row ["id"];
            $_SESSION['email']=$row["email"];
            $_SESSION['uqid']=$row["uqid"];

            $msg = "Log in Success!";
            header('Location: /',  true,  301);
            session_write_close();
            exit();
        }
      } else {
        $msg = "Invalid username and password!";
      }
    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
  } else {
    $msg = "Both fields are required!";
  }
}

if(isset($_POST['submitBtnRegister'])) {


    if( $_POST['email'] != "") {
        try {
            include 'config.php';
            $query = "select * from `user` where `email`=:username";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam('username', $_POST['email'], PDO::PARAM_STR);
            $stmt->execute();
            $row   = $stmt->fetch(PDO::FETCH_ASSOC);

            $count = $stmt->rowCount();
            // echo var_dump($row);
            if($count == 1 && !empty($row)) {
                    //check if already a record exists
                    $query3 = "select * from `of_pass_rese` where `email`=:username";
                    $stmt3 = $pdo->prepare($query3);
                    $stmt3->bindParam('username', $_POST['email'], PDO::PARAM_STR);
                    $stmt3->execute();
                    $row3   = $stmt3->fetch(PDO::FETCH_ASSOC);
                    $count2 = $stmt3->rowCount();
                    $tokenId=$row3['id'];
                if($count2 == 0 ) {
                    //token generation
                    $token = bin2hex(random_bytes(50));
                    //get user and insert the details in token table
                    $query2 = "INSERT INTO `of_pass_rese`( `userid`, `email`, `token`)VALUES (:userid,:email, :token )";
                    $stmt2 = $pdo->prepare($query2);
                    $stmt2->bindParam('userid', $row['id'], PDO::PARAM_STR);
                    $stmt2->bindParam('email', $_POST['email'], PDO::PARAM_STR);
                    $stmt2->bindParam('token', $token, PDO::PARAM_STR);
                    $stmt2->execute();
                }else{
                    $query4 = "DELETE FROM `of_pass_rese` WHERE `id`=:tid";
                    $stmt4 = $pdo->prepare($query4);
                    $stmt4->bindParam('tid', $tokenId, PDO::PARAM_STR);
                    $stmt4->execute();
                    //token generation
                    $token = bin2hex(random_bytes(50));
                    //get user and insert the details in token table
                    $query2 = "INSERT INTO `of_pass_rese`( `userid`, `email`, `token`)VALUES (:userid,:email, :token )";
                    $stmt2 = $pdo->prepare($query2);
                    $stmt2->bindParam('userid', $row['id'], PDO::PARAM_STR);
                    $stmt2->bindParam('email', $_POST['email'], PDO::PARAM_STR);
                    $stmt2->bindParam('token', $token, PDO::PARAM_STR);
                    $stmt2->execute();
                }
                //send an email with the reset link
                $to = $_POST['email'];
                $subject = "[Optimistic Futures]Password Reset";
                $txt  = '<html><body>';
                $txt='<p>Dear user,</p>';
                $txt.='<p>Please click on the following link to reset your password.</p>';
                $txt.='<p>-------------------------------------------------------------</p>';
                $txt.='<p><a href="'.$url.'/reset-password.php?key='.$token.'&email='.$_POST['email'].'&action=reset" target="_blank">
                http://testenrol.of.edu.au/reset-password.php?key='.$token.'&email='.$_POST['email'].'&action=reset</a></p>';
                $txt.='<p>-------------------------------------------------------------</p>';
                $txt.='<p>Please be sure to copy the entire link into your browser.
The link will expire after 1 day for security reason.</p>';
                $txt.='<p>If you did not request this forgotten password email, no action
is needed, your password will not be reset. However, you may want to log into
your account and change your security password as someone may have guessed it.</p>';
                $txt.='<p>Thanks,</p>';
                $txt.='<p>Optimistic Futures Team</p>';
                $txt .= '</body></html>';


                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: itsupport@of.edu.au \r\n";
                mail($to,$subject,$txt,$headers);

                $msg = "If you supplied a correct email address then an email should have been sent to you.";
            } else {
                $msg = "If you supplied a correct email address then an email should have been sent to you.";
            }
        } catch (PDOException $e) {
            echo "Error : ".$e->getMessage();
        }
    }
}
?>