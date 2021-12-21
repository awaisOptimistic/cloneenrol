function thankyou($page,$form){
get_breadcrumbs($page);
/* Begin Page Content */
include('config.php');
//        $userId=$_SESSION['userid'];
//        try {
//
//            $query = "select * from `usersteps` where `userid`=:userId";
//            $stmt = $pdo->prepare($query);
//            $stmt->bindParam('userId', $userId, PDO::PARAM_STR);
//            $stmt->execute();
//            $row   = $stmt->fetch(PDO::FETCH_ASSOC);
//            //var_dump($row);
//            if($row==NULL || empty($row)){
//                $query = "INSERT INTO `usersteps`( `userid`, `lln`, `documentUpload`, `ptr`, `skillFirstForm`, `enrolmentForm`, `usi`) VALUES (:userId,NULL,NULL,NULL,NULL,NULL,NULL)";
//                $stmt = $pdo->prepare($query);
//                $stmt->bindParam('userId', $userId, PDO::PARAM_STR);
//                $stmt->execute();
//            }
//        } catch (PDOException $e) {
//            echo "Error : " . $e->getMessage();
//        }



echo '<div class="container-fluid">';
    //echo  '<h1 class="h3 mb-4 text-gray-800" style="text-align: center; padding-top: 30px;">List of Approved Students</h1>';
    /*  Page Heading */
    if($form=='enrolForm'){
    //            $query = "UPDATE `usersteps` SET lln=1 WHERE `userid`=:userId";
    //            $stmt = $pdo->prepare($query);
    //            $stmt->bindParam('userId', $userId, PDO::PARAM_STR);
    //            $stmt->execute();
    $data = json_encode($_POST);
    $sql = "UPDATE `of_enrolment` SET `enrolForm`= ? WHERE std_id = ?";
    $stmt= $pdo->prepare($sql);
    $result = $stmt->execute([$data,$_POST['identificationnumber'] ]);

    }elseif ($form=='skillForm'){
    $data = json_encode($_POST);
    $sql = "UPDATE `of_enrolment` SET `skillForm`= ? WHERE std_id = ?";
    $stmt= $pdo->prepare($sql);
    $result = $stmt->execute([$data,$_POST['identificationnumber'] ]);
    }elseif ($form=='usiForm'){
    echo '<h1>it worked</h1>';
    $data = json_encode($_POST);
    $sql = "UPDATE `of_enrolment` SET `usiForm`= ? WHERE std_id = ?";
    $stmt= $pdo->prepare($sql);
    $result = $stmt->execute([$data,$_POST['identificationnumber'] ]);
    }elseif ($form=='documentForm'){

    $data = json_encode($_POST);
    $sql = "UPDATE `of_enrolment` SET `documentForm`= ? WHERE std_id = ?";
    $stmt= $pdo->prepare($sql);
    $result = $stmt->execute([$data,$_POST['identificationnumber'] ]);
    }elseif ($form=='ptrForm'){
    $data = json_encode($_POST);
    $sql = "UPDATE `of_enrolment` SET `ptrForm`= ? WHERE std_id = ?";
    $stmt= $pdo->prepare($sql);
    $result = $stmt->execute([$data,$_POST['identificationnumber'] ]);
    }elseif ($form=='llnForm'){
    $data = json_encode($_POST);
    $sql = "UPDATE `of_enrolment` SET `llnForm`= ? WHERE std_id = ?";
    $stmt= $pdo->prepare($sql);
    $result = $stmt->execute([$data,$_POST['identificationnumber'] ]);
    }

    echo  '<div class="row">
        <div class="col-sm-12">
            <div class="card shadow mb-4">
                <!-- <div class="card-header py-3">
                     <h6 class="m-0 font-weight-bold text-primary">You can edit,update and delete users through this panel</h6>
                 </div>-->
                <div class="card-body border-bottom-success">
                    <div style="text-align: center !important; ">
                        <img src="img/Thankyou-iconV2.png" style="width: 20% !important">
                    </div>
                    <h1 style="text-align: center !important; "> Thank You!</h1>
                    <h4 style="text-align: center !important; ">Your submission has been received.</h4>
                    <div style="text-align: center !important; ">
                        <a href="http://testenrol.of.edu.au/index.php" class="btn btn-success w-30">
                            Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';
/* container-fluid */



}