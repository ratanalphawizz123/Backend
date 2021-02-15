<?php
class Home extends Controller
{

    public function __contruct()
    {
        parent::__construct();
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

    }
    //Company page
    public function index($Param = '')
    {
        if (!empty(get_session('useremail')))
        {
            $base_url = base_url() . 'Dashboard/welcome';
            redirect($base_url);
        }
        elseif (@$Param[2] != "back")
        {

            $company_code = get_cookies();
            if (!empty($company_code))
            {
                echo '<script>alert("Session Terminated");'; 
                echo '</script>';
                redirect(base_url() . "home/login");
            }
            else
            {
           
                $this->view("company_login");
            }
        }
        else
        {
            destroy_cookies('type');
            destroy_session('UserData');
            $this->view("company_login");
        }
    }
    //Company login page
    public function login()
    {
        $UserData = get_session('UserData');
        if (empty(get_session('useremail')))
        {
            if (!empty($UserData))
            {
                $this->view("login");
            }
            else
            {
                redirect("index");
            }
        }
        else
        {
            $base_url = base_url() . 'Dashboard/welcome';
            redirect($base_url);
        }

    }

    //Company forgetpassword page
    public function forgetpassword()
    {
        $this->view("forgetpassword");
    }
        //Company login function
    public function ForgetPasswordAction()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        
        //Get header token
        $allheader= getallheaders();
        $auth_token=!empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With']:'';
        $token_data= decode($auth_token);
        $jsondata=json_decode($token_data);
        $final_token=!empty($jsondata->Token) ? $jsondata->Token:'';
        
        $cid = get_session('company_ID');
        $email = get_session('useremail');
        
        
        $model = $this->model("Dynamic_model");
        $newpassword = $_POST['newpassword'];
        $confirmpassword = $_POST['confirmpassword'];

         $where = "Company_ID= ? AND User_email_address=?";
         $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*",$prepare = 'is',$cid,$email);
         
         $where1 = "Company_ID= ?";
         $rowretrive1 = $model->getCompanydata('Company', $where1, $data = "*",$prepare = 'i',$cid);
         
          $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token']:'';
         //Match header token
         if($Header_Token != $final_token){
         $errorMessage = GetSystemCode('317');
         $response = array("status" => false,"message" =>$errorMessage);
         echo json_encode($response);exit;
         }
                    
         
          if(isset($_POST['defaultpass']) && !empty($_POST['defaultpass'])){

           if($rowretrive1[0]['Minimum_length_of_password'] > 0){ 
             
             if (strlen($newpassword) <  $rowretrive1[0]['Minimum_length_of_password'] ) {        
              $errorMessage = GetSystemCode('306');
              $response = array("status" => false,"message" =>$errorMessage);
              echo json_encode($response);exit;
           
               }
           }
            
           if($rowretrive1[0]['Compulsory_numeric'] > 0){ 
             if(!preg_match("#[0-9]+#",$newpassword)) {
                   $errorMessage = GetSystemCode('305');
                   $response = array("status" => false,"message" =>$errorMessage);
                   echo json_encode($response);exit;
               }
           }
           if($rowretrive1[0]['Compulsory_upper_case'] > 0 ){ 
             if(!preg_match("#[A-Z]+#",$newpassword)) {
                   $errorMessage = GetSystemCode('306');
                   $response = array("status" => false,"message" =>$errorMessage);
                   echo json_encode($response);exit;
               }
           }
           if($rowretrive1[0]['Compulsory_special_character'] > 0){ 
             if(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $newpassword)) {
              $errorMessage = GetSystemCode('307');
              $response = array("status" => false,"message" =>$errorMessage);
              echo json_encode($response);exit;
        }
        }
        if ($newpassword === $confirmpassword) {  
        }
        else {
        $errorMessage = GetSystemCode('308');
        $response = array("status" => false,"message" =>$errorMessage);
         echo json_encode($response);exit;
        }  
        $hashpassword = new PasswordHash();
        $password=$hashpassword->HashPassword($newpassword);
        $Last5Passwords = !empty($rowretrive[0]['Last5Passwords']) ? $rowretrive[0]['Last5Passwords']:'';
        $check_last = !empty($rowretrive1[0]['Check_Last_5_Passwords']) ? $rowretrive1[0]['Check_Last_5_Passwords']:'';
        if($check_last >= 0){
        $Last5Passwords_array = explode(",", $Last5Passwords);
        if (in_array($password, $Last5Passwords_array)) {
        $result = count($Last5Passwords_array);
        //echo $result = !empty($Last5Passwords) ? count(explode(',', $Last5Passwords)) : 0;
        if($check_last > $result || $Last5Passwords == '0'){
        $addlast5password =  $password.','.$Last5Passwords;    
        }else{
        $addlast5password='0';
        $errorMessage = GetSystemCode('309');
         $response = array("status" => false,"message" =>$errorMessage);
         echo json_encode($response);exit;
        }
        } else {
        if($Last5Passwords =='0'){
        $addlast5password = $password;
        }else{
        $addlast5password = $Last5Passwords;
        }
        $addlast5password='0';
        date_default_timezone_set('Asia/Kolkata');
        $date = date('yy-m-d h:i:s');
         $wheredata = "Company_ID=? AND User_email_address=?";
         $update_data="Current_Password=? ,Last5_Passwords=?, First_Login=?, REC_lastUpdate_datetime=?, Last_Changed_Password_DateTime=?, REC_lastUpdate_by=?";
         $First_Login='0';
         $rec_datetime=$date;
         $last_password_datetime=$date;
         $update = $model->updateDefaultPassword('CompanyUser', $wheredata, $update_data,$prepare = 'issis',$email,$cid,$password,$addlast5password,$First_Login,$rec_datetime,$last_password_datetime,$cid);
        
       
        if($update){
        $response = array("status" => true,"message" =>"Change password successfully");
          echo json_encode($response);exit;
        }
        }
        }
        
        }
        elseif(isset($_POST['changepass']) && !empty($_POST['changepass'])){
       // print_r($rowretrive1);die;
        if($rowretrive1[0]['Minimum_length_of_password'] > 0){ 
        if (strlen($newpassword) <=  $rowretrive1[0]['Minimum_length_of_password']) {        
        $errorMessage = GetSystemCode('304');
        $response = array("status" => false,"message" =>$errorMessage);
        echo json_encode($response);exit;
        }
        }
        if($rowretrive1[0]['Compulsory_numeric'] > 0){ 
        if(!preg_match("#[0-9]+#",$newpassword)) {
        $errorMessage = GetSystemCode('305');
        $response = array("status" => false,"message" =>$errorMessage);
        echo json_encode($response);exit;
        }
        }
        if($rowretrive1[0]['Compulsory_upper_case'] > 0 ){ 
        if(!preg_match("#[A-Z]+#",$newpassword)) {
        $errorMessage = GetSystemCode('306');
        $response = array("status" => false,"message" =>$errorMessage);
              echo json_encode($response);exit;
        }
        }
        if($rowretrive1[0]['Compulsory_special_character'] > 0){ 
        if(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $newpassword)) {
        $errorMessage = GetSystemCode('307');
        $response = array("status" => false,"message" =>$errorMessage);
              echo json_encode($response);exit;
        }
        }
        if ($newpassword === $confirmpassword) {  
        }
        else {
        $errorMessage = GetSystemCode('308');
        $response = array("status" => false,"message" =>$errorMessage);
        echo json_encode($response);exit;
        } 
         $hashpassword = new PasswordHash();
        // echo $newpassword;die;
        $password= $hashpassword->HashPassword($newpassword);
        //print_r($rowretrive);die;
        date_default_timezone_set('Asia/Kolkata');
        $date = date('yy-m-d h:i:s');
        $Last5Passwords = !empty($rowretrive[0]['Last5Passwords']) ? $rowretrive[0]['Last5Passwords']:'';
        $check_last = !empty($rowretrive1[0]['Check_Last_5_Passwords']) ? $rowretrive1[0]['Check_Last_5_Passwords']:'';
        if($check_last > 0){
        $Last5Passwords_array = explode(",", $Last5Passwords);
         $result = count($Last5Passwords_array);
        }
        //$sql = "UPDATE CompanyUser SET Current_Password='".$password."',Last5_Passwords='".$last5password."',First_Login='0',  REC_lastUpdate_datetime='".$date."',Last_Changed_Password_DateTime='".$date."',REC_lastUpdate_by='".$_SESSION['UserData']['Company_ID']."'  WHERE Company_ID='".$_SESSION['UserData']['Company_ID']."'"; 
       
       
         //$wheredata = "Company_ID=?";
         $wheredata = "Company_ID=? AND User_email_address=?";
         $update_data="Current_Password=? ,Last5_Passwords=?, First_Login=?, REC_lastUpdate_datetime=?, Last_Changed_Password_DateTime=?, REC_lastUpdate_by=?";
         $First_Login='0';
         $rec_datetime=$date;
         $last_password_datetime=$date;
         $update = $model->updateDataPrepare('CompanyUser', $wheredata, $update_data,$prepare = 'issis',$email,$cid,$password,$Last5Passwords,$First_Login,$rec_datetime,$last_password_datetime,$cid);
        
        
        if($update){
        $response = array("status" => true,"message" =>"Change password successfully");
          echo json_encode($response);exit;
        }
        
        }
        
    }

    //Welcome page
    public function welcome()
    {
        $model = $this->model("Dynamic_model");
        $company_ID = get_session('company_ID');
        $data = $model->getdatafromtable('Company', array(
            "Company_ID" => $company_ID
        ) , $data = "Company_Language,Automatic_SignOnActivity_Lockout,Force_change_password_days", $limit = "", $offset = "", $orderby = "", $ordertype = "ASC", $prepare = 'ss');
        //$this->view("includes/sidebar");
        $this->view("includes/header");
        $this->view("welcome", $data);
        $this->view("includes/footer");
    }

}

?>
