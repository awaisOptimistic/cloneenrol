<?php
require 'sessionCheckForLogicPages.php';
$sessId=$_GET['user'];
try {
    $sql = "Delete from bbfdccAppSessions WHERE sessId=?";
	$stmt= $pdo->prepare($sql);
	$stmt->execute([$sessId]);

    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
    header('Location: /index.php?page=5?message=success');
    
?>