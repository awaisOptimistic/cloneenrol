<?php
try {

    $pdo = new PDO('mysql:host=localhost;dbname=optimis7_testenrol;charset=utf8mb4', 'optimis7_awais', 'bbfdcc$123');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    /*** Base URL ***/
    $url= "https://testenrol.of.edu.au";

    /*** Rapid ID API ***/
    $rapidid = '19cc6dccddf2fbced02d7a4ba088b4bb97d64d0bcaca3ffa0b6e75edd03480a8' ;


    /*** Forms ID ***/

    $enrolmentForm = 213487567631868;
    $usiForm = 212640822702851;
    $skillForm = 212641364945862;
    $documentForm = 213198793540867;
    $usitransForm = 213147220992857 ;
    $seclln= 213116587606861;


} catch (PDOException $e) {
    echo "Connection failed : ". $e->getMessage();
}
?>