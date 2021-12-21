<?php


/***
 * @param $type
 * @param $std_id
 * @param $response
 * @return string
 */
/*function documentResponse($type, $std_id, $response){
    global $pdo;
    try {
        echo $response;
        echo $response;
     $verifyData = json_decode($response, true);
    // $documentId = implode($verifyData["VerifyDocumentResult"]["attributes"]);
     $rapidId = $verifyData["VerifyDocumentResult"]["VerificationRequestNumber"] ;
     $status =   $verifyData["VerifyDocumentResult"]["VerificationResultCode"];
     $pdfReport = get_PDFReport($rapidId);
      /*** Insert Data into identityDocument Table **/
  /* $query = "INSERT INTO of_documentVerify(documentId, std_id, verifyData, rapidId, status, download)
                                VALUES ('$type','$std_id','$response','$rapidId','$status' ,'$pdfReport')";
   $stmt = $pdo->prepare($query);
   $stmt->execute();
   } catch (PDOException $e) {
        return $e->getMessage();
   }
}*/

/**
 * @param $rapidId
 * @return string
 */
function get_PDFReport($rapidId){

  $rapidapi = '19cc6dccddf2fbced02d7a4ba088b4bb97d64d0bcaca3ffa0b6e75edd03480a8'; ;

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://sandbox.ridx.io/report/'.$rapidId,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            "token: $rapidapi",
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $bloba=base64_encode($response);
    return $bloba;
}

/**
 * @param $data
 * @param $std_id
 * @param $type
 * @return bool|string
 */
function getRapidId($data,$type){

    $rapidapi = '19cc6dccddf2fbced02d7a4ba088b4bb97d64d0bcaca3ffa0b6e75edd03480a8';
    /*** Insert Data into identityDocument Table **/
  if(strpos($type, 'Current Australian Passport') !== false){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sandbox.ridx.io/dvs/v1/passport',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                "token: $rapidapi"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
       // documentResponse($type, $std_id, $response);
    }elseif (strpos($type, 'Current Driving License or Learner Permit') !== false) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sandbox.ridx.io/dvs/v1/driverLicence',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "token: $rapidapi",
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
        // documentResponse($type, $std_id, $response);
    }

    elseif(strpos($type, 'Australian Citizenship Certificate') !== false){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sandbox.ridx.io/dvs/v1/citizenship',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                "token: $rapidapi"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
        //  documentResponse($type, $std_id, $response);
    }
    elseif(strpos($type, 'Current New Zealand Passport') !== false){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sandbox.ridx.io/infolog/dia/passportValidation',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                "token: $rapidapi"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
        // documentResponse($type, $std_id, $response);
    }
    elseif(strpos($type, 'Australian Birth Certificate (not Birth Extract)') !== false){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sandbox.ridx.io/dvs/v1/birthCertificate',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                "token: $rapidapi"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
      //  documentResponse($type, $std_id, $response);
    }
    elseif(strpos($type, 'Current green Medicare card') !== false){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sandbox.ridx.io/dvs/v1/medicare',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                "token: $rapidapi"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
       // documentResponse($type, $std_id, $response);
    }
    elseif(strpos($type, 'Visa Approval Notification and Foreign Passport') !== false){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sandbox.ridx.io/dvs/v1/visa',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                "token: $rapidapi"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
      //  documentResponse($type, $std_id, $response);
    }
    elseif(strpos($type, 'ImmiCard')!=false){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sandbox.ridx.io/dvs/v1/immiCard',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                "token: $rapidapi"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
      //  documentResponse($type, $std_id, $response);
    }

}

/**
 * Update the value
 * @param $data
 * @param $std_id
 * @param $type
 * @param $userId
 */
function update_identificationData($data,$std_id,$type,$userId){
    global $pdo;
    if ($type == 'Current New Zealand Passport') {
        $response = getRapidId($data, $type);

        if(!empty($response)) {
            $verifyData = json_decode($response, true);
            // $documentId = implode($verifyData["VerifyDocumentResult"]["attributes"]);
            $rapidId = '-';
            if ($verifyData["status"] == 200) {
                $status = 'Y';
            } else {
                $status = 'N';
            }
            $pdfReport = $verifyData["data"]["pdfLink"];
            /*** Insert Data into identityDocument Table **/
            $query = "UPDATE of_documentVerify SET request='$data',verifyData='$response', rapidId='$rapidId',status='$status',download='$pdfReport' WHERE std_id = :userID AND documentId = :type ";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam('userID', $std_id, PDO::PARAM_STR);
            $stmt->bindParam('type', $type, PDO::PARAM_STR);
            $stmt->execute();
        }
    }else{

            $response = getRapidId($data, $type);
        if(!empty($response)) {
            $verifyData = json_decode($response, true);
            $rapidId = $verifyData["VerifyDocumentResult"]["VerificationRequestNumber"];
            $status = $verifyData["VerifyDocumentResult"]["VerificationResultCode"];
            $pdfReport = get_PDFReport($rapidId);
            /*** Insert Data into identityDocument Table **/
            $query = "UPDATE of_documentVerify SET request = '$data', verifyData='$response', rapidId='$rapidId',status='$status',download='$pdfReport' WHERE std_id = :userID AND documentId = :type ";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam('userID', $std_id, PDO::PARAM_STR);
            $stmt->bindParam('type', $type, PDO::PARAM_STR);
            $stmt->execute();
        }
    }

}

/**
 * @param $data
 * @param $std_id
 * @param $formid
 * @param $submissionid
 * @param $type
 * @param $userId
 */
function insert_identificationData($data,$std_id,$type,$userId){
    global $pdo;

    if($type == 'Current New Zealand Passport'){
        $response =  getRapidId($data, $type);

            $verifyData = json_decode($response, true);
            $rapidId = '-';
            if ($verifyData["status"] == 200) {
                $status = 'Y';
            } else {
                $status = 'N';
            }
            $pdfReport = $verifyData["data"]["pdfLink"];
            /*** Insert Data into identityDocument Table **/
            $query = "INSERT INTO of_documentVerify(documentId, std_id, request, verifyData, rapidId, status, download)
                                              VALUES('$type','$std_id', '$data','$response','$rapidId','$status' ,'$pdfReport')";
            $stmt = $pdo->prepare($query);
            $stmt->execute();

    }else{
            $response =  getRapidId($data, $type);
            $verifyData = json_decode($response, true);
            $rapidId = $verifyData["VerifyDocumentResult"]["VerificationRequestNumber"];
            $status = $verifyData["VerifyDocumentResult"]["VerificationResultCode"];
            $pdfReport = get_PDFReport($rapidId);
            /*** Insert Data into identityDocument Table **/
            $query = "INSERT INTO of_documentVerify(documentId, std_id, request, verifyData, rapidId, status, download)
                                              VALUES ('$type','$std_id', '$data', '$response','$rapidId','$status' ,'$pdfReport')";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
    }
}

              /*** Return user id***/
function get_userid($std_id){
    global $pdo;
    try {
        $query = "SELECT id FROM user WHERE uqid =:userID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('userID',  $std_id, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!empty($row)){
            return $row['id'];
        }
        else{
            return 0;
        }
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/**
 * @param $response
 * @param $identificationNumber
 */
function checkDocument($response, $identificationNumber){
    /**
     * User is Not Australian Resident
     */
    if (isset($response['identificationdocumenta'])) {
        $Doc2Type = $response['identificationdocumenta'];//basically doc1

        foreach ($Doc2Type as $rs) {
            /**
             * Current Australian Passport/
             */
            if (strpos($rs, 'Current Australian Passport') !== false) {
                if ($response['australianpassportgender'] == 'MALE' || $response['australianpassportgender'] == 'Male') {
                    $gender = 'M';
                } elseif ($response['australianpassportgender'] == 'FEMALE' || $response['australianpassportgender'] == 'Female') {
                    $gender = 'F';
                } else {
                    $gender = $response['australianpassportgender'];
                }
                $australianpassportbirthdate = $response['australianpassportbirthdate'][2] . '-' . $response['australianpassportbirthdate'][1] . '-' . $response['australianpassportbirthdate'][0];
                $australianpassportexpirydate = $response['australianpassportexpirydate'][2] . '-' . $response['australianpassportexpirydate'][1] . '-' . $response['australianpassportexpirydate'][0];
                $arrPassport = array('BirthDate' => $australianpassportbirthdate, 'GivenName' => $response['australianpassportgivenname'],
                    'FamilyName' => $response['australianpassportfamilyname'], 'TravelDocumentNumber' => $response['australianpassporttraveldocumentnumber'],
                    'Gender' => $gender, 'ExpiryDate' => $australianpassportexpirydate);
                $data = json_encode($arrPassport);
                $userId = get_userid($identificationNumber);

                /** Insert of Update into of_documentverify table */
               // getRapidId($data, $Doc2Type);
                if(checkVerifyResult($identificationNumber, $rs) == 1){
                    update_identificationData($data, $identificationNumber, $rs, $userId);
                }elseif(checkVerifyResult($identificationNumber, $rs) == 2){
                    insert_identificationData($data, $identificationNumber, $rs, $userId);
                }else{
                    //do nothing
                }
            }
            /**
             * Australian Citizenship Certificate
             */
            elseif (strpos($rs, 'Australian Citizenship Certificate') !== false) {
                $citizenshipcertificatebirthdate = $response['citizenshipcertificatebirthdate'][2] . '-' . $response['citizenshipcertificatebirthdate'][1] . '-' . $response['citizenshipcertificatebirthdate'][0];
                $citizenshipcertificateacquisitiondate = $response['citizenshipcertificateacquisitiondate'][2] . '-' . $response['citizenshipcertificateacquisitiondate'][1] . '-' . $response['citizenshipcertificateacquisitiondate'][0];
                $arrcitizenshipcertificate = array('BirthDate' => $citizenshipcertificatebirthdate, 'GivenName' => $response['citizenshipcertificategivenname'],
                    'FamilyName' => $response['citizenshipcertificatefamilyname'], 'StockNumber' => $response['citizenshipcertificatestocknumber'],
                    'AcquisitionDate' => $citizenshipcertificateacquisitiondate);
                $data = json_encode($arrcitizenshipcertificate);
                $userId = get_userid($identificationNumber);
                /** Insert of Update into of_documentverify table */
                if(checkVerifyResult($identificationNumber, $rs) == 1){
                    update_identificationData($data, $identificationNumber, $rs, $userId);
                }elseif(checkVerifyResult($identificationNumber, $rs) == 2){
                    insert_identificationData($data, $identificationNumber, $rs, $userId);
                }else{
                    //do nothing
                }
            } /**
             * Current New Zealand Passport
             */
            elseif (strpos($rs, 'Current New Zealand Passport') !== false) {
                $nzpassportdateofbirth = $response['nzpassportdateofbirth'][2] . '-' . $response['nzpassportdateofbirth'][1] . '-' . $response['nzpassportdateofbirth'][0];
                $nzpassporttraveldocumentexpirydate = $response['nzpassporttraveldocumentexpirydate'][2] . '-' . $response['nzpassporttraveldocumentexpirydate'][1] . '-' . $response['nzpassporttraveldocumentexpirydate'][0];
                $nzpassportarr = array('FirstName' => $response['nzpassportfirstname'], 'LastName' => $response['nzpassportlastname'], 'DateOfBirth' => $nzpassportdateofbirth,
                    'TravelDocumentExpiryDate' => $nzpassporttraveldocumentexpirydate, 'TravelDocumentNumber' => $response['nzpassporttraveldocumentnumber']);
                $data = json_encode($nzpassportarr);
                $userId = get_userid($identificationNumber);
                /** Insert of Update into of_documentverify table */
                if(checkVerifyResult($identificationNumber, $rs) == 1){
                    update_identificationData($data, $identificationNumber, $rs, $userId);
                }elseif(checkVerifyResult($identificationNumber, $rs) == 2){
                    insert_identificationData($data, $identificationNumber, $rs, $userId);
                }else{
                    //do nothing
                }
            } /**
             * Australian Birth Certificate (not Birth Extract)
             */
            elseif (strpos($rs, 'Australian Birth Certificate (not Birth Extract)') !== false) {
                if ($response['birthcertificateregistrationstate'] == 'TAS' || $response['birthcertificateregistrationstate'] == 'QLD') {
                    $birthcertificateregistrationdate = $response['birthcertificateregistrationdate'][2] . '-' . $response['birthcertificateregistrationdate'][1] . '-' . $response['birthcertificateregistrationdate'][0];
                    $birthcertificatereRegistrationYear = $response['birthcertificateregistrationdate'][2];
                    $birthcertificateCertificateNumber = $response['birthcertificatecertificatenumber'];
                } elseif ($response['birthcertificateregistrationstate'] == 'VIC') {
                    $birthcertificatereRegistrationYear = $response['birthcertificateregistrationyear'];
                    $birthcertificateregistrationdate = null;
                    $birthcertificateCertificateNumber = null;
                } elseif ($response['birthcertificateregistrationstate'] != 'VIC') {
                    $birthcertificatereRegistrationYear = null;
                    $birthcertificateregistrationdate = null;
                    $birthcertificateCertificateNumber = $response['birthcertificatecertificatenumber'];
                }
                $birthcertificatebirthdate = $response['birthcertificatebirthdate'][2] . '-' . $response['birthcertificatebirthdate'][1] . '-' . $response['birthcertificatebirthdate'][0];
                $birthCertificatearr = array('BirthDate' => $birthcertificatebirthdate, 'GivenName' => $response['birthcertificategivenname'],
                    'FamilyName' => $response['birthcertificatefamilyname'], 'RegistrationState' => $response['birthcertificateregistrationstate'],
                    'RegistrationNumber' => $response['birthcertificateregistrationnumber'], 'RegistrationDate' => $birthcertificateregistrationdate,
                    'RegistrationYear' => $birthcertificatereRegistrationYear, 'CertificateNumber' => $birthcertificateCertificateNumber);
                $data = json_encode($birthCertificatearr);
                $userId = get_userid($identificationNumber);
                /** Insert of Update into of_documentverify table */
                if(checkVerifyResult($identificationNumber, $rs) == 1){
                    update_identificationData($data, $identificationNumber, $rs, $userId);
                }elseif(checkVerifyResult($identificationNumber, $rs) == 2){
                    insert_identificationData($data, $identificationNumber, $rs, $userId);
                }else{
                    //do nothing
                }
            } /**
             * Current Green Medicare
             */
            elseif (strpos($rs, 'Current green Medicare card') !== false) {
                $medicarebirthdate = $response['medicarebirthdate'][2] . '-' . $response['medicarebirthdate'][1] . '-' . $response['medicarebirthdate'][0];
                $medicarecardexpiry = $response['medicarecardexpiryyear'] . '-' . $response['medicarecardexpirymonth'];
                if ($response['medicarehowmanylines'] == 1) {
                    $medicarefullname1 = $response['medicarefullname1'];
                    $medicarefullname2 = null;
                    $medicarefullname3 = null;
                    $medicarefullname4 = null;
                } elseif ($response['medicarehowmanylines'] == 2) {
                    $medicarefullname1 = $response['medicarefullname1'];
                    $medicarefullname2 = $response['medicarefullname2'];
                    $medicarefullname3 = null;
                    $medicarefullname4 = null;
                } elseif ($response['medicarehowmanylines'] == 3) {
                    $medicarefullname1 = $response['medicarefullname1'];
                    $medicarefullname2 = $response['medicarefullname2'];
                    $medicarefullname3 = $response['medicarefullname3'];
                    $medicarefullname4 = null;
                } elseif ($response['medicarehowmanylines'] == 4) {
                    $medicarefullname1 = $response['medicarefullname1'];
                    $medicarefullname2 = $response['medicarefullname2'];
                    $medicarefullname3 = $response['medicarefullname3'];
                    $medicarefullname4 = $response['medicarefullname4'];
                }
                $medicarearr = array('BirthDate' => $medicarebirthdate, 'CardExpiry' => $medicarecardexpiry, 'CardNumber' => $response['medicarecardnumber'],
                    'CardType' => 'G', 'FullName1' => $medicarefullname1, 'FullName2' => $medicarefullname2,
                    'FullName3' => $medicarefullname3, 'FullName4' => $medicarefullname4, 'IndividualReferenceNumber' => $response['medicareindividualreferencenumber']);
                $data = json_encode($medicarearr);
                $userId = get_userid($identificationNumber);
               // echo $data;
                /** Insert of Update into of_documentverify table */

                if(checkVerifyResult($identificationNumber, $rs) == 1){
                    update_identificationData($data, $identificationNumber, $rs, $userId);
                }elseif(checkVerifyResult($identificationNumber, $rs) == 2){
                    insert_identificationData($data, $identificationNumber, $rs, $userId);
                }else{
                    //do nothing
                }
            } /**
             * Visa Approval Notification and Foreign Passport
             */
            elseif (strpos($rs, 'Visa Approval Notification and Foreign Passport') !== false) {
                $PrVisaBirthDate = $response['PrVisaBirthDate'][2] . '-' . $response['PrVisaBirthDate'][1] . '-' . $response['PrVisaBirthDate'][0];
                //$prvisaGrantNumber = $response['prvisa'];
                //$prvisaprexpirydate = $response['prexpirydate'][2] . '-' . $response['prexpirydate'][1] . '-' . $response['prexpirydate'][0];
                $prvisa = array("BirthDate" => $PrVisaBirthDate, "GivenName" => $response['prgivenname'], "FamilyName" => $response['prfamilyname'],
                    "PassportNumber" => $response['prpassportnumber'], "CountryOfIssue" => $response['prcountryissued']);
                $data = json_encode($prvisa);
                $userId = get_userid($identificationNumber);
                if(checkVerifyResult($identificationNumber, $rs) == 1){
                    update_identificationData($data, $identificationNumber, $rs, $userId);
                }elseif(checkVerifyResult($identificationNumber, $rs) == 2){
                    insert_identificationData($data, $identificationNumber, $rs, $userId);
                }else{
                    //do nothing
                }
                /** Insert of Update into of_documentverify table */
             // insert_identificationData($data, $identificationNumber, $rs, $userId);
            } /**
             * Visa Approval Notification and  ImmiCard
             */
            elseif (strpos($rs, 'ImmiCard') !== false) {
                $immibirthdate = $response['immibirthdate'][2] . '-' . $response['immibirthdate'][1] . '-' . $response['immibirthdate'][0];
                $immiArr = array("BirthDate" => $immibirthdate, "GivenName" => $response['immigivenname'],
                    "FamilyName" => $response['immifamilyname'], "ImmiCardNumber" => $response['immicardnumber']);
                $data = json_encode($immiArr);
                $userId = get_userid($identificationNumber);
                /** Insert of Update into of_documentverify table */
                if(checkVerifyResult($identificationNumber, $rs) == 1){
                    update_identificationData($data, $identificationNumber, $rs, $userId);
                }elseif(checkVerifyResult($identificationNumber, $rs) == 2){
                    insert_identificationData($data, $identificationNumber, $rs, $userId);
                }else{
                    //do nothing
                }
            }
        }
    }
    /**
     * Section B Documents
     */
    if (strpos($response['identificationdocumentb'][0], 'Current Driving License or Learner Permit') !== false) {

        $documentid = $response['identificationdocumentb'][0];
        $drivinglicensebirthdate = $response['drivinglicensebirthdate'][2] . '-' . $response['drivinglicensebirthdate'][1] . '-' . $response['drivinglicensebirthdate'][0];
        $drivingArr = array("BirthDate" => $drivinglicensebirthdate, "GivenName" => $response['drivinglicensegivenname'], "FamilyName" => $response['drivinglicensefamilyname'],
            "LicenceNumber" => $response['licensepermitnumber174'], "StateOfIssue" => $response['drivinglicensestateofissue']);
        $data2 = json_encode($drivingArr);
        $userId = get_userid($identificationNumber);
        /** Insert of Update into of_documentverify table */
     /* print_r($response['identificationdocumentb'][0]);*/
        if(checkVerifyResult($identificationNumber, $documentid) == 1){

            update_identificationData($data2, $identificationNumber, $documentid, $userId);
        }
        elseif(checkVerifyResult($identificationNumber, $documentid) == 2){

            insert_identificationData($data2, $identificationNumber, $documentid, $userId);
        }else{
            //do nothing
        }
    }
    /**************************************************************
     ******************** Document Uploaded ***********************
     **************************************************************/
}

/**
 * @param $std_id
 * @param $type
 * @return int|string
 */
function checkVerifyResult($std_id, $type){
    global $pdo;
    try {
        $query = "SELECT * FROM of_documentVerify WHERE std_id =:userID AND documentId =:type";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('userID',  $std_id, PDO::PARAM_STR);
        $stmt->bindParam('type',  $type, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row){
            if($row['status'] == 'Y') {
                return 0;
            }else{
                return 1;
            }
        }else{
            return 2;
        }
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


/***
 * @param $std_id
 * @param $id
 */
function check_for_record($std_id,$id){

    global $pdo;
    $query = "SELECT * FROM `of_enrolment` where usrid=:usrid";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam('usrid', $id, PDO::PARAM_STR);
    $stmt->execute();
    $row  = $stmt->fetch(PDO::FETCH_ASSOC);
    // $result = get_studentDetails($std_id);

    if($row==NULL || empty($row) ){
        $query = "INSERT INTO `of_enrolment`( `usrid`, `enrolForm`, `skillForm`, `usiForm`, `documentForm`, `ptrForm`, `llnForm`) VALUES (:userid,:stdid, NULL,NULL,NULL,NULL,NULL,NULL)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('userid', $id, PDO::PARAM_STR);
        $stmt->bindParam('stdid', $std_id, PDO::PARAM_STR);
        //$stmt->bindParam('std_id', $uqid, PDO::PARAM_STR);
        $stmt->execute();
    }
}

//GET USER ID USING uqid
function get_user_id($std_id,$email){

    global $pdo;
    $query2 = "SELECT * FROM user where uqid=:uqid OR email=:email";
    $stmt2 = $pdo->prepare($query2);
    $stmt2->bindParam('uqid', $std_id, PDO::PARAM_STR);
    $stmt2->bindParam('email', $email, PDO::PARAM_STR);
    $stmt2->execute();
    $row   = $stmt2->fetch(PDO::FETCH_ASSOC);
    return $row['id'];
}

/** Edited By Inam 12/11/2021 */
/** Send SMS to coordinator once USI form is submitted */
function send_usiCompletionSMS($std_id){
    global $url;
    $result = get_studentDetails($std_id);
    $txt  = 'A student has now completed Enrolment, Document and USI forms. The student details are:
Student ID: '.$std_id.'
Full Name: '.$result['firstname'].' '.$result['lastname'].'
Email Address: '.$result['email'].'
Please go to '.$url.'/index.php?page=20&userid='.$result['id'].' to check student submissions.
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
    // echo $response;
}

/** Return the specific user detail */
function get_studentDetails($std_id){
    global $pdo;
    try {
        $query = "SELECT * FROM `user` WHERE uqid = :stdid ";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('stdid',  $std_id, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

/**
 * Send mail to coordinator on completion of forms
 */
/** Edited By Inam 15/11/2021 */
function send_formcompletion_mail_tocoordinator($std_id, $formID){
    global $pdo, $url, $enrolmentForm, $usiForm, $skillForm, $documentForm, $usitransForm,$seclln;
    $query2 = "select * from user WHERE uqid=:userID";
    $stmt2 = $pdo->prepare($query2);
    $stmt2->bindParam('userID',  $std_id, PDO::PARAM_STR);
    $stmt2->execute();
    $row2   = $stmt2->fetch(PDO::FETCH_ASSOC);
    $name = $row2['firstname']." ".$row2['lastname'];
    $email = $row2['email'];
    $to = $email;
    if($formID == $enrolmentForm){
        $subject = "[Optimistic Futures]Enrolment Form Submission";
        $txt  = '<html><body>';
        $txt .= '<h1 style="font-size:18px;">Hi '.$name.',</h1>';
        $txt .= '<p style="font-size:18px;">You have successfully submitted Enrolment form. Please go to <a href="'.$url.'">'.$url.'</a> and complete the remaining steps.</p>';
        $txt .= '<p style="font-size:18px;">Thank you</p>';
        $txt .= '<p style="font-size:18px;">Optimistic Futures Team</p>';
        $txt .= '</body></html>';
    }elseif ($formID == $usiForm || $formID == $usitransForm){
        $subject = "[Optimistic Futures]USI Form Submission";
        $txt  = '<html><body>';
        $txt .= '<h1 style="font-size:18px;">Hi '.$name.',</h1>';
        $txt .= '<p style="font-size:18px;">You have successfully submitted USI. Please go to <a href="'.$url.'">'.$url.'</a> and complete the remaining steps.</p>';
        $txt .= '<p style="font-size:18px;">Thank you</p>';
        $txt .= '<p style="font-size:18px;">Optimistic Futures Team</p>';
        $txt .= '</body></html>';
    }elseif ($formID == $skillForm){
        $subject = "[Optimistic Futures]Skill First Form Submission";
        $txt  = '<html><body>';
        $txt .= '<h1 style="font-size:18px;">Hi '.$name.',</h1>';
        $txt .= '<p style="font-size:18px;">You have successfully submitted Skill First Form. Please go to <a href="'.$url.'">'.$url.'</a> and complete the remaining steps.</p>';
        $txt .= '<p style="font-size:18px;">Thank you</p>';
        $txt .= '<p style="font-size:18px;">Optimistic Futures Team</p>';
        $txt .= '</body></html>';
    }elseif ($formID == $documentForm){
        $subject = "[Optimistic Futures]Document Submission";
        $txt  = '<html><body>';
        $txt .= '<h1 style="font-size:18px;">Hi '.$name.',</h1>';
        $txt .= '<p style="font-size:18px;">You have successfully submitted your identity documents. Please go to <a href="'.$url.'">'.$url.'</a> and complete the remaining steps.</p>';
        $txt .= '<p style="font-size:18px;">Thank you</p>';
        $txt .= '<p style="font-size:18px;">Optimistic Futures Team</p>';
        $txt .= '</body></html>';
    }elseif($formID == $seclln){
        $subject = "[Optimistic Futures]Security LLN Submission";
        $txt  = '<html><body>';
        $txt .= '<h1 style="font-size:18px;">Hi '.$name.',</h1>';
        $txt .= '<p style="font-size:18px;">You have successfully completed Security LLN. Our representative will contact you soon.</p>';
        $txt .= '<p style="font-size:18px;">Thank you</p>';
        $txt .= '<p style="font-size:18px;">Optimistic Futures Team</p>';
        $txt .= '</body></html>';
    }else{
        $subject = "[Optimistic Futures]Enrolment Received";
        $txt  = '<html><body>';
        $txt .= '<h1 style="font-size:18px;">Hi '.$name.',</h1>';
        $txt .= '<p style="font-size:18px;">Your submission has been received. If you have already completed all steps then wait for our representative to contact you.</p>';
        $txt .= '<p style="font-size:18px;">Thank you</p>';
        $txt .= '<p style="font-size:18px;">Optimistic Futures Team</p>';
        $txt .= '</body></html>';
    }
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: addmissions@of.edu.au. \r\n";
    mail($to,$subject,$txt,$headers);
}