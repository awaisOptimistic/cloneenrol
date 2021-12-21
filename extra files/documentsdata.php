<?php
include "lib/apilib.php";
include "config.php";
if ($_GET['document'] == 'identification') {
    global $pdo;
    $data = json_encode($_POST);
    $sql = "UPDATE `of_enrolment` SET `documentForm`= ? WHERE std_id = ?";
    $stmt= $pdo->prepare($sql);
    $result = $stmt->execute([$data,$_POST['identificationnumber'] ]);

    $submissionid = $_POST['submission_id'];
    $formid = $_POST['formID'];
    $identificationNumber = $_POST['identificationnumber'];
    $email = $_POST['email'];

    /**
     * User is Not Australian Resident
     */
    if ($_POST['ruaussie'] == 'No') {
        $sectionResident = $_POST['sectionnonresident'][0];
        $Doc1Type = $_POST['sectionnonresident'][0];
        if (isset($_POST['bvptype'])) {
            $bvpDate = $_POST['bvpexpirydate'][0] . '-' . $_POST['bvpexpirydate'][1] . '-' . $_POST['bvpexpirydate'][2];
            $arrBVP = array('bvptype' => $_POST['bvptype'], 'bvpgrantnumber' => $_POST['bvpgrantnumber'], 'bvppassportnumber' => $_POST['bvppassportnumber'],
                'bvpexpirydate' => $bvpDate, 'bvpfamilyname' => $_POST['bvpfamilyname'], 'bvpgivenname' => $_POST['bvpgivenname'], 'bvpnationality' => $_POST['bvpnationality'],
                'bvpcountryissued' => $_POST['bvpcountryissued']);
            $data = json_encode($arrBVP);
            /*$userId = get_userid($identificationNumber);
            insert_identificationData($data, $identificationNumber, $formid, $submissionid, $Doc1Type,$userId);
            echo json_encode($arrBVP);*/

        } else {
            $avpDate = $_POST['avpexpirydate'][0] . '-' . $_POST['avpexpirydate'][1] . '-' . $_POST['avpexpirydate'][2];
            $arrAVP = array('avpvisatype' => $_POST['avpvisatype'], 'avpgrantnumber' => $_POST['avpgrantnumber'], 'avppassportnumber' => $_POST['avppassportnumber'],
                'avpexpirydate' => $avpDate, 'avpfamilyname' => $_POST['avpfamilyname'], 'avpgivenname' => $_POST['avpgivenname'], 'avpnationality' => $_POST['avpnationality'],
                'avpcountry' => $_POST['avpcountry']);
            $data = json_encode($arrAVP);
            /* $userId = get_userid($identificationNumber);
             insert_identificationData($userId, $data,$identificationNumber, $formid,$submissionid, $Doc1Type, $userId);
            echo json_encode($arrAVP); */
        }
    } /**
     * User is Australian Resident
     */
    else {
        $Doc2Type = $_POST['sectionaprholder'][0];//basically doc1
        /**
         * Current Australian Passport/
         */
        if (strpos($Doc2Type, 'Current Australian Passport') !== false) {

            if ($_POST['australianpassportgender'] == 'MALE' || $_POST['australianpassportgender'] == 'Male') {
                $gender = 'M';
            } elseif ($_POST['australianpassportgender'] == 'FEMALE' || $_POST['australianpassportgender'] == 'Female') {
                $gender = 'F';
            } else {
                $gender = $_POST['australianpassportgender'];
            }


            $australianpassportbirthdate = $_POST['australianpassportbirthdate'][2] . '-' . $_POST['australianpassportbirthdate'][1] . '-' . $_POST['australianpassportbirthdate'][0];
            $australianpassportexpirydate = $_POST['australianpassportexpirydate'][2] . '-' . $_POST['australianpassportexpirydate'][1] . '-' . $_POST['australianpassportexpirydate'][0];
            $arrPassport = array('BirthDate' => $australianpassportbirthdate, 'GivenName' => $_POST['australianpassportgivenname'], 'MiddleName' => $_POST['australianpassportmiddlename'],
                'FamilyName' => $_POST['australianpassportfamilyname'], 'TravelDocumentNumber' => $_POST['australianpassporttraveldocumentnumber'],
                'Gender' => $gender, 'ExpiryDate' => $australianpassportexpirydate);
            $data = json_encode($arrPassport);
            $userId = get_userid($identificationNumber);
            insert_identificationData($data, $identificationNumber, $formid, $submissionid, $Doc2Type, $userId);

        }
        /**
         * Australian Citizenship Certificate
         */
        elseif (strpos($Doc2Type, 'Australian Citizenship Certificate') !== false) {
            $citizenshipcertificatebirthdate = $_POST['citizenshipcertificatebirthdate'][2] . '-' . $_POST['citizenshipcertificatebirthdate'][1] . '-' . $_POST['citizenshipcertificatebirthdate'][0];
            $citizenshipcertificateacquisitiondate = $_POST['citizenshipcertificateacquisitiondate'][2] . '-' . $_POST['citizenshipcertificateacquisitiondate'][1] . '-' . $_POST['citizenshipcertificateacquisitiondate'][0];
            $arrcitizenshipcertificate = array('BirthDate' => $citizenshipcertificatebirthdate, 'GivenName' => $_POST['citizenshipcertificategivenname'],
                'MiddleName' => $_POST['citizenshipcertificatemiddlename'],
                'FamilyName' => $_POST['citizenshipcertificatefamilyname'], 'StockNumber' => $_POST['citizenshipcertificatestocknumber'],
                'AcquisitionDate' => $citizenshipcertificateacquisitiondate);
            $data = json_encode($arrcitizenshipcertificate);
            $userId = get_userid($identificationNumber);
            insert_identificationData($data, $identificationNumber, $formid, $submissionid, $Doc2Type, $userId);

        }
        /**
         * Current New Zealand Passport
         */
        elseif (strpos($Doc2Type, 'Current New Zealand Passport') !== false) {
            $nzpassportdateofbirth = $_POST['nzpassportdateofbirth'][2] . '-' . $_POST['nzpassportdateofbirth'][1] . '-' . $_POST['nzpassportdateofbirth'][0];
            $nzpassporttraveldocumentexpirydate = $_POST['nzpassporttraveldocumentexpirydate'][2] . '-' . $_POST['nzpassporttraveldocumentexpirydate'][1] . '-' . $_POST['nzpassporttraveldocumentexpirydate'][0];
            $nzpassportarr = array('FirstName' => $_POST['nzpassportfirstname'], 'LastName' => $_POST['nzpassportlastname'], 'DateOfBirth' => $nzpassportdateofbirth,
                'TravelDocumentExpiryDate' => $nzpassporttraveldocumentexpirydate, 'TravelDocumentNumber' => $_POST['nzpassporttraveldocumentnumber']);
            $data = json_encode($nzpassportarr);
            $userId = get_userid($identificationNumber);
            insert_identificationData($data, $identificationNumber, $formid, $submissionid, $Doc2Type, $userId);
        }
        /**
         * Australian Birth Certificate (not Birth Extract)
         */
        elseif (strpos($Doc2Type, 'Australian Birth Certificate (not Birth Extract)') !== false) {
            if ($_POST['birthcertificateregistrationstate'] == 'TAS' || $_POST['birthcertificateregistrationstate'] == 'QLD') {
                $birthcertificateregistrationdate = $_POST['birthcertificateregistrationdate'][2] . '-' . $_POST['birthcertificateregistrationdate'][1] . '-' . $_POST['birthcertificateregistrationdate'][0];
                $birthcertificatereRegistrationYear = $_POST['birthcertificateregistrationdate'][2];
                $birthcertificateCertificateNumber = $_POST['birthcertificatecertificatenumber'];
            } elseif ($_POST['birthcertificateregistrationstate'] == 'VIC') {
                $birthcertificatereRegistrationYear = $_POST['birthcertificateregistrationyear'];
                $birthcertificateregistrationdate = null;
                $birthcertificateCertificateNumber = null;
            } elseif ($_POST['birthcertificateregistrationstate'] != 'VIC') {
                $birthcertificatereRegistrationYear = null;
                $birthcertificateregistrationdate = null;
                $birthcertificateCertificateNumber = $_POST['birthcertificatecertificatenumber'];
            }
            $birthcertificatebirthdate = $_POST['birthcertificatebirthdate'][2] . '-' . $_POST['birthcertificatebirthdate'][1] . '-' . $_POST['birthcertificatebirthdate'][0];
            $birthCertificatearr = array('BirthDate' => $birthcertificatebirthdate, 'GivenName' => $_POST['birthcertificategivenname'],
                'FamilyName' => $_POST['birthcertificatefamilyname'], 'RegistrationState' => $_POST['birthcertificateregistrationstate'],
                'RegistrationNumber' => $_POST['birthcertificateregistrationnumber'], 'RegistrationDate' => $birthcertificateregistrationdate,
                'RegistrationYear' => $birthcertificatereRegistrationYear, 'CertificateNumber' => $birthcertificateCertificateNumber);
            $data = json_encode($birthCertificatearr);
            $userId = get_userid($identificationNumber);
            insert_identificationData($data, $identificationNumber, $formid, $submissionid, $Doc2Type, $userId);
        }
        /**
         * Current Green Medicare
         */
        elseif (strpos($Doc2Type, 'Current green Medicare card') !== false) {
            $medicarebirthdate = $_POST['medicarebirthdate'][2] . '-' . $_POST['medicarebirthdate'][1] . '-' . $_POST['medicarebirthdate'][0];
            $medicarecardexpiry = $_POST['medicarecardexpiryyear'] . '-' . $_POST['medicarecardexpirymonth'];
            if ($_POST['medicarehowmanylines'] == 1) {
                $medicarefullname1 = $_POST['medicarefullname1'];
                $medicarefullname2 = null;
                $medicarefullname3 = null;
                $medicarefullname4 = null;
            } elseif ($_POST['medicarehowmanylines'] == 2) {
                $medicarefullname1 = $_POST['medicarefullname1'];
                $medicarefullname2 = $_POST['medicarefullname2'];
                $medicarefullname3 = null;
                $medicarefullname4 = null;
            } elseif ($_POST['medicarehowmanylines'] == 3) {
                $medicarefullname1 = $_POST['medicarefullname1'];
                $medicarefullname2 = $_POST['medicarefullname2'];
                $medicarefullname3 = $_POST['medicarefullname3'];
                $medicarefullname4 = null;
            } elseif ($_POST['medicarehowmanylines'] == 4) {
                $medicarefullname1 = $_POST['medicarefullname1'];
                $medicarefullname2 = $_POST['medicarefullname2'];
                $medicarefullname3 = $_POST['medicarefullname3'];
                $medicarefullname4 = $_POST['medicarefullname4'];
            }
            $medicarearr = array('BirthDate' => $medicarebirthdate, 'CardExpiry' => $medicarecardexpiry, 'CardNumber' => $_POST['medicarecardnumber'],
                'CardType' => $_POST['medicarecardtype'], 'FullName1' => $medicarefullname1, 'FullName2' => $medicarefullname2,
                'FullName3' => $medicarefullname3, 'FullName4' => $medicarefullname4, 'IndividualReferenceNumber' => $_POST['medicareindividualreferencenumber']);
            $data = json_encode($medicarearr);
            $userId = get_userid($identificationNumber);
            insert_identificationData($data, $identificationNumber, $formid, $submissionid, $Doc2Type, $userId);
        }
        /**
         * Visa Approval Notification and Foreign Passport
         */
        elseif (strpos($Doc2Type, 'Visa Approval Notification and Foreign Passport') !== false) {
            $PrVisaBirthDate = $_POST['$PrVisaBirthDate'][2] . '-' . $_POST['$PrVisaBirthDate'][1] . '-' . $_POST['$PrVisaBirthDate'][0];
            $prvisaGrantNumber = $_POST['prvisa'];
            $prvisaprexpirydate = $_POST['prexpirydate'][2] . '-' . $_POST['prexpirydate'][1] . '-' . $_POST['prexpirydate'][0];
            $prvisa = array("BirthDate" => $PrVisaBirthDate, "GivenName" => $_POST['prgivenname'], "MiddleName" => $_POST['prMiddleName'], "FamilyName" => $_POST['prfamilyname'],
                "PassportNumber" => $_POST['prpassportnumber'], "CountryOfIssue" => $_POST['prcountryissued']);
            $data = json_encode($prvisa);
            $userId = get_userid($identificationNumber);
            insert_identificationData($data, $identificationNumber, $formid, $submissionid, $Doc2Type, $userId);
        }
        /**
         * Visa Approval Notification and  ImmiCard
         */
        elseif (strpos($Doc2Type, 'ImmiCard') !== false) {
            $immibirthdate = $_POST['immibirthdate'][2] . '-' . $_POST['immibirthdate'][1] . '-' . $_POST['immibirthdate'][0];
            $immiArr = array("BirthDate" => $immibirthdate, "GivenName" => $_POST['immigivenname'], "MiddleName" => $_POST['immimiddlename'],
                "FamilyName" => $_POST['immifamilyname'], "ImmiCardNumber" => $_POST['immicardnumber']);
            $data = json_encode($immiArr);
            $userId = get_userid($identificationNumber);
            insert_identificationData($data, $identificationNumber, $formid, $submissionid, $Doc2Type, $userId);
        }
    }
    /**
     * Section B Documents
     */
    if (strpos($_POST['sectionbphotodocument'], 'Current Driving License or Learner Permit') !== false) {
        $drivinglicensebirthdate = $_POST['drivinglicensebirthdate'][2] . '-' . $_POST['drivinglicensebirthdate'][1] . '-' . $_POST['drivinglicensebirthdate'][0];
        $drivingArr = array("BirthDate" => $drivinglicensebirthdate, "GivenName" => $_POST['drivinglicensegivenname'],
            "FamilyName" => $_POST['drivinglicensefamilyname'], "LicenceNumber" => $_POST['licensepermitnumber174'],
            "StateOfIssue" => $_POST['drivinglicensestateofissue']);
        $data2 = json_encode($drivingArr);
        $userId = get_userid($identificationNumber);
        insert_identificationData($data2, $identificationNumber, $formid, $submissionid, $_POST['sectionbphotodocument'][0], $userId);
        //get_driverLicence($data2);
    }

    header("location: /index.php");
}
elseif ($_GET['document'] == 'identification') {


}