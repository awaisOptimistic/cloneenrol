<?php
//include_once 'database.php';

function check_condition($log1, $value){

    if ($log1["name"] == $value AND array_key_exists('answer', $log1)) {
        return 0;
    } else {
        return 1;
    }
}
function check_array_condition($log1){
    if ($log1["type"] == "control_fullname") {
        return 0;
    }

    else{
        return 1;
    }
}
function myFilter($var){
    return ($var !== NULL && $var !== FALSE && $var !== "");
}
function insert_student_details($detail, $previousqualification,$qualification, $shortcourse){
    global $DB;

    if(array_key_exists('std_id', $detail)){ $std_id = $detail["std_id"]; } else { $std_id = NULL; }
    if(array_key_exists('title', $detail)){  $title = $detail["title"]; } else { $title = NULL; }
    if(array_key_exists('genderDetails', $detail)){ $genderDetails = $detail["genderDetails"]; } else { $genderDetails = NULL; }
    if(array_key_exists('firstname', $detail)){ $firstname = $detail["firstname"]; } else { $firstname = NULL; }
    if(array_key_exists('middlename', $detail)){ $middlename = $detail["middlename"]; } else { $middlename = NULL; }
    if(array_key_exists('lastname', $detail)){  $lastname = $detail["lastname"]; } else {  $lastname = NULL; }
    if(array_key_exists('dob', $detail)){  $dob = $detail["dob"]; } else { $dob = NULL; }
    if(array_key_exists('residentialAddress', $detail)){ $residentialAddress = $detail["residentialAddress"]; } else { $residentialAddress = NULL; }
    if(array_key_exists('suburbtown', $detail)){ $suburbtown = $detail["suburbtown"]; } else { $suburbtown = NULL; }
    if(array_key_exists('state', $detail)){  $state = $detail["state"]; } else { $state = NULL; }
    if(array_key_exists('postcode', $detail)){ $postcode = $detail["postcode"]; } else { $postcode = NULL; }
    if(array_key_exists('postalAddress', $detail)){ $postalAddress = $detail["postalAddress"]; } else { $postalAddress = NULL; }
    if(array_key_exists('homePhone', $detail)){ $homePhone = $detail["homePhone"]; } else { $homePhone = NULL; }
    if(array_key_exists('mobile', $detail)){ $mobile = $detail["mobile"]; } else { $mobile = NULL; }
    if(array_key_exists('fax', $detail)){ $fax = $detail["fax"]; } else { $fax = NULL; }
    if(array_key_exists('email', $detail)){  $email = $detail["email"]; } else { $email = NULL; }
    if(array_key_exists('preferredMethod', $detail)){ $preferredMethod = $detail["preferredMethod"];; } else { $preferredMethod = NULL; }
    if(array_key_exists('relationname', $detail)){ $relationname = $detail["relationname"]; } else { $relationname = NULL; }
    if(array_key_exists('relationship', $detail)){$relationship = $detail["relationship"]; } else { $relationship = NULL; }
    if(array_key_exists('relationhomeNumber', $detail)){ $relationhomeNumber = $detail["relationhomeNumber"]; } else { $relationhomeNumber = NULL; }
    if(array_key_exists('relationmobile', $detail)){  $relationmobile = $detail["relationmobile"]; } else { $relationmobile = NULL; }
    if(array_key_exists('emergencyPrefernce', $detail)){   $emergencyPrefernce = $detail["emergencyPrefernce"]; } else { $emergencyPrefernce = NULL; }
    if(array_key_exists('vsn', $detail)){ $vsn = $detail["vsn"]; } else { $vsn = NULL; }
    if(array_key_exists('noVSN', $detail)){  $noVSN = $detail["noVSN"]; } else { $noVSN = NULL; }
    if(array_key_exists('birthCountry', $detail)){ $birthCountry = $detail["birthCountry"]; } else { $birthCountry = NULL; }
    if(array_key_exists('birthCity', $detail)){    $birthCity = $detail["birthCity"]; } else { $birthCity = NULL; }
    if(array_key_exists('citizenshipStatus', $detail)){  $citizenshipStatus = $detail["citizenshipStatus"]; } else { $citizenshipStatus = NULL; }
    if(array_key_exists('VisaNumber', $detail)){  $VisaNumber = $detail["VisaNumber"]; } else { $VisaNumber = NULL; }
    if(array_key_exists('speakEnglish', $detail)){ $speakEnglish = $detail["speakEnglish"]; } else { $speakEnglish = NULL; }
    if(array_key_exists('speakStatus', $detail)){ $speakStatus = $detail["speakStatus"]; } else { $speakStatus = NULL; }
    if(array_key_exists('TSIorigin', $detail)){ $TSIorigin = $detail["TSIorigin"]; } else { $TSIorigin = NULL; }
    if(array_key_exists('disability', $detail)){  $disability = $detail["disability"]; } else { $disability = NULL; }
    if(array_key_exists('disabilityCondition', $detail)){ $disabilityCondition = $detail["disabilityCondition"]; } else { $disabilityCondition = NULL; }
    if(array_key_exists('paymentMethod', $detail)){  $paymentMethod = $detail["paymentMethod"]; } else { $paymentMethod = NULL; }
    if(array_key_exists('displayTestimonials', $detail)){ $displayTestimonials = $detail["displayTestimonials"]; } else { $displayTestimonials = NULL; }
    if(array_key_exists('displayPicture', $detail)){  $displayPicture = $detail["displayPicture"]; } else { $displayPicture = NULL; }
    if(array_key_exists('studentSignature', $detail)){  $studentSignature = $detail["studentSignature"]; } else { $studentSignature = NULL; }
    if(array_key_exists('date', $detail)){ $date = $detail["date"]; } else { $date = NULL; }
    if(array_key_exists('parentguardianSignature', $detail)){  $parentguardianSignature = $detail["parentguardianSignature"]; } else { $parentguardianSignature = NULL; }
    if(array_key_exists('date130', $detail)){  $date130 = $detail["date130"]; } else { $date130 = NULL; }
    if(array_key_exists('qualificationStatus', $detail)){  $qualificationStatus = $detail["qualificationStatus"]; } else { $qualificationStatus = NULL; }
    if(array_key_exists('modeOfstudy', $detail)){  $modeOfstudy = $detail["modeOfstudy"]; } else { $modeOfstudy = NULL; }
    if(array_key_exists('studyReason', $detail)){  $studyReason = $detail["studyReason"]; } else { $studyReason = NULL; }
    if(array_key_exists('newEducationSector', $detail)){ $newEducationSector = $detail["newEducationSector"]; } else { $newEducationSector = NULL; }


    // Start Employment table field
    if(array_key_exists('employmentStatus', $detail)){ $employmentStatus = $detail["employmentStatus"]; } else { $employmentStatus = NULL; }
    if(array_key_exists('employmentRole', $detail)){ $employmentRole = $detail["employmentRole"]; } else { $employmentRole = NULL; }
    if(array_key_exists('employmentSector', $detail)){  $employmentSector = $detail["employmentSector"]; } else { $employmentSector = NULL; }
    if(array_key_exists('organisation', $detail)){ $organisation = $detail["organisation"]; } else { $organisation = NULL; }
    if(array_key_exists('organisationPosition', $detail)){  $organisationPosition= $detail["organisationPosition"]; } else { $organisationPosition = NULL; }
    if(array_key_exists('organisationAddress', $detail)){ $organisationAddress = $detail["organisationAddress"]; } else { $organisationAddress = NULL; }
    if(array_key_exists('organisationTelephone', $detail)){  $organisationTelephone = $detail["organisationTelephone"]; } else { $organisationTelephone = NULL; }
    if(array_key_exists('abn', $detail)){  $abn = $detail["abn"]; } else { $abn = NULL; }
    // End Employment table field

    // Start Concession table field

    if(array_key_exists('medicareNo', $detail)){ $medicareNo = $detail["medicareNo"]; } else { $medicareNo = NULL; }
    if(array_key_exists('medicareExpiry', $detail)){ $medicareExpiry = $detail["medicareExpiry"]; } else { $medicareExpiry = NULL; }
    if(array_key_exists('concessionCard', $detail)){  $concessionCard = $detail["concessionCard"]; } else { $concessionCard = NULL; }
    if(array_key_exists('concessionExpiry', $detail)){ $concessionExpiry = $detail["concessionExpiry"]; } else { $concessionExpiry = NULL; }
    if(array_key_exists('currentConcessionCard', $detail)){  $currentConcessionCard= $detail["currentConcessionCard"]; } else { $currentConcessionCard = NULL; }
    if(array_key_exists('concessionCardType', $detail)){ $concessionCardType = $detail["concessionCardType"]; } else { $concessionCardType = NULL; }
    if(array_key_exists('jobSeeker', $detail)){  $jobSeeker = $detail["jobSeeker"]; } else { $jobSeeker = NULL; }
    // End Concession table field

    // Start Schooling Table field
    if(array_key_exists('schoolingLevel', $detail)){ $schoolingLevel = $detail["schoolingLevel"]; } else { $schoolingLevel = NULL; }
    if(array_key_exists('schoolingLevelYear', $detail)){ $schoolingLevelYear = $detail["schoolingLevelYear"]; } else { $schoolingLevelYear = NULL; }
    if(array_key_exists('schoolingStatus', $detail)){  $schoolingStatus = $detail["schoolingStatus"]; } else { $schoolingStatus = NULL; }

    // End Schooling Table field

    // Start USI Table field
    if(array_key_exists('usi', $detail)){ $usi = $detail["usi"]; } else { $usi = NULL; }
    if(array_key_exists('signature', $detail)){ $signature = $detail["signature"]; } else { $signature = NULL; }
    if(array_key_exists('fileUpload201', $detail)){  $fileUpload201 = $detail["fileUpload201"]; } else { $fileUpload201 = NULL; }

    // End USI Table field
    // Start Identification Table field
    if(array_key_exists('identificationDocument', $detail)){ $identificationDocument = $detail["identificationDocument"]; } else { $identificationDocument = NULL; }
    if(array_key_exists('fileUpload', $detail)){ $fileUpload = $detail["fileUpload"]; } else { $fileUpload = NULL; }
    // End Identification Table field

    //  check_student($std_id);

    if (check_student($std_id) == 1){
        // Student details table sql query
        $detail_student_sql = "INSERT INTO student_detail(std_id, title, genderDetails, firstname,middlename,lastname, dob, residentialAddress, suburbtown, states, postcode, postalAddress,
                                 homePhone, mobile, fax, email, vsn, noVSN, preferredMethod, relationname, relationship, relationhomeNumber,
                                 relationmobile, emergencyPrefernce, birthCountry, birthCity, citizenshipStatus, VisaNumber, speakEnglish, speakStatus,
                                 TSIorigin, disability, disabilityCondition, paymentMethod, displayTestimonials, displayPicture, studentSignature, date1,
                                 parentguardianSignature, date130, studyReason, newEducationSector )
                VALUES ('$std_id', '$title', '$genderDetails', '$firstname', '$middlename', '$lastname', '$dob',' $residentialAddress', '$suburbtown','$state' ,'$postcode',  '$postalAddress', '$homePhone' , '$mobile' ,
                       '$fax' ,'$email', '$vsn','$noVSN',' $preferredMethod', '$relationname' ,'$relationship' ,'$relationhomeNumber', '$relationmobile' ,'$emergencyPrefernce', '$birthCountry', '$birthCity' ,
                          '$citizenshipStatus' , '$VisaNumber' ,'$speakEnglish', '$speakStatus' , '$TSIorigin' , '$disability' ,'$disabilityCondition', '$paymentMethod','$displayTestimonials',
                          '$displayPicture' , '$studentSignature', '$date', ' $parentguardianSignature' ,'$date130', '$studyReason','$newEducationSector')";
        $detail_sql_result = $DB->query($detail_student_sql);

        //Employment table sql query
        $employment_sql = "INSERT INTO employment(employmentStatus, employmentRole, employmentSector, organisation, organisationPosition, organisationAddress, 
                                                 organisationTelephone, abn, std_id) 
                          VALUES ('$employmentStatus','$employmentRole','$employmentSector','$organisation','$organisationPosition','$organisationAddress',
                                  '$organisationTelephone','$abn','$std_id')";
        $employment_sql_result = $DB->query($employment_sql);

        //Concession table sql query
        $concession_sql = "INSERT INTO concession_detail(medicareNo, medicareExpiry, concessionCard, concessionExpiry, currentConcessionCard, 
                                    concessionCardType, jobSeeker, std_id) 
                          VALUES ('$medicareNo','$medicareExpiry','$concessionCard','$concessionExpiry','$currentConcessionCard','$concessionCardType','$jobSeeker',
                                  '$std_id')";
        $concession_sql_result = $DB->query($concession_sql);

        //schooling table sql query
        $schooling_sql = "INSERT INTO schooling(schoolingLevel, schoolingLevelYear, schoolingStatus, std_id) 
                            VALUES ('$schoolingLevel','$schoolingLevelYear',' $schoolingStatus','$std_id')";
        $schooling_sql_result = $DB->query($schooling_sql);

        //usi table sql query
        $usi_sql = "INSERT INTO usi(usi, usisignature, fileUpload201, std_id) VALUES ('$usi','$signature','$fileUpload201', '$std_id')";
        $usi_sql_result = $DB->query($usi_sql);

        //identification table sql query
        $identification_sql = "INSERT INTO identification(identificationDocument, fileUpload, std_id) VALUES ('$identificationDocument','$fileUpload','$std_id')";
        $identification_sql_result = $DB->query($identification_sql);

        //previous qualification table sql query
        if(!empty($previousqualification)){
            foreach($previousqualification as $key=>$value){
                $previousqualification_sql = "INSERT INTO previous_qualification(qualificationStatus, qualificationName,qualificationType,  std_id) VALUES ('$qualificationStatus', '$key','$value','$std_id')";
                $previousqualification_sql_result = $DB->query($previousqualification_sql);
            }
        }

        //Qualification table sql query
        if(!empty($qualification)) {
            foreach ($qualification as $key => $value) {
                $qualification_sql = "INSERT INTO qualification(modeOfstudy, qualificationTitle, qualificationCost, std_id) VALUES ('$modeOfstudy', '$key','$value','$std_id')";
                $qualification_sql_result = $DB->query($qualification_sql);
            }
        }

        //short course table sql query
        if(!empty($shortcourse)) {
            foreach($shortcourse as $key=>$value){
                $shortcourse_sql = "INSERT INTO short_qualification(shortCourse, shortQualificationCost, std_id) VALUES ('$key','$value','$std_id')";
                $shortcourse_sql_result = $DB->query($shortcourse_sql);
            }
        }

        if ($detail_sql_result > 0 AND $employment_sql_result > 0 AND $concession_sql_result > 0 AND $schooling_sql_result > 0 AND $usi_sql_result > 0 AND $identification_sql_result > 0 AND $previousqualification_sql_result > 0 AND $qualification_sql_result > 0 AND $shortcourse_sql_result > 0) {
            echo "Record inserted";
        } else {
            echo "0 results";
        }
    }


    else{
        echo "Record Exist";
    }
}

/*Function to check record exist in database*/
/*function check_student($id){
    global $DB;

    $result = $DB->query("SELECT * FROM student_detail");
    //$student = $result["std_id"];
    if (!$result){
        foreach($result as $log){
            if($log["std_id"] == $id ){
                return 0;
            }
            else{
                return 1;
            }
        }
    }
    else{
        return 1;
    }
}*/



?>