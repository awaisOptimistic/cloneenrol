<?php

class users{
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
    /**
     * Function to display current active user
     * @print [display table with all users details]
     */

    public function current_users_display_report($page){
        $role =  $_SESSION['role'];
        get_breadcrumbs($page);
        /* Begin Page Content */
        echo '<div class="container-fluid">';
        /*  Page Heading */

        if($role == 1) {
            echo '<h1 class="h1 mb-4 text-gray-800" style="text-align: center; padding-top: 30px;">Current Users &nbsp; <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning"><i class="fa fa-plus "></i>&nbsp; Add New User</button> </h1> ';
            print_table_header();
            echo '<thead>
                    <tr>
                        <th>S.No.</th>
                        <th >Id</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Course</th>
                        <th>Campus</th>
                        <th>Referral</th>
                        <th>Registration Date</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
               </thead>
               <tfoot>
                    <tr>
                        <th>S.No.</th>
                        <th >Id</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Course</th>
                        <th>Campus</th>
                        <th>Referral</th>
                        <th>Registration Date</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
               </tfoot>
               <tbody>';
            $row = get_current_users();
            $i=0;
            foreach ($row as $data){
                $i++;
                echo '<tr>';
                echo '<td >'.$i.'</td>';
                echo '<td >' . $data["uqid"] . '</td>';
                echo '<td>' . $data["firstname"] .' ' .$data["lastname"] . '</td>';
                echo '<td>' . $data["email"] . '</td>';
                echo '<td> +61'.$data["phone"].'</td>';
                echo '<td>'.$data["courses"].'</td>';
                echo '<td>'.$data["campus"].'</td>';
                if($data["referral"]==null || empty($data["referral"])){echo '<td>-</td>';}else {
                    echo '<td>' . $data["referral"] . '</td>';
                }
                echo '<td>'.$data["signupDate"].'</td>';
                /*  echo '<td>'.$data["password"].'</td>';*/
                if ($data["role"] == 1):    echo '<td>Admin</td>';
                elseif ($data["role"] == 2):echo '<td>Coordinator</td>';
                elseif ($data["role"] == 4):echo '<td>Auditor</td>';
                else:echo '<td>Student</td>'; endif;
                echo '<td><a href="#" id="' . $data["id"] . '" data-toggle="modal" data-target="#add_data_Modal2" class="btn btn-primary btn-circle btn-md bringupdateform"  >
                           <i class="fas fa-edit"></i></a>
                           
                   <a href="#" class="btn btn-danger btn-circle btn-md" id="' . $data["id"] . '"><i class="fas fa-trash"></i></a></td></tr>'  ;
            }
            print_table_footer();
        }
        else{
            echo '<h1 class="h1 mb-4 text-gray-800" style="text-align: center; padding-top: 30px;">Current Students </h1>';
            print_table_header();
            echo '<thead>
                    <tr>
                        <th>S.No.</th>
                        <th >Id</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Course</th>
                        <th>Campus</th>
                       <!-- <th>Referral</th>-->
                        <th>Registration Date</th>
                    </tr>
               </thead>
               <tfoot>
                    <tr>
                        <th>S.No.</th>
                        <th>Id</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Course</th>
                        <th>Campus</th>
                       <!-- <th>Referral</th>-->
                        <th>Registration Date</th>
                        
                    </tr>
               </tfoot>
               <tbody>';
            $row = get_current_students();
            $i=0;
            foreach ($row as $data){
                $i++;
                echo '<tr>';
                echo '<td>'.$i.'</td>';
                echo '<td>' . $data["uqid"] . '</td>';
                echo '<td>' . $data["firstname"] .' ' .$data["lastname"] . '</td>';
                echo '<td>' . $data["email"] . '</td>';
                echo '<td>'.$data["phone"].'</td>';
                echo '<td>'.$data["courses"].'</td>';
                echo '<td>'.$data["campus"].'</td>';
                /*if($data["referral"]==null || empty($data["referral"])){echo '<td>-</td>';}else {
                    echo '<td>' . $data["referral"] . '</td>';
                }*/
                echo '<td>'.$data["signupDate"].'</td>';
            }
            print_table_footer();
        }
        echo '<div id="add_data_Modal2" class="modal fade">  
                  <div class="modal-dialog">  
                       <div class="modal-content">  
                            <div class="modal-header">  
                                   <h4 class="modal-title">Edit User Details</h4>  
                                   <button type="button" class="close" data-dismiss="modal">&times;</button>  
                            </div>  
                            <div class="modal-body" id="updationform">  
                            </div>  
                            <div class="modal-footer">  
                                 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
                            </div>  
                       </div>  
                  </div>  
              </div> 
              <!-- / PHP Ajax Update MySQL Data Through Bootstrap Modal -->';
        ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".bringupdateform").click(function() {
                    var userid = $(this).attr('id');
                    $.ajax({    //create an ajax request to display.php
                        type: "POST",
                        url: "editUser.php",
                        data:{'userid': userid},
                        dataType: "html",   //expect html to be returned
                        success: function(data){
                            $("#updationform").html(data);
                            //alert(response);
                        }
                    });
                });
            });
        </script>
        <?php
        echo '<!-- PHP Ajax Update MySQL Data Through Bootstrap Modal For Add New User -->
              <div id="add_data_Modal" class="modal fade">  
                  <div class="modal-dialog">  
                       <div class="modal-content">  
                            <div class="modal-header">  
                                   <h4 class="modal-title">Create new account</h4>  
                                   <button type="button" class="close" data-dismiss="modal">&times;</button>  
                            </div>  
                            <div class="modal-body">  
                                <form class="user" id="registrationform" method="post" action="">
                          <div class="card-body">
                             <div class="mb-3"> <input type="text" class="form-control form-control-user" id="FirstName" placeholder="First Name" name="firstname"></div>
                             <div class="mb-3"> <input type="text" class="form-control form-control-user" id="LastName" placeholder="Last Name" name="lastname"> </div>
                             <div class="form-group mb-3"> <input type="email" class="form-control form-control-user" id="Email" placeholder="Email Address" name="email"> </div>
                             <div class="form-group mb-3"> <input type="number" class="form-control form-control-user" id="phone" placeholder="Phone" name="phone"> </div>
                             <div class="form-group row mb-3">
                                <div class="col-sm-6 mb-3 mb-sm-0 mb-3"> <input type="password" class="form-control form-control-user" id="Password" placeholder="Password" name="password"></div>
                                <div class="col-sm-6 mb-3"> <input type="password" class="form-control form-control-user" id="RepeatPassword" placeholder="Repeat Password" </div>
                                <div id="passworderror" style="margin-left: 20px;"></div>
                             </div>

                            <div class="col-sm-6 mb-3 form-floating">
                                <div class="form-group row">
                                    <div id="roleDiv">
                                        <select class="browser-default custom-select form-select" id="role">
                                            <option value="Select Role" selected>Select Role</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Coordinator</option>
                                            <option value="3">Student</option>
                                            <option value="4">Auditor</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-footer">
                              <button type="submit" name="submitBtnLogin" id="submitBtnLogin" class="btn btn-success w-100">Create new account</button>
                            </div>
                          </div>
                          <div id="messageblock" style="padding-top:10px; display: none; ">
                                <div class="card mb-4 py-3 border-left-success" style="padding-top:0px !important;padding-bottom:0px !important; ">
                                    <div class="card-body" style="color:#1cc88a" id="msg"></div>
                                </div>
                          </div>
                          <div id="errorblock" style="padding-top:10px; display: none; ">
                                <div class="card mb-4 py-3 border-left-danger" style="padding-top:0px !important;padding-bottom:0px !important; ">
                                    <div class="card-body" style="color:red" id="errormsg"></div>
                                </div>
                          </div>
                        </form>
                            </div>  
                            <div class="modal-footer">  
                                 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
                            </div>  
                       </div>  
                  </div>  
              </div> 
              <!-- / PHP Ajax Update MySQL Data Through Bootstrap Modal -->';

        ?>
        <!--for multiselect-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
        <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
        <script>
            $(document).ready(function(){
                var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                    removeItemButton: true,
                    maxItemCount:3,
                    searchResultLimit:3,
                    renderChoiceLimit:100
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#role').change(function (){
                    var optvalue=$("#role option:selected").text();
                    if(optvalue!='Student'){
                        $("#studentData").css("display","none");
                    }else{

                        $("#studentData").css("display","block");
                    }
                });


                $('#registrationform').submit(function(e) {
                    e.preventDefault();
                    $("#errorblock").css("display","none");
                    $("#messageblock").css("display","none");
                    var first_name = $('#FirstName').val();
                    var last_name = $('#LastName').val();
                    var email = $('#Email').val();
                    var phone = $('#phone').val();
                    var password = $('#Password').val();
                    var repeatPassword = $('#RepeatPassword').val();
                    var EmailregEx = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    var nameRegEx=/^(?=.{1,50}$)[a-z]+(?:['_.\s][a-z]+)*$/i;
                    var errorCount=0;
                    var page="adminPanel";
                    var role=$("#role option:selected").text();
                    $(".error").remove();

                    var validFirstName = nameRegEx.test(first_name);
                    if (first_name.length < 1) {
                        $('#FirstName').after('<div class="error" style="padding-top:10px; margin:0px;"><p class="error" style="color:red; font-size:12px;margin:0px;">This field is required</p></div>');
                        errorCount++;
                    }else if (!validFirstName) {
                        $('#FirstName').after('<div class="error" style="padding-top:10px; margin:0px;"><p class="error" style="color:red; font-size:12px;margin:0px;">Enter a valid First Name</p></div>');
                        errorCount++;
                    }

                    var validLastName = nameRegEx.test(last_name);
                    if (last_name.length < 1) {
                        $('#LastName').after('<div class="error" style="padding-top:10px;margin:0px;"><p class="error" style="color:red; font-size:12px;margin:0px;">This field is required</p></div>');
                        errorCount++;
                    }else if(!validLastName) {
                        $('#LastName').after('<div class="error" style="padding-top:10px;margin:0px;"><p class="error" style="color:red; font-size:12px;margin:0px;">Enter a valid Last Name</p></div>');
                        errorCount++;
                    }
                    if (email.length < 1) {
                        $('#Email').after('<div class="error" style="padding-top:10px;margin:0px;"><p style="color:red; font-size:12px;margin:0px;">This field is required</p></div>');
                        errorCount++;
                    }else {
                        var validEmail = EmailregEx.test(email);
                        if (!validEmail) {
                            $('#Email').after('<div class="error" style="padding-top:10px;" margin:0px;><p class="error" style="color:red; font-size:12px;margin:0px;">Enter a valid email</p></div>');
                            errorCount++;
                        }
                    }

                    if (password.length < 8 ) {
                        $('#passworderror').append('<div class="error" style="padding-top:10px;margin:0px;margin:0px;"><p class="error" style="color:red; font-size:12px;">Password must be at least 8 characters</p></div>');
                        errorCount++;
                    }else if(password!=repeatPassword){
                        $('#passworderror').append('<div class="error" style="padding-top:10px;margin:0px;margin:0px;"><p class="error" style="color:red; font-size:12px;">Password do not match.</p></div>');
                        errorCount++;
                    }
                    if(role=="Select Role" || role==null){
                        $('#roleDiv').after('<div class="error" style="padding-top:10px; margin:0px;"><p class="error" style="color:red; font-size:12px;margin:0px;">Please select any role</p></div>');
                        errorCount++;
                    }else if(role=="Student"){
                        var select = document.getElementById('choices-multiple-remove-button');
                        var selected = [...select.options]
                            .filter(option => option.selected)
                            .map(option => option.value);
                        if(selected=="" || role==null){
                            $('#choices-multiple-remove-button').after('<div class="error" style="padding-top:10px; margin:0px;"><p class="error" style="color:red; font-size:12px;margin:0px;">Please select course/courses</p></div>');
                            errorCount++;
                        }
                        var mediaSource=$("#source option:selected").text();
                        if(mediaSource=="How did you find us?"){
                            $('#source').after('<div class="error" style="padding-top:10px; margin:0px;"><p class="error" style="color:red; font-size:12px;margin:0px;">Please select one of the options</p></div>');
                            errorCount++;
                        }
                    }
                    if(errorCount==0){
                        if (role=="Student"){
                            var info={
                                FirstName: first_name,
                                LastName: last_name,
                                Email: email,
                                Phone:phone,
                                Password: password,
                                Page:page,
                                Role:3,
                                source:mediaSource,
                                course:selected
                            }
                        }else if (role=="Admin"){
                            var info={
                                FirstName: first_name,
                                LastName: last_name,
                                Email: email,
                                Phone:phone,
                                Password: password,
                                Page:page,
                                Role:1
                            }
                        }else if (role=="Coordinator"){
                            var info={
                                FirstName: first_name,
                                LastName: last_name,
                                Email: email,
                                Phone:phone,
                                Password: password,
                                Page:page,
                                Role:2
                            }
                        }else if (role=="Auditor"){
                            var info={
                                FirstName: first_name,
                                LastName: last_name,
                                Email: email,
                                Phone:phone,
                                Password: password,
                                Page:page,
                                Role:4
                            }
                        }
                        $.ajax({
                            url: "registerationlogic2.php",
                            type: "POST",
                            data: info,
                            success: function(data){
                                var a = data.includes("Success");
                                if (a) {
                                    $("#messageblock").css("display","block");
                                    $('#msg').html(data);
                                    $('#registrationform').find('input').val('')
                                } else {
                                    $("#errorblock").css("display","block");
                                    $('#errormsg').html(data);
                                }
                            },error: function(xhr, status, error) {
                                var err = eval("(" + xhr.responseText + ")");
                                alert(err.Message);
                            }
                        });
                    }
                });
            });

            /**
             * Ajax to delete form
             **/
            $(function(){
                $(document).on('click','.btn.btn-danger.btn-circle.btn-md',function() {
                    if (confirm("Are you sure delete this ?")) {
                        var del_id = $(this).attr('id');
                        var $ele = $(this).parent().parent();
                        //console.log(del_id);
                        $.ajax({
                            type: 'POST',
                            url:  'registerationlogic2.php',
                            data: {'del_id': del_id},
                            success: function (data) {
                                if (data == "YES") {
                                    $ele.fadeOut().remove();
                                    alert("User deleted successfully");
                                    window.location.reload();
                                } else {
                                    window.location.reload();
                                    alert("Invalid User id")
                                }
                            }
                        });
                    }
                });
            });
        </script>
        <?php
    }


    /*** Student Progress Page 20 ***/
    public function current_users_progress_report($page){
        $role =  $_SESSION['role'];
        global $pdo;
        get_breadcrumbs($page);
        ?>
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
        <?php
        /* Begin Page Content */
        echo '<div class="container-fluid">';

        /*  Page Heading */
        if($role == 1 || $role==2) {
            echo '<h1 class="h1 mb-4 text-gray-800" style="text-align: center; padding-top: 30px;">Students Progress</h1> ';
            echo '<div class="row">
            <div class="col-lg-3">
            <div class="card">
                      <div class="card-body p-2 text-center">
                        <div class="h1 m-0"><i class="fa fa-check" style="color:green;"></i></div>
                        <div class="text-muted mb-3">Reviewed by coordinator</div>
                      </div>
                    </div>
            </div>
            <div class="col-lg-3">
            <div class="card">
                      <div class="card-body p-2 text-center">
                        <div class="h1 m-0"><i class="fab fa-medium-m" style="color:orange;"></i></div>
                        <div class="text-muted mb-3">Marked Manually on paper</div>
                      </div>
                    </div>
            </div>
            <div class="col-lg-3">
            <div class="card">
                      <div class="card-body p-2 text-center">
                        <div class="h1 m-0"><i class="fas fa-globe" style="color:orange;"></i></div>
                        <div class="text-muted mb-3">Submitted Online</div>
                      </div>
                    </div>
            </div>
            <div class="col-lg-3">
            <div class="card">
                      <div class="card-body p-2 text-center">
                        <div class="h1 m-0"><button class="btn-dark btn-circle btn-sm"><i class="fa fa-check" style="color:white;"></i></button></div>
                        <div class="text-muted mb-3">Mark activity as Manually completed</div>
                      </div>
                    </div>
            </div>
            </div>
            </div>';

            include "config.php";


            $query2 = "SELECT * FROM `of_enrolment` , `user` WHERE of_enrolment.usrid = user.id AND user.role = 3 ORDER BY of_enrolment.id DESC";
            $stmt2 = $pdo->prepare($query2);
            //$stmt2->bindParam('userId', $userId, PDO::PARAM_STR);
            $stmt2->execute();
            $row2   = $stmt2->fetchAll(PDO::FETCH_ASSOC);


            $i= 1;

            print_table_header();
            echo '<thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Student Id</th>
                        <th>Full Name</th>           
                        <th>Phone</th>
                        <th>Course</th>
                        <th>Campus</th>
                        <th>Enrol</th>
                        <th>Documents</th>
                        <th>USI</th>
                        <th>LLN</th>
                        <th>Skill First</th>
                        <th>PTR</th>
                        <th>Details</th>
                    </tr>
               </thead>
               <tfoot>
                    <tr>
                        <th>S.No.</th>
                        <th>Student Id</th>
                        <th>Full Name</th>                
                        <th>Phone</th>
                        <th>Course</th>
                        <th>Campus</th>
                        <th>Enrolment Form</th>
                        <th>Documents</th>
                        <th>USI</th>
                        <th>LLN</th>
                        <th>Skill First</th>
                        <th>PTR</th>
                        <th>Details</th>
                    </tr>
               </tfoot>
               <tbody>';
            foreach ($row2 as $data){
                echo '<tr>';
                echo '<td ">'.$i.'</td>';
                echo '<td >' . $data["uqid"] . '</td>';
                echo '<td>' . $data["firstname"] .' ' .$data["lastname"] . '</td>';
                echo '<td> +61'.$data["phone"].'</td>';
                echo '<td>'.$data["courses"].'</td>';
                echo '<td>'.$data["campus"].'</td>';
                $course=getStudentCourse($data["courses"]);

                if($course==2){
                    echo '<td>'.currentEnrolmentStatus($data).'</td>';
                    echo '<td>'.currentDocStatus($data).'</td>';
                    echo '<td>-</td>';
                    echo '<td>-</td>';
                    echo '<td>-</td>';
                    echo '<td>-</td>';
                }else{
                    echo '<td>'.currentEnrolmentStatus($data).'</td>';
                    //docs
                    echo '<td>'.currentDocStatus($data).'</td>';

                    //usi
                    echo '<td>'.currentusiStatus($data).'</td>';

                    //lln
                    echo '<td>'.currentllnStatus($data).'</td>';

                    //skill first
                    echo '<td>'.currentskillfirstStatus($data).'</td>';

                    //ptr
                    echo '<td>'.currentptrStatus($data).'</td>';
                }
                $submission = getSubmissionID($data["uqid"]);

              //  echo $submission;
            /*    if (get_enrolmentStatus($data["uqid"]) != 1){*/
                    echo '<td><a href="index.php?page=20&userid='.$data['id'].'" target="_blank"></ahref><i class="fa fa-link" style="color:blue;"></i></a>';
                    echo '<a href="index.php?page=14&submission='.$submission.'" class="btn btn-warning" onclick="showHide2();">Sync</a></td></tr>';
              /*  }else{
                    echo '<td><a href="index.php?page=20&userid='.$data['id'].'" target="_blank"></ahref><i class="fa fa-link" style="color:blue;"></i></a></td></tr>';
                }*/

                $i++;
            }
            print_table_footer();
        }
        else{
            echo '<h1 class="h1 mb-4 text-gray-800" style="text-align: center; padding-top: 30px;">Current Students </h1>';
            print_table_header();
            echo '<thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Id</th>
                        <th>Full Name</th>                    
                        <th>Enrolment Form</th>
                        <th>Documents</th>
                        <th>USI</th>
                        <th>LLN</th>
                        <th>Skill First</th>
                        <th>PTR</th>
                        <th>Details</th>
                    </tr>
               </thead>
               <tfoot>
                    <tr>
                        <th>S.No.</th>
                        <th >Id</th>
                        <th>Full Name</th>                   
                        <th>Enrolment Form</th>
                        <th>Documents</th>
                        <th>USI</th>
                        <th>LLN</th>
                        <th>Skill First</th>
                        <th>PTR</th>
                        <th>Details</th>
                    </tr>
               </tfoot>
               <tbody>';

            $row = get_StudentProgressForCoordinator();
            print_table_footer();
        }
        ?>
        <script>

            //checked100
            $(function(){
                $(document).on('change','.form-switch',function() {
                    if (confirm("Do you want to mark this activity as checked?")) {
                        var id = $(this).attr('id');
                        var val=$(this).attr('value');
                        var $ele = $(this).parent().parent();
                        var $ele2 = $(this);
                        //console.log(id);
                        //console.log(val);
                        $.ajax({
                            type: 'POST',
                            url: 'thankyou.php',
                            data: {formvalue: val, userId:id},
                            success: function (data) {
                                if (data == "YES") {
                                    //$ele.fadeOut().remove();
                                    //$ele.append('<i class="fab fa-medium-m" style="color:orange;" data-toggle="tooltip" data-placement="top" title=" atha rakh"></i>');
                                    //$id.html("welcome");
                                    $ele2.html('<i class="fas fa-archive" style="color:green;" data-toggle="tooltip" data-placement="top" title="Marked Completed"></i>');
                                    //alert("Mark completed successfully");
                                    //window.location.reload();
                                    //$('.form-switch').remove();
                                } else {
                                    alert(data);
                                    //window.location.reload();
                                    //alert("Invalid User id")
                                }
                            }
                        });
                    }
                });
            });
            $(function(){
                $(document).on('click','.btn.btn-dark.btn-circle.btn-sm',function() {
                    if (confirm("Do you want to mark this activity as completed ?")) {
                        var id = $(this).attr('id');
                        var val=$(this).attr('value');
                        var $ele = $(this).parent().parent();
                        var $ele2 = $(this).parent();
                       // console.log(id);
                        //console.log(val);
                        $.ajax({
                            type: 'POST',
                            url: 'thankyou.php',
                            data: {formvalue: val, userId:id},
                            success: function (data) {
                                if (data == "YES") {
                                    //$ele.fadeOut().remove();
                                    $ele2.html('<i class="fab fa-medium-m" style="color:orange;"></i>');
                                    //alert("Mark completed successfully");
                                    //window.location.reload();
                                } else {
                                    alert(data);
                                    window.location.reload();
                                    alert("Invalid User id");
                                }
                            }
                        });
                    }
                });
            });

        </script>

        <?php
    }

    public function user_profile($page){
        global $url,$pdo, $enrolmentForm, $usiForm, $skillForm, $documentForm, $usitransForm,$seclln ;
        $role =  $_SESSION['role'];
        get_breadcrumbs($page);
        $userId= $_GET['userid'];
        $api=get_setting_api();

        $query2 = "SELECT * FROM `of_enrolment` JOIN `user` ON of_enrolment.usrid= user.id AND of_enrolment.usrid=:userId ORDER BY of_enrolment.id";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->bindParam('userId', $userId, PDO::PARAM_STR);
        $stmt2->execute();
        $row2   = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        $std_id = $row2[0]['uqid'];

        //   print_r($row2);
        echo '</div><div class="container-fluid">';
        ?>
        <div class="container">
            <div class="main-body">
                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="img/avatarProfile.PNG" alt="Admin" class="rounded-circle" width="150">
                                    <div class="mt-3">
                                        <h4><?php echo $row2[0]['firstname'].' '.$row2[0]['lastname'].' ('.$row2[0]['uqid'].')';?></h4>
                                        <p class="text-secondary mb-1"><?php echo $row2[0]['email'];?></p>
                                        <p class="text-secondary mb-1"><?php echo '+61'.$row2[0]['phone'];?></p>
                                        <p class="text-muted font-size-sm"><?php echo $row2[0]['campus'];?></p>
                                        <p><b>Courses:</b></p>
                                        <p><?php echo $row2[0]['courses'];?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <?php
                            /** Table Start */
                            print_table_header();
                            echo '<thead>
                            <tr>
                                <th style="display: none;">S.No.</th>
                                <th>Document Name</th>
                                <th>Download</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>';

                            $i = 1;
                            echo '<h1 style="text-align: center">Student Enrolment Documents</h1>';
                            echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';
                            /*******************************
                             *******************************
                             ******* Enrolment Form ********
                             *******************************
                             *******************************
                             */

                            $rs = json_decode($row2[0]['enrolForm'],true);
                            if (isset($row2[0]['enrolForm'])!=NULL && is_array($rs)){
                                echo '<br>';
                                $data = json_decode($row2[0]['enrolForm']);
                                $enrolmentSumissionData = json_decode(json_encode($data), true);
                                echo '<tr>';
                                echo '<td style="display: none;">' . $i . '</td>';
                                echo '<td>Enrolment Agreement Form</td>';
                                echo '<td><a href="https://api.jotform.com/pdf-converter/' . $enrolmentForm . '/fill-pdf?download=1&submissionID=' . $enrolmentSumissionData["submission_id"] . '&apikey=' . $api . '" class="text-reset" target="_blank">
                                            <i class="fa fa-file-pdf-o" style="font-size:40px;color:red"></i>
                                        </a></td>';
                                if($role == 1){
                                    echo '<td><a href="'.$url.'/index.php?page=23&submissionid='.$enrolmentSumissionData["submission_id"] .'" id="#"  class="btn btn-primary btn-circle btn-md bringupdateform" target="_blank" ><i class="fas fa-edit"></i></a></td>';
                                }else{
                                    echo '<td>-</td>';
                                }
                                echo '</tr>';

                            }elseif(isset($row2[0]['enrolForm'])==NULL){
                                echo '<tr>';
                                echo '<td style="display: none;">'.$i.'</td>';
                                echo '<td>Enrolment Agreement Form</td>';
                                echo '<td>-</td>';
                                echo '</tr>';
                            }else{
                                echo '<tr>';
                                echo '<td style="display: none;">'.$i.'</td>';
                                echo '<td>Enrolment Agreement Form</td>';
                                echo '<td>Manually Completed</td>';
                                echo '</tr>';
                            }

                            /*******************************
                             *******************************
                             ********* Skill Form  *********
                             *******************************
                             *******************************
                             */
                            $rs1 = json_decode($row2[0]['skillForm'],true);
                            if (isset($row2[0]['skillForm'])!=NULL && is_array($rs1)){
                                $data = json_decode($row2[0]['skillForm']);
                                $skillFormData = json_decode(json_encode($data), true);
                                //https://api.jotform.com/pdf-converter/{formId}/fill-pdf?download=1&submissionID={sumissionID}&apikey={apiKey}
                                echo '<tr>';
                                echo '<td style="display: none;">'.$i.'</td>';
                                echo '<td>Skill First Form</td>';
                                echo '<td><a href="https://api.jotform.com/pdf-converter/'.$skillForm.'/fill-pdf?download=1&submissionID='. $skillFormData["submission_id"].'&apikey='.$api.'" class="text-reset" target="_blank">
                                         <i class="fa fa-file-pdf-o" style="font-size:40px;color:red"></i>
                                    </a></td>';

                                if($role == 1){
                                    echo '<td><a href="'.$url.'/index.php?page=23&submissionid='.$skillFormData["submission_id"] .'" id="#"  class="btn btn-primary btn-circle btn-md bringupdateform" target="_blank" ><i class="fas fa-edit"></i></a></td>';
                                }else{
                                    echo '<td>-</td>';
                                }

                                echo '</tr>';
                            }elseif(isset($row2[0]['skillForm'])==NULL){
                                echo '<tr>';
                                echo '<td style="display: none;">'.$i.'</td>';
                                echo '<td>Skill First Form</td>';
                                echo '<td>-</td>';
                                echo '</tr>';
                            }else{
                                echo '<tr>';
                                echo '<td style="display: none;">'.$i.'</td>';
                                echo '<td>Skill First Form</td>';
                                echo '<td>Manually Completed</td>';
                                echo '</tr>';
                            }
                            /*******************************
                             *******************************
                             ******** USI Form *************
                             *******************************
                             *******************************
                             */
                            $rs3 = json_decode($row2[0]['usiForm'],true);
                            if (isset($row2[0]['usiForm'])!=NULL && is_array($rs3)){
                                $data = json_decode($row2[0]['usiForm']);
                                $usiFormData = json_decode(json_encode($data), true);
                                if($usiFormData['formID'] != $usitransForm){
                                    //https://api.jotform.com/pdf-converter/{formId}/fill-pdf?download=1&submissionID={sumissionID}&apikey={apiKey}
                                    echo '<tr>';
                                    echo '<td style="display: none;">'.$i.'</td>';
                                    echo '<td>USI Form</td>';
                                    echo '<td><a href="https://api.jotform.com/pdf-converter/'.$usiForm.'/fill-pdf?download=1&submissionID='. $usiFormData["submission_id"].'&apikey='.$api.'" class="text-reset" target="_blank">
                                         <i class="fa fa-file-pdf-o" style="font-size:40px;color:red"></i>
                                    </a></td>';
                                    if($role == 1){
                                        echo '<td><a href="'.$url.'/index.php?page=23&submissionid='.$usiFormData["submission_id"] .'" id="#"  class="btn btn-primary btn-circle btn-md bringupdateform" target="_blank" ><i class="fas fa-edit"></i></a></td>';
                                    }else{
                                        echo '<td>-</td>';
                                    }
                                    echo '</tr>';
                                }
                                /*******************************
                                 *******************************
                                 ******** USI Transcript *******
                                 *******************************
                                 *******************************
                                 */
                                else{
                                    echo '<tr>
                                    <td style="display: none;">'.$i.'</td>
                                    <td>USI Transcript</td><td>';

                                    foreach($usiFormData['fileupload'] as $rs){
                                        if(strpos($rs, 'pdf') != true) {
                                            echo '<a href="https://www.jotform.com/uploads/Mohammad_Ayad/'.$usiFormData['formID'].'/'.$usiFormData['submission_id'].'/'.$rs.'" class="pop" ><img  src="https://www.jotform.com/uploads/Mohammad_Ayad/'.$usiFormData['formID'].'/'.$usiFormData['submission_id'].'/'.$rs.'" width="100" height="100"  ></a>&nbsp;&nbsp;';
                                        }else{
                                            echo '<a href="https://www.jotform.com/uploads/Mohammad_Ayad/' . $usiFormData['formID'] . '/' . $usiFormData['submission_id'] . '/' . $rs . '" ><i class="fa fa-file-pdf-o" style="font-size:40px;color:red" target="_blank"></i></a>&nbsp;&nbsp;';
                                        }
                                    }
                                    echo '</td>';
                                    if($role == 1){
                                        echo '<td><a href="'.$url.'/index.php?page=23&submissionid='.$usiFormData["submission_id"] .'" id="#"  class="btn btn-primary btn-circle btn-md bringupdateform" target="_blank" ><i class="fas fa-edit"></i></a></td>';
                                    }else{
                                        echo '<td>-</td>';
                                    }
                                    echo '</tr>';
                                }
                            }elseif(isset($row2[0]['usiForm'])==NULL){
                                echo '<tr>';
                                echo '<td style="display: none;">'.$i.'</td>';
                                echo '<td>USI Form/USI Transcript</td>';
                                echo '<td>-</td>';
                                echo '</tr>';
                            }else{
                                echo '<tr>';
                                echo '<td style="display: none;">'.$i.'</td>';
                                echo '<td>USI Form/USI Transcript</td>';
                                echo '<td>Manually Completed</td>';
                                echo '</tr>';
                            }

                            /*******************************
                             *******************************
                             ******* PTR & LLN ********
                             *******************************
                             *******************************
                             */
                            $rs4 = json_decode($row2[0]['llnForm'],true);
                            if (isset($row2[0]['ptrForm'])!=NULL || isset($row2[0]['llnForm'])!=NULL || isset($row2[0]['ptrForm'])!=1 || isset($row2[0]['ptrForm'])!=1  ){
                                if(is_array($rs4)){
                                    echo '<br>';
                                    $data = json_decode($row2[0]['llnForm']);
                                    $llnptr = json_decode(json_encode($data), true);

                                    echo '<tr>';
                                    echo '<td style="display: none;">' . $i . '</td>';
                                    echo '<td>Security LLN & PTR</td>';
                                    echo '<td><a href="https://api.jotform.com/pdf-converter/' . $seclln . '/fill-pdf?download=1&submissionID=' . $llnptr["submission_id"] . '&apikey=' . $api . '" class="text-reset" target="_blank">
                                                <i class="fa fa-file-pdf-o" style="font-size:40px;color:red"></i>
                                            </a></td>';

                                    if($role == 1){
                                        echo '<td><a href="'.$url.'/index.php?page=23&submissionid='.$llnptr["submission_id"] .'" id="#"  class="btn btn-primary btn-circle btn-md bringupdateform" target="_blank" ><i class="fas fa-edit"></i></a></td>';
                                    }else{
                                        echo '<td>-</td>';
                                    }
                                    echo '</tr>';
                                }elseif(isset($row2[0]['llnForm'])==NULL){
                                    echo '<tr>';
                                    echo '<td style="display: none;">'.$i.'</td>';
                                    echo '<td>LLN & PTR</td>';
                                    echo '<td>-</td>';
                                    echo '</tr>';
                                }else{
                                    echo '<tr>';
                                    echo '<td style="display: none;">'.$i.'</td>';
                                    echo '<td>LLN & PTR</td>';
                                    echo '<td>Manually Completed</td>';
                                    echo '</tr>';
                                }
                            }

                            echo '<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">              
                                        <br>
                                          <div class="modal-body" style="text-align: center !important;">
                                            <a href="" class="btn btn-success" id="download" target="_blank">Download image</a>
                                            <img src="" class="imagepreview" style="width: 100%;" >
                                          </div>
                                        </div>
                                      </div>
                                   </div>';
                            /******************************
                             *******************************
                             ****** Student Document *******
                             *******************************
                             *******************************
                             */
                            // $rs5 = json_decode($row2[0]['llnForm'],true);
                            /** Edited on 06/12/2021 */

                            // Use comparison operator to
                            // compare dates
                             if (isset($row2[0]['enrolForm'])!=NULL){
                                $signup = getSigupTime($userId);
                                $date1 = "2021-12-09";
                                /*** Check if there are new enrolment form submissions **/
                                if ($signup > $date1){
                                    $data = json_decode($row2[0]['enrolForm']);
                                }else{
                                    $data = json_decode($row2[0]['documentForm']);
                                }

                                $documentFormData = json_decode(json_encode($data), true);
                                echo '<tr>
                                    <td style="display: none;">'.$i.'</td>
                                    <td>Original Documents</td><td>';

                                foreach($documentFormData['fileupload'] as $rs){
                                    if(strpos($rs, 'pdf') != true) {
                                        echo '<a class="pop"><img src="https://www.jotform.com/uploads/Mohammad_Ayad/'.$documentFormData['formID'].'/'.$documentFormData['submission_id'].'/'.$rs.'" width="100" height="100" ></a>&nbsp;&nbsp;';
                                    }else{
                                        echo '<a href="https://www.jotform.com/uploads/Mohammad_Ayad/' . $documentFormData['formID'] . '/' . $documentFormData['submission_id'] . '/' . $rs . '" ><i class="fa fa-file-pdf-o" style="font-size:40px;color:red" target="_blank" ></i></a>&nbsp;&nbsp;';
                                    }
                                }
                                foreach($documentFormData['fileupload80'] as $rs1){
                                    if(strpos($rs1, 'pdf') != true) {
                                        echo '<a class="pop"><img src="https://www.jotform.com/uploads/Mohammad_Ayad/'.$documentFormData['formID'].'/'.$documentFormData['submission_id'].'/'.$rs1.'" width="100" height="100" ></a>&nbsp;&nbsp;';
                                    }else{
                                        echo '<a href="https://www.jotform.com/uploads/Mohammad_Ayad/' . $documentFormData['formID'] . '/' . $documentFormData['submission_id'] . '/' . $rs1 . '"><i class="fa fa-file-pdf-o" style="font-size:40px;color:red"></i></a>&nbsp;&nbsp;';
                                    }
                                }
                                foreach($documentFormData['fileupload82'] as $rs2){
                                    if(strpos($rs2, 'pdf') != true) {
                                        echo '<a class="pop"><img src="https://www.jotform.com/uploads/Mohammad_Ayad/'.$documentFormData['formID'].'/'.$documentFormData['submission_id'].'/'.$rs2.'" width="100" height="100"  ></a>&nbsp;&nbsp;';
                                    }else{
                                        echo '<a href="https://www.jotform.com/uploads/Mohammad_Ayad/' . $documentFormData['formID'] . '/' . $documentFormData['submission_id'] . '/' . $rs2 . '" ><i class="fa fa-file-pdf-o" style="font-size:40px;color:red"></i></a>&nbsp;&nbsp;';
                                    }
                                }

                                echo '</td>';
                                if($role == 1){
                                    echo '<td><a href="'.$url.'/index.php?page=23&submissionid='.$documentFormData["submission_id"] .'" id="#"  class="btn btn-primary btn-circle btn-md bringupdateform" target="_blank" ><i class="fas fa-edit"></i></a></td>';
                                }else{
                                    echo '<td>-</td>';
                                }
                                echo '</tr>';

                                print_table_footer();
                                ?>
                                <script>
                                    $(function() {
                                        $('.pop').on('click', function() {
                                            $('.imagepreview').attr('src', $(this).find('img').attr('src'));
                                            //download
                                            $('#download').attr('href', $(this).find('img').attr('src'));
                                            $('#imagemodal').modal('show');
                                        });
                                    });
                                </script>

                                <?php
                                /** Table Start */
                                print_table_header();
                                echo '<h1 style="text-align: center">Document Verification Service (DVS)</h1>';
                                echo '  <tr>
                                        <th>Document Name</th>
                                        <th>Status</th>
                                        <th>Download</th>
                                        </tr>';

                                 /******************************
                                 *******************************
                                 ** Document Verification Code *
                                 *******************************
                                 ******************************/

                                /**** Edit By Inam 11/9/2021 ****/
                                $query3 = "SELECT * FROM `of_documentVerify` WHERE std_id=:userId";
                                $stmt3 = $pdo->prepare($query3);
                                $stmt3->bindParam('userId', $std_id, PDO::PARAM_STR);
                                $stmt3->execute();
                                $row3   = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($row3 as $rs) {
                                    echo '<tr>';
                                    echo '<td>' . $rs['documentId'] . '</td>';
                                    if ($rs['status'] == 'Y') {
                                        echo '<td>Verified</td>';
                                        echo '<td><a href="' . $url . '/pdfReport.php?id=' . $rs['id'] . '" class="text-reset" target="_blank">
                                              <i class="fa fa-file-pdf-o" style="font-size:40px;color:red"></i></a></td>';
                                    }else{
                                        echo '<td>Failed</td>';
                                        echo '<td>Please verify document<br> manually from <a href = "https://ridx.io/login"> RapidID </a></td>';
                                        //                                            echo '<td><a href="#" class="btn btn btn-primary btn-circle btn-md" id="' . $rs["std_id"] . '" value="#">Verify Again</a></td>';
                                    }
                                    echo '</tr>';
                                }
                            }
                            print_table_footer();
                            /** Table End */
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .main-body {
                padding: 15px;
            }
            .card {
                box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
            }
            .card {
                position: relative;
                display: flex;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-color: #fff;
                background-clip: border-box;
                border: 0 solid rgba(0,0,0,.125);
                border-radius: .25rem;
            }

            .card-body {
                flex: 1 1 auto;
                min-height: 1px;
                padding: 1rem;
            }

            .gutters-sm {
                margin-right: -8px;
                margin-left: -8px;
            }

            .gutters-sm>.col, .gutters-sm>[class*=col-] {
                padding-right: 8px;
                padding-left: 8px;
            }
            .mb-3, .my-3 {
                margin-bottom: 1rem!important;
            }

            .bg-gray-300 {
                background-color: #e2e8f0;
            }
            .h-100 {
                height: 100%!important;
            }
            .shadow-none {
                box-shadow: none!important;
            }

            /*Setting Basic Dimensions to give
       gallery view */
            .container{
                margin: 0 auto;
                width: 90%;
            }
            .main_view{
                width: 80%;
                height: 25rem;
            }
            .main_view img{
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
            .side_view{
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
            }
            .side_view img{
                width: 9rem;
                height: 7rem;
                object-fit: cover;
                cursor: pointer;
                margin:0.5rem;
            }
        </style>

        <?php
    }

    /************
    Code changed
     *
     **************/
    function editProfile($page){
        get_breadcrumbs($page);
        $user=$_SESSION['userid'];
        //echo $user;
        $course=getCourseName($user);
        $enrolmentProgress=enrolmentProgress($user);
        //var_dump($enrolmentProgress);
        ?>
        <script>
            $(function() {

                $(document).on('click', '.startanewcourse', function (event) {
                    //alert('working');
                    event.preventDefault();
                    var val = $("#changeOfCourse").find(":selected").text();
                    if (val != "Open this select menu") {
                        //alert("ok");
                        $.ajax({
                            type: 'POST',
                            url: 'lib/userlib.php',
                            data: {'newcourse': val},
                            success: function (data) {
                                alert(data);

                                    $("#oldCourseSpan").remove();
                                    $("#currentcourse").append('<span style="font-size: 16px;" id="oldCourseSpan">'+val+'</span>');
                                    $("#coursechangemessage").remove();
                                    $('.CourseChangeMessage').append('<div class="alert alert-success" id="coursechangemessage" role="alert">Course changed.</div>');
                                    $('.addANewCourseCard').remove();
                            }
                        });
                    }

                });
            });
            /**
             * Ajax to delete form
             */
            $(function(){


                // Password validation

                var OldPassword = $('#oldPassword').val();

                var passwordError=0;
                $('#Password').change(function(){
                    var password = $('#Password').val();
                    var repeatPassword = $('#RepeatPassword').val();
                    if (password.length < 8 ) {
                        $('#passwordError').remove();
                        $('#passworderror').append('<div class="error" id="passwordError" style="padding-top:10px;margin:0px;margin:0px;"><p class="error" style="color:red; font-size:12px;">Password must be at least 8 characters</p></div>');
                        passwordError=1;
                    }else if(password!=repeatPassword){
                        $('#passwordError').remove();
                        $('#passworderror').append('<div class="error" id="passwordError"  style="padding-top:10px;margin:0px;margin:0px;"><p class="error" style="color:red; font-size:12px;">Password do not match.</p></div>');
                        passwordError=1;
                    }else if(password==repeatPassword){
                        $('#passwordError').remove();
                        passwordError=2;
                    }
                });

                $('#RepeatPassword').change(function(){

                    var repeatPassword = $('#RepeatPassword').val();
                    if (password.length < 8 ) {
                        $('#passwordError').remove();
                        $('#passworderror').append('<div class="error" id="passwordError" style="padding-top:10px;margin:0px;margin:0px;"><p class="error" style="color:red; font-size:12px;">Password must be at least 8 characters</p></div>');
                        passwordError=1;
                    }else if(password!=repeatPassword){
                        $('#passwordError').remove();
                        $('#passworderror').append('<div class="error" id="passwordError"  style="padding-top:10px;margin:0px;margin:0px;"><p class="error" style="color:red; font-size:12px;">Password do not match.</p></div>');
                        passwordError=1;
                    }else if(password==repeatPassword){
                        $('#passwordError').remove();
                        passwordError=2;
                    }
                });
                $('#RepeatPassword').change(function(){
                    if ( oldPassword.length < 2 ) {
                        $('#oldPasswordError').remove();
                        $('#oldpassworderror').append('<div class="error" id="oldPasswordError" style="padding-top:10px;margin:0px;margin:0px;"><p class="error" style="color:red; font-size:12px;">Password cannot empty</p></div>');
                    }
                });


                $('#updatePassword').submit(function(e) {

                    e.preventDefault();
                    var errorCount=0;
                    var repeatPassword = $('#RepeatPassword').val();
                    var oldPassword = $('#oldPassword').val();
                    var password = $('#Password').val();
                    if (password.length < 8 ) {
                        $('#passwordError').remove();
                        $('#passworderror').append('<div class="error" id="passwordError" style="padding-top:10px;margin:0px;margin:0px;"><p class="error" style="color:red; font-size:12px;">Password must be at least 8 characters</p></div>');
                        errorCount++;
                    }else if(password!=repeatPassword){
                        $('#passwordError').remove();
                        $('#passworderror').append('<div class="error" id="passwordError" style="padding-top:10px;margin:0px;margin:0px;"><p class="error" style="color:red; font-size:12px;">Password do not match.</p></div>');
                        errorCount++;
                    }else if(password==repeatPassword){
                        $('#passwordError').remove();
                    }
                    if ( oldPassword.length < 1 ) {
                        $('#oldPasswordError').remove();
                        $('#oldpassworderror').append('<div class="error" id="oldPasswordError" style="padding-top:10px;margin:0px;margin:0px;"><p class="error" style="color:red; font-size:12px;">Password cannot empty</p></div>');
                        errorCount++;
                    }else{
                        $('#oldPasswordError').remove();
                    }

                    if(errorCount==0){

                        $.ajax({
                            type: 'POST',
                            url: 'lib/userlib.php',
                            data: {'oldpass': oldPassword,'newpassword':password},
                            success: function (data) {
                                //alert(data);
                                if (data == "NO") {
                                    $("#passwordNotMatch").remove();
                                    $('.passError').append('<div class="alert alert-danger" id="passwordNotMatch" role="alert">Current Password is incorrect. Please Try again.</div>');
                                } else {
                                    $("#passwordNotMatch").remove();

                                    $("#updatePassword").remove();
                                    $('#passwordChangeConfirmation').append('<div class="alert alert-success" id="coursechangemessage" role="alert">Password changed.</div>');

                                }
                            }
                        });
                    }
                });

            });
        </script>

        <?php
        echo '<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
<div class="row flex-lg-nowrap">
  <div class="col">
    <div class="row">
      <div class="col mb-3">
        <div class="card">
          <div class="card-body">
            <div class="e-profile">
              <div class="row">
                <div class="col-12 col-sm-auto mb-3">
                  <div class="mx-auto" style="width: 140px;">
                    <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                      <span style="color: rgb(166, 168, 170); font: bold 8pt Arial;">
                      <span class="avatar">
                              <span class="badge bg-green"></span>'.substr($course["firstname"], 0, 1).'
                  </span>
                    </div>
                  </div>
                </div>
                <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                  <div class="text-center text-sm-left mb-2 mb-sm-0">
                    <h2 class="pt-sm-2 pb-1 mb-0 text-nowrap">'.$course["firstname"].' '.$course["lastname"].'</h2>
                  </div>
                  <div class="text-center text-sm-right">';
                if ($course["role"]==1){
                    echo '<span class="badge badge-secondary">Admin</span>';
                }elseif ($course["role"]==2){
                    echo '<span class="badge badge-secondary">Coordinator</span>';
                }elseif ($course["role"]==3){
                    echo '<span class="badge badge-secondary">Student</span>';
                }
        echo '
                    
                  </div>
                </div>
              </div>
              <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Change course</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Change password</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Change Personal details</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  <br>
  <h1>Currently selected course:</h1>
  <div id="currentcourse"> <span style="font-size: 16px;" id="oldCourseSpan">'.$course["courses"].'</span></div>
  <br>
                    <div class="CourseChangeMessage"></div>
  ';
        if($enrolmentProgress['enrolForm']==NULL){

                echo '
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
        ';
        }else{
            echo '<h4 style="border: 4px solid red;padding: 10px;">You cannot change course after completion of the step 1. Please contact office to get it reset for you.</h4>';
        }
                echo '
  
</div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <form class="form" id="updatePassword">
                    <div class="row">
                   
                    </div>
                    <div class="row">
                      <div class="col-12 col-sm-6 mb-3">
                        <br>
                        <div class="mb-3">
                            <label>Current Password</label>
                            <div class="input-group input-group-flat">
                                
                                <input type="password" class="form-control form-control-user" id="oldPassword" placeholder="••••••" name="oldPassword">
                                <span class="input-group-text">
                                       <a href="#" class="link-secondary" title="" data-bs-toggle="tooltip" data-bs-original-title="Show password" onClick="pass2();"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                       <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="2"></circle><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path></svg>
                                       </a>
                                </span>
                            </div>
                        </div>
                        <div id="oldpassworderror" style="margin-left: 20px;"></div>
                        
                        <br>
                        <div class="form-group row mb-3">
                        <div class="mb-3">
                            <label>New Password</label>
                            <div class="input-group input-group-flat">
                                <input type="password" class="form-control form-control-user" id="Password" name="password" placeholder="••••••">
                                <span class="input-group-text">
                                        <a href="#" class="link-secondary" title="" data-bs-toggle="tooltip" data-bs-original-title="Show password" onClick="pass();"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="2"></circle><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path></svg>
                                        </a>
                                 </span>
                            </div>
                        </div>
    
                        <div class="mb-3">
                            <label>Confirm New Password</label>
                            <div class="input-group input-group-flat">
                                
                                <input type="password" class="form-control form-control-user" id="RepeatPassword" placeholder="••••••" name="repeatpassword">
                                <span class="input-group-text">
                                       <a href="#" class="link-secondary" title="" data-bs-toggle="tooltip" data-bs-original-title="Show password" onClick="pass2();"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                       <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="2"></circle><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path></svg>
                                       </a>
                                </span>
                            </div>
                        </div>
                        <div id="passworderror" style="margin-left: 20px;"></div>
                    </div>
                       <button type="submit" class="btn btn-primary updatePassword" style="padding: 20px;font-size: 16px;">Submit</button>
                       <br>
                       <div class="passError"></div>
                      </div>
                    </div>
                  </form>
                   <div id="passwordChangeConfirmation"></div>
                  </div>
                  
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
     <h1>Currently phone number:</h1>
    <div id="currentcourse"> <span style="font-size: 16px;" id="oldCourseSpan">'.$course["phone"].'</span></div>
        <form class="form" id="changePhone">
           <div class="row">
                <div class="col-sm-3" style="padding: 20px;">
                     <div class="form-group mb-3">
                        <input type="tel" class="form-control form-control-user" id="phone" placeholder="Phone" name="phone" style="margin-bottom: 2px;">
                        <input type="tel" class="form-control form-control-user" id="otp" placeholder="Please type recieved code here" name="otp" style="display: none;" style="margin-bottom: 2px;!important;">
                        <a class="btn btn-primary" href="#" role="button" id="verify"  onClick="verifyOTP();" style="display:none;" style="margin-bottom: 2px;!important;" >Verify</a>
                        <a class="btn btn-primary" href="#" role="button" id="sendAgain" onClick="sendOTP();" style="margin-bottom: 2px !important;">Send OTP</a>
                        <p id="verifyPhoneblock" style="display: none;color:#18bd5b !important;">Phone verified</p>
                    </div>
                </div>
           </div>
                    <button type="submit" class="btn btn-primary changePhone" style="">Change Phone</button>
        </form>
                   <div id="phoneChangeConfirmation"></div>
  
    </div>
</div>
              
              
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
</div>
</div>';
?>
        <script>
            var phoneVerification=0;
            function sendOTP(){
                var phone = $('#phone').val();
                var phoneRegex=/^(?:\+?(61))? ?(?:\((?=.*\)))?(0?[2-57-8])\)? ?(\d\d(?:[- ](?=\d{3})|(?!\d\d[- ]?\d[- ]))\d\d[- ]?\d[- ]?\d{3})$/gm;
                if (phone.length < 1) {
                    $('#phoneError').remove();
                    $('#phone').after('<div class="error" id="phoneError" style="padding-top:10px;margin:0px;margin-bottom: 2px;"><p style="color:red; font-size:12px;margin:0px;">This field is required</p></div>');
                    errorPhone=1;
                } else {
                    var validPhone = phoneRegex.test(phone);
                    if (!validPhone) {
                        $('#phoneError').remove();
                        $('#phone').after('<div class="error" id="phoneError" style="padding-top:10px;margin:0px;margin-bottom: 2px;"><p class="error" style="color:red; font-size:12px;margin:0px;">Enter a valid phone number</p></div>');
                        errorPhone=1;
                    }else if(validPhone){
                        $('#phoneError').remove();
                        errorPhone=2;
                    }
                }
                if (errorPhone==2){
                    var info={
                        sentOTP:phone
                    }
                    $.ajax({
                        url: "registerationlogic2.php",
                        type: "POST",
                        data: info,
                        success: function(data){
                            var a = data.includes("Success");
                            if(a){
                                $('#otpWait').remove();
                                $('#otp').css('display','block');
                                $("#otp").after( "<p style='color:orange;' id='otpWait'>You can receive next OTP after 1 min.</p>" );
                                $("#verify").css('display','block');
                                $("#sendAgain").css('display','none');
                                alert('OTP Sent');
                            }else {
                                alert('OTP Failed.Please check your phone number and try again!');
                            }
                        },error: function(xhr, status, error) {
                            var err = eval("(" + xhr.responseText + ")");
                            alert(err.Message);
                        }
                    });

                    $(this).text('loading...').delay(60000).queue(function() {
                        if (errorPhone!=2){
                            $('a#sendAgain').text('Send again');
                            $("#sendAgain").css('display','block');
                        }
                    });
                }
            }

            function verifyOTP(){
                var otp = $('#otp').val();
                var info={
                    verifyOTP:otp
                }
                $.ajax({
                    url: "registerationlogic2.php",
                    type: "POST",
                    data: info,
                    success: function(data){
                        //alert(data);
                        var a = data.includes("success");
                        if(a){
                            $('#otpWait').remove();
                            $("#errorblock").css("display","none");
                            $("#otp").remove();
                            $("#verify").remove();
                            $("#phone").prop('disabled', true);
                            $("#verifyPhoneblock").css("display","block");
                            phoneVerification=1;
                        }else {
                            alert('OTP Failed. Please Try Again!')
                        }

                    },error: function(xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        alert(err.Message);
                    }
                });
            }
            $('#changePhone').submit(function(e) {
                var phone = $('#phone').val();

                e.preventDefault();
                if(phoneVerification==1){

                        $.ajax({
                            type: 'POST',
                            url: 'lib/userlib.php',
                            data: {'phone': phone},
                            success: function (data) {
                                alert(data);

                                    $('.phoneChangeConfirmation').append('<div class="alert alert-danger" id="" role="alert">Phone Number Updated.</div>');

                            }
                        });
                }
            });

        </script>

        <?php

    }


}