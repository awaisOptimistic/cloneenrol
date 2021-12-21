<?php
include('config.php');
global $pdo;
if (isset($_POST['formname']) && isset($_POST['iframe'])) {
    $FormName= $_POST['formname'];
    $Link = $_POST['iframe'];
    $query  = "INSERT INTO `form` ( `formname`, `iframe`) VALUES (:formnames, :link)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam('formnames', $FormName, PDO::PARAM_STR);
    $stmt->bindParam('link', $Link, PDO::PARAM_STR);
    $stmt->execute();
    echo 'Success: Form Added Successfully!';
    header("Location: index.php?page=8");
} else {
    header("Location: index.php");
}