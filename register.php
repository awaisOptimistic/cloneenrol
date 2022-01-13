<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <noscript><h1 style="text-align:center; font-size:2em; padding-bottom:100000px; color:black; background:white; padding-top:400px;">JavaScript is off. Please enable to view full site.</h1></noscript>
    <title>Enrolment Management System</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
    <!-- Custom styles for this template-->
    <!-- <link href="css/sb-admin-2.min.css" rel="stylesheet"> -->
    <!-- NEEEEEEEEEEEEEEEEEEEEEEEEEEEEEWWWWWWWWWWWWWWWWWWW -->
    <link href="css/tabler.min.css" rel="stylesheet"/>
    <link href="css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="css/demo.min.css" rel="stylesheet"/>
    <!-- //////////////////////////////////////////////// -->
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <!-- <script src="js/sb-admin-2.min.js"></script> -->
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!--for multiselect-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
    <script>
        $(document).ready(function(){
            var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                removeItemButton: true,
                maxItemCount:1,
                searchResultLimit:3,
                renderChoiceLimit:100
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            var errorfname=0;
            $('#FirstName').change(function(){
                var first_name = $('#FirstName').val();
                var FirstNameregEx=/^[a-z ,.'-]+$/i;
                var validFirstName = FirstNameregEx.test(first_name);
                if (first_name.length < 1) {
                    $('#firstNameError').remove();
                    $('#FirstName').after('<div class="error" id="firstNameError" style="padding-top:10px; margin:0px;"><p class="error" style="color:red; font-size:12px;margin:0px;">This field is required</p></div>');
                    errorfname=1;
                }else if (!validFirstName) {
                    $('#firstNameError').remove();
                    $('#FirstName').after('<div class="error"  id="firstNameError" style="padding-top:10px; margin:0px;"><p class="error" style="color:red; font-size:12px;margin:0px;">Enter a valid First Name</p></div>');
                    errorfname=1;
                }else if (validFirstName) {
                    $('#firstNameError').remove();
                    errorfname=2;
                }
            });

            var errorlname=0;
            $('#LastName').change(function(){
                var last_name = $('#LastName').val();
                var lastNameregEx=/^[a-z ,.'-]+$/i;
                var validLastName = lastNameregEx.test(last_name);
                if (last_name.length < 1) {
                    $('#LastNameError').remove();
                    $('#LastName').after('<div class="error" id="LastNameError" style="padding-top:10px; margin:0px;"><p class="error" style="color:red; font-size:12px;margin:0px;">This field is required</p></div>');
                    errorlname=1;
                }else if (!validLastName) {
                    $('#LastNameError').remove();
                    $('#LastName').after('<div class="error"   id="LastNameError" style="padding-top:10px; margin:0px;"><p class="error" style="color:red; font-size:12px;margin:0px;">Enter a valid Last Name</p></div>');
                    errorlname=1;
                }else if (validLastName) {
                    $('#LastNameError').remove();
                    errorlname=2;
                }
            });

            var erroremail=0;
            $('#Email').change(function(){
                var email = $('#Email').val();
                var EmailregEx = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if (email.length < 1) {
                    $('#emailError').remove();
                    $('#Email').after('<div class="error" id="emailError" style="padding-top:10px;margin:0px;"><p style="color:red; font-size:12px;margin:0px;">This field is required</p></div>');
                    erroremail=1;
                } else {
                    var validEmail = EmailregEx.test(email);
                    if (!validEmail) {
                        $('#emailError').remove();
                        $('#Email').after('<div class="error"  id="emailError" style="padding-top:10px;"margin:0px;><p class="error" style="color:red; font-size:12px;margin:0px;">Enter a valid email</p></div>');
                        erroremail=1;
                    }else if(validEmail){
                        $('#emailError').remove();
                        erroremail=2;
                    }
                }
            });

            var errorPhone=0;
            $('#phone').change(function(){
                var phone = $('#phone').val();
                var phoneRegex=/^(?:\+?(61))? ?(?:\((?=.*\)))?(0?[2-57-8])\)? ?(\d\d(?:[- ](?=\d{3})|(?!\d\d[- ]?\d[- ]))\d\d[- ]?\d[- ]?\d{3})$/gm;
                if (phone.length < 1) {
                    $('#phoneError').remove();
                    $('#phone').after('<div class="error" id="phoneError" style="padding-top:10px;margin:0px;"><p style="color:red; font-size:12px;margin:0px;">This field is required</p></div>');
                    errorPhone=1;
                } else {
                    var validPhone = phoneRegex.test(phone);
                    if (!validPhone) {
                        $('#phoneError').remove();
                        $('#phone').after('<div class="error" id="phoneError" style="padding-top:10px;"margin:0px;><p class="error" style="color:red; font-size:12px;margin:0px;">Enter a valid phone number</p></div>');
                        errorPhone=1;
                    }else if(validPhone){
                        $('#phoneError').remove();
                        errorPhone=2;
                    }
                }
            });
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

            $('#source').change(function(){
                var mediaSource=$("#source option:selected").text();
                if(mediaSource=="How did you find us?"){
                    $('#sourceerror').remove();
                    $('#source').after('<div class="error" id="sourceerror" style="padding-top:10px; margin:0px;"><p class="error" style="color:red; font-size:12px;margin:0px;">Please select one of the options</p></div>');
                }else{
                    $('#sourceerror').remove();
                }
            });

            //courseSelect
            $( "#courseSelect" ).change(function() {

                var val=$("#courseSelect option:selected").text();
                if(val.indexOf('HLTAID') > -1||val.indexOf('CPCCWHS1001') > -1 ||val.indexOf('Building and Construction') > -1 ){
                    //$('#govsubornot').select;
                    $('#govsubornot  option:eq(2)').prop('selected', true);
                    $("#govsubornot").attr("disabled", "disabled");
                }else{
                    $("#govsubornot").removeAttr("disabled");
                    //alert( val );
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
                var nameRegEx=/^[a-z ,.'-]+$/i;
                var errorCount=0;
                var page="adminPanel";
                var campus =  $('#campus').val();
                var role=$("#role option:selected").text();
                var referred =  $('#ReferredBy').val();
                var phoneRegex=/^(?:\+?(61))? ?(?:\((?=.*\)))?(0?[2-57-8])\)? ?(\d\d(?:[- ](?=\d{3})|(?!\d\d[- ]?\d[- ]))\d\d[- ]?\d[- ]?\d{3})$/gm;

                $(".error").remove();
                var validFirstName = nameRegEx.test(first_name);
                if (first_name.length < 1) {
                    $('#firstNameError').remove();
                    $('#FirstName').after('<div class="error" id="firstNameError" style="padding-top:10px; margin:0px;"><p class="error" style="color:red; font-size:12px;margin:0px;">This field is required</p></div>');
                    errorCount++;
                }else if (!validFirstName) {
                    $('#firstNameError').remove();
                    $('#FirstName').after('<div class="error" id="firstNameError" style="padding-top:10px; margin:0px;"><p class="error" style="color:red; font-size:12px;margin:0px;">Enter a valid First Name</p></div>');
                    errorCount++;
                }else if (validFirstName) {
                    $('#firstNameError').remove();
                }
                var validLastName = nameRegEx.test(last_name);
                if (last_name.length < 1) {
                    $('#LastNameError').remove();
                    $('#LastName').after('<div class="error" id="LastNameError" style="padding-top:10px;margin:0px;"><p class="error" style="color:red; font-size:12px;margin:0px;">This field is required</p></div>');
                    errorCount++;
                }else if(!validLastName) {
                    $('#LastNameError').remove();
                    $('#LastName').after('<div class="error" id="LastNameError" style="padding-top:10px;margin:0px;"><p class="error" style="color:red; font-size:12px;margin:0px;">Enter a valid Last Name</p></div>');
                    errorCount++;
                }else if (validLastName) {
                    $('#LastNameError').remove();
                }
                if (email.length < 1) {
                    $('#emailError').remove();
                    $('#Email').after('<div class="error" id="emailError" style="padding-top:10px;margin:0px;"><p style="color:red; font-size:12px;margin:0px;">This field is required</p></div>');
                    errorCount++;
                } else {
                    var validEmail = EmailregEx.test(email);
                    if (!validEmail) {
                        $('#emailError').remove();
                        $('#Email').after('<div class="error" id="emailError" style="padding-top:10px;"margin:0px;><p class="error" style="color:red; font-size:12px;margin:0px;">Enter a valid email</p></div>');
                        errorCount++;
                    }else if(validEmail){
                        $('#emailError').remove();
                    }
                }

                if (phone.length < 1) {
                    $('#phoneError').remove();
                    $('#phone').after('<div class="error" id="phoneError" style="padding-top:10px;margin:0px;"><p style="color:red; font-size:12px;margin:0px;">This field is required</p></div>');
                    errorCount++;
                } else {
                    var validPhone = phoneRegex.test(phone);
                    if (!validPhone) {
                        $('#phoneError').remove();
                        $('#phone').after('<div class="error" id="phoneError" style="padding-top:10px;"margin:0px;><p class="error" style="color:red; font-size:12px;margin:0px;">Enter a valid phone number</p></div>');
                        errorCount++;
                    }else if(validPhone){
                        $('#phoneError').remove();
                    }
                }

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




                //courseerror fundingerror


                var courseselection=$("#courseSelect option:selected").text();
                var govsubornot=$("#govsubornot option:selected").val();

                if (courseselection=="" || courseselection=="Select courses you are interested in"){
                    $('#courseerror').html('<div class="error" id="" style="padding-top:10px; margin:0px;"><p class="error" style="color:red; font-size:12px;margin:0px;">Please select course/courses</p></div>');
                    errorCount++;
                }else{
                    $('#courseerror').html('');
                }

                if (govsubornot=="" || govsubornot=="Funding Type"){
                    $('#fundingerror').html('<div class="error" id="" style="padding-top:10px; margin:0px;"><p class="error" style="color:red; font-size:12px;margin:0px;">Please select funding type</p></div>');
                    errorCount++;
                }else{
                    $('#fundingerror').html('');
                }

                var mediaSource=$("#source option:selected").text();
                if(mediaSource=="How did you find us?"){
                    $('#sourceerror').remove();
                    $('#source').after('<div class="error" id="sourceerror" style="padding-top:10px; margin:0px;"><p class="error" style="color:red; font-size:12px;margin:0px;">Please select one of the options</p></div>');
                    errorCount++;
                }else {
                    $('#sourceerror').remove();
                }
                if(errorCount==0 && phoneVerification==0){
                    alert('You need to verify phone number to complete registeration process.');
                }
                if(errorCount==0 && phoneVerification==0){
                    var info={
                        FirstName: first_name,
                        LastName: last_name,
                        Email: email,
                        Phone:phone,
                        Password: password,
                        Page:page,
                        Role:3,
                        source:mediaSource,
                        course:courseselection,
                        govsubornot:govsubornot,
                        ReferredBy: referred,
                        Campus: campus
                    }

                    $.ajax({
                        url: "registerationlogic2.php",
                        type: "POST",
                        data: info,
                        success: function(data){
                            alert(data);
                                $("#messageblock").css("display","block");
                                $('#msg').html(data);
                                $('#registrationform').find('input').val('')
                                window.location.href='login.php';


                        },error: function(xhr, status, error) {
                            var err = eval("(" + xhr.responseText + ")");
                            alert(err.Message);
                        }
                    });
                }
            });
        });
    </script>

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
    </script>
</head>

<body class="antialiased border-top-wide border-success d-flex flex-column" data-new-gr-c-s-check-loaded="14.1022.0" data-gr-ext-installed="">
<div class="page page-center">
    <div class="container-tight py-4">
        <div class="text-center mb-4">
            <a href="."><div class="sidebar-brand-text mx-3" style="padding: 20px;"><img src="img/Optimistic-Futures-Trans-logoLat.png" width="150px;"></div></a>
        </div>
        <form class="user card card-md" id="registrationform" method="post" action="">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Create new account</h2>
                <p style="color:red; font-size:12px;margin:0px;">* All fields are required to be filled except <b>Referred by</b>.</p>
                <br>
                <div class="mb-3">
                    <input type="text" class="form-control form-control-user" id="FirstName" placeholder="First Name" name="firstname">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control form-control-user" id="LastName" placeholder="Last Name" name="lastname">
                </div>
                <div class="form-group mb-3">
                    <input type="email" class="form-control form-control-user" id="Email" placeholder="Email Address" name="email">
                </div>
                <div class="form-group mb-3">
                    <input type="tel" class="form-control form-control-user" id="phone" placeholder="Phone" name="phone" style="margin-bottom: 2px;">
                    <input type="tel" class="form-control form-control-user" id="otp" placeholder="Please type recieved code here" name="otp" style="display: none;" style="margin-bottom: 2px;!important;">
                    <a class="btn btn-primary" href="#" role="button" id="verify"  onClick="verifyOTP();" style="display:none;" style="margin-bottom: 2px;!important;" >Verify</a>
                    <a class="btn btn-primary" href="#" role="button" id="sendAgain" onClick="sendOTP();" style="margin-bottom: 2px !important;">Send OTP</a>
                    <p id="verifyPhoneblock" style="display: none;color:#18bd5b !important;">Phone verified</p>
                </div>

                <div class="form-group row mb-3">
                    <div class="mb-3">
                        <div class="input-group input-group-flat">
                            <input type="password" class="form-control form-control-user" id="Password" placeholder="Password" name="password">
                            <span class="input-group-text">
                                    <a href="#" class="link-secondary" title="" data-bs-toggle="tooltip" data-bs-original-title="Show password" onClick="pass();"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="2"></circle><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path></svg>
                                    </a>
                             </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="input-group input-group-flat">
                            <input type="password" class="form-control form-control-user" id="RepeatPassword" placeholder="Repeat Password" name="repeatpassword">
                            <span class="input-group-text">
                                   <a href="#" class="link-secondary" title="" data-bs-toggle="tooltip" data-bs-original-title="Show password" onClick="pass2();"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                   <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="2"></circle><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path></svg>
                                   </a>
                            </span>
                        </div>
                    </div>
                    <div id="passworderror" style="margin-left: 20px;"></div>
                </div>

                <div class="col-sm-12 mb-3 form-floating">
                    <div class="form-group row">
                        <div id="roleDiv">
                            <select class="browser-default custom-select form-select" id="campus" >
                                <option value="Select Role" selected>Select your preferred location</option>
                                <option value="0">Broadmeadows</option>
                                <option value="1">Campbellfield</option>
                                <option value="2">Coolaroo</option>
                                <option value="3">Craigieburn</option>
                                <option value="4">Werribee</option>
                                <option value="5">Attwood</option>
                                <option value="6">Preston</option>
                                <option value="7">Fawkner</option>
                                <option value="8">Footscary</option>
                                <option value="9">Shepparton</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="studentData">
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
                    <div class="form-group row" style="padding-top:20px;margin-bottom: 10px;">
                        <div class="col-md-12">
                            <select id="courseSelect" class="form-select" aria-label="Default select example">
                                <option selected>Select courses you are interested in</option>
                                <option value="CHC33015 Certificate III in Individual Support">CHC33015 Certificate III in Individual Support (Aged Care)</option>
                                <option value="CPP20218 Certificate II in Security Operations">CPP20218 Certificate II in Security Operations</option>
                                <option value="BH">Baton & Handcuff</option>
                                <option value="CRO">Control Room Operation</option>
                                <option value="CHC30113 Certificate III in Early Childhood Education and Care">CHC30113 Certificate III in Early Childhood Education and Care</option>
                                <option value="CHC50113 Diploma of Early Childhood Education and Care">CHC50113 Diploma of Early Childhood Education and Care</option>
                                <option value="HLTAID009 Provide cardiopulmonary resuscitation">HLTAID009 Provide cardiopulmonary resuscitation</option>
                                <option value="HLTAID010 Provide basic emergency life support">HLTAID010 Provide basic emergency life support</option>
                                <option value="HLTAID011 Provide First Aid">HLTAID011 Provide First Aid</option>
                                <option value="HLTAID012 Provide First Aid in an education and care setting">HLTAID012 Provide First Aid in an education and care setting</option>
                                <option value="CPC40110 Certificate lV in Building and Construction">CPC40110 Certificate lV in Building and Construction (Building)</option>
                                <option value="CPC50210 Diploma of Building and Construction">CPC50210 Diploma of Building and Construction (Building)</option>
                                <option value="CPCCWHS1001 Prepare to work safely in the Construction Industry">CPCCWHS1001 Prepare to work safely in the Construction Industry</option>
                                <option value="CHC40213 Certificate IV in Education Support">CHC40213 Certificate IV in Education Support</option>
                                <option value="CHC43015 Certificate IV in Ageing Support">CHC43015 Certificate IV in Ageing Support</option>
                                <option value="CHC43115 Certificate IV in Disability">CHC43115 Certificate IV in Disability</option>
                            </select>
                            <div id="courseerror" style="margin-left: 20px;"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <select class="browser-default custom-select form-select" id="govsubornot">
                            <option value="funding" selected>Funding Type</option>
                            <option value="1">Government Funded</option>
                            <option value="0">Fee for Service</option>
                        </select>
                        <div id="fundingerror" style="margin-left: 20px;"></div>
                    </div>
                </div>
                <br>
                <div class="mb-3">
                    <input type="text" class="form-control form-control-user" id="ReferredBy" placeholder="Referred By (Optional)" name="referredby">
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

        <div class="text-center text-muted mt-3">
            Already have account? <a href="login.php" tabindex="-1">Sign in</a>
        </div>
    </div>
</div>

<script>
    function pass() {
        var x = document.getElementById("Password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    function pass2() {
        var x = document.getElementById("RepeatPassword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

</script>
<!-- Libs JS -->

<!-- Tabler Core -->
<script src="./dist/js/tabler.min.js?1620587987"></script>
</body>
</html>