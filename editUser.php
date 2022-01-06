<?php
if (isset($_POST['userid'])) {
    include('config.php');
    $userId=$_POST['userid'];
    try {
        $query = "select * from `user` where `id`=:userId";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('userId', $userId, PDO::PARAM_STR);
        $stmt->execute();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error : " . $e->getMessage();
    }
    ?>
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
    <script src="js/sb-admin-2.min.js"></script>
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

            $('#updateform').submit(function(e) {
                e.preventDefault();
                $("#errorblock").css("display","none");
                $("#messageblock").css("display","none");
                var userId = $('#userId').val();
                var first_name = $('#FirstName').val();
                var last_name = $('#LastName').val();
                var email = $('#Email').val();
                var Password = $('#Password').val();
                var repeatPassword = $('#RepeatPassword').val();
                var role=$("#selectrole option:selected").text();
                var loc="abc";
                var EmailregEx = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                var nameRegEx=/^(?=.{1,50}$)[a-z]+(?:['_.\s][a-z]+)*$/i;
                var role=$("#role option:selected").val();
                var phone = $('#phone').val();
                var errorCount=0;
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

                if($('#samepass').is(":checked")){
                    Password='keepthesame';
                    var keepTheSamePass=1;
                }else{
                    if (Password.length < 8 ) {
                        $('#passworderror').append('<div class="error" style="padding-top:10px;margin:0px;margin:0px;"><p class="error" style="color:red; font-size:12px;">Password must be at least 8 characters</p></div>');
                        errorCount++;
                    }else if(Password!=repeatPassword){
                        $('#passworderror').append('<div class="error" style="padding-top:10px;margin:0px;margin:0px;"><p class="error" style="color:red; font-size:12px;">Password do not match.</p></div>');
                        errorCount++;
                    }
                }
                if(role=="Select Role" || role==null){
                    $('#roleDiv').after('<div class="error" style="padding-top:10px; margin:0px;"><p class="error" style="color:red; font-size:12px;margin:0px;">Please select any role</p></div>');
                    errorCount++;
                }
                if (role==3){
                    if($('#samecourses').is(":checked")) {
                        var selectedCourses = 'keepthesamecourses';
                    }else{
                        var select = document.getElementById('choices-multiple-remove-button');
                        var selectedCourses = [...select.options]
                            .filter(option => option.selected)
                            .map(option => option.value);
                        if(selectedCourses=="" || role==null){
                            $('#choices-multiple-remove-button').after('<div class="error" style="padding-top:10px; margin:0px;"><p class="error" style="color:red; font-size:12px;margin:0px;">Please select course/courses</p></div>');
                            errorCount++;
                        }
                    }
                    var mediaSource=$("#source option:selected").text();
                    if(mediaSource=="How did you find us?") {
                        $('#source').after('<div class="error" style="padding-top:10px; margin:0px;"><p class="error" style="color:red; font-size:12px;margin:0px;">Please select one of the options</p></div>');
                        errorCount++;
                    }
                }
                if(errorCount==0){
                    if (role==3){
                        var info={
                            userId:userId,
                            FirstName: first_name,
                            LastName: last_name,
                            Email: email,
                            Phone:phone,
                            Password: Password,
                            Role: role,
                            source:mediaSource,
                            course:selectedCourses

                        };
                    }else{
                        var info={
                            userId:userId,
                            FirstName: first_name,
                            LastName: last_name,
                            Email: email,
                            Phone:phone,
                            Password: Password,
                            Role: role
                        };
                    }
                    $.ajax({
                        url: "updationlogic.php",
                        type: "POST",
                        data: info,
                        success: function(data){
                            //alert(data);
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
    <div class="">
        <div class="">
            <div class="">
                <div class="">
                    <div class="">
                        <form class="user" id="updateform" method="post" action="">
                            <div class="card-body">
                                <h2 class="card-title text-center mb-4">Update User</h2>
                                <input type="text" class="form-control form-control-user" id="userId" name="firstname" value="<?php echo $row["id"]; ?>" style="display: none;">
                                <div class="mb-3">
                                    <input type="text" class="form-control form-control-user" id="FirstName"
                                           placeholder="First Name" name="firstname" value="<?php echo $row["firstname"]; ?>">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control form-control-user" id="LastName"
                                           placeholder="Last Name" name="lastname" value="<?php echo $row["lastname"]; ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <input type="email" class="form-control form-control-user" id="Email"
                                           placeholder="Email Address" name="email" value="<?php echo $row["email"]; ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control form-control-user" id="phone"
                                           placeholder="Phone" name="phone" value="<?php echo $row["phone"]; ?>">
                                </div>
                                <div class="form-group row mb-3">
                                    <div class="col-sm-6 mb-3 mb-sm-0 mb-3">
                                        <label>New Password</label>
                                        <input type="password" class="form-control form-control-user"
                                               id="Password" placeholder="**********" name="password">
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label>Confirm New Password</label>
                                        <input type="password" class="form-control form-control-user"
                                               id="RepeatPassword" placeholder="**********" name="repeatpassword">
                                    </div>
                                    <div id="passworderror" style="margin-left: 20px;">
                                    </div>
                                    <div id="passworderror" class="mb-3" style="">
                                        <input type="checkbox" id="samepass" name="samepass" value="samepass">
                                        <label for="samepass"> Keep the same password</label><br>
                                    </div>
                                </div>

                                <div class="col-sm-6 mb-3 form-floating">
                                    <div class="form-group row">
                                        <div id="roleDiv">
                                            <select class="browser-default custom-select form-select" id="role">
                                                <?php
                                                if($row["role"]=="1"){
                                                    ?>
                                                    <option value="Select Role">Select Role</option>
                                                    <option value="1" selected>Admin</option>
                                                    <option value="2">Coordinator</option>
                                                    <option value="3">Student</option>
                                                    <?php
                                                }else if($row["role"]=="2"){
                                                    ?>
                                                    <option value="Select Role">Select Role</option>
                                                    <option value="1" >Admin</option>
                                                    <option value="2" selected>Coordinator</option>
                                                    <option value="3">Student</option>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <option value="Select Role">Select Role</option>
                                                    <option value="1" >Admin</option>
                                                    <option value="2" >Coordinator</option>
                                                    <option value="3" selected>Student</option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="studentData" style="display: none;">
                                    <div class="form-group row">
                                        <select class="browser-default custom-select form-select" id="source">
                                            <option value="How did you find us?" <?php if($row['source']=="How did you find us?") echo 'selected';?>>How did you find us?</option>
                                            <option value="google" <?php if($row['source']=="Google") echo 'selected';?>>Google</option>
                                            <option value="fb" <?php if($row['source']=="Facebook") echo 'selected';?>>Facebook</option>
                                            <option value="fb" <?php if($row['source']=="Instagram") echo 'selected';?>>Instagram</option>
                                            <option value="fb" <?php if($row['source']=="Linkedin") echo 'selected';?>>Linkedin</option>
                                            <option value="fb" <?php if($row['source']=="Word of mouth") echo 'selected';?>>Word of mouth</option>
                                        </select>
                                    </div>
                                    <div class="form-group row" style="padding-top:10px;">
                                        <div class="col-md-12">
                                            <select id="choices-multiple-remove-button" placeholder="Select courses you are interested in" multiple>

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
                                            <?php
                                            $courses = explode(",", $row['courses']);
                                            //var_dump($courses);
                                            if($courses!=null || !empty($courses)){
                                                echo '<h5 style="color: #49c27d;">Currently Selected Courses</h5>';
                                                echo $row['courses'];
                                                ?>
                                                <div id="courseInDB">

                                                    <input type="checkbox" id="samecourses" name="samecourses" value="samecourses">
                                                    <label for="samecourses"> Keep the same courses</label><br>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        foreach ($courses as $value){
                                            echo '<script type="text/javascript">',
                                                'var course = $("#'.$value.'").text();$("#myUL").append("<li>"+course+"</li>");',
                                            '</script>';
                                        }
                                        echo '<input type="text" id="keepSameCourses" name="keepSameCourses" value="'.$row["courses"].'" placeholder="'.$row["courses"].'" style="display:none;">';
                                        ?>
                                    </div>
                                </div>
                                <div class="form-footer">
                                    <button type="submit" name="submitBtnLogin" id="submitBtnLogin" class="btn btn-primary w-100">Update User</button>

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
}
    ?>