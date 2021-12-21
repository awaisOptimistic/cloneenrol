<?php


class setting
{ public $baseURL = 'https://api.jotform.com';
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
     * Function to get API
     * @print [get API from the database]
     */
    public function display_report($page){
        get_breadcrumbs($page);
        /* Begin Page Content */
        echo '<div class="container-fluid">';
        echo '<h1 class="mb-4 text-gray-800" style="text-align: center; padding-top: 30px;">JotForm API &nbsp; <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Update API</button></h1>';

        /*  Page Heading */
       print_table_header();

       echo '<thead>
                <tr>
                    <th>S.No.</th>
                    <th>JotForm API</th>
                 <!--<th>Action</th>-->
                </tr>
             </thead>
             <tbody>';
                $i=1;
                $api = get_setting_api();
                    echo '<tr>';
                    echo '<td>'.$i.'</td>';
                    echo '<td>'.$api.'</td>';
                    echo '</tr>';
                    $i++;
       print_table_footer();
       echo '<!-- PHP Ajax Update MySQL Data Through Bootstrap Modal -->
             <div id="add_data_Modal" class="modal fade">  
                  <div class="modal-dialog">  
                       <div class="modal-content">  
                            <div class="modal-header">  
                                   <h4 class="modal-title">Add New Form</h4>  
                                   <button type="button" class="close" data-dismiss="modal">&times;</button>  
                            </div>  
                            <div class="modal-body">  
                                 <form method="post" id="insert_form">  
                                      <label>Update API</label>  
                                      <input type="text" name="name" id="name" class="form-control" />  
                                      <br />
                                      <input type="submit" name="insert" id="insert" value="Update" class="btn btn-success" />  
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
        <script>
        $(document).ready(function() {
            $('#add').click(function() {
                $('#insert').val("Update");
                $('#insert_form')[0].reset();
            });

            $('#insert_form').on("submit", function(event) {
                var apikey =$('#name').val();
                var info = {
                    api : apikey
                    }
                event.preventDefault();
                if (apikey == "") {
                    alert("Enter API key");
                } else {
                    $.ajax({
                        url: "insertform.php",
                        method: "POST",
                        data: info,
                        success: function(data) {
                            $('#insert_form')[0].reset();
                            $('#add_data_Modal').modal('hide');
                            setInterval('location.reload()', 1000);
                        }
                    });
                }
            });
        });
        </script>
<?php
    }

    public function who_can_recieve_sms($page){

        get_breadcrumbs($page);
        /* Begin Page Content */
        echo '<div class="container-fluid">';
        echo '<h1 class="mb-4 text-gray-800" style="text-align: center; padding-top: 30px;">Who can receive SMS &nbsp; <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Add New Recipient</button></h1>';

        /*  Page Heading */
        print_table_header();

        echo '<thead>
                <tr>
                    <th>S.No.</th>
                    <th>Recipient Name</th>
                    <th>Phone Number</th>
                    <th>Action</th>
                </tr>
             </thead>
             <tbody>';
        $i=1;
        $row = get_sms_recipients();
        foreach ($row as $form) {
            echo '<tr>';
            echo '<td>'.$i.'</td>';
            echo '<td>'.$form["fullName"].'</td>';
            echo '<td>'.$form["phone"].'</td>';
            echo '<td>
                    <a href="#" class="btn btn-success btn-circle btn-md" id="'.$form["id"].'">
                        <i class="fas fa-edit"></i>
                    </a>
                   
                    <a href="#" class="btn btn-danger btn-circle btn-md" id="'.$form["id"].'">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>';
            echo '</tr>';
            $i++;
        }
        print_table_footer();
        echo '<!-- PHP Ajax Update MySQL Data Through Bootstrap Modal -->
             <div id="add_data_Modal" class="modal fade">  
                  <div class="modal-dialog">  
                       <div class="modal-content">  
                            <div class="modal-header">  
                                   <h4 class="modal-title">Add New Recipient</h4>  
                                   <button type="button" class="close" data-dismiss="modal">&times;</button>  
                            </div>  
                            <div class="modal-body">  
                      <form class="user card card-md" id="addNewRecipientForm" method="post" action="">
                          <div class="card-body">
                             <div class="mb-3">
                                    <input type="text" class="form-control form-control-user" id="name"
                                           placeholder="Full Name" name="name">
                            </div>
                            
                            <div class="form-group mb-3">
                                <input type="tel" class="form-control form-control-user" id="phone"
                                       placeholder="Phone" name="phone" >
                            </div>
                            <div class="form-footer">
                              <button type="submit" name="submitBtnLogin" id="submitBtnLogin" class="btn btn-success w-100">Add Now</button>
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

                $('#name').change(function(){
                    var name = $('#name').val();
                    var nameregEx=/^[a-z ,.'-]+$/i;
                    var validName = nameregEx.test(name);
                    if (name.length < 1) {
                        $('#nameError').remove();
                        $('#name').after('<div class="error" id="nameError" style="padding-top:10px; margin:0px;"><p class="error" style="color:red; font-size:12px;margin:0px;">This field is required</p></div>');
                    }else if (!validName) {
                        $('#nameError').remove();
                        $('#name').after('<div class="error"  id="nameError"  style="padding-top:10px; margin:0px;"><p class="error" style="color:red; font-size:12px;margin:0px;">Enter a valid Name</p></div>');
                    }else if (validName) {
                        $('#nameError').remove();
                    }
                });


                $('#phone').change(function(){
                    var phone = $('#phone').val();
                    var phoneRegex=/^(?:\+?(61))? ?(?:\((?=.*\)))?(0?[2-57-8])\)? ?(\d\d(?:[- ](?=\d{3})|(?!\d\d[- ]?\d[- ]))\d\d[- ]?\d[- ]?\d{3})$/gm;
                    if (phone.length < 1) {
                        $('#phoneError').remove();
                        $('#phone').after('<div class="error" id="phoneError" style="padding-top:10px;margin:0px;"><p style="color:red; font-size:12px;margin:0px;">This field is required</p></div>');
                    } else {
                        var validPhone = phoneRegex.test(phone);
                        if (!validPhone) {
                            $('#phoneError').remove();
                            $('#phone').after('<div class="error" id="phoneError" style="padding-top:10px;"margin:0px;><p class="error" style="color:red; font-size:12px;margin:0px;">Enter a valid phone number</p></div>');
                        }else if(validPhone){
                            $('#phoneError').remove();
                        }
                    }
                });


                $('#addNewRecipientForm').submit(function(e) {
                    e.preventDefault();
                    errorCount=0;
                    $("#errorblock").css("display","none");
                    $("#messageblock").css("display","none");

                    var phone = $('#phone').val();
                    var phoneRegex=/^(?:\+?(61))? ?(?:\((?=.*\)))?(0?[2-57-8])\)? ?(\d\d(?:[- ](?=\d{3})|(?!\d\d[- ]?\d[- ]))\d\d[- ]?\d[- ]?\d{3})$/gm;

                    $(".error").remove();

                    var name = $('#name').val();
                    var nameregEx=/^[a-z ,.'-]+$/i;
                    var validName = nameregEx.test(name);

                        var name = $('#name').val();
                        var nameregEx=/^[a-z ,.'-]+$/i;
                        var validName = nameregEx.test(name);
                        if (name.length < 1) {
                            $('#nameError').remove();
                            $('#name').after('<div class="error" id="nameError" style="padding-top:10px; margin:0px;"><p class="error" style="color:red; font-size:12px;margin:0px;">This field is required</p></div>');
                            errorCount++;
                        }else if (!validName) {
                            $('#nameError').remove();
                            $('#name').after('<div class="error"  id="nameError"  style="padding-top:10px; margin:0px;"><p class="error" style="color:red; font-size:12px;margin:0px;">Enter a valid Name</p></div>');
                            errorCount++;
                        }else if (validName) {
                            $('#nameError').remove();
                        }

                    if (phone.length < 1) {
                        $('#phone').after('<div class="error" style="padding-top:10px;margin:0px;"><p style="color:red; font-size:12px;margin:0px;">This field is required</p></div>');
                        errorCount++;
                    } else {
                        var validPhone = phoneRegex.test(phone);
                        if (!validPhone) {
                            $('#phone').after('<div class="error" style="padding-top:10px;"margin:0px;><p class="error" style="color:red; font-size:12px;margin:0px;">Enter a valid phone number</p></div>');
                            errorCount++;
                        }
                    }


                    if(errorCount==0){
                        var newrec={
                            recipientPage:1,
                            FullName: name,
                            Phone:phone
                        }
                        //alert(phone);
                        $.ajax({
                            url: "insertform.php",
                            type: "POST",
                            data: newrec,
                            success: function(data){
                                //alert(data);
                                var a = data.includes("Success");
                                if (a) {
                                    $("#messageblock").css("display","block");
                                    $('#msg').html(data);
                                    $('#addNewRecipientForm').find('input').val('')
                                    location.reload();
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
             * Ajax to Update form
             */
                $(document).on('click','.btn.btn-danger.btn-circle.btn-md',function() {
                    if (confirm("Are you sure you want to delete this recipient?")) {
                        var recdel_id = $(this).attr('id');
                        var $ele = $(this).parent().parent();
                        //console.log(del_id);
                        $.ajax({
                            type: 'POST',
                            url: 'insertform.php',
                            data: {'recdel_id': recdel_id},
                            success: function (data) {
                                    window.location.reload();
                            }
                        });
                    }
                });
        </script>

        <script>
            $(document).ready(function() {
                $('#add').click(function() {
                    $('#insert').val("Update");
                    $('#insert_form')[0].reset();
                });

                $('#insert_form').on("submit", function(event) {
                    var apikey =$('#name').val();
                    var info = {
                        api : apikey
                    }
                    event.preventDefault();
                    if (apikey == "") {
                        alert("Enter API key");
                    } else {
                        $.ajax({
                            url: "insertform.php",
                            method: "POST",
                            data: info,
                            success: function(data) {
                                $('#insert_form')[0].reset();
                                $('#add_data_Modal').modal('hide');
                                setInterval('location.reload()', 1000);
                            }
                        });
                    }
                });
            });
        </script>
        <?php
    }
    public function permissions($page){
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
            echo '<h1 class="h1 mb-4 text-gray-800" style="text-align: center; padding-top: 30px;">Permissions</h1> ';
            include "config.php";
            $query2 = "SELECT * FROM  `user` WHERE user.role != 3";
            $stmt2 = $pdo->prepare($query2);
            //$stmt2->bindParam('userId', $userId, PDO::PARAM_STR);
            $stmt2->execute();
            $row2   = $stmt2->fetchAll(PDO::FETCH_ASSOC);
            $i= 1;

            print_table_header();
            echo '<thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Full Name</th>           
                        <th>Role</th>
                        <th>Student progress</th>
                        <th>Current Users</th>
                        <th>JotForm Submission</th>
                        <th>Approved Students</th>
                        <th>JotForm API </th>
                        <th>Permissions</th>
                    </tr>
               </thead>
               <tfoot>
                    <tr>
                        <th>S.No.</th>
                        <th>Full Name</th>           
                        <th>Role</th>
                        <th>Student progress</th>
                        <th>Current Users</th>
                        <th>JotForm Submission</th>
                        <th>Approved Students</th>
                        <th>JotForm API </th>
                        <th>Permissions</th>
                    </tr>
               </tfoot>
               <tbody>';
            //var_dump($row2);
            foreach ($row2 as $data){
                //check for the course of the student
                echo '<tr>';
                echo '<td ">'.$i.'</td>';
                echo '<td>' . $data["firstname"] .' ' .$data["lastname"] . '</td>';
                if($data["role"]==1){ echo "<td>Admin</td>";}
                elseif($data["role"]==2){echo "<td>Coordinator</td>";}elseif($data["role"]==4){echo "<td>Auditor</td>";}

                    //Student Progress

                    echo '<td> '.canView($data["id"],19,'line1'.$i).canEdit($data["id"],19,'line1'.$i).'</td>';
                    //Current Users
                    echo '<td> '.canView($data["id"],3,'line2'.$i).canEdit($data["id"],3,'line2'.$i).'</td>';

                    //JotForm Submission
                    echo '<td> '.canView($data["id"],12,'line3'.$i).canEdit($data["id"],12,'line3'.$i).'</td>';

                    //Approved Students
                    echo '<td> '.canView($data["id"],11,'line4'.$i).canEdit($data["id"],11,'line4'.$i).'</td>';

                    //JotForm API
                    echo '<td>'.canView($data["id"],2,'line5'.$i).canEdit($data["id"],2,'line5'.$i).'</td>';

                    //Permissions
                    echo '<td>'.canView($data["id"],24,'line6'.$i).canEdit($data["id"],24,'line6'.$i).'</td>';

                /*  }else{
                      echo '<td><a href="index.php?page=20&userid='.$data['id'].'" target="_blank"></ahref><i class="fa fa-link" style="color:blue;"></i></a></td></tr>';
                  }*/

                $i++;
            }
            print_table_footer();
        }
        ?>
        <script>
            $(function(){
                $(document).on('change','.canView',function() {
                    var id=$(this).attr('id');
                    var page = $(this).attr('alt');
                    var userid=$(this).attr('tooltip');
                    var CanVieworcanEdit='view';

                    if($("#"+id).is(':checked')==true){
                        var state=1;

                    }else{
                        var state=0;
                    }
                    //alert(state);
                    $.ajax({
                        type: 'POST',
                        url: 'lib.php',
                        data: {permissionOption: page, userId:userid,CanVieworcanEdit:CanVieworcanEdit,state:state},
                        success: function () {
                                alert("Permission Granted");
                            $("#"+page).removeAttr("checked");
                        }
                    });
                });

                $(document).on('change','.canEdit',function() {
                    var id=$(this).attr('id');
                    var page = $(this).attr('alt');
                    var userid=$(this).attr('tooltip');
                    var CanVieworcanEdit='edit';

                    if($("#"+id).is(':checked')==true){
                        var state=1;

                    }else{
                        var state=0;
                    }
                    alert(state);
                    $.ajax({
                        type: 'POST',
                        url: 'lib.php',
                        data: {permissionOption: page, userId:userid,CanVieworcanEdit:CanVieworcanEdit,state:state},
                        success: function () {
                            alert("Permission Granted");
                            $("#"+page).removeAttr("checked");
                        }
                    });
                });

            });
            //checked100
            // $(function(){
            //     $(document).on('change','.canView',function() {
            //         if (confirm("Do you want to mark this activity as checked?")) {
            //             var id = $(this).attr('id');
            //             var val=$(this).attr('value');
            //             var $ele = $(this).parent().parent();
            //             var $ele2 = $(this);
            //             var CanVieworcanEdit='view';
            //             //console.log(id);
            //             //console.log(val);
            //             $.ajax({
            //                 type: 'POST',
            //                 url: 'lib.php',
            //                 data: {permissionOption: val, userId:id,CanVieworcanEdit:CanVieworcanEdit},
            //                 success: function (data) {
            //                     if (data == "YES") {
            //                         //$ele.fadeOut().remove();
            //                         //$ele.append('<i class="fab fa-medium-m" style="color:orange;" data-toggle="tooltip" data-placement="top" title=" atha rakh"></i>');
            //                         //$id.html("welcome");
            //                         $ele2.html('<i class="fas fa-archive" style="color:green;" data-toggle="tooltip" data-placement="top" title="Marked Completed"></i>');
            //                         //alert("Mark completed successfully");
            //                         //window.location.reload();
            //                         //$('.form-switch').remove();
            //                     } else {
            //                         alert(data);
            //                         //window.location.reload();
            //                         //alert("Invalid User id")
            //                     }
            //                 }
            //             });
            //         }
            //     });
            // });
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
}