<?php
//include('config.php');
global $rapidId;

function getCourseName($userid){
    global $pdo;
    $query = "SELECT * FROM `user` WHERE id =:userid";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam('userid',  $userid, PDO::PARAM_STR);
    $stmt->execute();
    $row   = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}
function enrolmentProgress($user){
    global $pdo;
    $query = "SELECT * FROM `of_enrolment` WHERE `usrid` =:userid order by `of_enrolment`.id desc limit 1";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam('userid',  $user, PDO::PARAM_STR);
    $stmt->execute();
    $row   = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}
function send_sms_to_coordinator($name,$uqid, $Email,$course){
    global $url;
    $txt  = 'Hi,
A new student account has been created with Optimistic Futures. The student details are:
Student ID: '.$uqid.'
Full Name: '.$name.'
Email Address: '.$Email.'
Email Address: '.$course.'
Please go to enrol.of.edu.au
Thanks
Optimistic Futures Team';

    $value = array("number" => "61414429051", "senderid"=> "OPTFUTURES", "message"=> "$txt", "campaignName"=> "My Api Campaign", "reference"=> "campaign");
    $data = http_build_query($value);

    $curl = curl_init();
    curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://platform.touchsms.com.au/rest/v1/messages',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic MzI0NS05MDd5RlQ4TGZYWUpQOWozOkExVEpHRFJRQ3dHZjQ0ZmkyMg==',
                    'Cookie: PHPSESSID=7b0796903dc8d2e14239cd4fbed883ab'
            ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
}

/**
 * Verify Phone number
 */
function verifyPhoneNumber($number,$message){
    global $url;
    $txt  = $message;
    $value = array("number" => $number, "senderid"=> "OPTFUTURES", "message"=> "$txt", "campaignName"=> "My Api Campaign", "reference"=> "campaign");
    $data = http_build_query($value);

    $curl = curl_init();
    curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://platform.touchsms.com.au/rest/v1/messages',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic MzI0NS05MDd5RlQ4TGZYWUpQOWozOkExVEpHRFJRQ3dHZjQ0ZmkyMg==',
                    'Cookie: PHPSESSID=7b0796903dc8d2e14239cd4fbed883ab'
            ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return
            $response;
}

/**
 * Get Student Identification document
 */
function get_studentDocumentVerification(){
    global $pdo;
    try {
        $query = "SELECT * FROM `of_documentVerify`";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


/**
 * Get Student All documents
 */
function get_studentDocuments(){
    global $pdo;
    try {
        $query = "SELECT * FROM `of_enrolment`";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


/**
 * Send mail to student once account is approved
 */
function send_llncompletion_mail($name,$uqid,$Email){
    $to = $Email;
    $subject = "Account Approval";
    $txt  = '<html><body>';
    $txt .= '<h1 style="font-size:18px;">Hi, '.$name .'</h1>';
    $txt .= '<p style="font-size:18px;">Your LLN has been marked. Your credentials are: </p>';
    $txt.='<p>-------------------------------------------------------------</p>';
    $txt .= '<p style="font-size:18px;"> Student ID: '.$uqid.'</p>';
    $txt .= '<p style="font-size:18px;"> Email Address: '.$Email.'</p>';
    $txt .= '<p style="font-size:18px;"> Password: [Your Chosen Password]</p>';
    $txt.='<p>-------------------------------------------------------------</p>';
    $txt .= '<a href="enrol.of.edu.au"> <p style="color:#080;font-size:24px;">Click Here</p></a>';
    $txt .= '<p style="font-size:18px;">Thanks</p>';
    $txt.= '<p style="font-size:18px;">Optimistic Futures Team</p>';
    $txt .= '</body></html>';
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: admissions@of.edu.au. \r\n";
    mail($to,$subject,$txt,$headers);
}

/**
 * Send mail to student once account creation
 */
function send_newaccount_mail_tostudent($name, $Email){
    $to = $Email;
    $subject = "[Optimistic Futures]New User Account";
    $txt  = '<html><body>';
    $txt .= '<h1 style="font-size:18px;">Hi, '.$name .'</h1>';
    $txt .= '<p  style="font-size:18px;">Thank you for creating account at Optimistic Futures. Our representative will inform you through call or email once your account will be approved.</p>';
    $txt .= '<p  style="font-size:18px;">Thanks</p>';
    $txt.= '<p style="font-size:18px;">Optimistic Futures Team</p>';
    $txt .= '</body></html>';
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: admissions@of.edu.au. \r\n";
    mail($to,$subject,$txt,$headers);
}

/**
 * Send mail to student once account is approved
 */
function send_mail_tostudent($name,$uqid,$Email){
    $to = $Email;
    $subject = "[Optimistic Futures]Account Approval";
    $txt  = '<html><body>';
    $txt .= '<h1 style="font-size:18px;">Hi, '.$name .'</h1>';
    $txt .= '<p style="font-size:18px;">Your account has been approved by Optimistic representative. Your credentials are: </p>';
    $txt.='<p>-------------------------------------------------------------</p>';
    $txt .= '<p style="font-size:18px;"> Student ID: '.$uqid.'</p>';
    $txt .= '<p style="font-size:18px;"> Email Address: '.$Email.'</p>';
    $txt .= '<p style="font-size:18px;"> Password: [Your Chosen Password]</p>';
    $txt.='<p>-------------------------------------------------------------</p>';
    $txt .= '<a href="enrol.of.edu.au"> <p style="color:#080;font-size:24px;">Click Here</p></a>';
    $txt .= '<p style="font-size:18px;">Thanks</p>';
    $txt.= '<p style="font-size:18px;">Optimistic Futures Team</p>';
    $txt .= '</body></html>';
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: admissions@of.edu.au. \r\n";
    mail($to,$subject,$txt,$headers);
}

/**
 * Send mail to coordinator on new user account creation
 */
function send_mail_tocoordinator($name, $uqid, $Email, $course){

    global $url;
    $to = "admissions@of.edu.au";
    $subject = "[Optimistic Futures]New User Account";
    $txt  = '<html><body>';
    $txt .= '<h1 style="font-size:18px;">Hi,</h1>';
    $txt .= '<p style="font-size:18px;">A new student account has been created with Optimistic Futures. The student details are: </p>';
    $txt.='<p>-------------------------------------------------------------</p>';
    $txt .= '<p style="font-size:18px;"> Student ID: '.$uqid.'</p>';
    $txt .= '<p style="font-size:18px;"> Full Name: '.$name.'</p>';
    $txt .= '<p style="font-size:18px;"> Email Address: '.$Email.'</p>';
    $txt .= '<p style="font-size:18px;"> Course: '.$course.'</p>';
    $txt.='<p>-------------------------------------------------------------</p>';
    $txt .= '<br><p style="font-size:18px;">Please go to <a href="'.$url.'/index.php">enrol.of.edu.au</a>.</p>';
    $txt .= '<p style="font-size:18px;">Thanks</p>';
    $txt.='<p style="font-size:18px;">Optimistic Futures Team</p>';
    $txt .= '</body></html>';
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: itsupport@of.edu.au. \r\n";
    mail($to,$subject,$txt,$headers);
}

function get_userRole($value){
    if ($value == 1) {return "Admin";}
    elseif($value ==  2){return "Coordinator";}
    elseif($value ==  4){return "Auditor";}
    else{return "Student";}
}
function get_enrolmentForm(){
    global $pdo;
    try {
        $formname = "Enrolment Agreement Form";
        $query = "SELECT * FROM `form` WHERE formname =:form";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('form',  $formname, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $form = $row['iframe']; //Convert table field into array
            return $form;
        }
        else{
            return 0;
        }
    }
    catch (PDOException $e) {
        return $e->getMessage();
    }
}

/**
 * @param $key PriorEducationId
 * @param $value PriorEducationTypeId
 * @return array
 */
function get_previousEducation($key, $value){
    $array["PriorEducationId"] = $key;
    $array["PriorEducationTypeId"] = $value;
    return $array;
}

/* *
 * Return Student Forms from FormAcess Table
 * */
function get_user_form_id($userid){
    global $pdo;
    try {
        $query = "SELECT * FROM `formaccess` WHERE user_id =:userID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('userID',  $userid, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        $form = explode(",", $row['form_id']); //Convert table field into array
        return $form;
    }
    catch (PDOException $e) {
        return $e->getMessage();
    }
}

/* *
 * Return form detail of selected form id
 * */
function get_user_form($formid){
    global $pdo;
    try {
        $query = "SELECT * FROM `form` WHERE `id` =:form ";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('form',  $formid, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/* *
 * Return array length of selected user forms
 * */
function get_arr_length($userid){
    global $pdo;
    try {
        $query = "SELECT * FROM `formaccess` WHERE user_id =:userID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('userID',  $userid, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        $form = explode(",", $row['form_id']); //Convert table field into array
        $arrLength = count($form);
        return $arrLength;
    }
    catch (PDOException $e) {
        return $e->getMessage();
    }
}

/* *
 * Return user role
 * */
function get_user_role($user){
    global $pdo;
    try {
        $query = "SELECT * FROM `user` WHERE id = :usrid";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('usrid',  $user, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['role'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/* *
 * Return All form details
 * */
function get_form(){
    global $pdo;
    try {
        $query = "SELECT * FROM `form`";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/* *
 * Return All form details
 * */
function del_form($formid){
    global $pdo;
    try {
        $query = "DELETE FROM `form` WHERE id =?";
        $stmt = $pdo->prepare($query);
        $response = $stmt->execute([$formid]);
        return $response;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/* *
 * Return All form details
 * */
function edit_form($formid){
    global $pdo;
    try {
        $query = "DELETE FROM `form` WHERE id =?";
        $stmt = $pdo->prepare($query);
        $response = $stmt->execute([$formid]);
        return $response;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/* *
 * Return Assign User Form Name
 * */
function get_form_access($stdid){
    global $pdo;
    try {
        $query = "SELECT * FROM `formaccess` WHERE user_id =:userID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('userID', $stdid, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $form = explode(",", $row['form_id']); //Convert table field into array

        $arrLength = count($form);
        $formname = '';
        for ($i = 0; $i < $arrLength; $i++) {
            $query2 = "SELECT * FROM `form` WHERE id = :formid ";
            $stmt2 = $pdo->prepare($query2);
            $stmt2->bindParam('formid', $form[$i], PDO::PARAM_STR);
            $stmt2->execute();
            $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
            $formname .= $row2['formname'] . '<br>';
        }
        return $formname;
    }catch (PDOException $e) {
        return $e->getMessage();
    }
}

/* *
 * Return All form users
 * */
function get_form_users(){
    global $pdo;
    try {
        $query = "SELECT * FROM `personal` WHERE status = 0";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
/*function get_form_submission($usrid){
    global $pdo;
    try {
        $query = "SELECT * FROM `userFormSubmission` WHERE userid =:usrid";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('usrid', $usrid, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}*/

/* *
 * Return UserID status
 * */
function get_useridStatus($log){
    global $pdo;
    try {
        $query = "SELECT std_id FROM `personal` WHERE std_id = :stdid ";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('stdid',  $log, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!empty($row)){
            return 0;
        }
        else{
            return 1;
        }

    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/* *
 * Return All approved student users
 * */
function get_approved_student(){
    global $pdo;
    try {
        $query = "SELECT * FROM `personal` WHERE status = 1";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


function get_staff($userid){
    global $pdo;
    try {
        $sql3 = "SELECT `firstname`,`lastname` FROM `user` WHERE id= :userid";
        $stmt3 = $pdo->prepare($sql3);
        $stmt3->bindParam('userid',  $userid, PDO::PARAM_STR);
        $stmt3->execute();
        $row3   = $stmt3->fetch(PDO::FETCH_ASSOC);
        $name=$row3['firstname'].' '.$row3['lastname'];

        return $name;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/**
 * Enable wisenet upload option once all the forms field.
 * @param $std_id
 * @return int|string
 *
 */
function get_enrolmentStatus($std_id){
    global $pdo;
    try {
        $query = "SELECT * FROM `of_enrolment` WHERE std_id = :userID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('userID',  $std_id, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row['enrolForm']!= NULL &&  $row['enrolReview']!= NULL&& $row['skillForm']!= NULL && $row['skillReview']!= NULL && $row['usiForm']!= NULL && $row['documentForm']!= NULL
            && $row['documentReview']!= NULL && $row['usiForm']!= NULL && $row['usiReview']!= NULL && $row['ptrForm']!= NULL && $row['ptrReview']!= NULL && $row['llnForm']!= NULL && $row['llnReview']!= NULL){
            return 0;
        }
        else{
            return 1;
        }
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/**
 * Return All approved student users
 **/
function get_studentCourseName($stdid){
    global $pdo;
    try {
        $query = "SELECT * FROM `user` WHERE uqid = :userID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('userID',  $stdid, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['courses'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


/**
 * Return All approved student users
 **/
function get_all_students(){
    global $pdo;
    try {
        $query = "SELECT * FROM `personal`";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
/**
 * Return current session Fullname
 **/
function get_session_detail($userid){
    global $pdo;
    try {
        $sessId= $userid;
        $query2 = "select * from `user` WHERE id=:userID";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->bindParam('userID',  $sessId, PDO::PARAM_STR);
        $stmt2->execute();
        $row2   = $stmt2->fetch(PDO::FETCH_ASSOC);
        return $row2['firstname']." ".$row2['lastname'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/**
 * Return current session Fullname
 **/
function get_uqid($userid){
    global $pdo;
    try {
        $sessId= $userid;
        $query2 = "select * from user WHERE id=:userID";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->bindParam('userID',  $sessId, PDO::PARAM_STR);
        $stmt2->execute();
        $row2   = $stmt2->fetch(PDO::FETCH_ASSOC);
        return $row2['uqid'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/* *
 * Return Form USI
 * */
function get_users_usi($std_id){
    global $pdo;
    try {
        $query = "SELECT * FROM `usi` WHERE `std_id` = $std_id";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/**
 * Unique ID generator
 * @return string
 */
function generateRandomString() {
    global $pdo;
    $length = 5;
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $query2 = "select * from `user` where `uqid`=:uqid";
    $stmt2 = $pdo->prepare($query2);
    $stmt2->bindParam('uqid', $randomString, PDO::PARAM_STR);
    $stmt2->execute();
    $count2 = $stmt2->fetch();
    if($count2){
        generateRandomString();
    }
    return $randomString;
}


/**
 * Return current verified users
 * */
function get_current_users(){
    global $pdo;
    try {
        $query = "select * from `user` where `verified`=1 ORDER BY `user`.`id` DESC";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/**
 * ProgressReport
 **/
function progressReport(){
    global $pdo;
    try {
        $query = "SELECT * FROM `of_enrolment` ORDER BY `of_enrolment`.`id` DESC";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/**
 * List of current students
 * @return array|string
 */
function get_current_students(){
    global $pdo;
    try {
        $query = "select * from `user` where `verified`=1 AND `role` = 3 ORDER BY `user`.`id` DESC";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/**
 * Return All student count
 **/
function get_studentCount(){
    global $pdo;
    try {
        $query = "select * from `user` where `verified`=1 AND `role` = 3 ";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $row   = $stmt->rowCount();
        return $row;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/*** Functions edited by Inam 11Nov2021 ***/

/**
 * API function for message credits
 **/
function get_smsCredit(){
    global $pdo;
    try {
        $curl = curl_init();
        curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://platform.touchsms.com.au/rest/v1/users',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                        'Authorization: Basic MzI0NS05MDd5RlQ4TGZYWUpQOWozOkExVEpHRFJRQ3dHZjQ0ZmkyMg==',
                        'Cookie: PHPSESSID=426625e0587bc2289bab66e9a45a6425'
                ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response, true);
        return $result['credits'];

    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/**
 * Count number of student in the courses
 * @return array|string
 */
function studentCourses(){
    global $pdo;
    try {
        $query1 = "select * from `user` where `courses` LIKE 'CPP20218%' AND `role` = 3";
        $stmt1 = $pdo->prepare($query1);
        $stmt1->execute();
        $row1   = $stmt1->rowCount();

        $query2 = "select * from `user` where `courses` LIKE 'CHC40213%' AND `role` = 3";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->execute();
        $row2   = $stmt2->rowCount();

        $query3 = "select * from `user` where `courses` LIKE 'CHC43115%' AND `role` = 3";
        $stmt3 = $pdo->prepare($query3);
        $stmt3->execute();
        $row3   = $stmt3->rowCount();

        $query4 = "select * from `user` where `courses` LIKE 'CHC33015%' AND `role` = 3";
        $stmt4 = $pdo->prepare($query4);
        $stmt4->execute();
        $row4   = $stmt4->rowCount();

        $query5 = "select * from `user` where `courses` LIKE 'CHC50113%' AND `role` = 3";
        $stmt5 = $pdo->prepare($query5);
        $stmt5->execute();
        $row5   = $stmt5->rowCount();

        $query6 = "select * from `user` where `courses` LIKE 'CHC30113%' AND `role` = 3";
        $stmt6 = $pdo->prepare($query6);
        $stmt6->execute();
        $row6   = $stmt6->rowCount();

        $query7 = "select * from `user` where `courses` LIKE 'HLTA%' AND `role` = 3";
        $stmt7 = $pdo->prepare($query7);
        $stmt7->execute();
        $row7   = $stmt7->rowCount();

        $query8 = "select * from `user` where `courses` LIKE 'CPCCWHS1001%' AND `role` = 3";
        $stmt8 = $pdo->prepare($query8);
        $stmt8->execute();
        $row8   = $stmt8->rowCount();

        $result=array("course1"=>$row1,"course2"=>$row2, "course3"=>$row3,"course4"=>$row4, "course5"=>$row5,"course6"=>$row6, "course7"=>$row7,"course8"=>$row8 );

        return $result;

    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


/**
 * @return array|string
 */
function studentCoursesShepparton(){
    global $pdo;
    try {
        $query1 = "select * from `user` where `courses` LIKE 'CPP20218%' AND `campus` = 'Greater Shepparton' AND `role` = 3";
        $stmt1 = $pdo->prepare($query1);
        $stmt1->execute();
        $row1   = $stmt1->rowCount();

        $query2 = "select * from `user` where `courses` LIKE 'CHC40213%' AND campus = 'Greater Shepparton' AND `role` = 3";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->execute();
        $row2   = $stmt2->rowCount();

        $query3 = "select * from `user` where `courses` LIKE 'CHC43115%' AND campus = 'Greater Shepparton' AND `role` = 3";
        $stmt3 = $pdo->prepare($query3);
        $stmt3->execute();
        $row3   = $stmt3->rowCount();

        $query4 = "select * from `user` where `courses` LIKE 'CHC33015%' AND campus = 'Greater Shepparton' AND `role` = 3";
        $stmt4 = $pdo->prepare($query4);
        $stmt4->execute();
        $row4   = $stmt4->rowCount();

        $query5 = "select * from `user` where `courses` LIKE 'CHC50113%' AND campus = 'Greater Shepparton' AND `role` = 3";
        $stmt5 = $pdo->prepare($query5);
        $stmt5->execute();
        $row5   = $stmt5->rowCount();

        $query6 = "select * from `user` where `courses` LIKE 'CHC30113%' AND campus = 'Greater Shepparton' AND `role` = 3";
        $stmt6 = $pdo->prepare($query6);
        $stmt6->execute();
        $row6   = $stmt6->rowCount();

        $query7 = "select * from `user` where `courses` LIKE 'HLTA%' AND campus = 'Greater Shepparton' AND `role` = 3";
        $stmt7 = $pdo->prepare($query7);
        $stmt7->execute();
        $row7   = $stmt7->rowCount();

        $query8 = "select * from `user` where `courses` LIKE 'CPCCWHS1001%' AND campus = 'Greater Shepparton' AND `role` = 3";
        $stmt8 = $pdo->prepare($query8);
        $stmt8->execute();
        $row8   = $stmt8->rowCount();

        $result=array("course1"=>$row1,"course2"=>$row2, "course3"=>$row3,"course4"=>$row4, "course5"=>$row5,"course6"=>$row6, "course7"=>$row7,"course8"=>$row8 );

        return $result;

    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


/**
 * @return array|string
 */
function studentCoursesColaroo(){
    global $pdo;
    try {
        $query1 = "select * from `user` where `courses` LIKE 'CPP20218%' AND campus = 'Colaroo/Roxburgh Park' AND `role` = 3";
        $stmt1 = $pdo->prepare($query1);
        $stmt1->execute();
        $row1   = $stmt1->rowCount();

        $query2 = "select * from `user` where `courses` LIKE 'CHC40213%' AND campus = 'Colaroo/Roxburgh Park' AND `role` = 3";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->execute();
        $row2   = $stmt2->rowCount();

        $query3 = "select * from `user` where `courses` LIKE 'CHC43115%' AND campus = 'Colaroo/Roxburgh Park' AND `role` = 3";
        $stmt3 = $pdo->prepare($query3);
        $stmt3->execute();
        $row3   = $stmt3->rowCount();

        $query4 = "select * from `user` where `courses` LIKE 'CHC33015%' AND campus = 'Colaroo/Roxburgh Park' AND `role` = 3";
        $stmt4 = $pdo->prepare($query4);
        $stmt4->execute();
        $row4   = $stmt4->rowCount();

        $query5 = "select * from `user` where `courses` LIKE 'CHC50113%' AND campus = 'Colaroo/Roxburgh Park' AND `role` = 3";
        $stmt5 = $pdo->prepare($query5);
        $stmt5->execute();
        $row5   = $stmt5->rowCount();

        $query6 = "select * from `user` where `courses` LIKE 'CHC30113%' AND campus = 'Colaroo/Roxburgh Park' AND `role` = 3";
        $stmt6 = $pdo->prepare($query6);
        $stmt6->execute();
        $row6   = $stmt6->rowCount();

        $query7 = "select * from `user` where `courses` LIKE 'HLTA%' AND campus = 'Colaroo/Roxburgh Park' AND `role` = 3";
        $stmt7 = $pdo->prepare($query7);
        $stmt7->execute();
        $row7   = $stmt7->rowCount();

        $query8 = "select * from `user` where `courses` LIKE 'CPCCWHS1001%' AND campus = 'Colaroo/Roxburgh Park' AND `role` = 3";
        $stmt8 = $pdo->prepare($query8);
        $stmt8->execute();
        $row8   = $stmt8->rowCount();

        $result=array("course1"=>$row1,"course2"=>$row2, "course3"=>$row3,"course4"=>$row4, "course5"=>$row5,"course6"=>$row6, "course7"=>$row7,"course8"=>$row8 );

        return $result;

    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/**
 * @return array|string
 */
function studentCoursesBroady(){
    global $pdo;
    try {
        $query1 = "select * from `user` where `courses` LIKE 'CPP20218%' AND campus = 'Broadmeadows/Campbellfield' AND `role` = 3";
        $stmt1 = $pdo->prepare($query1);
        $stmt1->execute();
        $row1   = $stmt1->rowCount();

        $query2 = "select * from `user` where `courses` LIKE 'CHC40213%' AND campus = 'Broadmeadows/Campbellfield' AND `role` = 3";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->execute();
        $row2   = $stmt2->rowCount();

        $query3 = "select * from `user` where `courses` LIKE 'CHC43115%' AND campus = 'Broadmeadows/Campbellfield' AND `role` = 3";
        $stmt3 = $pdo->prepare($query3);
        $stmt3->execute();
        $row3   = $stmt3->rowCount();

        $query4 = "select * from `user` where `courses` LIKE 'CHC33015%' AND campus = 'Broadmeadows/Campbellfield' AND `role` = 3";
        $stmt4 = $pdo->prepare($query4);
        $stmt4->execute();
        $row4   = $stmt4->rowCount();

        $query5 = "select * from `user` where `courses` LIKE 'CHC50113%' AND campus = 'Broadmeadows/Campbellfield' AND `role` = 3";
        $stmt5 = $pdo->prepare($query5);
        $stmt5->execute();
        $row5   = $stmt5->rowCount();

        $query6 = "select * from `user` where `courses` LIKE 'CHC30113%' AND campus = 'Broadmeadows/Campbellfield' AND `role` = 3";
        $stmt6 = $pdo->prepare($query6);
        $stmt6->execute();
        $row6   = $stmt6->rowCount();

        $query7 = "select * from `user` where `courses` LIKE 'HLTA%' AND campus = 'Broadmeadows/Campbellfield' AND `role` = 3";
        $stmt7 = $pdo->prepare($query7);
        $stmt7->execute();
        $row7   = $stmt7->rowCount();

        $query8 = "select * from `user` where `courses` LIKE 'CPCCWHS1001%' AND campus = 'Broadmeadows/Campbellfield' AND `role` = 3";
        $stmt8 = $pdo->prepare($query8);
        $stmt8->execute();
        $row8   = $stmt8->rowCount();

        $result=array("course1"=>$row1,"course2"=>$row2, "course3"=>$row3,"course4"=>$row4, "course5"=>$row5,"course6"=>$row6, "course7"=>$row7,"course8"=>$row8 );

        return $result;

    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function getPercentage($val){
    $total = 100;
    $result = ($val / 100) * $total;
    return $result."%";
}
/*** End Functions edited by Inam 11Nov2021 ***/

/**
 * Count completed submission
 **/
function get_newSubmissionCount(){
    global $pdo;
    try {
        $query = "select * from `personal` where `status`=0";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $row   = $stmt->rowCount();
        return $row;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}



/**
 * Count all wisenet uploaded student
 **/
function get_newUploadedStudentCount(){
    global $pdo;
    try {
        $query = "select * from `personal` where `status`=1";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $row   = $stmt->rowCount();
        return $row;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


/**
 * Return list of all students
 **/
function get_student(){
    global $pdo;
    try {
        $query = "select * from `user` where `verified`=1 AND `role` = 3";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/**
 * Return All students
 **/
function get_studentFormaccess(){
    global $pdo;
    try {
        $query = "select * from `formaccess` where `access`=1";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
/* *
 * Return all users full name
 * */
function get_user_name($id){
    global $pdo;
    try {
        $query = "select * from `user` where `id` =:userid";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('userid', $id, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['firstname']. ' ' .$row['lastname'] ;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/**
 * Return Full name of coordinator
 **/
function get_coordinator_name($id){
    global $pdo;
    try {
        /* $query = "select * from `formaccess` where `user_id` =:userid";
         $stmt = $pdo->prepare($query);
         $stmt->bindParam('userid', $id, PDO::PARAM_STR);
         $stmt->execute();
         $row  = $stmt->fetch(PDO::FETCH_ASSOC);*/

        //   $cdrid = $row['cdr_id']; //Get Student's Coordinator id
        $query2 = "select * from `user` where `id` =:cdrid";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->bindParam('cdrid', $id, PDO::PARAM_STR);
        $stmt2->execute();
        $row2   = $stmt2->fetch(PDO::FETCH_ASSOC);
        return $row2['firstname']. ' ' .$row2['lastname'] ;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/**
 * Return pending users
 **/
function get_pending_users(){
    global $pdo;
    try {
        $query = "select * from `user` where `verified`=0 ORDER BY `user`.`id` DESC";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/**
 * Return current login users
 **/
function get_login_users(){
    global $pdo;
    try {
        //$sesscount= $stmt->rowCount();
        $query = "SELECT * FROM user INNER JOIN bbfdccAppSessions ON user.id=bbfdccAppSessions.userId";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/**
 * Accept pending users
 **/
function accept_users(){
    global $pdo;
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
}

/**
 * Return JotForm api
 **/
function get_setting_api(){
    global $pdo;
    try {
        $query = "select * from `api`";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($row as $rs):
            $api = $rs["api"];
        endforeach;
        return $api;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
/**
 * Return SMS api recipients
 **/
function get_sms_recipients(){
    global $pdo;
    try {
        $query = "SELECT * FROM `smsrecipients`";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


/**
 * Table Header
 **/
function print_table_header(){
    echo '<div class="row">
                        <div class="col-sm-12">
                    <div class="card shadow mb-4">
                        <!--<div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">You can edit,update and delete users through this panel</h6>
                        </div>-->
                        <div class="card-body border-bottom-success">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
}

/**
 * Table Footer
 **/
function print_table_footer(){
    echo '</tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>';
    /* container-fluid */
}

function check_condition($log1, $value){
    if ($log1["name"] == $value AND array_key_exists('answer', $log1)) { return 0;}
    else {return 1;}
}

/**
 * @param $userid
 * @param $wisenetid
 * @return string
 */
function insert_moodle($userid,$wisenetid){
    global $pdo;
    try {
        $query = "select * from personal WHERE std_id=:userID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('userID',  $userid, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row){
            $username = $row['email'];
            $password = get_userPassword($userid);
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $email = $row['email'];
            $address = $row['residentialAddress	'] ." ". $row['suburbtown'];
            $std_id = $row['std_id'];
            $wisenet_id = $wisenetid;
            $moodle_sql = "INSERT INTO moodleUsers (username, password, firstname, lastname, email, address, std_id, wisenetId) 
                                VALUES ('$username','$password', '$firstname', '$lastname',  '$email','$address' , '$std_id','$wisenet_id' )";
            $stmt = $pdo->prepare($moodle_sql);
            $stmt->execute();
        }
        else{
            echo "Not insert";
        }

    } catch (PDOException $e) {
        return $e->getMessage();
    }

}

/**
 * return user password
 * @param $id
 * @return mixed|string
 */
function get_userPassword($id){
    global $pdo;
    try {
        $query = "select * from `user` WHERE uqid =:id ";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id',  $id, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['password'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

                                                            /****************************
                                                             ****************************
                                                             ***** Enrolment Jotform ****
                                                             ***** and Wisenet API   ****
                                                             ****************************
                                                             ***************************/

/**
 * @param $detail
 * @param $previousqualification
 * @param $qualification
 * @param $shortcourse
 */
function insert_student_details($Personal,$Demographics,$NextOfKin, $disabilityid,$previousqualification, $formid, $submissionid, $date){
    global $pdo;

    if(array_key_exists('std_id', $Personal)){ $std_id = $Personal["std_id"]; } else { $std_id = NULL; }
    if(array_key_exists('title', $Personal)){  $title = $Personal["title"]; } else { $title = NULL; }
    if(array_key_exists('genderDetails', $Personal)){ $genderDetails = get_gender($Personal["genderDetails"]); } else { $genderDetails = NULL; }
    if(array_key_exists('firstname', $Personal)){ $firstname = $Personal["firstname"]; } else { $firstname = NULL; }
    if(array_key_exists('middlename', $Personal)){ $middlename = $Personal["middlename"]; } else { $middlename = NULL; }
    if(array_key_exists('lastname', $Personal)){  $lastname = $Personal["lastname"]; } else {  $lastname = NULL; }
    // Creating timestamp from given date

    // Creating new date format from that timestamp
    if(array_key_exists('dob', $Personal)){  $dob = $Personal["dob"]; } else { $dob = NULL; }
    if(array_key_exists('residentialAddress', $Personal)){ $residentialAddress = $Personal["residentialAddress"]; } else { $residentialAddress = NULL; }
    if(array_key_exists('suburbtown', $Personal)){ $suburbtown = $Personal["suburbtown"]; } else { $suburbtown = NULL; }
    if(array_key_exists('state', $Personal)){  $state = get_state($Personal["state"]); } else { $state = NULL; }
    if(array_key_exists('postcode', $Personal)){ $postcode = $Personal["postcode"]; } else { $postcode = NULL; }
    if(array_key_exists('postalAddress', $Personal)){ $postalAddress = $Personal["postalAddress"]; } else { $postalAddress = NULL; }
    if(array_key_exists('homePhone', $Personal)){ $homePhone = $Personal["homePhone"]; } else { $homePhone = NULL; }
    if(array_key_exists('mobile', $Personal)){ $mobile = $Personal["mobile"]; } else { $mobile = NULL; }
    if(array_key_exists('fax', $Personal)){ $fax = $Personal["fax"]; } else { $fax = NULL; }
    if(array_key_exists('email', $Personal)){  $email = $Personal["email"]; } else { $email = NULL; }

    if(array_key_exists('relationname', $NextOfKin)){ $relationname = $NextOfKin["relationname"]; } else { $relationname = NULL; }
    if(array_key_exists('relationship', $NextOfKin)){$relationship = get_relation($NextOfKin["relationship"]); } else { $relationship = NULL; }
    if(array_key_exists('relationhomeNumber', $NextOfKin)){ $relationhomeNumber = $NextOfKin["relationhomeNumber"]; } else { $relationhomeNumber = NULL; }
    if(array_key_exists('relationmobile', $NextOfKin)){ $relationmobile = $NextOfKin["relationmobile"]; } else { $relationmobile = NULL; }
    if(array_key_exists('noVSN', $Personal)){  $noVSN = $Personal["noVSN"]; } else { $noVSN = '888888888'; }
    if(array_key_exists('usi', $Personal)){ $usi = $Personal["usi"]; } else { $usi = NULL; }

    if(array_key_exists('birthCountry', $Demographics)){ $birthCountry = get_country($Demographics["birthCountry"]) ; } else { $birthCountry = NULL; }
    if(array_key_exists('speakEnglish', $Demographics)){ $speakEnglish = get_speakLanguage($Demographics["speakEnglish"]); } else { $speakEnglish = NULL; }
    if(array_key_exists('speakStatus', $Demographics)){ $speakStatus = get_englishStatus($Demographics["speakStatus"]); } else { $speakStatus = NULL; }
    if(array_key_exists('TSIorigin', $Demographics)){ $TSIorigin = get_tsiorigin($Demographics["TSIorigin"]); } else { $TSIorigin = NULL; }
    if(array_key_exists('disability', $Demographics)){ $disability = get_DisabilityFlagId($Demographics["disability"]); } else { $disability = NULL; }
    // if(array_key_exists('disabilityCondition', $detail)){ $disabilityCondition = $detail["disabilityCondition"]; } else { $disabilityCondition = NULL; }
    if(array_key_exists('qualificationStatus', $Demographics)){ $qualificationStatus = $Demographics["qualificationStatus"]; } else { $qualificationStatus = NULL; }

    // Start Employment table field
    if(array_key_exists('employmentStatus', $Demographics)){ $employmentStatus = get_employmentstatus($Demographics["employmentStatus"]); } else { $employmentStatus = NULL; }
    if(array_key_exists('employmentRole', $Demographics)){ $employmentRole = get_employmentrole($Demographics["employmentRole"]); } else { $employmentRole = NULL; }
    if(array_key_exists('employmentSector', $Demographics)){ $employmentSector = get_employmentindustry($Demographics["employmentSector"]); } else { $employmentSector = NULL; }
    // End Employment table field

    // Start Concession table field
    if(array_key_exists('currentConcessionCard', $Personal)){ $currentConcessionCard = $Personal["currentConcessionCard"]; } else { $currentConcessionCard = NULL; }
    if(array_key_exists('concessionCard', $Personal)){ $concessionCard = $Personal["concessionCard"]; } else { $concessionCard = NULL; }
    if(array_key_exists('concessionExpiry', $Personal)){ $concessionExpiry = $Personal["concessionExpiry"]; } else { $concessionExpiry = NULL; }
    if(array_key_exists('medicareNumber', $Personal)){ $MedicareNumber = $Personal["medicareNumber"]; } else { $MedicareNumber = NULL; }
    if(array_key_exists('medicareExpiryDate', $Personal)){ $MedicareExpiryDate = $Personal["medicareExpiryDate"]; } else { $MedicareExpiryDate = NULL; }

    // End Concession table field

    // Start Schooling Table field
    if(array_key_exists('schoolingLevel', $Demographics)){ $schoolingLevel = get_schoolLevel($Demographics["schoolingLevel"]); } else { $schoolingLevel = NULL; }
    if(array_key_exists('schoolingLevelYear', $Demographics)){ $schoolingLevelYear = $Demographics["schoolingLevelYear"]; } else { $schoolingLevelYear = NULL; }
    if(array_key_exists('schoolingStatus', $Demographics)){  $schoolingStatus = $Demographics["schoolingStatus"]; } else { $schoolingStatus = NULL; }
    // End Schooling Table field


    print_r('<pre>');
    print_r($Personal);
    print_r('</pre>');

   // Student details table sql query
    $personal_sql = "INSERT INTO `personal`(`title`, `genderDetails`, `firstname`, `middlename`, `lastname`, `dob`, `residentialAddress`, `suburbtown`, `state`, `postcode`, `postalAddress`,
                       `homePhone`, `mobile`, `fax`, `email`, `noVSN`, `usi`, `concessionCard`, `concessionExpiry`, `medicareNumber`, `medicareExpiryDate`, `std_id`)
                        VALUES ('$title', '$genderDetails', '$firstname', '$middlename', '$lastname', '$dob',' $residentialAddress', '$suburbtown','$state' ,'$postcode',  '$postalAddress', '$homePhone' , '$mobile' ,
                       '$fax' ,'$email', '$noVSN' , '$usi', '$concessionCard' , '$concessionExpiry' ,'$MedicareNumber', '$MedicareExpiryDate', '$std_id')";
    $stmt = $pdo->prepare($personal_sql);
    $stmt->execute();
    //  echo 'Success: Please contact your admin to approve your account';

    //Employment table sql query
    $demographics_sql = "INSERT INTO demographics(employmentStatus, employmentRole, employmentSector, schoolingStatus, schoolingLevel, schoolingLevelYear,
                                                 birthCountry, speakEnglish, speakStatus, TSIorigin, disability, usrid)
                             VALUES ('$employmentStatus','$employmentRole','$employmentSector','$schoolingStatus','$schoolingLevel','$schoolingLevelYear',
                                  '$birthCountry','$speakEnglish', '$speakStatus','$TSIorigin','$disability', (SELECT id FROM personal WHERE std_id = '$std_id'))";
    $stmt2 = $pdo->prepare($demographics_sql);
    $stmt2->execute();

    //schooling table sql query
    $localnextofkin_sql = "INSERT INTO localnextofkin(relationname, relationship, relationhomeNumber,relationmobile, usrid)
                               VALUES ('$relationname','$relationship','$relationhomeNumber',$relationmobile, (SELECT id FROM personal WHERE std_id = '$std_id'))";
    $stmt3 = $pdo->prepare($localnextofkin_sql);
    $stmt3->execute();

    if(!empty($previousqualification)){
        foreach($previousqualification as $key=>$value){
            $PriorEducationId = get_PriorEducationId($key);
            $PriorEducationTypeId= get_PriorEducationTypeId($value);
            $previousqualification_sql = "INSERT INTO previousqualification(qualificationName, qualificationType, usrid) VALUES ('$PriorEducationId','$PriorEducationTypeId',(SELECT id FROM personal WHERE std_id = '$std_id'))";
            $stmt4 = $pdo->prepare($previousqualification_sql);
            $stmt4->execute();
        }
    }

    if($disability != 3){
        foreach($disabilityid as $key=>$value){
            $DisabilityFlagId= get_DisabilityIds($value);
            $disability_sql = "INSERT INTO disability(disabilityCondition, usrid) VALUES ('$DisabilityFlagId ', (SELECT id FROM personal WHERE std_id = '$std_id'))";
            $stmt5 = $pdo->prepare($disability_sql);
            $stmt5->execute();
        }
    }

    $formSubmission_sql ="INSERT INTO `userFormSubmission`(`usrid`, `std_id`, `formid`, `formSubmission`, `date` )
                                VALUES ((SELECT id FROM personal WHERE std_id = '$std_id'), '$std_id','$formid', '$submissionid', '$date' )";
    $stmt6 = $pdo->prepare($formSubmission_sql);
    $stmt6->execute();

    if ($stmt AND $stmt2 AND $stmt3 AND $stmt6) {
        return 0;
    } else {
        return 1;
    }

}

function getQualificationStatus($status){
    if($status == 'Yes' ){
            return 2;
    }else{
        return 3;
    }
}

function wisesnetInsertData($wisedata){
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.wisenet.co/v1/learnersAU',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $wisedata,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'X-Api-Key: w9NF6Y1xVs5ZDFOx3IgHpajH2vgCsWft8hPpXzh7'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}


/**
 * Check submission Date
 * @param $date
 * @return int|string
 * @throws Exception
 */
function check_submissionDate($date){
    global $pdo;
    try {
        $query = "SELECT `id`, `usrid`, `std_id`, `formid`, `formSubmission`, `date` FROM `userFormSubmission` ORDER BY `id` DESC LIMIT 1";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $lastdate    = new DateTime($row['date']);
        $newdate   = new DateTime($date);
        if($newdate > $lastdate){
            return 1;
        }
        else{
            return  0;
        }
    } catch (PDOException $e) {
        return $e->getMessage();
    }

}
/**
 * Function to check record exist in database
 * @param $id
 * @return int
 */
function check_student($id){
    global $pdo;
    try {
        $query = "SELECT * FROM personal WHERE std_id =:userID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('userID',  $id, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!empty($row)){
            return 0;
        }else{
            return 1;
        }
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


/**
 * @param $log1 gender String
 * @return int genderId
 */
function get_gender($log1){
    if ($log1 == "Male") {return 2;}
    elseif($log1 == "Female"){return 1;}
    elseif($log1 == "Other"){return 4;}
    else{return 3;}
}

/**
 * @param $log1 state String
 * @return int stateId
 */
function get_state($log1){
    if ($log1 == "NSW") {return 1;}
    elseif($log1 == "VIC"){ return 2;}
    elseif($log1 == "QLD"){return 3;}
    elseif($log1 == "SA"){return 4;}
    elseif($log1 == "WA"){return 5;}
    elseif($log1 == "TAS"){return 6;}
    elseif($log1 == "NT"){return 7;}
    elseif($log1 == "ACT"){return 8;}
    elseif($log1 == "Other: (Aus)"){return 9;}
    else{return 10;}
}
/**
 * @param $log1 relationship String
 * @return int relationshipId
 */
/** Edited By Inam 26/10/2021 */
function get_relation($log1){
    if ($log1 == "Father") {return 32;}
    elseif($log1 == "Mother"){ return 33;}
    elseif($log1 == "Brother"){return 34;}
    elseif($log1 == "Sister"){return 35;}
    elseif($log1 == "Grandparent"){return 36;}
    elseif($log1 == "Wife"){return 43;}
    elseif($log1 == "Friend"){return 44;}
    elseif($log1 == "Other"){return 45;}
    elseif($log1 == "Husband"){return 46;}
    elseif($log1 == "Partner"){return 47;}
    elseif($log1 == "Son"){return 48;}
    else{return 49;}
}

/**
 * @param $log1 employmentstatus String
 * @return int employmentId
 */
function get_employmentstatus($log1){
    if ($log1 == "Full-Time Employee") {return 2;}
    elseif($log1 == "Part-Time Employee"){ return 3;}
    elseif($log1 == "Self employed - not employing others"){return 4;}
    elseif($log1 == "Self-employed - employing others"){return 5;}
    elseif($log1 == "Employed - unpaid worker in a family business"){return 6;}
    elseif($log1 == "Unemployed - seeking full-time work"){return 7;}
    elseif($log1 == "Unemployed - seeking part-time work"){return 8;}
    elseif($log1 == "Not employed - not seeking employment"){return 9;}
    else{return 1;}
}

/**
 * @param $log1 enrolmentrole String
 * @return int employmentroleId
 */
function get_employmentrole($log1){
    if ($log1 == "Manager") {return 1;}
    elseif($log1 == "Professionals"){ return 2;}
    elseif($log1 == "Technicians and Trades Workers"){return 3;}
    elseif($log1 == "Community and personal Service Workers"){return 4;}
    elseif($log1 == "Clerical and Administrative Workers"){return 5;}
    elseif($log1 == "Sales Workers"){return 6;}
    elseif($log1 == "Machinery Operators and Drivers"){return 7;}
    elseif($log1 == "Labourers"){return 8;}
    else{return 9;}
}

/**
 * @param $log1 employmentindustry string
 * @return int employmentindustryId
 */
function get_employmentindustry($log1){
    if ($log1 == "Agriculture, Forestry and Fishing") {return 1;}
    elseif($log1 == "Mining"){ return 2;}
    elseif($log1 == "Manufacturing"){return 3;}
    elseif($log1 == "Electricity, Gas, Water and Waste Services"){return 4;}
    elseif($log1 == "Construction"){return 5;}
    elseif($log1 == "Wholesale Trade"){return 6;}
    elseif($log1 == "Retail Trade"){return 7;}
    elseif($log1 == "Accommodation and Food Services"){return 8;}
    elseif($log1 == "Transport, Postal and Warehousing"){return 9;}
    elseif($log1 == "Information Media and telecommunications"){return 10;}
    elseif($log1 == "Financial and Insurance Services"){return 11;}
    elseif($log1 == "Rental, Hiring and real Estate Services"){return 12;}
    elseif($log1 == "Professional, Scientific and Technical Services"){return 13;}
    elseif($log1 == "Administrative and Support Services"){return 14;}
    elseif($log1 == "Public Administration and Safety"){return 15;}
    elseif($log1 == "Education and Training"){return 16;}
    elseif($log1 == "Health Care and Social Assistance"){return 17;}
    elseif($log1 == "Arts and recreation Services"){return 18;}
    else{return 19;}
}

/**
 * @param $log1 tsiorigin String
 * @return int tsioriginId
 */
function get_tsiorigin($log1){
    if ($log1 == "No") {return  4;}
    elseif($log1 == "Yes, Aboriginal"){ return 1;}
    elseif($log1 == "Yes, Torres Strait Islander"){return 2;}
    elseif($log1 == "Yes, Both"){return 3;}
    else{return 5;}

}

/**
 * @param $log1 englishstatus String
 * @return int englishstatusId
 */
function get_englishStatus($log1){
    if ($log1 == "Very Well") {return 1;}
    elseif($log1 == "Well"){ return 2;}
    elseif($log1 == "Not Well"){return 3;}
    elseif($log1 == "Not at all"){return 4;}
    else{return 5;}
}

/**
 * @param $log1 schoolLevel String
 * @return int schoolLevelId
 */
function get_schoolLevel($log1){
    if ($log1 == "Year 12 or equivalent") {return 7;}
    elseif($log1 == "Year 11 or equivalent"){ return 6;}
    elseif($log1 == "Year 10 or equivalent"){return 5;}
    elseif($log1 == "Year 9 or equivalent"){return 4;}
    elseif($log1 == "Year 8 or equivalent"){return 3;}
    elseif($log1 == "Never Attended"){return 2;}
    else{return 1;}
}

/**
 * @param $log1 schoolStatus String
 * @return string schoolStatus
 */
function get_schoolStatus($log1){
    if ($log1 == "Yes") {return "Y";}
    else{return "N";}
}

/**
 * @param $log1
 * @return mixed
 */
function get_speakLanguage($log1){
    $curl = curl_init();
    curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.wisenet.co/v1/combos/languages',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                    'X-Api-Key: w9NF6Y1xVs5ZDFOx3IgHpajH2vgCsWft8hPpXzh7'
            ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($response, TRUE);
    foreach($data as $value){
        foreach ($value as $log){
            if (!empty($log['Description']) && $log['Description'] == $log1) {

                return $log['LanguageId'];
            }
        }
    }
}

/**
 * @param $log1
 * @return mixed
 */
function get_country($log1){
    $curl = curl_init();
    curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.wisenet.co/v1/combos/countries',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                    'X-Api-Key: w9NF6Y1xVs5ZDFOx3IgHpajH2vgCsWft8hPpXzh7'
            ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($response, TRUE);

    foreach($data as $value){
        foreach ($value as $log){
            if (!empty($log['Description']) && $log['Description'] == $log1) {
                return $log['CountryId'];
            }
        }
    }
}


/**
 * @param $log1
 * @return int
 */
function get_priorEducationalAchievementId($log1){
    if ($log1 == "Yes") {return 2;}
    elseif ($log1 == "No") {return 3;}
    else{return 1;}
}

/**
 * @param $log1
 * @return int
 */
function get_DisabilityFlagId($log1){
    if ($log1 == "Yes") {return 2;}
    elseif ($log1 == "No") {return 3;}
    else{return 1;}
}

/**
 * @param $value
 * @return int
 */
function get_DisabilityIds($value){
    if ($value == "Intellectual") {return 3;}
    elseif ($value == "Physical") {return 2;}
    elseif ($value == "Hearing/Deaf") {return 1;}
    elseif ($value == "Mental Illness") {return 5;}
    elseif ($value == "Vision") {return 7;}
    elseif ($value == "Medical Condition") {return 8;}
    elseif ($value == "Acquired brain impairment") {return 6;}
    elseif ($value == "Learning") {return 4;}
    elseif ($value == "Unspecified") {return 10;}
    else{return 9;}
}


/**
 * @param $value
 * @return int
 */
function get_PriorEducationTypeId($value){
    if ($value == '["Australia"]') {return 1;}
    elseif($value ==  '["International (Overseas)"]'){return 3;}
    else{return 2;}
}

/**
 * @param $key
 * @return int
 */
function get_PriorEducationId($key){
    if ($key == "Certificate I") {return 7;}
    elseif($key ==  "Certificate II"){ return 6;}
    elseif($key ==  "Certificate III (or Trade Certificate)"){ return 5;}
    elseif($key ==  "Certificate IV (or Advance Certificate/Technician)"){ return 4;}
    elseif($key ==  "Diploma (or Associate Diploma)"){ return 3;}
    elseif($key ==  "Advance diploma or Associate Degree"){ return 2;}
    elseif($key ==  "Bachelor degree or Higher degree"){ return 1;}
    elseif($key ==  "Certificate V"){ return 9;}
    elseif($key ==  "Certificate VI"){ return 10;}
    elseif($key ==  "Certificate VII"){ return 11;}
    elseif($key ==  "Doctoral Degree"){ return 12;}
    elseif($key ==  "Master Degree"){ return 13;}
    elseif($key ==  "Graduate Diploma or Graduate Certificate"){ return 14;}
    elseif($key ==  "Bachelor Degree"){ return 15;}
    else{return 8;}
}

/**
 * Get Breadcrumbs
 */
function get_breadcrumbs($page){
    global $pdo, $url;
    echo '<div class="container">
            <div class="horizontal">	
                <div class="verticals ten offset-by-one">
                    <ol class="breadcrumb breadcrumb-fill0">
                        <li><a href="'.$url.'"><i class="fa fa-home"></i></a></li>';

    if($page == 3){
        echo '<li><a href="javascript:void(0);">Users</a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li><a href="'.$url.'/index.php?page=3">Current Users</a></li>
                       ';
    }
    elseif($page == 4){
        echo '<li><a href="javascript:void(0);">Users</a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li><a href="'.$url.'/index.php?page=4">Pending Users</a></li>
                        ';
    }

    elseif($page == 8){
        echo '<li><a href="javascript:void(0);">Forms</a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li><a href="'.$url.'/index.php?page=8">Add New Form Link</a></li>
                        ';
    }
    elseif($page == 7){
        echo '<li><a href="javascript:void(0);">Forms</a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li><a href="'.$url.'/index.php?page=7">Student Form Access</a></li>
                        ';
    }
    elseif($page == 1){
        echo '<li><a href="javascript:void(0);">Forms</a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li><a href="'.$url.'/index.php?page=1">JotForm Forms</a></li>
                        ';
    }
    elseif($page == 12){
        echo '<li><a href="javascript:void(0);">Enrolments</a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li><a href="'.$url.'/index.php?page=12">New Enrolments/JotForm Submission</a></li>
                        ';
    }
    elseif($page == 11){
        echo '<li><a href="javascript:void(0);">Enrolments</a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li><a href="'.$url.'/index.php?page=11">Approved Students</a></li>
                        ';
    }
    elseif($page == 13){
        echo '<li><a href="javascript:void(0);">Enrolments</a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li><a href="'.$url.'/index.php?page=11">JotForm Submissions Records  </a></li>
                        ';
    }
    elseif($page == 2){
        echo ' <li><i class="fa fa-angle-right"></i></li>
                                <li><a href="'.$url.'/index.php?page=2">Setting</a></li>';
    }elseif($page == 14){
        echo ' <li><i class="fa fa-angle-right"></i></li>
                                <li><a href="'.$url.'/index.php?page=14">Edit Your Profile</a></li>';
    }elseif($page == 15){
        echo ' <li><i class="fa fa-angle-right"></i></li>
                                <li><a href="'.$url.'/index.php?page=15">View Your Profile</a></li>';
    }elseif($page == 19){
        echo ' <li><i class="fa fa-angle-right"></i></li>
                                <li><a href="'.$url.'/index.php?page=19">Students Progress Check</a></li>';
    }elseif($page == 20){
        echo ' <li><i class="fa fa-angle-right"></i></li>
                                <li><a href="#">Student Profile</a></li>';
    }elseif($page == 21){
        echo ' <li><i class="fa fa-angle-right"></i></li>
                                <li><a href="'.$url.'/index.php?page=21">SMS Settings</a></li>';
    }elseif($page == 23){
        echo ' <li><i class="fa fa-angle-right"></i></li>
                                <li><a href="'.$url.'/index.php?page=23">Edit Submission</a></li>';
    }elseif($page == 24){
        echo ' <li><i class="fa fa-angle-right"></i></li>
                                <li><a href="'.$url.'/index.php?page=24">Permissions Settings</a></li>';
    }elseif($page == 25){
        echo ' <li><i class="fa fa-angle-right"></i></li>
                                <li><a href="'.$url.'/index.php?page=25">Edit Profile</a></li>';
    }elseif($page == 27){
        echo ' <li><i class="fa fa-angle-right"></i></li>
                                <li><a href="'.$url.'/index.php?page=27">100% Enrolment</a></li>';
    }else{
        echo '<li><i class="fa fa-angle-right"></i></li>';
    }
    echo'  </ol>
                </div> 
            </div>
        </div>
';
}

/** Get User Full Name */
function get_username($stdid){
    global $pdo;
    try {
        $query = "SELECT * FROM `user` where uqid=:id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id', $stdid, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row["firstname"]." ".$row["lastname"];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/** Print PDF */
function printPDF($id){
    global $pdo;
    try {
        $query = "SELECT * FROM `of_documentVerify` where id=:id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        header('Content-type: application/pdf');
        $decodedBlob= base64_decode($row["download"]);
        echo $decodedBlob;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/**
 * Avoid Duplicate form
 * @param $formname
 * @param $std_Id
 * @return int|string
 */
function get_formResponse($formname,$std_Id){
    global $pdo;
    try {
        $query = "SELECT * FROM `of_enrolment` where std_id=:id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id', $std_Id, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($formname == 'enrol'){
            if($row['enrolForm'] != NULL){
                return 0;
            }else{
                return 1;
            }
        }elseif($formname == 'docupd'){
            if($row['documentForm'] != NULL){
                return 0;
            }else{
                return 1;
            }
        }elseif($formname == 'usi' || $formname == 'usitrans'){
            if($row['usiForm'] != NULL){
                return 0;
            }else{
                return 1;
            }
        }elseif($formname == 'skillfirst'){
            if($row['skillForm'] != NULL){
                return 0;
            }else{
                return 1;
            }
        }else{
            if($row['llnForm'] != NULL || $row['ptrForm'] != NULL){
                return 0;
            }else{
                return 1;
            }
        }

    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

///////Code changed on 11 nov 2021 by awais
/*function checkCampus($campus){
    if ($campus == "Colaroo/Roxburgh Park") {
        echo '<td>Colaroo/<br>Roxburgh</td>';
    }elseif($campus == "Broadmeadows/Campbellfield"){
        echo '<td>Broad/<br>Campbell</td>';
    } else{
        echo '<td>Greater<br>Shepparton</td>';
    }
}*/

function checkForhunderdPercent($data,$course){
    //echo $course;
    //echo properArrayCheck($data["enrolReview"]);
    $enrol= properArrayCheck($data["enrolReview"]);
    $docs= properArrayCheck($data["documentReview"]);
    $usi= properArrayCheck($data["usiReview"]);
    $lln= properArrayCheck($data["llnReview"]);
    $skillfirst= properArrayCheck($data["skillReview"]);
    $ptr= properArrayCheck($data["ptrReview"]);
    if($course!=2){
        if($enrol==1 && $docs==1 && $usi==1 && $lln==1 && $skillfirst==1 && $ptr==1){
            $result=1;
        }else{
            $result=0;
        }
    }else{
        if($enrol==1 && $docs==1){
            $result=1;
        }else{
            $result=0;
        }
    }
    return $result;
}
function properArrayCheck($a){
    $rs = json_decode($a,true);
    if($rs!=0 && is_array($rs) || !empty($rs)){
        return 1;
    }else{
        return 0;
    }
}

function arrayCheck($data){
    $rs = json_decode($data,true);
    return $rs;
}
function getStudentCourse($course){
    if (strpos($course, 'CPP20218') !== false){
        $course=1;
    }elseif (strpos($course, 'HLTAID') !== false || strpos($course, 'CPCCWHS1001') !== false){
        $course=2;
    }else{
        $course=3;
    }
    return $course;
}
function manualcomplete($checkedStatus,$data,$form){
    $myObj =$checkedStatus;
    $myJSON = json_decode($myObj);
    $checkedStatus= $myJSON->userid;
    $time=$myJSON->time;



    if($checkedStatus!=NULL){
        if($form=="enrolForm"){
            $result=printOrangeM($data['enrolForm']).'<br>'.printGreenTick($checkedStatus,$time);
        }else if($form=='documentForm'){
            $result=printOrangeM($data['documentForm']).'<br>'.printGreenTick($checkedStatus,$time);
        }else if($form=='usiForm'){
            $result=printOrangeM($data['usiForm']).'<br>'.printGreenTick($checkedStatus,$time);
        }else if($form=='llnForm'){
            $result=printOrangeM($data['llnForm']).'<br>'.printGreenTick($checkedStatus,$time);
        }else if($form=='skillForm'){
            $result=printOrangeM($data['skillForm']).'<br>'.printGreenTick($checkedStatus,$time);
        }else if($form=='ptrForm'){
            $result=printOrangeM($data['ptrForm']).'<br>'.printGreenTick($checkedStatus,$time);
        }

    }else{
        if($form=="enrolForm"){
            $result=printOrangeM($data['enrolForm']);
        }else if($form=='documentForm'){
            $result=printOrangeM($data['documentForm']);
        }else if($form=='usiForm'){
            $result=printOrangeM($data['usiForm']);
        }else if($form=='llnForm'){
            $result=printOrangeM($data['llnForm']);
        }else if($form=='skillForm'){
            $result=printOrangeM($data['skillForm']);
        }else if($form=='ptrForm'){
            $result=printOrangeM($data['ptrForm']);
        }
        //100% checked
        $result=$result.printChecked($data['id'],$form);
    }
    return $result;
}
function autoComplete($checkedStatus,$data,$form){
    $myObj =$checkedStatus;
    $myJSON = json_decode($myObj);
    $checkedStatus= $myJSON->userid;
    $time=$myJSON->time;

    if($checkedStatus!=NULL){
        //$checkedStatus=$checkedStatus->userid;
        if($form=="enrolForm"){
            $result=printOrangeTick().'&nbsp;'.printGreenTick($checkedStatus,$time);
        } else if($form=='documentForm'){
            $result=printOrangeTick().'&nbsp;'.printGreenTick($checkedStatus,$time);
        }else if($form=='usiForm'){
            $result=printOrangeTick().'&nbsp;'.printGreenTick($checkedStatus,$time);
        }else if($form=='llnForm'){
            $result=printOrangeTick().'&nbsp;'.printGreenTick($checkedStatus,$time);
        }else if($form=='skillForm'){
            $result=printOrangeTick().'&nbsp;'.printGreenTick($checkedStatus,$time);
        }else if($form=='ptrForm'){
            $result=printOrangeTick().'&nbsp;'.printGreenTick($checkedStatus,$time);
        }
    }else{
        if($form=="enrolForm"){
            //show orange Tick
            $result=printOrangeTick($data['enrolReview']);
        }else if($form=='documentForm'){
            $result=printOrangeTick($data['documentReview']);
        }else if($form=='usiForm'){
            $result=printOrangeTick($data['usiForm']);
        }else if($form=='llnForm'){
            $result=printOrangeTick($data['llnForm']);
        }else if($form=='skillForm'){
            $result=printOrangeTick($data['skillForm']);
        }else if($form=='ptrForm'){
            $result=printOrangeTick($data['ptrForm']);
        }
        //100% checked
        $result=$result.printChecked($data['id'],$form);
    }
    return $result;
}

function markManualComplete($data,$form){
    //square button
    $result = printManualTick($data['id'],$form);
    return $result;
}

//getEnrolmentStatus($data["enrolForm"],$data['id'],$data['enrolReview']);
function currentEnrolmentStatus($data){
    $form="enrolForm";
    $maybeJson=arrayCheck($data["enrolForm"]);
    $checkedStatus=$data['enrolReview'];
    if($maybeJson != 0 && !is_array($maybeJson)){
        //manually completed
        $result= manualcomplete($checkedStatus,$data,$form);
    }
    else if($maybeJson!=NULL || $maybeJson!= 0){
        //it's array means done online
        $result= autoComplete($checkedStatus,$data,$form);
    }else{
/** @var ** $result */
        $result= markManualComplete($data,$form);
    }
    return $result;
}
//docs
// getDocsStatus($data["documentForm"],$data['id']);
function currentDocStatus($data){
    $form="documentForm";
    $maybeJson=arrayCheck($data["documentForm"]);
    $checkedStatus=$data['documentReview'];

    if($maybeJson != 0 && !is_array($maybeJson)){

        $result= manualcomplete($checkedStatus,$data,$form);
    }
    else if($maybeJson!=NULL || $maybeJson!= 0){
        $result= autoComplete($checkedStatus,$data,$form);
    }
    else{
        $result= markManualComplete($data,$form);
    }
    return $result;
}
//usi
//getUSIStatus($course,$data["usiForm"],$data['id']);
function currentusiStatus($data){
    $form="usiForm";
    $maybeJson=arrayCheck($data["usiForm"]);
    $checkedStatus=$data['usiReview'];
    if($maybeJson != 0 && !is_array($maybeJson)){
        $result= manualcomplete($checkedStatus,$data,$form);
    }
    else if($maybeJson!=NULL || $maybeJson!= 0){
        $result= autoComplete($checkedStatus,$data,$form);
    }
    else{
        $result= markManualComplete($data,$form);
    }
    return $result;
}

//lln
// getllnStatus($course,$data["llnForm"],$data['id']);
function currentllnStatus($data){
    $form="llnForm";
    $maybeJson=arrayCheck($data["llnForm"]);
    $checkedStatus=$data['llnReview'];
    if($maybeJson != 0 && !is_array($maybeJson)){
        $result= manualcomplete($checkedStatus,$data,$form);
    }
    else if($maybeJson!=NULL || $maybeJson!= 0){
        $result= autoComplete($checkedStatus,$data,$form);
    }
    else{
        $result= markManualComplete($data,$form);
    }
    return $result;
}

//skill first
//getSkillFirstStatus($course,$data["skillForm"],$data['id']);
function currentskillfirstStatus($data){
    $form="skillForm";
    $maybeJson=arrayCheck($data["skillForm"]);
    $checkedStatus=$data['skillReview'];
    if($maybeJson != 0 && !is_array($maybeJson)){
        $result= manualcomplete($checkedStatus,$data,$form);
    }
    else if($maybeJson!=NULL || $maybeJson!= 0){
        $result= autoComplete($checkedStatus,$data,$form);
    }
    else{
        $result= markManualComplete($data,$form);
    }
    return $result;
}

//ptr
//getptrStatus($course,$data["ptrForm"],$data['id']);
function currentptrStatus($data){
    $form="ptrForm";
    $maybeJson=arrayCheck($data["ptrForm"]);
    $checkedStatus=$data['ptrReview'];
    if($maybeJson != 0 && !is_array($maybeJson)){
        $result= manualcomplete($checkedStatus,$data,$form);
    }
    else if($maybeJson!=NULL || $maybeJson!= 0){
        $result= autoComplete($checkedStatus,$data,$form);
    }
    else{
        $result= markManualComplete($data,$form);
    }
    return $result;
}

function printGreenTick($id,$time){
    $result = '<span data-toggle="tooltip" data-placement="top" title="Finalised by '.get_staff($id).' on '.$time.'"><i class="fa fa-check" style="color:green;"></i>';
    return $result;
}
function printOrangeTick(){
    $result='<span data-toggle="tooltip" data-placement="top" title="Online"><i class="fas fa-globe" style="color:orange;"></i>';
    return $result;
}
function printGreenM($id,$time){
    $result ='<i class="fas fa-receipt" style="color:green;" data-toggle="tooltip" data-placement="top" title="Finalised by '.get_staff($id).' on '.$time.'"></i>';
    return $result;
}
function printOrangeM($id){
    $result ='<i class="fab fa-medium-m" style="color:orange;" data-toggle="tooltip" data-placement="top" title="'.get_staff($id).'"></i>';
    return $result;
}
function printManualTick($id,$form){
    $result ='<a href="#" class="btn btn btn-dark btn-circle btn-sm" id="' . $id . '" value="' . $form . '"><i class="fa fa-check" style="color:white;"></i></a>';
    return $result;
}
function printChecked($id,$form){
    $result ='<div class="form-check form-switch" id="' . $id . '" value="' . $form . 'Review">
      <input class="form-check-input checked100" type="checkbox" id="flexSwitchCheckDefault" style="background-color: #808080">
    </div>';
    return $result;
}
function getallPermissions($id,$form){
    global $pdo;
    $query = "select * from permissions where `userid`=:userid AND `page`=:page";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam('userid', $id, PDO::PARAM_STR);
    $stmt->bindParam('page', $form, PDO::PARAM_STR);
    $stmt->execute();
    $row   = $stmt->fetch();
    //var_dump($row);
    $count = $stmt->rowCount();
    if($count==0){
        //echo "not found";
        return 0;
    }else{
        //echo "--found--";
        return $row ["canView"];
    }
}


function getCanEditPermissions($id,$form){
    global $pdo;
    $query = "select * from permissions where `userid`=:userid AND `page`=:page";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam('userid', $id, PDO::PARAM_STR);
    $stmt->bindParam('page', $form, PDO::PARAM_STR);
    $stmt->execute();
    $row   = $stmt->fetch();
    //var_dump($row);
    $count = $stmt->rowCount();
    if($count==0){
        //echo "not found";
        return 0;
    }else{
        //echo "--found--";
        return $row ["canEdit"];
    }
}

function canView($userid,$form,$i){
    $a=getallPermissions($userid,$form);
//echo $a;
    if($a==0){
        //echo 'called';
            $result='<div class="form-check " >
              <input class="form-check-input canView" type="checkbox" value="" id="view' .  $i. '" tooltip="' . $userid . '" alt="' . $form . '">
              <label class="form-check-label" for="flexCheckDefault">
                Can View
              </label>
            </div>';
        }else{
        //echo "--nope--";
            $result='<div class="form-check " >
              <input class="form-check-input canView" type="checkbox" value="" id="view' .  $i. '" tooltip="' . $userid . '" alt="' . $form . '" checked="true">
              <label class="form-check-label" for="flexCheckDefault">
                Can View
              </label>
            </div>';
        }
    return $result;
}
function canEdit($userid,$form,$i){
    $a=getCanEditPermissions($userid,$form);
    //echo $a;
    if($a==0){
        //echo 'called';
        $result='<div class="form-check " >
              <input class="form-check-input canEdit" type="checkbox" value="" id="edit' .  $i. '" tooltip="' . $userid . '" alt="' . $form . '">
              <label class="form-check-label" for="flexCheckDefault">
                Can Edit
              </label>
            </div>';
    }else{
        //echo "--nope--";
        $result='<div class="form-check " >
              <input class="form-check-input canEdit" type="checkbox" value="" id="edit' .  $i. '" tooltip="' . $userid . '" alt="' . $form . '" checked="true">
              <label class="form-check-label" for="flexCheckDefault">
                Can Edit
              </label>
            </div>';
    }
    return $result;
}

if($_POST["CanVieworcanEdit"]){
    $page=$_POST["permissionOption"];
    $userId=$_POST["userId"];
    $state=$_POST["state"];
    global $pdo;
    $query = "select * from permissions where `userid`=:userid AND `page`=:page";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam('userid', $_POST["userId"], PDO::PARAM_STR);
    $stmt->bindParam('page', $_POST["permissionOption"], PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->rowCount();

    if($_POST["CanVieworcanEdit"]=='view'){
        if($count==0){
            $canview_sql = "INSERT INTO `permissions`( `userid`, `page`, `canView`)
                        VALUES ('$userId', ' $page', '$state')";
            $stmt = $pdo->prepare( $canview_sql);
            $stmt->execute();
        }else{
            $updatesql = "UPDATE `permissions` SET `canView`=? WHERE `userid`=? AND `page`=?";
            $stmt4= $pdo->prepare($updatesql);
            $result = $stmt4->execute([$state,$userId,$page]);
        }

    }else{
        if($count==0){
            $canview_sql = "INSERT INTO `permissions`( `userid`, `page`, `canEdit`)
                        VALUES ('$userId', ' $page', '$state')";
            $stmt = $pdo->prepare( $canview_sql);
            $stmt->execute();
        }else{
            $updatesql = "UPDATE `permissions` SET `canEdit`=? WHERE `userid`=? AND `page`=?";
            $stmt4= $pdo->prepare($updatesql);
            $result = $stmt4->execute([$state,$userId,$page]);
        }


    }
}



/**
 * @param $course
 * @param $data
 * @param $stuid
 */
function getSkillFirstStatus($course,$data,$stuid){
    $data=arrayCheck($data);
    if ($course==2){
        echo '<td>-</td>';
    }else{
        if ($data != 0 && !is_array($data)) {
            echo '<td><i class="fab fa-medium-m" style="color:orange;" data-toggle="tooltip" data-placement="top" title="'.get_staff($data).'"></i></td>';
        } else if ($data != NULL || $data != 0) {
            //echo $security;
            echo '<td> <i class="fa fa-check" style="color:green;"></i></td>';
        }  else {
            //  echo '<td><i class="fa fa-times" style="color:red;"></i></td>';
            echo '<td><a href="#" class="btn btn btn-dark btn-circle btn-sm" id="' . $stuid . '" value="skillFirstForm"><i class="fa fa-check" style="color:white;"></i></a></td>';
        }
    }
}

/**
 * @param $course
 * @param $data
 * @param $stuid
 */
function getptrStatus($course,$data,$stuid){
    $data=arrayCheck($data);
    if ($course==2){
        echo '<td>-</td>';
    }else{
        if ($data != 0 && !is_array($data)) {
            echo '<td><i class="fab fa-medium-m" style="color:orange;" data-toggle="tooltip" data-placement="top" title="'.get_staff($data).'"></i></td>';
        } else if ($data != NULL || $data != 0) {
            //echo $security;
            echo '<td> <i class="fa fa-check" style="color:green;"></i></td>';
        }  else {
            echo '<td><a href="#" class="btn btn btn-dark btn-circle btn-sm" id="' . $stuid . '" value="ptrForm"><i class="fa fa-check" style="color:white;"></i></a></td>';
        }
    }
}



function isJson($string) {
    json_decode($string);
    return json_last_error() === JSON_ERROR_NONE;
}

/**
 * @param $status
 * @param $rs
 * @param $staffid
 * @param $userId
 * @return bool|string
 */
function updatewisenetEntry($status, $rs,$staffid, $userId){
    global $pdo;
    try {
        $updatesql = "UPDATE personal SET status = ? , wisenetId= ?, addedby=? WHERE std_id =? ";
        $stmt4= $pdo->prepare($updatesql);
        $result = $stmt4->execute([$status, $rs,$staffid, $userId]);
        return $result;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/**
 * @param $status
 * @param $wisenetId
 * @param $data
 * @param $staffid
 * @param $userId
 * @param $std_id
 * @return bool|string
 */
function updateWisenetData($status, $wisenetId, $data,$staffid, $std_id){
    global $pdo;
    try {

       $sql = "INSERT INTO of_wisenet (std_id, wisenetId, wisenetdata, addedby, status) 
                                VALUES ('$std_id','$wisenetId', '$data', '$staffid',  '$status')";

       // $updatesql = "UPDATE of_wisenet SET status = ?, wisenetId= ?, wisenetdata=?, addedby=? WHERE std_id ";
        $stmt= $pdo->prepare($sql);
        $result = $stmt->execute();
        return $result;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}



/**
 * Return All completed enrolment
 **/
function get_completedEnrolment(){
    global $pdo;
    try {
        $query = "select * from `of_enrolment` WHERE enrolForm IS NOT NULL AND enrolReview IS NOT NULL AND skillForm IS NOT NULL AND skillReview IS NOT NULL
        AND usiForm IS NOT NULL AND usiReview IS NOT NULL AND documentForm IS NOT NULL AND documentReview IS NOT NULL AND ptrForm IS NOT NULL 
        AND ptrReview IS NOT NULL AND llnForm IS NOT NULL AND llnReview IS NOT NULL";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $row   = $stmt->rowCount();
        return $row;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


/* *
 * Return All completed enrolment
 * */
function get_completedEnrolmentData(){
    global $pdo;
    try {
        $query = "select * from `of_enrolment` WHERE enrolForm IS NOT NULL AND skillForm IS NOT NULL AND usiForm IS NOT NULL AND documentForm IS NOT NULL AND ptrForm IS NOT NULL AND llnForm IS NOT NULL";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


function  userDetails($userId){
    try {
        global $pdo;

        $query2 = "SELECT * FROM `of_enrolment`  JOIN user ON of_enrolment.usrid= user.id AND of_enrolment.usrid=:userId ORDER BY of_enrolment.id DESC LIMIT 1";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->bindParam('userId', $userId, PDO::PARAM_STR);
        $stmt2->execute();
        $row2   = $stmt2->fetch(PDO::FETCH_ASSOC);
        return $row2;

    } catch (PDOException $e) {
        echo "Error : " . $e->getMessage();
    }

}


function AdminDasboard(){
    $user = $_SESSION['userid'];
    $role = get_user_role($user);
    $usrform = get_user_form_id($user);
    $forms = get_form();
    if ($role == 1 || $role == 2 || $role == 4):
        if (!empty($forms)):
            echo '<div class="col-sm-4" style="margin-top: 10px;">
                    <div class="card">
                      <div class="card-body p-2 text-center">
                        <div class="text-end text-green">
                        </div>
                        <div class="h1 m-0">';
            echo get_studentCount();
            echo '</div>
                        <div class="text-muted mb-3">Current students in the system</div>
                      </div>
                    </div>
                  </div>';

            /*** Code edit by Inam 11Nov2021 ***/

            echo '<div class="col-sm-4" style="margin-top: 10px;">
                    <div class="card">
                      <div class="card-body p-2 text-center">
                        <div class="text-end text-green">
                        </div>
                        <div class="h1 m-0">';
            echo get_smsCredit();
            echo '</div>
                        <div class="text-muted mb-3">SMS Cerdits</div>
                      </div>
                    </div>
                  </div>';
            echo '<div class="col-sm-4" style="margin-top: 10px;">
                    <div class="card">
                      <div class="card-body p-2 text-center">
                        <div class="text-end text-green"></div>
                        <div class="h1 m-0">';
            echo get_newSubmissionCount();
            echo '</div>
                      <a href="index.php?page=11">  <div class="text-muted mb-3">New JotForm Submission</div></a>
                      </div>
                    </div>
                  </div>';


            /*** Code edit by Inam 11Nov2021 ***/
            $result = studentCourses();
            echo '<div class="col-md-6 col-lg-4" style="margin-top: 10px;">
                    <div class="card">
                      <div class="card-body p-2 text-center">
                        <div class="text-end text-green">
                        </div>
                        <div class="h1 m-0">';
            echo get_newUploadedStudentCount();

            /*** Code edit by Inam 11Nov2021 ***/
            echo '</div>
                        <div class="text-muted mb-3">Uploaded Wisenet/Users</div>
                      </div>
                    </div>
                  </div>
                  ';


            /*** Code edit by Inam 22Nov2021 ***/
            echo '<div class="col-md-6 col-lg-4" style="margin-top: 10px;">
                    <div class="card">
                      <div class="card-body p-2 text-center">
                        <div class="text-end text-green">
                        </div>
                        <div class="h1 m-0">';
            echo get_completedEnrolment();


            echo '</div>
                        <div class="text-muted mb-3">Completed Enrolments</div>
                      </div>
                    </div>
                  </div>
                   </div>';

            echo '<br>
                   
                <div class="col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Course Traffic</h3>
                  </div>
                  <table class="table card-table table-vcenter">
                    <thead>
                      <tr>
                        <th>Courses</th>
                        <th colspan="2">Users</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>CPP20218 Certificate II in Security Operations</td>
                        <td>'.$result['course1'].'</td>
                        <td class="w-50">
                          <div class="progress progress-xs">
                            <div class="progress-bar bg-primary" style="width: '.getPercentage($result['course1']).'"></div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>CHC40213 Certificate IV in Education Support</td>
                        <td>'.$result['course2'].'</td>
                        <td class="w-50">
                          <div class="progress progress-xs">
                            <div class="progress-bar bg-primary" style="width: '.getPercentage($result['course2']).'"></div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>CHC43115 Certificate IV in Disability</td>
                        <td>'.$result['course3'].'</td>
                        <td class="w-50">
                          <div class="progress progress-xs">
                            <div class="progress-bar bg-primary" style="width: '.getPercentage($result['course3']).'"></div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>CHC33015 Certificate III in Individual Support</td>
                        <td>'.$result['course4'].'</td>
                        <td class="w-50">
                          <div class="progress progress-xs">
                            <div class="progress-bar bg-primary" style="width: '.getPercentage($result['course4']).'"></div>
                          </div>
                        </td>
                      </tr>
                       <tr>
                        <td>CHC50113 Diploma of Early Childhood Education and Care</td>
                        <td>'.$result['course5'].'</td>
                        <td class="w-50">
                          <div class="progress progress-xs">
                            <div class="progress-bar bg-primary" style="width:'.getPercentage($result['course5']).'"></div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>CHC30113 Certificate III in Early Childhood Education and Care</td>
                        <td>'.$result['course6'].'</td>
                        <td class="w-50">
                          <div class="progress progress-xs">
                            <div class="progress-bar bg-primary" style="width: '.getPercentage($result['course6']).'"></div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>CPCCWHS1001 Prepare to work safely in the Construction Industry</td>
                        <td>'.$result['course8'].'</td>
                        <td class="w-50">
                          <div class="progress progress-xs">
                            <div class="progress-bar bg-primary" style="width: '.getPercentage($result['course8']).'"></div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>HLTAID011/HLTAID012/HLTAID009/HLTAID010 Provide First Aid</td>
                        <td>'.$result['course7'].'</td>
                        <td class="w-50">
                          <div class="progress progress-xs">
                            <div class="progress-bar bg-primary" style="width: '.getPercentage($result['course7']).'"></div>
                          </div>
                        </td>
                      </tr>
                     
                    </tbody>
                  </table>
                </div>
              </div>   <br>';


            /*** Code edit by Inam 10Nov2021 ***/
            $result1 = studentCoursesBroady();
            echo '<h1 class="mb-4 text-gray-800" style="text-align: center; padding-top: 30px;">Campus wise students</h1>';
            echo '<div class = "row"><div class="col-md-4 col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Broadmeadows/Campbellfield</h3>
                  </div>
                  <table class="table card-table table-vcenter">
                    <thead>
                      <tr>
                        <th>COURSES</th>
                        <th colspan="2">USERS</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>CPP20218 Certificate II in Security Operations</td>
                        <td>'.$result1['course1'].'</td>
                       
                      </tr>
                      <tr>
                        <td>CHC40213 Certificate IV in Education Support</td>
                        <td>'.$result1['course2'].'</td>
                        
                      </tr>
                      <tr>
                        <td>CHC43115 Certificate IV in Disability</td>
                        <td>'.$result1['course3'].'</td>
                        
                      </tr>
                      <tr>
                        <td>CHC33015 Certificate III in Individual Support</td>
                        <td>'.$result1['course4'].'</td>
                       
                      </tr>
                      <tr>
                        <td>CHC50113 Diploma of Early Childhood Education and Care</td>
                        <td>'.$result1['course5'].'</td>
                       
                      </tr>
                      <tr>
                        <td>CHC30113 Certificate III in Early Childhood Education and Care</td>
                        <td>'.$result1['course6'].'</td>
                       
                      </tr>
                      <tr>
                        <td>CPCCWHS1001 Prepare to work safely in the Construction Industry</td>
                        <td>'.$result1['course8'].'</td>
                        
                      </tr>
                      <tr>
                        <td>HLTAID011/HLTAID012/HLTAID009/HLTAID010 Provide First Aid</td>
                        <td>'.$result1['course7'].'</td>
                      </tr>
                    </tbody>
                  </table>          
                </div>
              </div>';


            $result2 = studentCoursesShepparton();
            echo '<div class="col-md-4 col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Greater Shepparton</h3>
                  </div>
                  <table class="table card-table table-vcenter">
                    <thead>
                      <tr>
                        <th>COURSES</th>
                        <th colspan="2">USERS</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>CPP20218 Certificate II in Security Operations</td>
                        <td>'.$result2['course1'].'</td>
                       
                      </tr>
                      <tr>
                        <td>CHC40213 Certificate IV in Education Support</td>
                        <td>'.$result2['course2'].'</td>
                        
                      </tr>
                      <tr>
                        <td>CHC43115 Certificate IV in Disability</td>
                        <td>'.$result2['course3'].'</td>
                        
                      </tr>
                      <tr>
                        <td>CHC33015 Certificate III in Individual Support</td>
                        <td>'.$result2['course4'].'</td>
                       
                      </tr>
                      <tr>
                        <td>CHC50113 Diploma of Early Childhood Education and Care</td>
                        <td>'.$result2['course5'].'</td>
                       
                      </tr>
                      <tr>
                        <td>CHC30113 Certificate III in Early Childhood Education and Care</td>
                        <td>'.$result2['course6'].'</td>
                       
                      </tr>
                      <tr>
                        <td>CPCCWHS1001 Prepare to work safely in the Construction Industry</td>
                        <td>'.$result2['course8'].'</td>
                        
                      </tr>
                      <tr>
                        <td>HLTAID011/HLTAID012/HLTAID009/HLTAID010 Provide First Aid</td>
                        <td>'.$result2['course7'].'</td>
                      </tr>
                    </tbody>
                  </table>          
                </div>
              </div>';

            $result3 = studentCoursesColaroo();

            echo '<div class="col-md-4 col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Colaroo/Roxburgh</h3>
                  </div>
                  <table class="table card-table table-vcenter">
                    <thead>
                      <tr>
                        <th>COURSES</th>
                        <th colspan="2">USERS</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>CPP20218 Certificate II in Security Operations</td>
                        <td>'.$result3['course1'].'</td>
                       
                      </tr>
                      <tr>
                        <td>CHC40213 Certificate IV in Education Support</td>
                        <td>'.$result3['course2'].'</td>
                        
                      </tr>
                      <tr>
                        <td>CHC43115 Certificate IV in Disability</td>
                        <td>'.$result3['course3'].'</td>
                        
                      </tr>
                      <tr>
                        <td>CHC33015 Certificate III in Individual Support</td>
                        <td>'.$result3['course4'].'</td>
                       
                      </tr>
                      <tr>
                        <td>CHC50113 Diploma of Early Childhood Education and Care</td>
                        <td>'.$result3['course5'].'</td>
                       
                      </tr>
                      <tr>
                        <td>CHC30113 Certificate III in Early Childhood Education and Care</td>
                        <td>'.$result3['course6'].'</td>
                       
                      </tr>
                      <tr>
                        <td>CPCCWHS1001 Prepare to work safely in the Construction Industry</td>
                        <td>'.$result3['course8'].'</td>
                        
                      </tr>
                      <tr>
                        <td>HLTAID011/HLTAID012/HLTAID009/HLTAID010 Provide First Aid</td>
                        <td>'.$result3['course7'].'</td>
                      </tr>
                    </tbody>
                  </table>          
                </div>
              </div> </div>';


            echo '<h1 class="mb-4 text-gray-800" style="text-align: center; padding-top: 30px;">Current Enabled Forms</h1>';
            print_table_header();
            echo '<thead>
                <tr>
                    <th>S.No.</th>
                    <th>Form Name</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>S.No.</th>
                    <th>Form Name</th>                
                </tr>
                </tfoot>
        <tbody>';
            $i = 1;
            $forms = get_form();
            if (!empty($forms)):
                foreach ($forms as $log):
                    echo '<tr>';
                    echo '<td>' . $i . '</td>';
                    echo '<td><a href="https://form.jotform.com/' . $log["iframe"] . '" target="_blank"> ' . $log['formname'] . '</a></td>';
                    $i++;
                    echo '</tr>';
                endforeach;
            else:
                echo '<tr>';
                echo '<td>No Data to Display</td>';
                echo '</tr>';
            endif;
        else:
            //echo "No form to Display !!!";
        endif;

        print_table_footer();
    else:
        $forms = get_form();
        if (!empty($forms)&&$role!=3):
            echo '<div class="row">';
            foreach ($forms as $usr):
                // $userforms = get_user_form($usr);
                echo '<div class="col-sm-6 col-lg-3" style="padding-top: 10px;">
                                <div class="card card-md">
                                    <div class="ribbon ribbon-top ribbon-bookmark bg-green">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path></svg>
                                    </div>
                                    <div class="card-body text-center">
                                        <div class="display-5 my-3"><img src="img/attachment%20icon%20(1).png""></div>
                                        <h3 style="margin: 0px;">' . $usr["formname"] . '</h3>
                                        <div class="text-center mt-2">
                                            <a href="'.$url.'/index.php?page=9&form=' . $usr["iframe"] . '&formname= ' . $usr["formname"] . '" class="btn btn-green w-100">Fill Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            endforeach;
            echo '</div>';
        else:
            //  echo "No form to Display !!!";
        endif;

        echo '</div>';
    endif;

}


function StudentDashboard($row2, $security, $found,$different,$userId){
    global $pdo,$url,  $enrolmentForm, $usiForm, $skillForm, $documentForm, $usitransForm ,$seclln;

    //check if course is funded or not
    $query1 = "SELECT * FROM `courses`  WHERE `id`=:courseid";
    $stmt2 = $pdo->prepare($query1);
    $stmt2->bindParam('courseid', $row2['courseid'], PDO::PARAM_STR);
    $stmt2->execute();
    $Govfund  = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    var_dump($Govfund);

    echo "<script>
            $(document).ready(function(){
              $('[data-toggle='tooltip']').tooltip();   
            });
          </script>";
?>
        <script>
            /**
             * Ajax to delete form
             */
            $(function(){
                $(document).on('click','.startanewcourse',function(event) {
                         //alert('working');
                        event.preventDefault();
                        var val = $("#changeOfCourse").find(":selected").text();
                        if(val!="Open this select menu"){
                            alert("ok");
                            $.ajax({
                                type: 'POST',
                                url: 'lib/userlib.php',
                                data: {'newcourse': val},
                                success: function (data) {
                                    alert(data);
                                    if (data == "YES") {
                                        $('#addANewCourse').remove();
                                        $('.addANewCourseCard').append('<div class="alert alert-success" role="alert">Changed Successfully. Refresh to see the changes.</div>');
                                        $('#newenrolment').remove();
                                    } else {
                                        window.location.reload();
                                    }
                                }
                            });
                        }

                });
            });
        </script>

    <?php

    echo '<input id="specialNumber" value="'.$userId.'" style="display:none;">';
    /***
     *
     * If only selected course is first aid or whitecard
     *
     ***/
    echo '<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="card-body addANewCourseCard">
            <form id="addANewCourse">
                <select class="custom-select custom-select-lg mb-3" id="changeOfCourse" style="padding: 20px;font-size: 16px;">
                        <option selected>Open this select menu</option>
                        <option value="CHC33015 Certificate III in Individual Support">CHC33015 Certificate III in Individual Support (Aged Care)</option>
                        <option value="CPP20218 Certificate II in Security Operations">CPP20218 Certificate II in Security Operations</option>
                        <option value="CHC30113 Certificate III in Early Childhood Education and Care">CHC30113 Certificate III in Early Childhood Education and Care</option>
                        <option value="CHC50113 Diploma of Early Childhood Education and Care">CHC50113 Diploma of Early Childhood Education and Care</option>
                        <option value="HLTAID009 Provide cardiopulmonary resuscitation">HLTAID009 Provide cardiopulmonary resuscitation</option>
                        <option value="HLTAID010 Provide basic emergency life support">HLTAID010 Provide basic emergency life support</option>
                        <option value="HLTAID011 Provide First Aid">HLTAID011 Provide First Aid</option>
                        <option value="HLTAID012 Provide First Aid in an education and care setting">HLTAID012 Provide First Aid in an education and care setting</option>
                        <option value="CPCCWHS1001 Prepare to work safely in the Construction Industry">CPCCWHS1001 Prepare to work safely in the Construction Industry</option>
                        <option value="CHC40213 Certificate IV in Education Support">CHC40213 Certificate IV in Education Support</option>
                        <option value="CHC43015 Certificate IV in Ageing Support">CHC43015 Certificate IV in Ageing Support</option>
                        <option value="CHC43115 Certificate IV in Disability">CHC43115 Certificate IV in Disability</option>
                    </select>
            <br>
                    <button type="submit" class="btn btn-primary startanewcourse" style="padding: 20px;font-size: 16px;">Submit</button>
        </form>
        </div>
    </div>
  </div>
</div>';

    if($row2['enrolForm']!=NULL && $row2['skillForm']!=NULL && $row2['usiForm']!=NULL && $row2['documentForm']!=NULL && $row2['ptrForm']!=NULL && $row2['llnForm']!=NULL){
        echo '<div style="text-align: center !important;"><img src="img/completed task.png"  style="width: 30%;"> <br><h1> Thank You for completing the enrolment process!</h1><br><p>Do you want to enrol for another course?</p><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" style="margin-bottom: 20px;" id="newenrolment">Start a new enrolment</button>
</div>';
    }elseif ($row2['enrolForm']!=NULL && $row2['documentForm']!=NULL && $found==1 && $different==0){
        echo '<div style="text-align: center !important;"><img src="img/completed task.png"  style="width: 30%;"> <br><h1> Thank You!</h1><br><p>Do you want to enrol for another course?</p><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" style="margin-bottom: 20px;" id="newenrolment">Start a new enrolment</button>
</div>';
    }else{
        echo '<h1 class="mb-4 text-gray-800" style="text-align: center; padding-top: 30px;">Dashboard ->'. $Govfund.'</h1>';
        /***
         *
         * Only Security course
         *
         ***/
        if($security==1){

            echo '<div style="border: 2px red solid; text-align: center;font-size: 24px;">
                          <p><b>Note:</b> 
                          For any information or query call 1300 436 487. <br> <a href="'.$url.'/Student Guide - Enrolment Procedure - V.1.4.pdf" target="_blank">Click here</a> for information about how to complete the enrolment process </p>
                          </div>';

            echo '<div class="container" style="margin-top:50px;">
                                <div class="row">
                                <div class="card-group ">';

            //////////////////////////////////////
            ///// ENROLMENT AGREEMENT FORM///////
            /////////////////////////////////////
            echo '<div class="card">';
            echo '
                <img class="card-img-top" src="https://images.pexels.com/photos/1438081/pexels-photo-1438081.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="Card image cap">
                <div class="card-body">
                    <a class="card-action" href="#" data-tooltip="In this step you will be required to fill enrolment form. This form is used to take different details like your personal details, emergency contact etc."><i class="fa fa-info-circle"></i></a>
                    <h5 class="card-title">Step 1: </h5>
                    <p class="card-text">ENROLMENT AGREEMENT FORM</p>';
            if(isset($row2['enrolForm'])==NULL){
                echo ' <button type="button" class="btn btn-secondary"><a href="'.$url.'/index.php?page=9&form='.$enrolmentForm.'&formname=enrol" style="text-decoration: none !important; color: white;" target="_blank">Fill Now</a></button>';
            }
            echo '</div>
                <div class="card-footer">';
            if(isset($row2['enrolForm'])!=NULL){
                echo '<small class="text-muted"><img src="img/completed task.png" width="20px" height="20px"> This step is completed.</small>';
            }else{
                echo '<small class="text-muted">This activity will be automatically marked as completed.</small>';
            }
            echo'
                </div>
            </div>';

            //////////////////////////////////////
            //////////////// USI FORM/////////////////
            /////////////////////////////////////

            /***
             *
             * Edited by awais 6 december 2021
             * delete Document and change condition for USI
             *
             ***/
            if(isset($row2['enrolForm'])!=NULL){
                echo '<div class="card">';
            }
            else{
                echo '<div class="card " style="-webkit-filter: blur(1px);">';
            }
            echo '
                <img class="card-img-top" src="https://images.pexels.com/photos/7713351/pexels-photo-7713351.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="Card image cap">
                <div class="card-body">
                    <a class="card-action" href="#" data-tooltip="If you do not have USI number then you must need to fill this form"><i class="fa fa-info-circle"></i></a>
                    <h5 class="card-title">Step 2: </h5>
                    <p class="card-text">USI</p>';

            /** Edited By Inam 26/10/2021 */
            if(isset($row2['usiForm'])==NULL && isset($row2['enrolForm'])!=NULL){
                echo '<p class="card-text">If you do not have USI Please fill the USI form.</p>';
                echo '<button type="button" class="btn btn-secondary"><a href="'.$url.'/index.php?page=9&form='.$usiForm.'&formname=usi" style="text-decoration: none !important; color: white;" target="_blank">USI Form</a></button> <br>';
            }

            if(isset($row2['usiForm'])==NULL && isset($row2['enrolForm'])!=NULL){
                echo '<br><b>OR</b><br>';
                echo '<p class="card-text">Please upload the USI transcript if you have USI number.</p>';
                echo '<button type="button" class="btn btn-secondary"><a href="'.$url.'/index.php?page=9&form='.$usitransForm.'&formname=usitrans" style="text-decoration: none !important; color: white;" target="_blank">USI Transcript</a></button>';
            }
            /** Edited By Inam 26/10/2021 */
            echo'
                    
                </div>
                <div class="card-footer">
                    ';

            if(isset($row2['usiForm'])!=NULL){
                echo '<small class="text-muted"><img src="img/completed task.png" width="20px" height="20px"> This step is completed.</small>';
            }else{
                echo '<small class="text-muted">This activity will be automatically marked as completed.</small>';
            }
            echo'
                </div>
            </div>
                        ';


            echo '
        <div class="card-group">
            <!--<div class="card " style="-webkit-filter: blur(2px);">-->
            ';
            //////////////////////////////////////
            //////////////// SKILLS FIRST PROGRAM ELIGIBILITY/////////////////
            /////////////////////////////////////
            if(isset($row2['usiForm'])!=NULL){
                echo '<div class="card">';
            }
            else{
                echo '<div class="card " style="-webkit-filter: blur(1px);">';
            }
            echo '
            
            <!--<div class="card " style="-webkit-filter: blur(2px);">-->
                <img class="card-img-top" src="https://images.pexels.com/photos/68704/pexels-photo-68704.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="Card image cap">
                <div class="card-body">
                    <a class="card-action" href="#" data-tooltip="In this step you will be required to fill the Skills first eligibility form.
                        Our trainer will assess you in the Step 3 (PRE TRAINING INTERVIEW) and will confirm whether you will be required to fill this form or not."><i class="fa fa-info-circle"></i></a>
                    <h5 class="card-title">Step 3: </h5>
                    <p class="card-text">SKILLS FIRST PROGRAM ELIGIBILITY</p>';
            if(isset($row2['skillForm'])==NULL && isset($row2['usiForm'])!=NULL){
                echo '<button type="button" class="btn btn-secondary"><a href="'.$url.'/index.php?page=9&form='.$skillForm.'&formname=skillfirst"
                                                                       style="text-decoration: none !important; color: white;" target="_blank">Fill Now</a></button>
                ';
            }
            echo'
                </div>
                <div class="card-footer">
                    ';if(isset($row2['skillForm'])!=NULL){
                echo '<small class="text-muted"><img src="img/completed task.png" width="20px" height="20px"> This step is completed.</small>';
            }else{
                echo '<small class="text-muted">This activity will be automatically marked as completed.</small>';
            }
            echo'
                </div>
            </div>';
            //////////////////////////////////////
            //////////////// PTR/////////////////
            /////////////////////////////////////
            if(isset($row2['skillForm'])!=NULL){
                echo '<div class="card">';
            }
            else{
                echo '<div class="card " style="-webkit-filter: blur(1px);">';
            }
            echo '
                <img class="card-img-top" src="https://images.pexels.com/photos/7675860/pexels-photo-7675860.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="Card image cap">
                <div class="card-body">
                    <a class="card-action" href="#" data-tooltip="In this step you are required to book an appointment with one of our representative for an interview call. It will be conducted on the same lln portal where you have completed your LLn assessment in step 1."><i class="fa fa-info-circle"></i></a>
                    <h5 class="card-title">Step 4: </h5>
                    <p class="card-text">LLN & PTR</p>';

            if(isset($row2['skillForm'])!=NULL  && isset($row2['llnForm'])==NULL){
                echo ' <button type="button" class="btn btn-secondary"><a href="'.$url.'/index.php?page=9&form='.$seclln.'&formname=lln" style="text-decoration: none !important; color: white;" target="_blank">Attempt Now</a></button>';
            }

            echo '</div>';
            echo '<div class="card-footer" id="llnfooter"> ';
            if(isset($row2['llnForm'])!=NULL){
                echo '<small class="text-muted"><img src="img/completed task.png" width="20px" height="20px"> This step is completed.</small>';
            }else{
                echo '<small class="text-muted">This activity will be automatically marked as completed.</small>';
            }
            /** Edited By Inam 26/10/2021 */
            /*else if(isset($row2['usiForm'])!=NULL){
                echo '<div class="form-check"><input class="form-check-input markAsCompletePTR" type="checkbox" value="" id="flexCheckDefault"><label class="form-check-label " for="flexCheckDefault">Mark As Completed</label></div>';
            }*/
            echo'

                </div>
            </div>     
          </div>
        </div>
    </div>
</div> ';
        }
        /***
         *
         * If only selected course is first aid or whitecard
         *
         ***/
        elseif ($found==1 && $different==0 && $security==0){
            echo '<div style="border: 2px red solid; text-align: center;font-size: 24px;">
                <p><b>Note:</b> 
            For any information or query call 1300 436 487.<br> <a href="'.$url.'/Student Guide - Enrolment Procedure - V.1.4.pdf" target="_blank">Click here</a> for information about how to complete the enrolment process </p>
            </div>
            <div class="row">
            <div class="col-sm-4 card-group">';

            //////////////////////////////////////
            ////// ENROLMENT AGREEMENT FORM //////
            /////////////////////////////////////
            echo '<div class="card">';
            echo '
                <img class="card-img-top" src="https://images.pexels.com/photos/1438081/pexels-photo-1438081.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="Card image cap">
                <div class="card-body">
                    <a class="card-action" href="#" data-tooltip="In this step you will be required to fill enrolment form.
                            This form is used to take different details like your personal details, emergency contact etc."><i class="fa fa-info-circle"></i></a>
                    <h5 class="card-title">Step 1: </h5>
                    <p class="card-text">ENROLMENT AGREEMENT FORM</p>';
            if(isset($row2['enrolForm'])==NULL){
                echo ' <button type="button" class="btn btn-secondary"><a href="'.$url.'/index.php?page=9&form='.$enrolmentForm.'&formname=enrol" style="text-decoration: none !important; color: white;" target="_blank">Fill Now</a></button>
                ';
            }
            echo'
                   </div>
                <div class="card-footer">
                    ';if(isset($row2['enrolForm'])!=NULL){
                echo '<small class="text-muted"><img src="img/completed task.png" width="20px" height="20px"> This step is completed.</small>';
            }else{
                echo '<small class="text-muted">This activity will be automatically marked as completed.</small>';
            }
            echo'
                </div>
            </div>';

            echo '
            </div>
            </div>';
        }

        ///////////////
        ///otherwise///
        //////////////
        else{
            //IF FOUND=1 AND DIFFERENT =1 THEN NOT ONLY WHITECARD OR FIRST AID
            echo '<div style="border: 2px red solid; text-align: center;font-size: 24px;">
                <p><b>Note:</b> 
            For any information or query call 1300 436 487. <br> <a href="'.$url.'/Student Guide - Enrolment Procedure - V.1.4.pdf" target="_blank">Click here</a> for information about how to complete the enrolment process </p>
            </div>';
            echo '<div class="container" style="margin-top:50px;">
            <div class="row">
            <div class="card-group">';

            //////////////////////////////////////
            ///// ENROLMENT AGREEMENT FORM///////
            /////////////////////////////////////

            echo '<div class="card">';
            echo '
                <img class="card-img-top" src="https://images.pexels.com/photos/1438081/pexels-photo-1438081.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="Card image cap">
                <div class="card-body">
                    <a class="card-action" href="#" data-tooltip="In this step you will be required to fill enrolment form. This form is used to take different details like your personal details, emergency contact etc."><i class="fa fa-info-circle"></i></a>
                    <h5 class="card-title">Step 1: </h5>
                    <p class="card-text">ENROLMENT AGREEMENT FORM</p>';
            if(isset($row2['enrolForm'])==NULL){
                echo ' <button type="button" class="btn btn-secondary"><a href="'.$url.'/index.php?page=9&form='.$enrolmentForm.'&formname=enrol" style="text-decoration: none !important; color: white;" target="_blank">Fill Now</a></button>';
            }
            echo '</div>
                <div class="card-footer">';
            if(isset($row2['enrolForm'])!=NULL){
                echo '<small class="text-muted"><img src="img/completed task.png" width="20px" height="20px"> This step is completed.</small>';
            }else{
                echo '<small class="text-muted">This activity will be automatically marked as completed.</small>';
            }
            echo'
                </div>
            </div>';

            /***
             *
             * Edited by awais 6 december 2021
             * delete Document and change condition for USI
             *
             ***/
            //////////////////////////////////////
            //////////////// USI FORM/////////////////
            /////////////////////////////////////
            if(isset($row2['enrolForm'])!=NULL){
                echo '<div class="card">';
            }
            else{
                echo '<div class="card " style="-webkit-filter: blur(1px);">';
            }
            echo '
                <img class="card-img-top" src="https://images.pexels.com/photos/7713351/pexels-photo-7713351.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="Card image cap">
                <div class="card-body">
                    <a class="card-action" href="#" data-tooltip="If you do not have USI number then you must need to fill this form"><i class="fa fa-info-circle"></i></a>
                    <h5 class="card-title">Step 2: </h5>
                    <p class="card-text">USI</p>';

            /** Edited By Inam 26/10/2021 */
            if(isset($row2['usiForm'])==NULL && isset($row2['enrolForm'])!=NULL){
                echo '<p class="card-text">If you do not have USI Please fill the USI form.</p>';
                echo '<button type="button" class="btn btn-secondary"><a href="'.$url.'/index.php?page=9&form='.$usiForm.'&formname=usi" style="text-decoration: none !important; color: white;" target="_blank">USI Form</a></button> <br>';
            }

            if(isset($row2['usiForm'])==NULL && isset($row2['enrolForm'])!=NULL){
                echo '<br><b>OR</b><br>';
                echo '<p class="card-text">Please upload the USI transcript if you have USI number.</p>';
                echo '<button type="button" class="btn btn-secondary"><a href="'.$url.'/index.php?page=9&form='.$usitransForm.'&formname=usitrans" style="text-decoration: none !important; color: white;" target="_blank">USI Transcript</a></button>';
            }
            /** Edited By Inam 26/10/2021 */
            echo'
                    
                </div>
                <div class="card-footer">';

            if(isset($row2['usiForm'])!=NULL){
                echo '<small class="text-muted"><img src="img/completed task.png" width="20px" height="20px"> This step is completed.</small>';
            }else{
                echo '<small class="text-muted">This activity will be automatically marked as completed.</small>';
            }
            echo'
                </div>
            </div>
                        ';
            //////////////////////////////////////
            //////////////// LLN/////////////////
            /////////////////////////////////////
            ///
            if(isset($row2['usiForm'])!=NULL){
                echo '<div class="card">';
            }
            else{
                echo '<div class="card " style="-webkit-filter: blur(1px);">';
            }
            echo '
                <img class="card-img-top" src="https://images.pexels.com/photos/207569/pexels-photo-207569.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="Card image cap">
                <div class="card-body">
                    <a class="card-action" href="#" data-tooltip="In this step you required to visit lln.of.edu.au and complete the assessment in Language,
                           Literacy and Numeracy course. You will be require to have a webcam to do this assessment."><i class="fa fa-info-circle"></i></a>
                    <h5 class="card-title">Step 3: </h5>
                    <p class="card-text">LANGUAGE, LITERACY AND NUMERACY ASSESSMENT</p>';
            if(isset($row2['llnForm'])==NULL && isset($row2['usiForm'])!=NULL){
                echo '<button type="button" class="btn btn-secondary"><a href="https://lln.of.edu.au/" style="text-decoration: none !important; color: white;" target="_blank">Attempt Now</a>';
            }
            echo'
                    </button>
                </div>
                <div class="card-footer" id="llnfooter"> ';
            if(isset($row2['llnForm'])!=NULL){
                echo '<small class="text-muted"><img src="img/completed task.png" width="20px" height="20px"> This step is completed.</small> <!--<span id="undoLln" style="color: #206bc4">Undo</span>-->';
            }
            /** Edited By Inam 26/10/2021 */

            echo'
                </div>
            </div>';

            echo '
        <div class="card-group">
            <!--<div class="card " style="-webkit-filter: blur(2px);">-->
            ';
            //////////////////////////////////////
            //////////////// SKILLS FIRST PROGRAM ELIGIBILITY/////////////////
            /////////////////////////////////////
            if(isset($row2['llnForm'])!=NULL){
                echo '<div class="card">';
            }
            else{
                echo '<div class="card " style="-webkit-filter: blur(1px);">';
            }
            echo '
            
            <!--<div class="card " style="-webkit-filter: blur(2px);">-->
                <img class="card-img-top" src="https://images.pexels.com/photos/68704/pexels-photo-68704.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="Card image cap">
                <div class="card-body">
                    <a class="card-action" href="#" data-tooltip="In this step you will be required to fill the Skills first eligibilty form.
                        Our trainer will assess you in the Step 3(PRE TRAINING INTERVIEW)
                        and will confirm whether you will be required to fill this form or not.
"><i class="fa fa-info-circle"></i></a>
                    <h5 class="card-title">Step 4: </h5>
                    <p class="card-text">SKILLS FIRST PROGRAM ELIGIBILITY</p>';
            if(isset($row2['skillForm'])==NULL && isset($row2['llnForm'])!=NULL){
                echo '<button type="button" class="btn btn-secondary"><a href="'.$url.'/index.php?page=9&form='.$skillForm.'&formname=skillfirst"
                                                                       style="text-decoration: none !important; color: white;" target="_blank">Fill Now</a></button>
                ';
            }
            echo'
                </div>
                <div class="card-footer">
                    ';if(isset($row2['skillForm'])!=NULL){
                echo '<small class="text-muted"><img src="img/completed task.png" width="20px" height="20px"> This step is completed.</small>';
            }else{
                echo '<small class="text-muted">This activity will be automatically marked as completed.</small>';
            }
            echo'
                </div>
            </div>';
            //////////////////////////////////////
            //////////////// PTR/////////////////
            /////////////////////////////////////
            if(isset($row2['skillForm'])!=NULL){
                echo '<div class="card">';
            }
            else{
                echo '<div class="card " style="-webkit-filter: blur(1px);">';
            }
            echo '
                <img class="card-img-top" src="https://images.pexels.com/photos/7675860/pexels-photo-7675860.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="Card image cap">
                <div class="card-body">
                    <a class="card-action" href="#" data-tooltip="In this step you are required to book an appointment with one of our representative for an
                     interview call. It will be conducted on the same lln portal where you have completed your LLn assessment in step 1."><i class="fa fa-info-circle"></i></a>
                    <h5 class="card-title">Step 5: </h5>
                    <p class="card-text">PRE TRAINING INTERVIEW</p>
                    ';
            //  if (isset($row2['campus'])=='Colaroo/Roxburgh Park' || isset($row2['campus'])=='Broadmeadows/Campbellfield'){
            echo '<p class="card-text">Our office will be in contact with you for an interview. If you have any query please feel free to call at <b>1300 436 487</b></p>';
            /* }
             else{
                 echo '<p class="card-text">Our office will be in contact with you for an interview. If you have any query please feel free to call at  at  <b>03 5821 8665</b></p>';
             }*/
            echo '
                    
                </div>
                <div class="card-footer" id="ptrfooter">
                    ';
            if(isset($row2['ptrForm'])!=NULL && isset($row2['skillForm'])!=NULL){
                echo '<small class="text-muted"><img src="img/completed task.png" width="20px" height="20px"> This step is completed.</small> ';
            }
            /** Edited By Inam 26/10/2021 */
            /*else if(isset($row2['usiForm'])!=NULL){
                echo '<div class="form-check"><input class="form-check-input markAsCompletePTR" type="checkbox" value="" id="flexCheckDefault"><label class="form-check-label " for="flexCheckDefault">Mark As Completed</label></div>';
            }*/
            echo'

                </div>
            </div>
            
        </div>
        </div>

    </div>

</div> ';
        }
    }
}


/** Campus **/
function studentCampus($campus){
    if($campus== 0){
        $result = "Broadmeadows";
    }else if($campus == 1){
        $result = "Campbellfield";
    }else if($campus == 2){
        $result = "Coolaroo";
    }else if($campus == 3){
        $result = "Craigieburn";
    }else if($campus == 4){
        $result = "Werribee";
    }else if($campus == 5){
        $result = "Attwood";
    }else if($campus== 6){
        $result = "Preston";
    }else if($campus == 7){
        $result = "Fawkner";
    }else if($campus == 8){
        $result = "Footscary";
    }else if($campus== 9){
        $result = "Shepparton";
    }else{
        $result = "OTHER";
    }
    return $result;
}

function userCheck($Email){
    global $pdo;
    $query = "select * from `user` where `email`=:username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam('username', $Email, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->rowCount();
    return $count;
}


function get_StudentProgressForCoordinator(){
    global $pdo;

    $query = "SELECT * FROM `of_enrolment` , `user` WHERE of_enrolment.usrid = user.id AND user.role = 3 ORDER BY of_enrolment.id DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $row   = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $i=0;
    foreach ($row as $data){
        $i++;
        echo '<tr>';
        echo '<td>' .$i. '</td>';
        echo '<td>' .$data["std_id"]. '</td>';
        echo '<td>' .get_session_detail($data["usrid"]). '</td>';

        /** Enrol Form Check */
        echo '<td>';
        if (!empty($data["enrolForm"])){
            echo '<i class="fa fa-check" style="color:green;"></i>';
        }else{
            echo "-";
        }
        echo '</td>';

        /** Skill Form Check */
        echo '<td>';
        if (!empty($data["skillReview"])){
            echo '<i class="fa fa-check" style="color:green;"></i>';
        }else{
            echo "-";
        }
        echo '</td>';


        /** Document Form Check */
        echo '<td>';
        if (!empty($data["documentForm"])){
            echo '<i class="fa fa-check" style="color:green;"></i>';
        }else{
            echo "-";
        }
        echo '</td>';

        /** USI Form Check */
        echo '<td>';
        if (!empty($data["usiForm"])){
            echo '<i class="fa fa-check" style="color:green;"></i>';
        }else{
            echo "-";
        }
        echo '</td>';

        /** LLN Form Check */
        echo '<td>';
        if (!empty($data["llnForm"])){
            echo '<i class="fa fa-check" style="color:green;"></i>';
        }else{
            echo "-";
        }
        echo '</td>';

        /** PTR Form Check */
        echo '<td>';
        if (!empty($data["ptrForm"])){
            echo '<i class="fa fa-check" style="color:green;"></i>';
        }else{
            echo "-";
        }
        echo '</td>';
        echo '<td><a href="index.php?page=20&userid='.$data['id'].'" target="_blank"></ahref><i class="fa fa-link" style="color:blue;"></i></a></td>
                </tr>';
    }
}



/**
 * GET submission id
 *
 */

function getSubmissionID($std_id){
    global $pdo;

    try {

        $query = "SELECT * FROM `of_enrolment` WHERE std_id =:uqid";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('uqid',  $std_id, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $result = json_decode($row['enrolForm'],true) ;
        $submissionId = $result['submission_id'];

        //print_r($submissionId);
        return $submissionId;
    } catch (PDOException $e) {
        return $e->getMessage();
    }


}

/**
 * Get Medicare Date
 * @param $month
 * @return int
 */
function getMedicareDate($month){
    if($month == 2 ){
        return 28;
    }elseif ($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12){
        return 31;
    }else{
        return 30;
    }
}


function getSigupTime($userId){
    global $pdo;
    try {

        $query = "SELECT * FROM `user` WHERE id =:id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id',  $userId, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['signupDate'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }

}