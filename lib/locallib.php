<?php

function get_wisenetGender($log1){
    global $pdo;
    try {
        $query = "SELECT * FROM `wt_gender` WHERE GenderId = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id',  $log1, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['Description'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function get_wisenetState($log1){
    global $pdo;
    try {
        $query = "SELECT * FROM `wt_states` WHERE StateId = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id',  $log1, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['ShortDescription'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


function get_wisenetRelation($log1){
    global $pdo;
    try {
        $query = "SELECT * FROM `wt_NextOfKinRelationships` WHERE NextOfKinRelationshipId = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id',  $log1, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['Description'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function get_wisenetEmploymentstatus($log1){
    global $pdo;
    try {
        $query = "SELECT * FROM `wt_EmploymentStatuses` WHERE EmploymentStatusId = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id',  $log1, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['Description'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


function get_wisenetEmploymentrole($log1){
    global $pdo;
    try {
        $query = "SELECT * FROM `wt_OccupationIdentifiers` WHERE OccupationIdentifierId = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id',  $log1, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['Description'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


function get_wisenetEmploymentsector($log1){
    global $pdo;
    try {
        $query = "SELECT * FROM `wt_IndustriesOfEmployment` WHERE IndustryOfEmploymentId = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id',  $log1, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['Description'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


function get_wisenetCountry($log1){
    global $pdo;
    try {
        $query = "SELECT * FROM `wt_Countries` WHERE CountryId = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id',  $log1, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['Description'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


function get_wisenetLanguage($log1){
    global $pdo;
    try {
        $query = "SELECT * FROM `wt_Languages` WHERE LanguageId = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id',  $log1, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['Description'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function get_wisenetSpeakstatus($log1){
    global $pdo;
    try {
        $query = "SELECT * FROM `wt_SpokenEnglishProficiencies` WHERE SpokenEnglishProficiencyId = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id',  $log1, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['Description'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


function get_wisenetTSIorigin($log1){
    global $pdo;
    try {
        $query = "SELECT * FROM `wt_FhIndigenousStatuses` WHERE FhIndigenousStatusId = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id',  $log1, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['Description'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


function get_wisenetDisabilityflag($log1){
    global $pdo;
    try {
        $query = "SELECT * FROM `wt_DisabilityFlags` WHERE DisabilityFlagId = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id',  $log1, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['Description'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function get_wisenetQualificationtype($log1){
    global $pdo;
    try {
        $query = "SELECT * FROM `wt_Disabilities` WHERE DisabilityId = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id',  $log1, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['Description'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function get_wisenetSchoolinglevel($log1){
    global $pdo;
    try {
        $query = "SELECT * FROM `wt_HighestSchoolLevelCompleted` WHERE HighestSchoolLevelCompletedId = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id',  $log1, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['Description'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

function get_wisenetQualificationname($log1){
    global $pdo;
    try {
        $query = "SELECT * FROM `wt_PriorEducations` WHERE PriorEducationId = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id',  $log1, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['Description'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


function get_wisenetDisabilities($log1){
    global $pdo;
    try {
        $query = "SELECT * FROM `wt_PriorEducationTypes` WHERE PriorEducationTypeId = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('id',  $log1, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['Description'];
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}



/*function get_driverLicence(){

$data = '{
    "BirthDate": "1965-01-01",
    "GivenName": "john",
    "FamilyName": "smith",
    "LicenceNumber": "11111111",
    "StateOfIssue": "NSW"
}';

$api = '19cc6dccddf2fbced02d7a4ba088b4bb97d64d0bcaca3ffa0b6e75edd03480a8';
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
       "token: $api",
        'Content-Type: application/x-www-form-urlencoded'
    ),
));

$response = curl_exec($curl);
curl_close($curl);
echo $response;

}*/

/*
function get_wisenetGender($log1){
    $apikey = '5MpnVN5S1TkW6ucHoX2F8XEK0GmfrEA1Tgs0NZn6';
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.wisenet.co/v1/combos/genders',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            "X-Api-Key: $apikey"
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($response, TRUE);
    foreach($data as $value){
        foreach ($value as $log){
            if ($log['GenderId'] == $log1) {
                return $log['Description'];
            }
        }
    }
}

function get_wisenetState($log1){
    $apikey = '5MpnVN5S1TkW6ucHoX2F8XEK0GmfrEA1Tgs0NZn6';
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.wisenet.co/v1/combos/states',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            "X-Api-Key: $apikey"
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($response, TRUE);
    foreach($data as $value){
        foreach ($value as $log){
            if (!empty($log['StateId']) && $log['StateId'] == $log1) {
                return $log['ShortDescription'];
            }
        }
    }
}


function get_wisenetRelation($log1){
    $apikey = '5MpnVN5S1TkW6ucHoX2F8XEK0GmfrEA1Tgs0NZn6';
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.wisenet.co/v1/combos/next-of-kin-relationships',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            "X-Api-Key: $apikey"
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($response, TRUE);
    foreach($data as $value){
        foreach ($value as $log){
            if (!empty($log['NextOfKinRelationshipId']) && $log['NextOfKinRelationshipId'] == $log1) {
                return $log['Description'];
            }
        }
    }
}

function get_wisenetEmploymentstatus($log1){
    $apikey = '5MpnVN5S1TkW6ucHoX2F8XEK0GmfrEA1Tgs0NZn6';
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.wisenet.co/v1/combos/employment-statuses',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            "X-Api-Key: $apikey"
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($response, TRUE);
    foreach($data as $value){
        foreach ($value as $log){
            if (!empty($log['EmploymentStatusId']) && $log['EmploymentStatusId'] == $log1) {
                return $log['Description'];
            }
        }
    }
}


function get_wisenetEmploymentrole($log1){
    $apikey = '5MpnVN5S1TkW6ucHoX2F8XEK0GmfrEA1Tgs0NZn6';
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.wisenet.co/v1/combos/occupation-identifiers',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            "X-Api-Key: $apikey"
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($response, TRUE);
    foreach($data as $value){
        foreach ($value as $log){
            if (!empty($log['OccupationIdentifierId']) && $log['OccupationIdentifierId'] == $log1) {
                return $log['Description'];
            }
        }
    }
}


function get_wisenetEmploymentsector($log1){
    $apikey = '5MpnVN5S1TkW6ucHoX2F8XEK0GmfrEA1Tgs0NZn6';
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.wisenet.co/v1/combos/industries-of-employment',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            "X-Api-Key: $apikey"
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($response, TRUE);
    foreach($data as $value){
        foreach ($value as $log){
            if (!empty($log['IndustryOfEmploymentId']) && $log['IndustryOfEmploymentId'] == $log1) {
                return $log['Description'];
            }
        }
    }
}


function get_wisenetCountry($log1){
    $apikey = '5MpnVN5S1TkW6ucHoX2F8XEK0GmfrEA1Tgs0NZn6';
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
            "X-Api-Key: $apikey"
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($response, TRUE);
    foreach($data as $value){
        foreach ($value as $log){
            if (!empty($log['CountryId']) && $log['CountryId'] == $log1) {
                return $log['Description'];
            }
        }
    }
}


function get_wisenetLanguage($log1){
    $apikey = '5MpnVN5S1TkW6ucHoX2F8XEK0GmfrEA1Tgs0NZn6';
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
            "X-Api-Key: $apikey"
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($response, TRUE);
    foreach($data as $value){
        foreach ($value as $log){
            if (!empty($log['LanguageId']) && $log['LanguageId'] == $log1) {
                return $log['Description'];
            }
        }
    }
}

function get_wisenetSpeakstatus($log1){
    $apikey = '5MpnVN5S1TkW6ucHoX2F8XEK0GmfrEA1Tgs0NZn6';
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.wisenet.co/v1/combos/spoken-english-proficiencies',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            "X-Api-Key: $apikey"
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($response, TRUE);
    foreach($data as $value){
        foreach ($value as $log){
            if (!empty($log['SpokenEnglishProficiencyId']) && $log['SpokenEnglishProficiencyId'] == $log1) {
                return $log['Description'];
            }
        }
    }
}


function get_wisenetTSIorigin($log1){
    $apikey = '5MpnVN5S1TkW6ucHoX2F8XEK0GmfrEA1Tgs0NZn6';
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.wisenet.co/v1/combos/fh-indigenous-statuses',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            "X-Api-Key: $apikey"
        ),
    ));


    $response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($response, TRUE);
    foreach($data as $value){
        foreach ($value as $log){
            if (!empty($log['FhIndigenousStatusId']) && $log['FhIndigenousStatusId'] == $log1) {
                return $log['Description'];
            }
        }
    }
}


function get_wisenetDisabilityflag($log1){
    $apikey = '5MpnVN5S1TkW6ucHoX2F8XEK0GmfrEA1Tgs0NZn6';
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.wisenet.co/v1/combos/disability-flags',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            "X-Api-Key: $apikey"
        ),
    ));


    $response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($response, TRUE);
    foreach($data as $value){
        foreach ($value as $log){
            if (!empty($log['DisabilityFlagId']) && $log['DisabilityFlagId'] == $log1) {
                return $log['Description'];
            }
        }
    }
}

function get_wisenetQualificationtype($log1){
    $apikey = '5MpnVN5S1TkW6ucHoX2F8XEK0GmfrEA1Tgs0NZn6';
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.wisenet.co/v1/combos/prior-education-types',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            "X-Api-Key: $apikey"
        ),
    ));


    $response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($response, TRUE);
    foreach($data as $value){
        foreach ($value as $log){
            if (!empty($log['PriorEducationTypeId']) && $log['PriorEducationTypeId'] == $log1) {
                return $log['Description'];
            }
        }
    }
}

function get_wisenetSchoolinglevel($log1){
    $apikey = '5MpnVN5S1TkW6ucHoX2F8XEK0GmfrEA1Tgs0NZn6';
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.wisenet.co/v1/combos/highest-school-level-completed',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            "X-Api-Key: $apikey"
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($response, TRUE);
    foreach($data as $value){
        foreach ($value as $log){
            if (!empty($log['HighestSchoolLevelCompletedId']) && $log['HighestSchoolLevelCompletedId'] == $log1) {
                return $log['Description'];
            }
        }
    }
}

function get_wisenetQualificationname($log1){
    $apikey = '5MpnVN5S1TkW6ucHoX2F8XEK0GmfrEA1Tgs0NZn6';
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.wisenet.co/v1/combos/prior-educations',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            "X-Api-Key: $apikey"
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($response, TRUE);
    foreach($data as $value){
        foreach ($value as $log){
            if (!empty($log['PriorEducationId']) && $log['PriorEducationId'] == $log1) {
                return $log['Description'];
            }
        }
    }
}


function get_wisenetDisabilities($log1){
    $apikey = '5MpnVN5S1TkW6ucHoX2F8XEK0GmfrEA1Tgs0NZn6';
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.wisenet.co/v1/combos/disabilities',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            "X-Api-Key: $apikey"
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($response, TRUE);
    foreach($data as $value){
        foreach ($value as $log){
            if (!empty($log['DisabilityId']) && $log['DisabilityId'] == $log1) {
                return $log['Description'];
            }
        }
    }
}


*/
?>