<?php
//include('locallib.php');

/**
 * Start Forms Class
 */
class forms{
    public function definition() {
        return false;
    }

    /**
     * Function to display Forms
     * [get JotForm API]
     * @print [print form whose status is enabled on JotForm]
     */
    public function display_report($page){
        get_breadcrumbs($page);
        $row = get_setting_api();
        foreach ($row as $rs):
            $api = $rs["api"];
        endforeach;

        $jotformAPI = new JotForm($api);
        $forms = $jotformAPI->getForms();

        /* Begin Page Content */
        echo '<div class="container-fluid">';
        echo '<h1 class="mb-4 text-gray-800" style="text-align: center; padding-top: 30px;">JotForm Forms</h1>';

        /*  Page Heading */
        echo '<div class="row">
                        <div class="col-sm-12">
                    <div class="card shadow mb-4">
                        <!--<div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">You can edit,update and delete users through this panel</h6>
                        </div>-->
                        <div class="card-body border-bottom-success">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
        echo  '<thead>
                <tr>
                    <th>S.No.</th>
                    <th>Form ID</th>
                    <th>Form Name</th>
                    <th>Form Status</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>S.No.</th>
                    <th>Form ID</th>
                    <th>Form Name</th>
                    <th>Form Status</th>
                </tr>
                </tfoot>
        <tbody>';
        $i=1;
        if(!empty($forms)):
            foreach ($forms as $form):
                if($form["status"] == "ENABLED"):
                    echo '<tr>';
                    echo '<td>'.$i.'</td>';
                    echo '<td>'.$form["id"].'</td>';
                    echo '<td> <a href="https://form.jotform.com/'.$form["id"].'" target="_blank">'.$form["title"].'</a></td>';
                    echo '<td>'.$form["status"].'</td>';
                    echo '</tr>';
                    $i++;
                endif;
            endforeach;
        else:
            echo "Please Check API";
        endif;

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
     * Function to display student and their assigned forms by coordinator
     * []
     * @print [print student, coordinator and Form Access]
     */
    public function form_access_display($page){
        get_breadcrumbs($page);
        /* Begin Page Content */
        echo '<h1 class="mb-4 text-gray-800" style="text-align: center; padding-top: 30px;">Student Forms Access&nbsp; <button type="button" name="add" id="add"  data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning"><i class="fa fa-plus "></i>&nbsp; New Form</button></h1>';
        echo '<div class="container-fluid">';
        /*  Page Heading */
        print_table_header();
        echo  '<thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Student Name</th> 
                        <th>Coordinator Name</th>
                        <th>Current Access</th>
                        <th>Action</th>
                    </tr>
               </thead>
               <tbody>';
        $i = 1;
        $student = get_studentFormaccess();


        if (!empty($student)):
            foreach($student as $std):
                echo '<tr>';
                echo '<td>'.$i.'</td>';
                echo '<td>'.get_user_name($std['user_id']).'</td>';
                if(!empty(get_coordinator_name($std['cdr_id']))):echo '<td>'.get_coordinator_name($std['cdr_id']).'</td>'; else: echo '<td> - </td>';endif;
                echo '<td>'.get_form_access($std['user_id']).'</td>';

                echo '<td><center><a href="#"  id="'.$std["user_id"].'"  class="btn btn-danger btn-circle btn-md" ><i class="fas fa-trash"></i></a></center></td>';
                $i++;
            endforeach;
            echo '</tr>';
        endif;

        print_table_footer();
        $forms = get_form();
        $student = get_student();
        echo '<!-- PHP Ajax Update MySQL Data Through Bootstrap Modal -->
              <div id="add_data_Modal" class="modal fade">  
                  <div class="modal-dialog">  
                       <div class="modal-content">  
                            <div class="modal-header">  
                                   <h4 class="modal-title">Add Student Forms </h4>  
                                   <button type="button" class="close" data-dismiss="modal">&times;</button>  
                            </div>  
                            <div class="modal-body">  
                                 <form method="post" id="insert_form">      
                                       <label>Select Student</label>
                                        <!-- <div id="myDropdown" class="dropdown-content">
                                            <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
                                            <a href="#about">About</a>-->
                                          ';
                                /*        foreach ($student as $std):
                                        echo  '<a href="#">'.get_user_name($std['id']).'</a>';
                                        endforeach;*/

         echo'<!--  </div>-->
              <select name="stdid" id="stdid" class="form-control">
                                         ';
            foreach ($student as $std):
                echo  '<option value='.$std['id'].'>'.get_user_name($std['id']).'</option>';
            endforeach;


        echo '</select>
            <label>Select Form</label>
            <select name= "form" id="choices-multiple-remove-button" placeholder="Select courses you are interested in" multiple required>';
        foreach ($forms as $form):
            echo  '<option value='.$form['id'].'>'.$form['formname'].'</option>';
        endforeach;
        echo '</select>  
                                      <br/>      
                                      <input type="hidden" name="cdrid" id="cdrid" value = "'.$_SESSION['userid'].'"/> 
                                      <input type="submit" name="insert" id="insert" value="Add" class="btn btn-success" />  
                                 </form>  
                            </div>  
                            <div class="modal-footer">  
                                 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
                            </div>  
                       </div>  
                  </div>  
              </div> 
              <!-- / PHP Ajax Update MySQL Data Through Bootstrap Modal -->';
        echo '<script>

$(document).ready(function(){
 


/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}


</script>';
        ?>
        <!--for multiselect-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
        <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
        <!-- / PHP Ajax Update MySQL Data Through Bootstrap Modal -->
        <script>
            $(document).ready(function(){
                var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                    removeItemButton: true,
                    maxItemCount:5,
                    searchResultLimit:3,
                    renderChoiceLimit:100
                });
            });

            $(document).ready(function() {
                $('#add').click(function() {
                    $('#insert').val("Insert");
                    $('#insert_form')[0].reset();
                });

                $('#insert_form').on("submit", function(event) {
                    var formid = $('#choices-multiple-remove-button').val().toString();
                    var user = $('#stdid').val();
                    var cdr = $('#cdrid').val();
                    var info = {
                        form  : formid,
                        stdid : user,
                        cdrid : cdr
                    }
                    event.preventDefault();
                    $.ajax({
                        url: "insertform.php",
                        method: "POST",
                        data: info,
                        success: function(data) {
                            $('#insert_form')[0].reset();
                            $('#add_data_Modal').modal('hide');
                            alert("Assign form to student successfully");
                            window.location.reload();
                        }
                    });
                });
            });


            /**
             * Ajax to delete form
             */
            $(function(){
                $(document).on('click','.btn.btn-danger.btn-circle.btn-md',function() {
                    if (confirm("Are you sure delete this ?")) {
                        var formacces_del = $(this).attr('id');
                        var $ele = $(this).parent().parent();

                        $.ajax({
                            type: 'POST',
                            url: 'insertform.php',
                            data: {'formacces_del': formacces_del},
                            success: function (data) {
                                if (data == "YES") {
                                    $ele.fadeOut().remove();
                                    alert("Form deleted successfully");
                                     window.location.reload();
                                } else {
                                     window.location.reload();
                                    // alert("Invalid Form id")
                                }
                            }
                        });
                    }
                });
            });
        </script>
        <?php
    }
    public function view_form_display($page){
        get_breadcrumbs($page);
        /* Begin Page Content */
        echo '<div class="container-fluid">';
        echo '<h1 class="mb-4 text-gray-800" style="text-align: center; padding-top: 30px;"> Enrolment Forms &nbsp; <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning"><i class="fa fa-plus "></i>&nbsp; New Form</button></h1>';
        /*  Page Heading */
        print_table_header();
        echo  '<thead>
                <tr>
                    <th>S.No.</th>
                    <th>Form Name</th>
                    <th>Form ID</th>  
                    <th>Action</th> 
                </tr>
                </thead>   
        <tbody>';
        $i=1;
        $forms = get_form();
        if (!empty($forms)):
            foreach ($forms as $log):
                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td><a href="index.php?page=9&form='.$log["iframe"].'" > '.$log['formname'].'</a></td>';
                echo '<td>'.$log['iframe'].'</td>';
                echo '<td><center><a href="#"  id="'.$log["id"].'"  class="btn btn-danger btn-circle btn-md" ><i class="fas fa-trash"></i></a></center></td>';
                $i++;
                echo '</tr>';
            endforeach;
        else:
            echo '<tr>';
            echo '<td>No Data to Display</td>';
            echo '</tr>';
        endif;
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
                                      <label>Enter Form Name</label>  
                                      <input type="text" name="name" id="name" class="form-control" />  
                                      <br />  
                                      <label>Enter Form ID</label>  
                                      <input name="link" id="link" class="form-control">
                                      <br />  
                                      <input type="submit" name="insert" id="insert" value="Add" class="btn btn-success" />  
                                 </form>  
                            </div>  
                            <div class="modal-footer">  
                                 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
                            </div>  
                       </div>  
                  </div>  
              </div> 
              <!-- / PHP Ajax Update MySQL Data Through Bootstrap Modal -->';?>

        <!-- / PHP Ajax Update MySQL Data Through Bootstrap Modal -->
        <script>
            /**
             * Ajax to Add New Form
             */
            $(document).ready(function() {
                $('#add').click(function() {
                    $('#insert').val("Add");
                    $('#insert_form')[0].reset();
                });
                $('#insert_form').on("submit", function(event) {
                    var formname =$('#name').val();
                    var link = $('#link').val();
                    var info = {
                        form : formname,
                        formlink : link
                    }
                    event.preventDefault();
                    if (formname == "") {
                        alert("Enter Form Name");
                    } else if (link == '') {
                        alert("Enter Form Link");
                    } else {
                        $.ajax({
                            url: "insertform.php",
                            method: "POST",
                            data: info,
                            success: function (data) {
                                $('#insert_form')[0].reset();
                                $('#add_data_Modal').modal('hide');
                                alert("Form added successfully");
                                window.location.reload();
                            }
                        });
                    }
                });
            });

            /**
             * Ajax to delete form
             */
            $(function(){
                $(document).on('click','.btn.btn-danger.btn-circle.btn-md',function() {
                    if (confirm("Are you sure delete this ?")) {
                        var del_id = $(this).attr('id');
                        var $ele = $(this).parent().parent();

                        // console.log(del_id);
                        $.ajax({
                            type: 'POST',
                            url: 'insertform.php',
                            data: {'del_id': del_id},
                            success: function (data) {
                                if (data == "YES") {
                                    $ele.fadeOut().remove();
                                    alert("Form deleted successfully");
                                    window.location.reload();
                                } else {
                                    window.location.reload();
                                   // alert("Invalid Form id")
                                }
                            }
                        });
                    }
                });
            });
        </script>
        <?php
    }


    /**
     * Function to open selected  Form
     * Display embeded form
     */
    public function open_new_form($formlink,$formname,$userId, $email){
        global $url;
        $response = get_formResponse($formname,$userId);
        if ($response == 1) {
        echo '<div class="container-fluid">';
        echo '<div class="row row-cards">
                  <div class="col-md-12 col-xl-12">
                    <div class="row row-cards">
                        <div class="col-6 border-0">
                            <div class="card">
                              <div class="card-body" STYLE="border: 2px #01bc70 dashed;">
                                <h1 class="" style="text-align: center; padding-top: 30px; ">Identification number</h1>
                                <p style="text-align: center; font-size: 24px;">' . $userId . '</p>
                              </div>
                            </div>
                        </div>
                        <div class="col-6 border-0">
                            <div class="card">
                              <div class="card-body" STYLE="border: 2px #01bc70 dashed;">
                                <h1 class="" style="text-align: center; padding-top: 30px;">Email</h1>
                                <p style="text-align: center;font-size: 24px;">' . $email . '</p>
                              </div>
                            </div>
                        </div>
                    </div>
                  </div>
              </div>';
        echo '<script type="text/javascript" src="https://form.jotform.com/jsform/' . $formlink . '"></script>';
        echo '</div>';
    }else{
        echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
     }
    }

    /**
     * Function to edit completed Form
     * Display embeded form
     */
    public function editform($link,$page){
        get_breadcrumbs($page);
        global $url;
    ?>
           <iframe id="JotFormIFrame"onload="window.parent.scrollTo(0,0)"allowtransparency="true"src="https://www.jotform.com/edit/<?php echo $link; ?>"
                 frameborder="0" style="width:100%;  height: 8815px; border:none;" scrolling="yes"> </iframe>
    <?php
       echo '</div>';

    }


    /**
     * Function to student assigned Forms
     * Display Users Forms on Dashboard
     **/
    public function student_form($role){

            global $pdo,$url,  $enrolmentForm, $usiForm, $skillForm, $documentForm, $usitransForm ,$seclln;
            $userId=$_SESSION['userid'];

            /** Edited By Inam 07/12/2021 */
            $query = "select * from user where `id`=:userId";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam('userId', $userId, PDO::PARAM_STR);
            $stmt->execute();
            $row  = $stmt->fetch(PDO::FETCH_ASSOC);
            // var_dump($row);
            $courses_ar = explode('a,', $row ["courses"]);
            //echo '<h1>d</h1>';
            //var_dump($courses_ar);
            $different=0;
            $found=0;
            //IF FOUND=1 AND DIFFERENT =0 THEN ONLY WHITECARD OR FIRST AID
            //IF FOUND=1 AND DIFFERENT =1 THEN NOT ONLY WHITECARD OR FIRST AID
            //IF FOUND=0 AND DIFFERENT =1 THEN NO WHITECARD OR FIRST AID
            $security=0;
            foreach ($courses_ar as $value) {
                if (strpos($value, 'CPP20218') !== false){
                    $security=1;
                }
                if (strpos($value, 'CPCCWHS1001') !== false || strpos($value, 'HLTAID0') !== false){
                    $found=1;
                }else{
                    $different=1;
                }
            }
            $row2= userDetails($userId);

        /** Edited By Inam 26/10/2021 */
        echo '<div class="container-fluid">';
        echo '<div class="row">';
        if($role==3){
            /** Edited By Inam 07/12/2021 */

            /** Student Dashboard */
            StudentDashboard($row2, $security, $found,$different,$userId);
        }else{

            /** Edited By Inam 07/12/2021 */

            /** Admin/Coordinator Dashbaord **/
            AdminDasboard();
        }
    }

        public function view_course_display($page){
            get_breadcrumbs($page);
            /* Begin Page Content */
            echo '<div class="container-fluid">';
            echo '<h1 class="mb-4 text-gray-800" style="text-align: center; padding-top: 30px;"> Courses Offer &nbsp; <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning"><i class="fa fa-plus "></i>&nbsp; Add New Course</button></h1>';
            /*  Page Heading */
            print_table_header();

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.wisenet.co/v1/course-offers',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'X-Api-Key: 9qYR1chb2Kabm3gdYBlJb31QHaCCw3lE8YeBpW6i'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($response,true);

            echo  '<thead>
                <tr>
                    <th>S.No.</th>
                    <th>Course Code</th>
                    <th>Description</th>  
                   <th>Start Date</th>
                    <th>End Date</th>      
                </tr>
                </thead>   
        <tbody>';
                $i=1;
                foreach ($result as $log) {
                    echo '<tr>';
                    echo '<td>' . $i . '</td>';
                    echo '<td>' . $log['Data']['Code'] . '</td>';
                    echo '<td>' . $log['Data']['Description'] . '</td>';
                    echo '<td>' . $log['Data']['CourseOfferStartDate'] . '</td>';
                    echo '<td>' . $log['Data']['CourseOfferEndDate']   . '</td>';
                    echo '</tr>';
                    $i++;
                }

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
                                      <label>Enter Form Name</label>  
                                      <input type="text" name="name" id="name" class="form-control" />  
                                      <br />  
                                      <label>Enter Form ID</label>  
                                      <input name="link" id="link" class="form-control">
                                      <br />  
                                      <input type="submit" name="insert" id="insert" value="Add" class="btn btn-success" />  
                                 </form>  
                            </div>  
                            <div class="modal-footer">  
                                 <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
                            </div>  
                       </div>  
                  </div>  
              </div> 
              <!-- / PHP Ajax Update MySQL Data Through Bootstrap Modal -->';?>

            <!-- / PHP Ajax Update MySQL Data Through Bootstrap Modal -->
            <script>
                /**
                 * Ajax to Add New Form
                 */
                $(document).ready(function() {
                    $('#add').click(function() {
                        $('#insert').val("Add");
                        $('#insert_form')[0].reset();
                    });
                    $('#insert_form').on("submit", function(event) {
                        var formname =$('#name').val();
                        var link = $('#link').val();
                        var info = {
                            form : formname,
                            formlink : link
                        }
                        event.preventDefault();
                        if (formname == '') {
                            alert("Enter Form Name");
                        } else if (link == '') {
                            alert("Enter Form Link");
                        } else {
                            $.ajax({
                                url: "insertform.php",
                                method: "POST",
                                data: info,
                                success: function (data) {
                                    $('#insert_form')[0].reset();
                                    $('#add_data_Modal').modal('hide');
                                    alert("Form added successfully");
                                    window.location.reload();
                                }
                            });
                        }
                    });
                });

                /**
                 * Ajax to delete form
                 */
                $(function(){
                    $(document).on('click','.btn.btn-danger.btn-circle.btn-md',function() {
                        if (confirm("Are you sure delete this ?")) {
                            var del_id = $(this).attr('id');
                            var $ele = $(this).parent().parent();

                            // console.log(del_id);
                            $.ajax({
                                type: 'POST',
                                url: 'insertform.php',
                                data: {'del_id': del_id},
                                success: function (data) {
                                    if (data == "YES") {
                                        $ele.fadeOut().remove();
                                        alert("Form deleted successfully");
                                        window.location.reload();
                                    } else {
                                        window.location.reload();

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

/**
 * End Forms Class
 */