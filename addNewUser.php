<?php
//include('style.php');
include('header.php');
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
                } else {

                    var validEmail = EmailregEx.test(email);
                    if (!validEmail) {
                        $('#Email').after('<div class="error" style="padding-top:10px;"margin:0px;><p class="error" style="color:red; font-size:12px;margin:0px;">Enter a valid email</p></div>');
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
    </script>


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="p-5">
                    <div class="card card-lg border-bottom-success">
                        <form class="user" id="registrationform" method="post" action="">
                          <div class="card-body">
                            <h2 class="card-title text-center mb-4">Create new account</h2>
                             <div class="mb-3">
                                    <input type="text" class="form-control form-control-user" id="FirstName" placeholder="First Name" name="firstname">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control form-control-user" id="LastName"
                                       placeholder="Last Name" name="lastname">
                            </div>
                            <div class="form-group mb-3">
                                <input type="email" class="form-control form-control-user" id="Email"
                                       placeholder="Email Address" name="email">
                            </div>
                            <div class="form-group mb-3">
                                <input type="number" class="form-control form-control-user" id="phone"
                                       placeholder="Phone" name="phone">
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-sm-6 mb-3 mb-sm-0 mb-3">
                                    <input type="password" class="form-control form-control-user"
                                           id="Password" placeholder="Password" name="password">
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <input type="password" class="form-control form-control-user"
                                           id="RepeatPassword" placeholder="Repeat Password" name="repeatpassword">
                                </div>
                                <div id="passworderror" style="margin-left: 20px;">
                                </div>
                            </div>

                            <div class="col-sm-6 mb-3 form-floating">
                                <div class="form-group row">
                                    <div id="roleDiv">
                                        <select class="browser-default custom-select form-select" id="role">
                                            <option value="Select Role" selected>Select Role</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Coordinator</option>
                                            <option value="3">Student</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="studentData" style="display: none;">
                                <div class="form-group row">
                                    <select class="browser-default custom-select form-select" id="source">
                                        <option value="How did you find us?" selected>How did you find us?</option>
                                        <option value="google">Google</option>
                                        <option value="fb">Facebook</option>
                                        <option value="fb">Instagram</option>
                                        <option value="fb">Linkedin</option>
                                        <option value="fb">Word of mouth</option>
                                    </select>
                                </div>
                                <div class="form-group row" style="padding-top:10px;">
                                    <div class="col-md-12">
                                         <select id="choices-multiple-remove-button" placeholder="Select courses you are interested in" multiple>
                                            <option value="CHC33015">CHC33015 Certificate III in Individual Support (Aged Care)</option>
                                            <option value="CPP20218">CPP20218 Certificate II in Security Operations</option>
                                            <option value="BH">Baton & Handcuff</option>
                                            <option value="CRO">Control Room Operation</option>
                                            <option value="CHC30113">CHC30113 Certificate III in Early Childhood Education and Care</option>
                                            <option value="CHC50113">CHC50113 Diploma of Early Childhood Education and Care</option>
                                            <option value="HLTAID001">HLTAID001 Provide cardiopulmonary resuscitation</option>
                                            <option value="HLTAID002">HLTAID002 Provide basic emergency life support</option>
                                            <option value="HLTAID003">HLTAID003 Provide first aid</option>
                                            <option value="HLTAID004">HLTAID004 Provide an emergency first aid response in an education and care setting</option>
                                            <option value="CPC40110">CPC40110 Certificate lV in Building and Construction (Building)</option>
                                            <option value="CPC50210">CPC50210 Diploma of Building and Construction (Building)</option>
                                            <option value="CPCCWHS1001">CPCCWHS1001 Prepare to work safely in the Construction Industry</option>
                                            <option value="CHC40213 ">CHC40213 Certificate IV in Education Support</option>
                                            <option value="CHC43015">CHC43015 Certificate IV in Ageing Support</option>
                                            <option value="CHC43115">CHC43115 Certificate IV in Disability</option>
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
                                    <div class="card-body" style="color:#1cc88a" id="msg">
                                    </div>
                                </div>
                          </div>
                          <div id="errorblock" style="padding-top:10px; display: none; ">
                                <div class="card mb-4 py-3 border-left-danger" style="padding-top:0px !important;padding-bottom:0px !important; ">
                                    <div class="card-body" style="color:red" id="errormsg">
                                    </div>
                                </div>
                          </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
<?php
require 'footer.php';

?>