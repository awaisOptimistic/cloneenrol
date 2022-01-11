<?php
    session_start();
  if ($_SESSION['currentSession'] != 1 ) {
        header('Location: /login.php', true, 301);
        exit();
    }

include('header.php');
include('class/enrolment.php');
include('class/forms.php');
include('class/users.php');
include('class/setting.php');
include('api/JotForm.php');
include('lib/userlib.php');
//include ('lib/apilib.php');

global  $url, $enrolmentForm, $usiForm, $skillForm, $documentForm, $usitransForm,$seclln;
?>
<div class="page-wrapper">
    <div class="container-xl">
        <?php

        $admin = 1;
        $coordinator = 2;
        $student = 3;
        $auditor = 4;
        $role=$_SESSION['role'];
        $page = $_GET['page'];

        if($page == 1){
            if($role==$admin || $role==$coordinator || $role==$auditor){
                $forms = new forms();
                $forms->display_report($page);
            }else{
                echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
            }
        }else if($page == 2){
            if($role==$admin || $role== $coordinator ){
                $setting = new setting();
                $setting->display_report($page);
            }else{
                echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
            }
        }else if($page == 3){
            if($role==$admin || $role==$coordinator || $role == $auditor){
                $currentusers = new users();
                $currentusers->current_users_display_report($page);
            }else{
                echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
            }
        }/*else if($page == 4){
            if($role==$admin || $role==$coordinator ){
                $pendingusers = new users();
                $pendingusers->pending_users_display_report($page);
            }else{
                echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
            }
        }else if($page == 5){
            if($role==$admin || $role==$coordinator ){
                $loginusers = new users();
                $loginusers->login_users_display_report();
            }else{
                echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
            }
        }*/else if($page == 6){
            if($role==$admin || $role==$coordinator){
                $getusers = new enrolment();
                $getusers->display_report($page);
            }else{
                echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
            }
        }else if($page == 7){
            if($role==$admin || $role==$coordinator){
                $forms = new forms();
                $forms->form_access_display($page);
            }else{
                echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
            }
        }else if($page == 8){
            if($role==$admin || $role==$coordinator ){
                $forms = new forms();
                $forms->view_form_display($page);
            }else{
                echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
            }
        }else if($page == 26){

                $forms = new forms();
                $forms->view_course_display($page);

        }else if($page == 9){
            if($role==$admin || $role == $student || $role==$coordinator){
                $formlink = $_GET['form'];
                $formname = $_GET['formname'];
                $userId = $_SESSION['uqid'] ;
                $email = $_SESSION['email'];
                $forms = new forms();
                $forms->open_new_form($formlink,$formname,$userId,$email);
            }else{
                echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
            }
        }else if($page == 10){
            global  $pdo;
            if($role==$admin || $role==$coordinator ){
                $userId=$_GET['user'];
                $forms = new enrolment();
                $wisenetdata = $forms->get_wisenet_users($userId);

                if(!empty($wisenetdata)){
                    $wisedata =  json_encode($wisenetdata);

                    $response = $forms->wisesnet_insert($wisedata);
                    if($response){
                        $data = json_decode($response, true);
                        $rs = $data[0]['Data']['Personal']['LearnerNumber'];
                        $status = 1;

                        $staffid=$_SESSION['userid'];
                        $result = updatewisenetEntry($status, $rs,$staffid, $userId);
                        if ($result){
                            insert_moodle($userId,$rs);
                            echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
                        }
                    }else{
                        echo "Error occured. No data insert !";
                        echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
                    }
                }else{
                    echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
                }
            }else{
                echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
            }
        }else if($page == 11){
            if($role==$admin || $role==$coordinator){
                $forms = new enrolment();
                $forms->approved_student($page);
            }else{
                echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
            }
        }else if($page == 12){
            if($role==$admin || $role==$coordinator ){
                $forms = new enrolment();
                $forms->display_report($page);
               // get_driverLicence();
            }else{
                echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
            }
        }else if($page == 13){
            if($role==$admin || $role==$coordinator){
                // echo $enrolmentForm;
                $api = get_setting_api();
                $jotformAPI = new JotForm($api);
                //  $formid = get_enrolmentForm();
                $submissions = $jotformAPI->getFormSubmissions($enrolmentForm);
                $forms = new enrolment();

                if($submissions[0]['status'] == 'ACTIVE' AND $submissions > 0){
                    $result = $forms->push_form_fields($submissions);
                    $forms->display_newEnrolment($result,$page);
                }else{
                    echo "Form is Not Active";
                }
            }else{
                echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
            }
        }else if($page == 14){
            if($role==$admin || $role==$coordinator){
                $api = get_setting_api();
                $submissionId=$_GET['submission'];
                $jotformAPI = new JotForm($api);
                $submissions = $jotformAPI->getSubmission($submissionId);

                $forms = new enrolment();
                if($submissions['status'] == 'ACTIVE'){
                    $result = $forms->pushEnrolment($submissions);
                    //$forms->display_newEnrolment($result,$page);
                }else{
                    echo "Form is Not Active";
                }
            }else{
                echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
            }
        }/*else if($page == 14){
            $usersPage = new users();
            if($role==$admin || $role==$coordinator  || $role==$student){
                $usersPage->edit_user_profile($page);
            }
            else{
                echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
            }
        }else if($page == 15){
            $usersPage = new users();
            if($role==$admin || $role==$coordinator  || $role==$student){
                $usersPage->view_user_profile($page);
            }
            else{
                echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
            }
        }else if($page == 16){
            if($role==$admin || $role==$coordinator){
                $forms = new enrolment();
                $forms->display_studentDocumentVerification($page);
            }
        }else if($page == 17) {
           if($role==$admin || $role==$coordinator ){
               $forms = new enrolment();
               $forms->display_studentDocuments($page);
           }
           else{
               echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
           }
        }*/else if($page == 18) {
            if($role==$student){
                $form=$_GET['form'];
                $forms = new enrolment();
                $forms->thankyou($page, $form);
            }
            else{
                echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
            }
        }else if($page == 19) {
            if($role==$admin || $role==$coordinator || $role == $auditor){
                $users = new users();
                $users->current_users_progress_report($page);
            }
            else{
                echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
            }
        }else if($page == 20) {
            if($role==$admin || $role==$coordinator || $role==$auditor ){
                $users = new users();
                $users->user_profile($page);
            }
            else{
                echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
            }
        }else if($page == 21) {
            if($role==$admin || $role== $coordinator ){
                $setting = new setting();
                $setting->who_can_recieve_sms($page);
            }else{
                echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
            }
        }else if($page == 23){
            if($role==$admin){
                $link = $_GET['submissionid'];
                $forms = new forms();
                $forms->editForm($link,$page);
            }else{
                echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
            }
        }else if($page == 24){
            if($role==$admin || $role == $coordinator ){
                $setting = new setting();
                $setting->permissions($page);
            }else{
                echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
            }
        }else if($page == 25){
            if($role){
                $users = new users();
                $users->editProfile($page);
            }else{
                echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
            }
        }else if($page == 27){
            if($role==$admin || $role == $coordinator ){
                $users = new users();
                $users->hundred_percent_users_progress_report($page);
            }else{
                echo '<script type="text/javascript">window.location.href = "'.$url.'"</script>';
            }
        }else{
            $forms = new forms();
            $forms->student_form($role);
        }
        require('footer.php');
        ?>
    </div>
</div>

<footer class="footer">
        <span style="color: white;">Copyright &copy; 2021 - 2023 <a href="https://of.edu.au/" class="link-primary" target="_blank">Optimistic futures RTO41053</a>.
         All rights reserved.</span>
</footer>
</body>
</html>