<?php

$userId=$_GET['user'];
$page=$_GET['page'];
try {
    $sql = "Delete from user WHERE id=?";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$userId]);
    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
    if($page=='pu') {
        header('Location: /index.php?page=4');
    }else {
        header('Location: /index.php?page=3');
    }

?>