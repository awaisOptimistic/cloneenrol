<?php
include('config.php');
require 'sessionCheckForLogicPages.php';
$userId=$_GET['user'];
$verified=1;
$page=$_GET['page'];
try {
    $sql = "UPDATE user SET verified=? WHERE id=?";
	$stmt= $pdo->prepare($sql);
	$stmt->execute([$verified,$userId]);

    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
    if ($page=='pu') {
    	header('Location: /index.php?page=4');
    }
    
?>