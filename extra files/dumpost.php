<?php
session_start();
include('lib.php');

print_r('<pre>');
print_r($_POST);

//print_r($value);
print_r('</pre>');
$std_id = $_POST["identificationnumber"];
$formid = $_POST["formID"];
$submissionid = $_POST["submission_id"];


//$usrid = $_SESSION['userid'];
$usrid = 13;


$value = json_encode($_POST);
echo $usrid;

insert_identificaiton($usrid,$std_id,$formid,$submissionid,$value);




























































//include('lib.php');
//session_start();
/*print_r('<pre>');
$value = json_encode($_POST);
print_r($value);
print_r('</pre>');*/

/*echo $_SESSION['userid'];*/
/*echo "<br>";
echo $_POST["formID"];
echo "<br>";
echo $_POST["submission_id"];
echo "<br>";
echo $_POST["ip"];
echo "<br>";
echo $_POST["std_id"];
echo "<br>";*/
/*
$UserSubmissions = array();
$Personal = array();
$Demographics = array();
$NextOfKin = array();
$Qualification = array();
$OtherDetails = array();*/


/**  UserSubmissions **/
/*$UserSubmissions['FormID'] = $_POST["formID"];
$UserSubmissions['SubmissionID'] = $_POST["submission_id"];
$UserSubmissions['Ip'] = $_POST["ip"];
$UserSubmissions['UserId'] = $_POST["std_id"];*/
/**  EndUserSubmissions **/

/**  Personal **/
/*$Personal['IsActive'] = true;
$Personal['Title'] = $_POST['title'];
$Personal['FirstName'] = $_POST['firstname'];
$Personal['MiddleName'] = $_POST['middlename'];
$Personal['LastName'] = $_POST['lastname'];
$Personal['DateOfBirth'] =implode("/",$_POST['dob']) ;
$Personal['GenderId'] = implode("",$_POST['genderdetails']);
$Personal['UniqueStudentIdentifier'] = $_POST['usi'];
if($value['vsnconfirmation'] != 'No'){
    $Personal['VictorianStudentNumber'] = $_POST['vsn'];
}
else {$Personal['VictorianStudentNumber'] = '888888888';
}
$Personal['LearnerAlt1Number'] = $_POST['std_id'];
$Personal['SyncToSugarCrm'] = true;
$Personal['SyncToXero'] = false;
$Personal['EmailAddresses']['Email'] = $_POST['email'];*/
/**  PhoneNumbers **/
/*$Personal['PhoneNumbers']['PhoneHome'] =  $_POST['homePhone'];
$Personal['PhoneNumbers'] ['Mobile'] = $_POST['mobile'];
$Personal['PhoneNumbers']['FaxHome'] = $_POST['fax'];*/
/**  End PhoneNumbers **/
/** StreetAddress , PostalAddress, PermanentAddress **/
/*$Personal['StreetAddress']['StreetName'] = $_POST['residentialaddress'];
$Personal['StreetAddress']['SuburbTownCity'] = $_POST['suburbtown'];
$Personal['StreetAddress']['StateId'] = $_POST['state'];
$Personal['StreetAddress']['Postcode'] = $_POST['postcode'];
$Personal['StreetAddress']['CountryId'] = 83;*/
/** End StreetAddress , PostalAddress, PermanentAddress **/
/** StreetAddress , PostalAddress, PermanentAddress **/
/*$Personal['PostalAddress']['StreetName'] = $_POST['postalAddress'];*/
/** End StreetAddress , PostalAddress, PermanentAddress **/
/** StreetAddress , PostalAddress, PermanentAddress **/
/*$Personal['PermanentAddress']['StreetName'] = $_POST['residentialaddress'];
$Personal['PermanentAddress']['SuburbTownCity'] = $_POST['suburbtown'];
$Personal['PermanentAddress']['StateId'] = $_POST['state'];
$Personal['PermanentAddress']['Postcode'] = $_POST['postcode'];
$Personal['PermanentAddress']['CountryId'] = 83;*/
/** End StreetAddress , PostalAddress, PermanentAddress **/
/*$Personal['HealthcareNumber'] = $_POST['concessionCard'];
$Personal['HealthcareExpiryDate'] = $_POST['concessionExpiry'];*/
/** End Personal **/

/**  Demographics **/
/*$Demographics['EmploymentStatusId'] = $_POST['employmentstatus'];
$Demographics['OccupationIdentifierId'] = $_POST['employmentrole'];
$Demographics['IndustryOfEmploymentId'] = $_POST['employmentsector'];
$Demographics['HighestSchoolLevelCompletedId'] = $_POST['schoolinglevel'];
$Demographics['HighestSchoolLevelCompletedYear'] = $_POST['schoolinglevelyear'];
$Demographics['IsStillAtSchool'] = get_schoolStatus($_POST['schoolingstatus']);
$Demographics['PrimaryLanguageId'] = $_POST['speakenglish'];
$Demographics['SpokenEnglishProficiencyId'] = $_POST['speakstatus'];
$Demographics['IndigenousStatusId'] = $_POST['tsiorigin'];
$Demographics['CountryOfBirthId'] = $_POST['birthcountry'];
$Demographics['DisabilityFlagId'] = $_POST['disability'];
$Demographics["DisabilityIds"][] = $_POST['disabilitycondition'];
//$Demographics["PriorEducationAchievements"][] = get_previousEducation($_POST['qualificationName'], $_POST['qualificationType']);
$Demographics["QualificationStatus"] = $_POST['qualificationstatus'];
$Demographics["PriorEducationAchievements"][] = $_POST['previousqualification'];*/
/**  End Demographics **/

/**  NextOfKinRelationships **/
/*$NextOfKin['LocalNextOfKin']['RelationshipId'] = $_POST['relationship'];
$NextOfKin['LocalNextOfKin']['PhoneHome'] = $_POST['relationhomeNumber'];
$NextOfKin['LocalNextOfKin']['Mobile'] = $_POST['relationmobile'];*/
/**  End NextOfKinRelationships **/
/*$NextOfKin['LocalNextOfKin']['FirstName'] = $_POST['relationname'];

$Qualification['ModeOfStudy'] = $_POST['modeofstudy'];
$Qualification['QualificationName'] = $_POST['qualification'];
$Qualification['QualificationFeeType'] = $_POST['qualificationfeetype'];
$Qualification['ShortCourses'] = $_POST['shortcourses'];
$Qualification['ShortcourseFeeType'] = $_POST['shortcoursfeetype'];
$Qualification['StudyReason'] = $_POST['studyreason'];

print_r('<pre>');
print_r($UserSubmissions);
print_r($Personal);
print_r($Demographics);
print_r($NextOfKin);
print_r($Qualification);

print_r('</pre>');*/


