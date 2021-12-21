<?php
class enrolment{
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
    public function definition() {
        return false;
    }

    public function display_report($page) {
        get_breadcrumbs($page);

        echo '<h1 class="mb-4 text-gray-800" style="text-align: center; padding-top: 30px;">List of New Students &nbsp; 
                <a href="/index.php?page=13" class="btn btn-warning" onclick="showHide2();"> Sync JotForm Submission</a></h1>';
        /* Begin Page Content */
        echo '<style>
.loader {
  border: 10px solid #f3f3f3;
  border-radius: 50%;
  border-top: 10px solid #3498db;
  width: 50px;
  height: 50px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
  padding:10px;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>';
        echo '<script>function showHide(){
            $("#cardAboutDetails").css("display","none");
            $("#loader").css("display","block");
}</script>';
        echo '<script>function showHide2(){
            $("#cardAboutDetails").css("display","none");
            $("#loader2").css("display","block");
}</script>';
           echo '<div class="container-fluid">';
                /*  Page Heading */
           echo  '<div class="row">

                    <div class="col-sm-6" style="display:none;" id="loader">
                        <div class="row">
                            <div class="col-sm-12 card shadow mb-4">
                                <div class="loader"></div>
                                <p style="padding-10px;">Please be patient data is being uploaded on wisenet and moodle....</p>
                            </div>
                        </div>
                    </div>
                                                                    
                    <div class="col-sm-6" style="display:none;" id="loader2">
                        <div class="row">
                            <div class="col-sm-12 card shadow mb-4">
                                <div class="loader"></div>
                                <p style="padding-10px;">Please be patient data is being synced....</p>
                            </div>
                        </div>
                    </div>
                    

                <div class="card shadow mb-4" id="cardAboutDetails">
                    <!--<div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">You can edit,update and delete users through this panel</h6>
                    </div>-->
                    <div class="card-body border-bottom-success">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="display:none;">Id</th>
                                        <th>JotForm ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>DOB</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th style="display:none;">Id</th>
                                         <th>JotForm ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>DOB</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>';

                                $row = get_form_users();
                                foreach ($row as $data){
                                   /*$formid = get_form_submission();
                                    $submissionid = get_submissionid();*/
                                   echo  '<tr>';
                                   echo '<td style="display:none;">'.$data["std_id"].'</td>';
                                   echo '<td>'.$data["std_id"].'</td>';
                                   echo '<td>'.$data["firstname"].'</td>';
                                   echo '<td>'.$data ["lastname"].'</td>';
                                   echo '<td>'.$data["dob"].'</td>';
                                   echo '<td>'.$data["email"].'</td>';
                                   echo '<td>'.$data["mobile"].'</td>';
                                   /*** Edited By Inam on 11 Nov 2021 **/
                                   if($data["status"] != 1) {
                                        if (get_enrolmentStatus($data["std_id"]) == 1) {
                                           echo '<td><a href="#" id="' . $data["id"] . '" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary btn-circle btn-md"  >
                                                 <i class="fas fa-eye"></i></a>';
                                        }
                                        else{
                                           echo '<td><a href="index.php?page=10&user=' . $data["std_id"] . '" class="btn btn-primary btn-circle btn-md" onclick="showHide();" >
                                                    <i class="fas fa-upload"></i></a>
                                                 <a href="#" id="' . $data["id"] . '" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary btn-circle btn-md"  >
                                                 <i class="fas fa-eye"></i></a>';
                                        }
                                       echo ' </td>';
                                   }
                                   else{
                                       echo '<td>Approved</td>';
                                   }
                                    echo '</tr>';
                                }
                                echo '</tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
                </div>
           </div>';

        echo '<!-- PHP Ajax Update MySQL Data Through Bootstrap Modal -->
              <div id="add_data_Modal" class="modal fade">  
                  <div class="modal-dialog">  
                       <div class="modal-content">  
                            <div class="modal-header">  
                                   <h4 class="modal-title">Student Details</h4>  
                                   <button type="button" class="close" data-dismiss="modal">&times;</button>  
                            </div>  
                            <div class="modal-body">  
                               <div id="responsecontainer" align="center">
                            </div>  
                            <div class="modal-footer">  
                                 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
                            </div>  
                       </div>  
                  </div>  
              </div> 
              <!-- / PHP Ajax Update MySQL Data Through Bootstrap Modal -->';
            /* container-fluid */
?>
        <script type="text/javascript">
            // $(document).ready(function() {
            //     $(".btn.btn-primary.btn-circle.btn-md").click(function() {
            //         var userid = $(this).attr('id');
            //         alert(userid);
            //         $.ajax({    //create an ajax request to display.php
            //             type: "POST",
            //             url: "insertfo+rm.php",
            //             data:{'userid': userid},
            //             dataType: "html",   //expect html to be returned
            //             success: function(data){
            //                 $("#responsecontainer").html(data);
            //                 //alert(response);
            //             }
            //         });
            //     });
            // });


            $(function(){
                $('#dataTable_wrapper tbody').on('click', '.btn.btn-primary.btn-circle.btn-md', function () {
                    var userid = $(this).attr('id');
                    //alert(userid);
                    $.ajax({    //create an ajax request to display.php
                        type: "POST",
                        url: "insertform.php",
                        data:{'userid': userid},
                        dataType: "html",   //expect html to be returned
                        success: function(data){
                            $("#responsecontainer").html(data);
                            //alert(response);
                        }
                    });
                });


                /**
                 * Ajax to delete form
                 */
                /////////////////////////////////////////////////////////////
                $(document).on('click','.btn.btn-danger.btn-circle.btn-md',function() {
                    if (confirm("Are you sure delete this ?")) {
                        var del_rcrd = $(this).attr('id');
                        var $ele = $(this).parent().parent();

                        $.ajax({
                            type: 'POST',
                            url: 'insertform.php',
                            data: {'del_rcrd': del_rcrd},
                            success: function (data) {
                                if (data == "YES") {
                                    $ele.fadeOut().remove();
                                    alert("Form deleted successfully");
                                    window.location.reload();
                                } else {
                                    alert("Invalid Form id")
                                    window.location.reload();
                                    //alert("Invalid Form id")
                                }
                            }
                        });
                    }
                });
            });
        </script>

<?php
    }

    public function approved_student($page) {
        get_breadcrumbs($page);
        /* Begin Page Content */
        echo '<div class="container-fluid">';
        //echo  '<h1 class="h3 mb-4 text-gray-800" style="text-align: center; padding-top: 30px;">List of Approved Students</h1>';
        echo '<h1 class="mb-4 text-gray-800" style="text-align: center; padding-top: 30px;">List of Approved Students</h1>';


        /*  Page Heading */
        echo  '<div class="row">
                    <div class="col-sm-12">
                <div class="card shadow mb-4">
                   <!-- <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">You can edit,update and delete users through this panel</h6>
                    </div>-->
                    <div class="card-body border-bottom-success">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th >Id</th>
                                        <th>JotForm ID</th>
                                        <th>Wisenet Student ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>DOB</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Courses</th>
                                         <th>Approved by</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>JotForm ID</th>
                                        <th>Wisenet Student ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>DOB</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Courses</th>
                                        <th>Approved by</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>';

        $row = get_approved_student();
$i =1;
        foreach ($row as $data){

            echo  '<tr>';
            echo '<td >'.$i.'</td>';
            echo '<td>'.$data["std_id"].'</td>';
            echo '<td> '.$data["wisenetId"].'</td>';
            echo '<td>'.$data["firstname"].'</td>';
            echo '<td>'.$data ["lastname"].'</td>';
            echo '<td>'.$data["dob"].'</td>';
            echo '<td>'.$data["email"].'</td>';
            echo '<td>'.$data["mobile"].'</td>';
            echo '<td>'.get_studentCourseName($data["std_id"]).'</td>';
            echo '<td>'.get_staff($data["addedby"]).'</td>';
            echo '<td>Approved</td>';
            echo '</tr>';
            $i++;
        }
        echo '                            </tbody>
                                   </table>
                              </div>
                         </div>
                     </div>
                  </div>
                </div>
            </div>';
        /* container-fluid */
    }


    public function JotFormSubmission() {
        echo '<a class="button button1"  href="/index.php?page=13">Sync JotForm Submission</a>';
        /* Begin Page Content */
        echo '<div class="container-fluid">';
        echo  '<h1 class="h3 mb-4 text-gray-800" style="text-align: center; padding-top: 30px;">List of New Students</h1>';
        /*  Page Heading */
        echo  '<div class="row">
                    <div class="col-sm-12">
                <div class="card shadow mb-4">
                    <!--<div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">You can edit,update and delete users through this panel</h6>
                    </div>-->
                    <div class="card-body border-bottom-success">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="display:none;">Id</th>
                                        <th>JotForm ID</th>
                                        <th>Wisenet Student ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>DOB</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <!--<th>Action</th>-->
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th style="display:none;">Id</th>
                                        <th>JotForm ID</th>
                                        <th>Wisenet Student ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>DOB</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                    </tr>
                                </tfoot>
                                <tbody>';

        $row = get_all_students();
        foreach ($row as $data){
            echo '<tr>';
            echo '<td style="display:none;">'.$data["std_id"].'</td>';
            echo '<td>'.$data["std_id"].'</td>';
            if(!empty($data["wisenetId"])){echo '<td> '.$data["wisenetId"].'</td>';} else {echo '<td> - </td>';}
                echo '<td>'.$data["firstname"].'</td>';
                echo '<td>'.$data ["lastname"].'</td>';
                echo '<td>'.$data["dob"].'</td>';
                echo '<td>'.$data["email"].'</td>';
                echo '<td>'.$data["mobile"].'</td>';
            /* if($data["std_id"] == 0){
                echo '<td>Approved</td>';
            }
            else{
                echo '<td>Not Approved</td>';
            }*/
            echo '</tr>';
        }
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

    /**
     * @param $submissions
     * @param $form_id
     * @param $questions
     *
     * Function to get Form Fields
     * [get_form_fields Get all submissions, form id and question id]
     * @return [array] [Return a table with all form fields including all user submissions]
     */
    function push_form_fields($submissions){

        $result = array();
        $i = 1;



        foreach($submissions as $value) {
         //   echo check_submissionDate($value["created_at"]);
            if($value["status"] == "ACTIVE" AND get_useridStatus($value['answers']['243']['answer']) == 1){
                $Personal = array();
                $Demographics = array();
                $NextOfKin = array();
                $previousqualification = array();
                $disability =  array();
                $Personal['firstname'] = NULL;
                $Personal['middlename'] = NULL;
                $Personal['lastname'] = NULL;
                $Personal['std_id'] = NULL;
                $Personal['title'] = NULL;
                $Personal['genderDetails'] = NULL;
                $Personal['dob'] = NULL;
                $Personal['residentialAddress'] = NULL;
                $Personal['suburbtown'] = NULL;
                $Personal['state'] = NULL;
                $Personal['postcode'] = NULL;
                $Personal['postalAddress'] = NULL;
                $Personal['homePhone'] = NULL;
                $Personal['mobile'] = NULL;
                $Personal['fax'] = NULL;
                $Personal['email'] = NULL;
                $Personal['noVSN'] = NULL;
                $Personal['usi'] = NULL;
                $Personal['currentConcessionCard'] = NULL;
                $NextOfKin['relationname'] = NULL;
                $NextOfKin['relationship'] = NULL;
                $NextOfKin['relationhomeNumber'] = NULL;
                $NextOfKin['relationmobile']  = NULL;
                $Demographics['employmentStatus'] = NULL;
                $Demographics['employmentRole']  = NULL;
                $Demographics['employmentSector'] = NULL;
                $Demographics['qualificationStatus']  = NULL;
                $Demographics['schoolingLevel'] = NULL;
                $Demographics['schoolingLevelYear'] = NULL;
                $Demographics['schoolingStatus'] = NULL;
                $Demographics['birthCountry'] = NULL;
                $Demographics['speakEnglish'] = NULL;
                $Demographics['TSIorigin'] = NULL;
                $Demographics['disability']  = NULL;

                $formid = $value["form_id"];
                $submissionid = $value["id"] ;
                $date = $value["created_at"];
                $result[$i]['date'] = $value["created_at"];


                foreach ($value["answers"] as $log1) { //Form fields

                      if (array_key_exists('name', $log1)) {
                        /** Start Personal table field **/
                        if (check_condition($log1, "name") == 0) {
                            if (array_key_exists('first', $log1["answer"])) {$Personal['firstname'] = $log1["answer"]["first"]; $result[$i]['firstname'] = $log1["answer"]["first"];} else {$Personal['firstname'] = NULL;}
                            if (array_key_exists('middle', $log1["answer"])) {$Personal['middlename'] = $log1["answer"]["middle"]; $result[$i]['middlename'] = $log1["answer"]["middle"];} else {$Personal['middlename'] = NULL;}
                            if (array_key_exists('last', $log1["answer"])) {$Personal['lastname'] = $log1["answer"]["last"];$result[$i]['lastname'] = $log1["answer"]["last"]; } else {$Personal['lastname'] = NULL;}
                        }
                        if (check_condition($log1, "std_id") == 0) {$Personal['std_id'] = $log1["answer"]; $result[$i]['std_id'] = $log1["answer"]; }
                        if (check_condition($log1, "title") == 0) {$Personal['title'] = $log1["prettyFormat"];}
                        if (check_condition($log1, "genderDetails") == 0) {$Personal['genderDetails'] = $log1["prettyFormat"];}
                        if (check_condition($log1, "dob") == 0) {$Personal['dob'] = $log1["answer"]["month"]."/".$log1["answer"]["day"]."/".$log1["answer"]["year"];}
                        if (check_condition($log1, "residentialAddress") == 0) {$Personal['residentialAddress'] = $log1["answer"];}
                        if (check_condition($log1, "suburbtown") == 0) {$Personal['suburbtown'] = $log1["answer"];}
                        if (check_condition($log1, "state") == 0) {$Personal['state'] = $log1["answer"];}
                        if (check_condition($log1, "postcode") == 0) {$Personal['postcode'] = $log1["answer"];}
                        if (check_condition($log1, "postalAddress") == 0) {$Personal['postalAddress'] = $log1["answer"];}
                        if (check_condition($log1, "homePhone") == 0) {$Personal['homePhone'] = $log1["prettyFormat"];}
                        if (check_condition($log1, "mobile") == 0) {$Personal['mobile'] = $log1["prettyFormat"]; $result[$i]['mobile'] = $log1["prettyFormat"]; }
                        if (check_condition($log1, "fax") == 0) {$Personal['fax'] = $log1["answer"];}
                        if (check_condition($log1, "email") == 0) {$Personal['email'] = $log1["answer"]; $result[$i]['email'] = $log1["answer"];}
                        if (check_condition($log1, "vsn") == 0) {$Personal['noVSN'] =  $log1["answer"];}
                        if (check_condition($log1, "usi") == 0) {$Personal['usi'] = $log1["answer"];}
                        if (check_condition($log1, "currentConcessionCard") == 0) {$Personal['currentConcessionCard'] = $log1["prettyFormat"];}
                          if ($Personal['identificationDocumentA']['answer'][0] == 'Current green Medicare card') {
                              if(check_condition($log1, "medicarecardnumber") == 0) {$Personal['medicareNumber'] = $log1["answer"];}
                              if(check_condition($log1, "MedicareCardExpiryYear") == 0) {$medicareyear = $log1["answer"];}
                              if(check_condition($log1, "MedicareCardExpiryMonth") == 0) {$medicaremonth = $log1["answer"];}
                              $medicaredate = getMedicareDate($medicaremonth);
                              $Personal['medicareExpiryDate'] = $medicaremonth."/".$medicaredate."/".$medicareyear;
                          }


                          if ($Personal['currentConcessionCard'] == 'Yes') {
                            if (check_condition($log1, "concessionCard") == 0) {
                                $Personal['concessionCard'] = $log1["answer"];
                            }
                            if (check_condition($log1, "concessionExpiry") == 0) {
                                $Personal['concessionExpiry'] =$log1["answer"]["month"]."/".$log1["answer"]["day"]."/".$log1["answer"]["year"];
                            }}
                        else{
                            $Personal['concessionCard'] = NULL;
                            $Personal['concessionExpiry'] = NULL;
                        }
                        /** End Personal table field **/

                        /** Start NextOfKinRelationships Table**/
                        if (check_condition($log1, "relationname") == 0) {$NextOfKin['relationname'] = $log1["answer"];}
                        if (check_condition($log1, "relationship") == 0) { $NextOfKin['relationship'] = $log1["answer"];}
                        if (check_condition($log1, "relationhomeNumber") == 0) {$NextOfKin['relationhomeNumber'] = preg_replace('/\D+/', '', $log1["prettyFormat"]);}
                        if (check_condition($log1, "relationmobile") == 0) {$NextOfKin['relationmobile'] = preg_replace('/\D+/', '', $log1["prettyFormat"]);}
                        /**  End NextOfKinRelationships **/

                        /** Start Demographics table field **/
                        if (check_condition($log1, "employmentStatus") == 0) {$Demographics['employmentStatus'] = $log1["prettyFormat"];}
                        if (check_condition($log1, "employmentRole") == 0) {$Demographics['employmentRole'] = $log1["prettyFormat"];}
                        if (check_condition($log1, "employmentSector") == 0) {$Demographics['employmentSector'] = $log1["prettyFormat"];}
                        if (check_condition($log1, "qualificationStatus") == 0) {$Demographics['qualificationStatus'] = $log1["prettyFormat"];}
                        if (check_condition($log1, "schoolingLevel") == 0) {$Demographics['schoolingLevel'] = $log1["prettyFormat"];}
                        if (check_condition($log1, "schoolingLevelYear") == 0) {$Demographics['schoolingLevelYear'] = $log1["answer"];}
                        if (check_condition($log1, "schoolingStatus") == 0) {$Demographics['schoolingStatus'] = $log1["prettyFormat"];}
                        if (check_condition($log1, "birthCountry") == 0) {$Demographics['birthCountry'] = $log1["answer"];}
                        if (check_condition($log1, "speakEnglish") == 0) {$Demographics['speakEnglish'] = $log1["answer"];}
                        if (check_condition($log1, "speakStatus") == 0) {$Demographics['speakStatus'] = $log1["prettyFormat"];}
                        if (check_condition($log1, "TSIorigin") == 0) {$Demographics['TSIorigin'] = $log1["prettyFormat"];}


                        if (check_condition($log1, "qualificationStatus") == 0) {$Demographics['qualificationStatus'] = $log1["prettyFormat"];}
                        if($Demographics['qualificationStatus'] == 'Yes' ){
                              // Start previous qualification Table field
                              if (check_condition($log1, "previousQualification") == 0) {
                                  foreach ($log1["answer"] as $key => $value) {
                                      if ($value != "[]" and !empty($value)) {
                                          $previousqualification[$key] = $value;
                                      }
                                  }
                              }
                          }
                        print_r($log1["previousQualification"]);
                          if (check_condition($log1,"disability") == 0){$Demographics['disability'] =$log1["prettyFormat"];}
                          if ($Demographics['disability'] == 'Yes') {
                              // Start disability qualification Table field
                              if (check_condition($log1, "disabilityCondition") == 0) {
                                  foreach ($log1["answer"] as $key => $value) {
                                      if (!empty($value)) {
                                          $disability[$key] = $value;
                                      }
                                  }
                              }
                          }
                    }
                }

                if (!empty($Personal) ) {
                  $response =  insert_student_details($Personal,$Demographics,$NextOfKin, $disability,$previousqualification, $formid, $submissionid, $date);
                   if ($response == 0 ) {
                       $result[$i]['status'] = "Record Inserted";
                   }
                   else{
                       $result[$i]['status'] = "Record Not Inserted";
                   }
                }
                $i++;
            }

            elseif($value["status"] == "ACTIVE"){
                foreach ($value["answers"] as $log1) {
                    if (array_key_exists('name', $log1)) {
                        /** Start Personal table field **/
                        if (check_condition($log1, "name") == 0) {
                            if (array_key_exists('first', $log1["answer"])) {$Personal['firstname'] = $log1["answer"]["first"]; $result[$i]['firstname'] = $log1["answer"]["first"];} else {$Personal['firstname'] = NULL;}
                            if (array_key_exists('middle', $log1["answer"])) {$Personal['middlename'] = $log1["answer"]["middle"]; $result[$i]['middlename'] = $log1["answer"]["middle"];} else {$Personal['middlename'] = NULL;}
                            if (array_key_exists('last', $log1["answer"])) {$Personal['lastname'] = $log1["answer"]["last"];$result[$i]['lastname'] = $log1["answer"]["last"]; } else {$Personal['lastname'] = NULL;}
                        }
                        if (check_condition($log1, "std_id") == 0) {$Personal['std_id'] = $log1["answer"]; $result[$i]['std_id'] = $log1["answer"]; }
                        if (check_condition($log1, "mobile") == 0) {$Personal['mobile'] = $log1["prettyFormat"]; $result[$i]['mobile'] = $log1["prettyFormat"]; }
                        if (check_condition($log1, "email") == 0) {$Personal['email'] = $log1["answer"]; $result[$i]['email'] = $log1["answer"];}
                        $result[$i]['status'] = "Record Exist";
                        $result[$i]['date'] = $value["created_at"];
                        /** End Personal table field **/
                    }
                }
                $i++;
            }
        }
        return $result;
    }

    /**
     * @param $submissions
     * @param $form_id
     * @param $questions
     *
     * Function to get Form Fields
     * [get_form_fields Get all submissions, form id and question id]
     * @return [array] [Return a table with all form fields including all user submissions]
     */
    function pushEnrolment($submissions){
       /** Intialized Array */
        $Personal = array();
        $Demographics = array();
        $NextOfKin = array();

        /** Retrieve Data JotForm submission */
        if($submissions['status'] == 'ACTIVE' AND get_useridStatus($submissions['answers']['243']['answer']) == 1){
            foreach ($submissions['answers'] as $log1) {
                if (check_condition($log1, "title") == 0) {$Personal['Title'] = strtoupper($log1["prettyFormat"]);}

                                                /********************************
                                                 **** Start Personal Details ****
                                                 ********************************/
                $Personal['IsActive'] = true;
                if (check_condition($log1, "name") == 0) {
                    if (array_key_exists('first', $log1["answer"])) {$Personal['FirstName'] = strtoupper($log1["answer"]["first"]); } else {$Personal['firstname'] = NULL;}
                    if (array_key_exists('middle', $log1["answer"])) {$Personal['MiddleName'] = strtoupper($log1["answer"]["middle"]); } else {$Personal['middlename'] = NULL;}
                    if (array_key_exists('last', $log1["answer"])) {$Personal['LastName'] = strtoupper($log1["answer"]["last"]); } else {$Personal['lastname'] = NULL;}
                }
                if (check_condition($log1, "genderDetails") == 0) {$Personal['GenderId'] = get_gender($log1["prettyFormat"]);}
                if (check_condition($log1, "dob") == 0) {$Personal['DateOfBirth'] = $log1["answer"]["month"]."/".$log1["answer"]["day"]."/".$log1["answer"]["year"];}
                if (check_condition($log1, "usi") == 0) {$Personal['UniqueStudentIdentifier'] = $log1["answer"];}
                if (check_condition($log1, "std_id") == 0) {$Personal['LearnerAlt1Number'] = $log1["answer"];  }
                $Personal['SyncToSugarCrm'] = true;
                $Personal['SyncToXero'] = false;
                if (check_condition($log1, "email") == 0) {$Personal['EmailAddresses']['Email'] = $log1["answer"];}
                if (check_condition($log1, "vsn") == 0) {
                    if($log1["prettyFormat"] != NULL){
                        $Personal['VictorianStudentNumber'] = $log1["prettyFormat"];
                    }else {
                        $Personal['VictorianStudentNumber'] = '888888888';
                    }
                }
                if (check_condition($log1, "homePhone") == 0) {
                    $homenumber = preg_replace('/\D+/', '', $log1["prettyFormat"]);
                    $Personal['PhoneNumbers']['PhoneHome'] = "+".$homenumber;
                }
                if (check_condition($log1, "mobile") == 0) {
                    $mobile = preg_replace('/\D+/', '', $log1["prettyFormat"]);
                    $Personal['PhoneNumbers'] ['Mobile'] ="+".$mobile;
                     }
                if (check_condition($log1, "fax") == 0) {$Personal['PhoneNumbers']['FaxHome'] = $log1["answer"];}
                if (check_condition($log1, "residentialAddress") == 0) {$Personal['StreetAddress']['StreetName']  = strtoupper($log1["answer"]); $Personal['PermanentAddress']['StreetName'] = strtoupper($log1["answer"]); }
                if (check_condition($log1, "suburbtown") == 0) {$Personal['StreetAddress']['SuburbTownCity'] = strtoupper($log1["answer"]); $Personal['PermanentAddress']['SuburbTownCity'] =  strtoupper($log1["answer"]);}
                if (check_condition($log1, "state") == 0) {$Personal['StreetAddress']['StateId'] = get_state($log1["answer"]);  $Personal['PermanentAddress']['StateId'] = get_state($log1["answer"]); }
                if (check_condition($log1, "postcode") == 0) {$Personal['StreetAddress']['Postcode'] = strtoupper($log1["answer"]);  $Personal['PermanentAddress']['Postcode'] = strtoupper($log1["answer"]);}
                $Personal['StreetAddress']['CountryId'] = 83;
                $Personal['PermanentAddress']['CountryId'] = 83;
                if (check_condition($log1, "postalAddress") == 0) {$Personal['PostalAddress']['StreetName']  = strtoupper($log1["answer"]);}
                if (check_condition($log1, "currentConcessionCard") == 0) {$Personal['currentConcessionCard'] = $log1["prettyFormat"];}
                if (check_condition($log1, "medicarecardnumber") == 0) {$Personal['MedicareNumber'] = $log1["answer"];}
                if (check_condition($log1, "MedicareCardExpiryYear") == 0) {$medicareyear = $log1["answer"];}
                if (check_condition($log1, "MedicareCardExpiryMonth") == 0) {$medicaremonth = $log1["answer"];}
                $medicaredate = getMedicareDate($medicaremonth);
                $Personal['MedicareExpiryDate'] = $medicaremonth."/".$medicaredate."/".$medicareyear;
                                        /********************************
                                         ********** End Personal ********
                                         ********************************/

                                    /****************************************************
                                     ****** Start NextOfKinRelationships Details ********
                                     ****************************************************/
                 if (check_condition($log1, "relationname") == 0) {$NextOfKin['LocalNextOfKin']['FirstName'] =  strtoupper($log1["answer"]);}
                 if (check_condition($log1, "relationship") == 0) { $NextOfKin['LocalNextOfKin']['RelationshipId'] =  get_relation($log1["answer"]);}
                 if (check_condition($log1, "relationhomeNumber") == 0) {
                     $relationhomenumber = preg_replace('/\D+/', '', $log1["prettyFormat"]);
                     $NextOfKin['LocalNextOfKin']['PhoneHome'] = "+".$relationhomenumber;
                 }
                 if (check_condition($log1, "relationmobile") == 0) {
                     $relationmobile = preg_replace('/\D+/', '', $log1["prettyFormat"]);
                     $NextOfKin['LocalNextOfKin']['Mobile'] = "+".$relationmobile;
                 }
                                            /********************************
                                             *** End NextOfKinRelationships**
                                             ********************************/

                                            /********************************
                                             ***Start Demographics Details***
                                             ********************************/
                if (check_condition($log1, "employmentStatus") == 0) {$Demographics['EmploymentStatusId'] = get_employmentstatus($log1["prettyFormat"]);}
                if (check_condition($log1, "employmentRole") == 0) {$Demographics['OccupationIdentifierId'] = get_employmentrole($log1["prettyFormat"]);}
                if (check_condition($log1, "employmentSector") == 0) {$Demographics['IndustryOfEmploymentId'] = get_employmentindustry($log1["prettyFormat"]);}
                if (check_condition($log1, "schoolingLevel") == 0) {$Demographics['HighestSchoolLevelCompletedId'] = get_schoolLevel($log1["prettyFormat"]);}
                if (check_condition($log1, "schoolingLevelYear") == 0) {$Demographics['HighestSchoolLevelCompletedYear'] = $log1["answer"];}
                if (check_condition($log1, "schoolingStatus") == 0) {$Demographics['IsStillAtSchool'] = get_schoolStatus($log1["prettyFormat"]);}
                if (check_condition($log1, "birthCountry") == 0) {$Demographics['CountryOfBirthId'] = get_country($log1["answer"]);}
                if (check_condition($log1, "speakEnglish") == 0) {$Demographics['PrimaryLanguageId'] = get_speakLanguage($log1["answer"]);}
                if (check_condition($log1, "speakStatus") == 0) {$Demographics['SpokenEnglishProficiencyId'] = get_englishStatus($log1["prettyFormat"]);}
                if (check_condition($log1, "TSIorigin") == 0) {$Demographics['IndigenousStatusId'] = get_tsiorigin($log1["prettyFormat"]);}
                if (check_condition($log1,"disability") == 0){$Demographics['DisabilityFlagId'] =get_DisabilityFlagId($log1["prettyFormat"]);}
                if (check_condition($log1, "qualificationStatus") == 0) {$Demographics['HasPriorEducationalAchievementId'] = getQualificationStatus($log1["prettyFormat"]);}
                if ($Demographics['HasPriorEducationalAchievementId'] == 'Yes' || $Demographics['HasPriorEducationalAchievementId'] == 2 ){
                    // Start previous qualification Table field
                    if (check_condition($log1, "previousQualification") == 0) {
                        foreach ($log1["answer"] as $key => $value) {
                            if ($value != "[]" and !empty($value)) {
                                $Demographics["PriorEducationAchievements"][] = get_previousEducation(get_PriorEducationId($key), get_PriorEducationTypeId($value));
                            }
                        }
                    }
                }

                if ($Demographics['DisabilityFlagId'] == 'Yes' || $Demographics['DisabilityFlagId'] == 2) {
                    // Start disability qualification Table field
                    if (check_condition($log1, "disabilityCondition") == 0) {
                        foreach ($log1["answer"] as $key => $value) {
                            if (!empty($value)) {
                                $Demographics["DisabilityIds"][] = get_DisabilityIds($value);
                            }
                        }
                    }
                }
                                                         /***********************
                                                         *****End Demographics***
                                                         ***********************/
            }
        }

      /** Push Data in details array */
        $i = 0;
        if (!empty($Personal)){
            $details = array("LearnerId" => 0, "Personal" => $Personal, "Demographics" => $Demographics, "NextOfKin" => $NextOfKin);
            $wisenet[$i] = $details;

        }
        unset($Personal);
        unset($Demographics);
        unset($NextOfKin);

       /** Upload user to Wisenet ***/
       if(!empty($wisenet)){
            $wisedata =  json_encode($wisenet);
            $response = wisesnetInsertData($wisedata);

            if($response){
                $data    = json_decode($response, true);
                $rs      = $data[0]['Data']['Personal']['LearnerNumber'];
                $std_id  = $data[0]['Data']['Personal']['LearnerAlt1Number'];
                $status  = 1;
                $staffid = $_SESSION['userid'];
                $result  = updateWisenetData($status, $rs, $response,$staffid, $std_id);
            }else{
                echo "Error occured. No data insert !";
                echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
            }
       }else{
                echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
       }
    }

    function display_newEnrolment($result,$page){
        get_breadcrumbs($page);
        echo '<h1 class="mb-4 text-gray-800" style="text-align: center; padding-top: 30px;">JotForm Submissions Records &nbsp;</h1>';
        /* Begin Page Content */
        echo '<div class="container-fluid">';
        /*  Page Heading */
        echo  '<div class="row">
                    <div class="col-sm-12">
                <div class="card shadow mb-4">
                    <!--<div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">You can edit,update and delete users through this panel</h6>
                    </div>-->
                    <div class="card-body border-bottom-success">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Id</th>                                     
                                        <th>First Name</th>
                                        <th>Last Name</th>              
                                        <th>Email</th>
                                        <th>Phone</th>  
                                        <th>Enrol Date</th>                                                                                
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>                                  
                                        <th>First Name</th>
                                        <th>Last Name</th>                               
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Enrol Date</th>     
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                                <tbody>';

        foreach ($result as $data){
            if ($data["status"] == "Record Exist") {
                echo '<tr >';
                    echo '<td>' . $data["std_id"] . '</td>';
                    echo '<td>' . $data["firstname"] . '</td>';
                    echo '<td>' . $data["lastname"] . '</td>';
                    echo '<td>' . $data["email"] . '</td>';
                    echo '<td>' . $data["mobile"] . '</td>';
                    echo '<td>' . $data["date"] . '</td>';
                    echo '<td style="background-color:#FF0000">' . $data["status"] . '</td>';
                echo '</tr>';
            }
            else{
                echo '<tr style="background-color:#32b474">';
                    echo '<td>' . $data["std_id"] . '</td>';
                    echo '<td>' . $data["firstname"] . '</td>';
                    echo '<td>' . $data["lastname"] . '</td>';
                    echo '<td>' . $data["email"] . '</td>';
                    echo '<td>' . $data["mobile"] . '</td>';
                    echo '<td>' . $data["date"]. '</td>';
                    echo '<td>' . $data["status"] . '</td>';
                echo '</tr>';
            }
        }
        echo '</tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
                </div>
            </div>';


    }

    /**
     * @param $submissions
     * @param $form_id
     * @return array
     */

    function get_wisenet_users($userid){
        global $pdo;
        $Personal = array();
        $Demographics = array();
        $NextOfKin = array();
        $i = 0;
        $sql = "SELECT per.id as ids, per.title, per.genderDetails, per.firstname, per.middlename, per.lastname, per.dob, per.residentialAddress, per.suburbtown, per.state, per.postcode, per.postalAddress, per.homePhone, per.mobile,
                per.fax, per.email, per.noVSN, per.usi, per.concessionCard, per.concessionExpiry, per.std_id, dem.id, dem.employmentStatus, dem.employmentRole, dem.employmentSector, dem.schoolingStatus, dem.schoolingLevel, 
                dem.schoolingLevelYear, dem.birthCountry, dem.speakEnglish, dem.speakStatus, dem.TSIorigin, dem.disability, dem.usrid, lnk.id, lnk.relationname, lnk.relationship, lnk.relationhomeNumber, lnk.relationmobile, 
                lnk.usrid FROM personal as per, demographics as dem, localnextofkin as lnk WHERE per.id = dem.usrid AND per.id = lnk.usrid AND per.status != 1 AND per.std_id = :userids";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam('userids',  $userid, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($row){
            foreach ($row as $value) {
                $id = $value['ids'];
                $Personal['IsActive'] = true;
                $Personal['Title'] = strtoupper($value['title']);
                $Personal['FirstName'] =  strtoupper($value['firstname']);
                $Personal['MiddleName'] =  strtoupper($value['middlename']);
                $Personal['LastName'] =  strtoupper($value['lastname']);
                $Personal['DateOfBirth'] = $value['dob'];
                $Personal['GenderId'] = $value['genderDetails'];
                $Personal['UniqueStudentIdentifier'] = $value['usi'];
                if($value['noVSN'] != NULL){
                    $Personal['VictorianStudentNumber'] = $value['noVSN'];
                }
                else {$Personal['VictorianStudentNumber'] = '888888888';
                }
                $Personal['LearnerAlt1Number'] = $value['std_id'];
                $Personal['SyncToSugarCrm'] = true;
                $Personal['SyncToXero'] = false;
                $Personal['EmailAddresses']['Email'] =  strtoupper($value['email']);
                /**  PhoneNumbers **/
                $Personal['PhoneNumbers']['PhoneHome'] = preg_replace('/\D+/', '', $value['homePhone']);
                $mobile = preg_replace('/\D+/', '', $value['mobile']);
                $Personal['PhoneNumbers'] ['Mobile'] = "+".$mobile;
                $Personal['PhoneNumbers']['FaxHome'] = $value['fax'];
                /**  End PhoneNumbers **/
                /** StreetAddress , PostalAddress, PermanentAddress **/
                $Personal['StreetAddress']['StreetName'] =  strtoupper($value['residentialAddress']);
                $Personal['StreetAddress']['SuburbTownCity'] = strtoupper($value['suburbtown']);
                $Personal['StreetAddress']['StateId'] = $value['state'];
                $Personal['StreetAddress']['Postcode'] =  strtoupper($value['postcode']);
                $Personal['StreetAddress']['CountryId'] = 83;
                /** End StreetAddress, PostalAddress, PermanentAddress **/
                /** StreetAddress, PostalAddress, PermanentAddress **/
                $Personal['PostalAddress']['StreetName'] =  strtoupper($value['postalAddress']);
                /** End StreetAddress , PostalAddress, PermanentAddress **/
                /** StreetAddress , PostalAddress, PermanentAddress **/
                $Personal['PermanentAddress']['StreetName'] =  strtoupper($value['residentialAddress']);
                $Personal['PermanentAddress']['SuburbTownCity'] =  strtoupper($value['suburbtown']);
                $Personal['PermanentAddress']['StateId'] = $value['state'];
                $Personal['PermanentAddress']['Postcode'] =  strtoupper($value['postcode']);
                $Personal['PermanentAddress']['CountryId'] = 83;
                /** End StreetAddress , PostalAddress, PermanentAddress **/
                $Personal['HealthcareNumber'] = $value['concessionCard'];
                $Personal['HealthcareExpiryDate'] = $value['concessionExpiry'];
                /**  NextOfKinRelationships **/
                $NextOfKin['LocalNextOfKin']['FirstName'] =  strtoupper($value['relationname']);
                $NextOfKin['LocalNextOfKin']['RelationshipId'] = $value['relationship'];
                $NextOfKin['LocalNextOfKin']['PhoneHome'] = $value['relationhomeNumber'];
                $NextOfKin['LocalNextOfKin']['Mobile'] = "+".$value['relationmobile'];
                /**  End NextOfKinRelationships **/
                /**  Demographics **/
                $Demographics['EmploymentStatusId'] = $value['employmentStatus'];
                $Demographics['OccupationIdentifierId'] = $value['employmentRole'];
                $Demographics['IndustryOfEmploymentId'] = $value['employmentSector'];
                $Demographics['HighestSchoolLevelCompletedId'] = $value['schoolingLevel'];
                $Demographics['HighestSchoolLevelCompletedYear'] = $value['schoolingLevelYear'];
                $Demographics['IsStillAtSchool'] = get_schoolStatus($value['schoolingStatus']);
                $Demographics['PrimaryLanguageId'] = $value['speakEnglish'];
                $Demographics['SpokenEnglishProficiencyId'] = $value['speakStatus'];
                $Demographics['IndigenousStatusId'] = $value['TSIorigin'];
                $Demographics['CountryOfBirthId'] = $value['birthCountry'];
                $Demographics['DisabilityFlagId'] = $value['disability'];

                $sql2 = "SELECT * FROM previousqualification WHERE usrid = :userid";
                $stmt2 = $pdo->prepare($sql2);
                $stmt2->bindParam('userid',  $id, PDO::PARAM_STR);
                $stmt2->execute();
                $row2   = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                if (!empty($row2)) {
                    $Demographics["HasPriorEducationalAchievementId"] = 2;
                    foreach ($row2 as $value2) {
                        $Demographics["PriorEducationAchievements"][] = get_previousEducation($value2['qualificationName'], $value2['qualificationType']);
                    }
                } else{
                    $Demographics["HasPriorEducationalAchievementId"] = 3;
                }
                $sql3 = "SELECT * FROM disability WHERE usrid = :userid";
                $stmt3 = $pdo->prepare($sql3);
                $stmt3->bindParam('userid',  $id, PDO::PARAM_STR);
                $stmt3->execute();
                $row3   = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                if (!empty($row3)) {
                        foreach ($row3 as $value3) {
                            $Demographics["DisabilityIds"][] = $value3['disabilityCondition'];
                        }
                }

                if (!empty($Personal)){
                    $details = array("LearnerId" => 0, "Personal" => $Personal, "Demographics" => $Demographics, "NextOfKin" => $NextOfKin);
                    $wisenet[$i] = $details;
                    $i++;
                }
                unset($Personal);
                unset($Demographics);
                unset($NextOfKin);
            }
            return $wisenet;
        }
        else{
            echo "Already Uploaded to wisenet";
        }
    }

    /**
     * @param $wisedata
     * @return bool|string
     */

    function wisesnet_insert($wisedata){
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
     * @return string
     */

    function display_studentDocumentVerification($page){
        global $url;
        get_breadcrumbs($page);
        /* Begin Page Content */
        echo '<div class="container-fluid">';
        //echo  '<h1 class="h3 mb-4 text-gray-800" style="text-align: center; padding-top: 30px;">List of Approved Students</h1>';
        echo '<h1 class="mb-4 text-gray-800" style="text-align: center; padding-top: 30px;">Student Documents Verification</h1>';
        /*  Page Heading */
        echo  '<div class="row">
               <div class="col-sm-12">
                <div class="card shadow mb-4">
                   <!-- <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">You can edit,update and delete users through this panel</h6>
                    </div>-->
                    <div class="card-body border-bottom-success">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Student Identification</th>
                                        <th>Student Name</th>
                                        <th>Document Type</th>
                                       <th>Status</th>
                                        <th>Download Certificate</th> 
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Student Identification</th>
                                        <th>Student Name</th>
                                        <th>Document Type</th>
                                        <th>Status</th>
                                        <th>Download Certificate</th>
                                    </tr>
                                </tfoot>
                                <tbody>';

        $row = get_studentDocumentVerification();
        foreach ($row as $data){
            echo '<tr>';
            echo '<td>'.$data["std_id"].'</td>';
            echo '<td> '.get_username($data["std_id"]).'</td>';
            echo '<td>'.$data["documentId"].'</td>';
            echo '<td>'.$data["status"].'</td>';
            echo '<td><a href = "'.$url.'/pdfReport.php?id='.$data["id"].'" target="_blank">Certificate</a></td>';
            echo '</tr>';
        }
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



    function display_studentDocuments($page){
        get_breadcrumbs($page);
        /* Begin Page Content */
        echo '<div class="container-fluid">';
        //echo  '<h1 class="h3 mb-4 text-gray-800" style="text-align: center; padding-top: 30px;">List of Approved Students</h1>';
        echo '<h1 class="mb-4 text-gray-800" style="text-align: center; padding-top: 30px;">Student Documents Verification</h1>';
        /*  Page Heading */
        echo  '<div class="row">
               <div class="col-sm-12">
                <div class="card shadow mb-4">
                   <!-- <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">You can edit,update and delete users through this panel</h6>
                    </div>-->
                   <div class="card-body border-bottom-success">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Student Identification</th>
                                        <th>Student Name</th>
                                        <th>Enrolment Agreement Form</th>
                                        <th>Skill First Program</th>
                                        <th>USI Documents</th>
                                        <th>Identity Documents</th>
                                        <th>Verified Documents</th> 
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Student Identification</th>
                                        <th>Student Name</th>
                                        <th>Enrolment Agreement Form</th>
                                        <th>Skill First Program</th>
                                        <th>USI Documents</th>
                                        <th>Identity Documents</th>
                                        <th>Verified Documents</th> 
                                    </tr>
                                </tfoot>
                                <tbody>';
        //https://api.jotform.com/pdf-converter/{formId}/fill-pdf?download=1&submissionID={sumissionID}&apikey={apiKey}
        //$url = "http://www.jotform.com/uploads/Account_Username/".$formid."/".$submission_id."/".$upload;
        $api = get_setting_api();
        $row = get_studentDocuments();
        foreach ($row as $data){
            $identity =json_decode($data["documentForm"], true);

            echo '<tr>';
            echo '<td>'.$data["std_id"].'</td>';
            echo '<td> '.get_username($data["std_id"]).'</td>';
            echo '<td>'.$data["enrolForm"].'</td>';
            echo '<td>'.$data["skillForm"].'</td>';
            echo '<td>'.$data["usiForm"].'</td>';
            echo '<td>'.$identity.'</td>';
            echo '<td> NULL </td>';
            echo '</tr>';
        }

       /* $row = get_studentDocumentVerification();
        foreach ($row as $data){
            echo '<tr>';
            echo '<td>'.$data["std_id"].'</td>';
            echo '<td> '.get_username($data["std_id"]).'</td>';
            echo '<td>'.$data["documentId"].'</td>';
            echo '<td>'.$data["status"].'</td>';

            echo '<td><a href = "http://testenrol.of.edu.au/pdfReport.php?id='.$data["id"].'" target="_blank">Certificate</a></td>';
            echo '</tr>';
        }*/
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


    function thankyou($page,$form){
        get_breadcrumbs($page);
        /* Begin Page Content */
        include('config.php');
        global $pdo, $url;

        echo '<div class="container-fluid">';
        //echo  '<h1 class="h3 mb-4 text-gray-800" style="text-align: center; padding-top: 30px;">List of Approved Students</h1>';
        /*  Page Heading */
        if($form=='enrolForm'){
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
                         <a href="'.$url.'/index.php" class="btn btn-success w-30">
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



function uploadUserWisenet($page){

    get_breadcrumbs($page);
    /* Begin Page Content */
    echo '<div class="container-fluid">';
    //echo  '<h1 class="h3 mb-4 text-gray-800" style="text-align: center; padding-top: 30px;">List of Approved Students</h1>';
    echo '<h1 class="mb-4 text-gray-800" style="text-align: center; padding-top: 30px;">Current Enrolment Submissions</h1>';


    /*  Page Heading */
    echo  '<div class="row">
                    <div class="col-sm-12">
                <div class="card shadow mb-4">
                   <!-- <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">You can edit,update and delete users through this panel</h6>
                    </div>-->
                    <div class="card-body border-bottom-success">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>JotForm ID</th>
                                        <th>Name</th>                          
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>JotForm ID</th>
                                        <th> Name</th>              
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>';

    $response = get_completedEnrolmentData();
 //   print_r($response);
    $row = get_approved_student();
    $i = 1;
    foreach ($response as $data){
        echo '<tr>';
        echo '<td>'.$i.'</td>';
        echo '<td>'.$data["std_id"].'</td>';
        echo '<td>'.get_user_name($data["usrid"]).'</td>';
        $rs = json_decode($data["enrolForm"], true);
        echo '<td>';
        print_r($rs);
        echo '</td>';
        echo '</tr>';
        $i++;
    }
   /* print_r($rs);*/
    echo '                            </tbody>
                                   </table>
                              </div>
                         </div>
                     </div>
                  </div>
                </div>
            </div>';
    /* container-fluid */
}

function get_wisenetUsers($userid){
        global $pdo;
        $Personal = array();
        $Demographics = array();
        $NextOfKin = array();
        $i = 0;
        $sql = "SELECT per.id as ids, per.title, per.genderDetails, per.firstname, per.middlename, per.lastname, per.dob, per.residentialAddress, per.suburbtown, per.state, per.postcode, per.postalAddress, per.homePhone, per.mobile,
                per.fax, per.email, per.noVSN, per.usi, per.concessionCard, per.concessionExpiry, per.std_id, dem.id, dem.employmentStatus, dem.employmentRole, dem.employmentSector, dem.schoolingStatus, dem.schoolingLevel, 
                dem.schoolingLevelYear, dem.birthCountry, dem.speakEnglish, dem.speakStatus, dem.TSIorigin, dem.disability, dem.usrid, lnk.id, lnk.relationname, lnk.relationship, lnk.relationhomeNumber, lnk.relationmobile, 
                lnk.usrid FROM personal as per, demographics as dem, localnextofkin as lnk WHERE per.id = dem.usrid AND per.id = lnk.usrid AND per.status != 1 AND per.std_id = :userids";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam('userids',  $userid, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($row){
            foreach ($row as $value) {
                $id = $value['ids'];
                $Personal['IsActive'] = true;
                $Personal['Title'] = strtoupper($value['title']);
                $Personal['FirstName'] =  strtoupper($value['firstname']);
                $Personal['MiddleName'] =  strtoupper($value['middlename']);
                $Personal['LastName'] =  strtoupper($value['lastname']);
                $Personal['DateOfBirth'] = $value['dob'];
                $Personal['GenderId'] = $value['genderDetails'];
                $Personal['UniqueStudentIdentifier'] = $value['usi'];
                if($value['noVSN'] != NULL){
                    $Personal['VictorianStudentNumber'] = $value['noVSN'];
                }
                else {$Personal['VictorianStudentNumber'] = '888888888';
                }
                $Personal['LearnerAlt1Number'] = $value['std_id'];
                $Personal['SyncToSugarCrm'] = true;
                $Personal['SyncToXero'] = false;
                $Personal['EmailAddresses']['Email'] =  strtoupper($value['email']);
                /**  PhoneNumbers **/
                $Personal['PhoneNumbers']['PhoneHome'] = preg_replace('/\D+/', '', $value['homePhone']);
                $mobile = preg_replace('/\D+/', '', $value['mobile']);
                $Personal['PhoneNumbers'] ['Mobile'] = "+".$mobile;
                $Personal['PhoneNumbers']['FaxHome'] = $value['fax'];
                /**  End PhoneNumbers **/
                /** StreetAddress , PostalAddress, PermanentAddress **/
                $Personal['StreetAddress']['StreetName'] =  strtoupper($value['residentialAddress']);
                $Personal['StreetAddress']['SuburbTownCity'] = strtoupper($value['suburbtown']);
                $Personal['StreetAddress']['StateId'] = $value['state'];
                $Personal['StreetAddress']['Postcode'] =  strtoupper($value['postcode']);
                $Personal['StreetAddress']['CountryId'] = 83;
                /** End StreetAddress, PostalAddress, PermanentAddress **/
                /** StreetAddress, PostalAddress, PermanentAddress **/
                $Personal['PostalAddress']['StreetName'] =  strtoupper($value['postalAddress']);
                /** End StreetAddress , PostalAddress, PermanentAddress **/
                /** StreetAddress , PostalAddress, PermanentAddress **/
                $Personal['PermanentAddress']['StreetName'] =  strtoupper($value['residentialAddress']);
                $Personal['PermanentAddress']['SuburbTownCity'] =  strtoupper($value['suburbtown']);
                $Personal['PermanentAddress']['StateId'] = $value['state'];
                $Personal['PermanentAddress']['Postcode'] =  strtoupper($value['postcode']);
                $Personal['PermanentAddress']['CountryId'] = 83;
                /** End StreetAddress , PostalAddress, PermanentAddress **/
                $Personal['HealthcareNumber'] = $value['concessionCard'];
                $Personal['HealthcareExpiryDate'] = $value['concessionExpiry'];
                /**  NextOfKinRelationships **/
                $NextOfKin['LocalNextOfKin']['FirstName'] =  strtoupper($value['relationname']);
                $NextOfKin['LocalNextOfKin']['RelationshipId'] = $value['relationship'];
                $NextOfKin['LocalNextOfKin']['PhoneHome'] = $value['relationhomeNumber'];

                $NextOfKin['LocalNextOfKin']['Mobile'] = "+".$value['relationmobile'];
                /**  End NextOfKinRelationships **/
                /**  Demographics **/
                $Demographics['EmploymentStatusId'] = $value['employmentStatus'];
                $Demographics['OccupationIdentifierId'] = $value['employmentRole'];
                $Demographics['IndustryOfEmploymentId'] = $value['employmentSector'];
                $Demographics['HighestSchoolLevelCompletedId'] = $value['schoolingLevel'];
                $Demographics['HighestSchoolLevelCompletedYear'] = $value['schoolingLevelYear'];
                $Demographics['IsStillAtSchool'] = get_schoolStatus($value['schoolingStatus']);
                $Demographics['PrimaryLanguageId'] = $value['speakEnglish'];
                $Demographics['SpokenEnglishProficiencyId'] = $value['speakStatus'];
                $Demographics['IndigenousStatusId'] = $value['TSIorigin'];
                $Demographics['CountryOfBirthId'] = $value['birthCountry'];
                $Demographics['DisabilityFlagId'] = $value['disability'];

                $sql2 = "SELECT * FROM previousqualification WHERE usrid = :userid";
                $stmt2 = $pdo->prepare($sql2);
                $stmt2->bindParam('userid',  $id, PDO::PARAM_STR);
                $stmt2->execute();
                $row2   = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($row2)) {
                    $Demographics["HasPriorEducationalAchievementId"] = 2;
                    foreach ($row2 as $value2) {
                        $Demographics["PriorEducationAchievements"][] = get_previousEducation($value2['qualificationName'], $value2['qualificationType']);
                    }
                }
                else{
                    $Demographics["HasPriorEducationalAchievementId"] = 3;
                }
                $sql3 = "SELECT * FROM disability WHERE usrid = :userid";
                $stmt3 = $pdo->prepare($sql3);
                $stmt3->bindParam('userid',  $id, PDO::PARAM_STR);
                $stmt3->execute();
                $row3   = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($row3)) {
                    foreach ($row3 as $value3) {
                        $Demographics["DisabilityIds"][] = $value3['disabilityCondition'];
                    }
                }

                if (!empty($Personal)){
                    $details = array("LearnerId" => 0, "Personal" => $Personal, "Demographics" => $Demographics, "NextOfKin" => $NextOfKin);
                    $wisenet[$i] = $details;
                    $i++;
                }
                unset($Personal);
                unset($Demographics);
                unset($NextOfKin);
            }
            return $wisenet;
        }
        else{
            echo "Already Uploaded to wisenet";
        }
    }

}