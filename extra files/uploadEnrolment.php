<?php
//include('style.php');
include('locallib.php');
//include('config.php');


class enrolments{
    public $baseURL = 'https://api.jotform.com';
   /**
     * @param $submissions
     * @param $form_id
     * @param $questions
     *
     * Function to get Form Fields
     * [get_form_fields Get all submissions, form id and question id]
     * @return [array] [Return a table with all form fields including all user submissions]
     */
    function get_form_fields($submissions, $form_id){
        if ($submissions > 0) {
            foreach ($submissions as $form1 => $value) {
                $detail = array();
                $qualification = array();
                $previousqualification = array();
                $shortcourse = array();
                //  print_r($submissions);
                if ($value["status"] == "ACTIVE" and $value["form_id"] == $form_id) { //Check if the form status is active and have same form id

                    // print_r($value);
                    //  echo '<tr>';
                    //print_r(enrolnment_form($value, $detail, $qualification,$previousqualification, $shortcourse));
                    foreach ($value["answers"] as $log1) { //Form fields
                        if(array_key_exists('name', $log1)){
                            // Start previous qualification Table field
                            if(check_condition($log1,"previousQualification") == 0){
                                foreach($log1["answer"] as $key => $value){
                                    if($value != "[]" AND !empty($value)){
                                        $previousqualification[$key] = $value;
                                    }
                                }
                            }
                            // End previous qualification Table field

                            // Start Student detail table field
                            if (check_array_condition($log1) == 0) {
                                if(array_key_exists('first', $log1["answer"])){ $detail['firstname'] = $log1["answer"]["first"]; }else{$detail['firstname']  =NULL;}
                                if(array_key_exists('middle', $log1["answer"])){$detail['middlename'] = $log1["answer"]["middle"];}else{$detail['middlename'] =NULL;}
                                if(array_key_exists('last', $log1["answer"])){$detail['lastname'] = $log1["answer"]["last"] ;}else{$detail['lastname'] =NULL;}
                            }

                            if(check_condition($log1,"std_id") == 0){$detail['std_id'] =  $log1["answer"];}
                            if(check_condition($log1,"title") == 0){$detail['title'] = $log1["prettyFormat"]; }
                            if(check_condition($log1,"genderDetails") == 0){$detail['genderDetails'] =$log1["prettyFormat"]; }
                            if(check_condition($log1,"dob") == 0){$detail['dob'] = $log1["prettyFormat"]; }
                            if(check_condition($log1,"residentialAddress") == 0){$detail['residentialAddress'] = $log1["answer"];}
                            if(check_condition($log1,"suburbtown") == 0){$detail['suburbtown'] = $log1["answer"];}
                            if(check_condition($log1,"state") == 0){$detail['state'] = $log1["answer"];}
                            if(check_condition($log1,"postcode") == 0){$detail['postcode'] = $log1["answer"];}
                            if(check_condition($log1,"postalAddress") == 0){$detail['postalAddress'] = $log1["answer"];}
                            if(check_condition($log1,"homePhone") == 0){$detail['homePhone'] = $log1["prettyFormat"];}
                            if(check_condition($log1,"mobile") == 0){$detail['mobile'] = $log1["prettyFormat"];}
                            if(check_condition($log1,"fax") == 0){$detail['fax'] = $log1["answer"];}
                            if(check_condition($log1,"email") == 0){$detail['email'] = $log1["answer"];}
                            if(check_condition($log1,"preferredMethod") == 0){$detail['preferredMethod'] = $log1["prettyFormat"];}
                            if(check_condition($log1,"relationname") == 0){$detail['relationname'] = $log1["answer"];}
                            if(check_condition($log1,"relationship") == 0){$detail['relationship'] = $log1["answer"];}
                            if(check_condition($log1,"relationhomeNumber") == 0){$detail['relationhomeNumber'] = $log1["answer"];}
                            if(check_condition($log1,"relationmobile") == 0){$detail['relationmobile'] = $log1["prettyFormat"];}
                            if(check_condition($log1,"emergencyPrefernce") == 0){$detail['emergencyPrefernce'] =$log1["prettyFormat"];}
                            if(check_condition($log1,"birthCountry") == 0){$detail['birthCountry'] = $log1["prettyFormat"];}
                            if(check_condition($log1,"birthCity") == 0){$detail['birthCity'] = $log1["answer"];}
                            if(check_condition($log1,"citizenshipStatus") == 0){$detail['citizenshipStatus'] = $log1["prettyFormat"];}
                            if(check_condition($log1,"VisaNumber") == 0){$detail['VisaNumber'] = $log1["answer"];}
                            if(check_condition($log1,"speakEnglish") == 0){$detail['speakEnglish'] =$log1["prettyFormat"];}
                            if(check_condition($log1,"speakStatus") == 0){$detail['speakStatus'] = $log1["prettyFormat"];}
                            if(check_condition($log1,"TSIorigin") == 0){$detail['TSIorigin'] = $log1["prettyFormat"];}
                            if(check_condition($log1,"disability") == 0){$detail['disability'] =$log1["prettyFormat"];}
                            if(check_condition($log1,"disabilityCondition") == 0){$detail['disabilityCondition'] = $log1["prettyFormat"];}
                            if(check_condition($log1,"paymentMethod") == 0){$detail['paymentMethod'] = $log1["prettyFormat"];}
                            if(check_condition($log1,"displayTestimonials") == 0){$detail['displayTestimonials'] =$log1["prettyFormat"];}
                            if(check_condition($log1,"displayPicture") == 0){$detail['displayPicture'] = $log1["prettyFormat"];}
                            if(check_condition($log1,"studentSignature") == 0){$detail['studentSignature'] = $log1["answer"];}
                            if(check_condition($log1,"date") == 0){$detail['date'] = $log1["prettyFormat"];}
                            if(check_condition($log1,"parentguardianSignature") == 0){$detail['parentguardianSignature'] = $log1["answer"];}
                            if(check_condition($log1,"date130") == 0){$detail['date130'] = $log1["prettyFormat"];}
                            if(check_condition($log1,"vsn") == 0){$detail['vsn'] = $log1["answer"];}
                            if(check_condition($log1,"noVSN") == 0){$detail['noVSN'] = $log1["answer"];}
                            if(check_condition($log1,"qualificationStatus") == 0){$detail['qualificationStatus'] = $log1["prettyFormat"];}
                            if(check_condition($log1,"newEducationSector") == 0){$detail['newEducationSector'] = $log1["prettyFormat"];}
                            if(check_condition($log1,"studyReason") == 0){$detail['studyReason'] = $log1["prettyFormat"];}
                            // End Student detail table field

                            // Start Employment table field
                            if(check_condition($log1,"employmentStatus") == 0){$detail['employmentStatus'] = $log1["prettyFormat"];}
                            if(check_condition($log1,"employmentRole") == 0){$detail['employmentRole'] = $log1["prettyFormat"];}
                            if(check_condition($log1,"employmentSector") == 0){$detail['employmentSector'] = $log1["prettyFormat"];}
                            if(check_condition($log1,"organisation") == 0){$detail['organisation'] = $log1["answer"];}
                            if(check_condition($log1,"organisationPosition") == 0){$detail['organisationPosition'] = $log1["answer"];}
                            if(check_condition($log1,"organisationAddress") == 0){$detail['organisationAddress'] = $log1["answer"];}
                            if(check_condition($log1,"organisationTelephone") == 0){$detail['organisationTelephone'] = $log1["prettyFormat"];}
                            if(check_condition($log1,"abn") == 0){$detail['abn'] = $log1["answer"];}
                            // End Employment table field

                            // Start Concession table field
                            if(check_condition($log1,"medicareNo") == 0){$detail['medicareNo'] = $log1["answer"];}
                            if(check_condition($log1,"medicareExpiry") == 0){$detail['medicareExpiry'] = $log1["prettyFormat"];}
                            if(check_condition($log1,"concessionCard") == 0){$detail['concessionCard'] = $log1["answer"];}
                            if(check_condition($log1,"concessionExpiry") == 0){$detail['concessionExpiry'] = $log1["prettyFormat"];}
                            if(check_condition($log1,"currentConcessionCard") == 0){$detail['currentConcessionCard'] = $log1["prettyFormat"];}
                            if(check_condition($log1,"concessionCardType") == 0){$detail['concessionCardType'] = $log1["prettyFormat"];}
                            if(check_condition($log1,"jobSeeker") == 0){$detail['jobSeeker'] = $log1["prettyFormat"];}
                            // End Concession table field

                            // Start Schooling Table field
                            if(check_condition($log1,"schoolingLevel") == 0){$detail['schoolingLevel'] = $log1["prettyFormat"];}
                            if(check_condition($log1,"schoolingLevelYear") == 0){$detail['schoolingLevelYear'] = $log1["answer"];}
                            if(check_condition($log1,"schoolingStatus") == 0){$detail['schoolingStatus'] = $log1["prettyFormat"];}
                            // End Schooling Table field
                            // Start USI Table field
                            if(check_condition($log1,"usi") == 0){$detail['usi'] = $log1["answer"];}
                            if(check_condition($log1,"signature") == 0){$detail['signature'] = $log1["answer"];}
                            if(check_condition($log1,"fileUpload201") == 0){$detail['fileUpload201'] = $log1["prettyFormat"];}
                            // End USI Table field
                            // Start Identification Table field
                            if(check_condition($log1,"identificationDocument") == 0){$detail['identificationDocument'] = $log1["prettyFormat"];}
                            if(check_condition($log1,"fileUpload") == 0){$detail['fileUpload'] = $log1["prettyFormat"];}
                            // End USI Table field

                            // Start qualification Table field
                            if(check_condition($log1,"modeOfstudy") == 0){$detail['modeOfstudy'] = $log1["prettyFormat"];}

                            if(check_condition($log1,"qualification2") == 0){
                                foreach($log1["answer"] as $key => $value){
                                    if($value != "[]" AND !empty($value)){
                                        $qualification[$key] = $value;
                                    }
                                }
                            }
                            // End qualification Table field

                            // Start short courses Table field
                            if(check_condition($log1,"shortCourse") == 0){
                                foreach($log1["answer"] as $key => $value){
                                    if($value != "[]" AND !empty($value)){
                                        $shortcourse[$key] = $value;
                                    }
                                }
                            }
                            // End short courses Table field
                        }
                    }  echo '<br>';//End foreach() Loop
                    //    echo '</tr>'; //End Table Row
                }  //End If() Condition
                if(!empty($detail)) {
                    print_r("<pre>");
                    /*print_r($detail);
                    print_r($qualification);
                    print_r($previousqualification);
                    print_r($shortcourse);*/

                    print_r("</pre>");
                   // insert_student_details($detail,$previousqualification,$qualification, $shortcourse);


                }
            } //End foreach() Loop
            // print_r($detail);
            //   echo '</tbody></table>'; //End table
        }
    }
}
