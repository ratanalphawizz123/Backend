<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Load the Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class Login extends REST_Controller {

    public function __construct(){
        parent::__construct();
        // Load the user model
        $this->load->library('session');
     $this->load->model('Api/LoginApiModel');


    }
    public function Companycode_post(){
    	 $Company_ID = $this->post('Company_ID');
    	 //print_r( $Company_ID);die();
   
        if((!empty($Company_ID)))
        {
            $user = $this->LoginApiModel->getcompany($Company_ID);
            //print_r($user);die();
             // unset($user['data']->username);
            if(!empty($user))
            {
                     $this->response([
                    'status' => TRUE,
                    'message' =>  "Valid Company ID",
                    'data' => $user
                ], REST_Controller::HTTP_OK);

            }

            else
            {
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
                $this->response([
                    'status' => FALSE,
                    'message' => "Company id is not valid",
                    
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
        else
        {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => "Provide email and password.",
               
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

public function login_post(){
       $Company_ID = $this->post('Company_ID');
       $User_Status = $this->post('User_Status');
       $User_email_address = $this->post('User_email_address');
       $Current_Password = md5($this->post('Current_Password'));
          
        $user = $this->LoginApiModel->login($User_email_address);
        //print_r($user);die();
        //print_r($user[0]->No_Of_Passsword_Retries);die();
        $No_Of_Passsword_Retries  =$user->No_Of_Passsword_Retries;
      // echo  $No_Of_Passsword_Retries;die();

      $sql = $this->LoginApiModel->logincomp($Company_ID);
     // print_r($sql);die();
       $No_of_retries_allowed  =$sql->No_of_retries_allowed;
       //echo  $No_of_retries_allowed ; die();
        // $user = $this->LoginApiModel->checkpass($User_email_address,$Current_Password);
        //   print_r($user);die();
        if($No_Of_Passsword_Retries >= $No_of_retries_allowed )
        {
           $user = $this->LoginApiModel->checkpass($User_email_address,$Current_Password,$Company_ID);
           //print_r($user);die();
          $User_Status=!empty($user->User_Status) ? $user->User_Status:'';

           if(!empty($user)){
           	 $SignonDate = date("Y-m-d H:i:s");
           	 //print_r($SignonDate);die();
           	  $date = date('yy-m-d h:i:s'); 
           	  //print_r($date);die();
             $userData= array('No_Of_Passsword_Retries'=>'0','REC_lastUpdate_datetime'=>$date,'REC_lastUpdate_by'=>'system');
             $userupdate=$this->LoginApiModel->checkupdate($User_email_address,$date);
            //print_r($userupdate);die();
              $this->response([
            'status' => TRUE,
            'message' =>'userlogin  successfully1',
            'data'=>  $sql
          ], REST_Controller::HTTP_OK);
           }

           else{
           	 $Count = ($No_Of_Passsword_Retries)+(1);
           	  $status=  $User_Status;
           	     if($status == 1){
                  $this->response([
            'status' => TRUE,
            'message' =>'details added successfully',
            //'data'=> $userData
          ], REST_Controller::HTTP_OK);
            }
            else{
              $this->response([
            'status' => FALSE,
            'message' =>'Wrong Password',
            //'data'=> $userData
          ], REST_Controller::HTTP_OK);
              }
            $date = date('yy-m-d h:i:s');
            $userupdate=$this->LoginApiModel->checkpassretives($User_email_address, $Count);
           	  
           }
        }
   else{
   	$date = date('yy-m-d h:i:s');
   $userupdate=$this->LoginApiModel->checkuserstatus2($date,$User_email_address);
      if($status == 1){
                 $this->response([
            'status' => TRUE,
            'message' =>'details added successfully',
            //'data'=> $userData
          ], REST_Controller::HTTP_OK);
   }else{
                    $this->response([
            'status' => FALSE,
            'message' =>'details added successfully',
            //'data'=> $userData
          ], REST_Controller::HTTP_OK);
   }

   }
 }
 public function first_login_post()
 {
  $email = $this->input->post('User_email_address');
  $Company_ID = $this->post('Company_ID');
  $user_first_login = $this->LoginApiModel->first_login($email,$Company_ID);
  $First_Login = $user_first_login->First_Login;
  //print_r($First_Login);die();
  //print_r($user_first_login);die();
    if($First_Login==1)
            {
              $this->response([
                    'status' => FALSE,
                    'message' => 'user allredy login',
             ], REST_Controller::HTTP_OK);

            }
          else
            {
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
                $this->response([
                    'status' => TRUE,
                    'message' => 'user first time login',
                    'data'=> $user_first_login 
                    
                ], REST_Controller::HTTP_BAD_REQUEST);
     }   
 }
 public function SignOnActivity_post(){
  $Company_ID = $this->post('Company_ID');
   $email = $this->input->post('User_email_address');
  $user_first_login = $this->LoginApiModel->SignOnActivity($Company_ID);
  //print_r($user_first_login);die();
   $date = date('yy-m-d h:i:s');
   $Company_Language =  $user_first_login->Company_Language;
  // print_r(  $Company_Language);die();
   $days =$user_first_login->Force_change_password_days;
   //print_r( $days);
  $logoutdays =$user_first_login->Automatic_SignOnActivity_Lockout;
  $NewDate = date('yy-m-d h', strtotime("-".$days." days"));
  //print_r($NewDate);die();
  $user_first_login = $this->LoginApiModel->first_login($email,$Company_ID);
  //print_r($user_first_login);die();
   $lastdate = $user_first_login->Last_Changed_Password_DateTime;
   $NewDate1 = date('yy-m-d h', strtotime("-".$logoutdays." days"));
  //print_r( $lastdate);die();
   $Last_SignOn_DateTime = $user_first_login->Last_SignOn_DateTime;
    //print_r($Last_SignOn_DateTime);die();
   if($days > 0 ){ 
       if($lastdate<$NewDate){
        $this->response([
                    'status' => TRUE,
                    'message' => 'Redirect on forgot',
             ], REST_Controller::HTTP_OK);
       }else{
      $this->response([
                    'status' => FALSE,
                    'message' => 'No record found',
             ], REST_Controller::HTTP_OK);
   }

   }
   else{
      $this->response([
                    'status' => FALSE,
                    'message' => 'No record found',
             ], REST_Controller::HTTP_OK);
   }

 }
  public function SignOutProfile_post(){
  $Company_ID = $this->post('Company_ID');
   $email = $this->input->post('User_email_address');
  $user_first_login = $this->LoginApiModel->SignOnActivity($Company_ID);
  //print_r($user_first_login);die();
   $date = date('yy-m-d h:i:s');
   $Company_Language =  $user_first_login->Company_Language;
  // print_r(  $Company_Language);die();
   $days =$user_first_login->Force_change_password_days;
  $logoutdays =$user_first_login->Automatic_SignOnActivity_Lockout;
  $NewDate = date('yy-m-d h', strtotime("-".$days." days"));
  //print_r($NewDate);die();
  $user_first_login = $this->LoginApiModel->first_login($email,$Company_ID);
  //print_r($user_first_login);die();
   $lastdate = $user_first_login->Last_Changed_Password_DateTime;
   $NewDate1 = date('yy-m-d h', strtotime("-".$logoutdays." days"));
  //print_r( $lastdate);die();
   $Last_SignOn_DateTime = $user_first_login->Last_SignOn_DateTime;
    //print_r($Last_SignOn_DateTime);die();

   if($logoutdays > 0 ){ 
    if($Last_SignOn_DateTime < $NewDate1){
        $date = date('yy-m-d h:i:s');
       $user_first_update = $this->LoginApiModel->SignOnActivityupdate($date,$Company_ID,$email);
      // print_r( $user_first_update);die();
       if (!empty($user_first_update)) {
        // print_r($user_first_update);die();
         $this->response([
                    'status' => TRUE,
                    'message' => 'redirect on login',
             ], REST_Controller::HTTP_OK);
       }
       else{
         $this->response([
                    'status' => FALSE,
                    'message' => 'redirect on forgot',
             ], REST_Controller::HTTP_OK);
       }
      

    }else{
      $this->response([
                    'status' => FALSE,
                    'message' => 'No record found',
             ], REST_Controller::HTTP_OK);
   }
   }else{
      $this->response([
                    'status' => FALSE,
                    'message' => 'No record found',
             ], REST_Controller::HTTP_OK);
   }
 }




 public function ForgetPassword_post(){       
            $email = $this->input->post('User_email_address');
            $password = rand(10000,100000000);
            $admin_info = $this->LoginApiModel->checkEmailAvailable($email);
            if($admin_info['status']){
                $this->load->config('email');
                $this->load->library('email');
                $from = $this->config->item('smtp_user');
                $to = $email;

                $subject   =  'Reset Password';
                $message   =  '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>';
                $message  .= '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>';
                $message  .=  '<div class="container">';
                $message  .=  '<div class="container">';
                $message  .=  '<div class="jumbotron text-center">';
                $message  .=  '<h1>Hii, '.$admin_info['User_first_name'].'</h1>';
                $message  .=  '<p class="content">You Recently Requested to reset password for your doctor admin account </br> we reset your password and your new password for username '.$admin_info['User_first_name'].' is '.$password;
                $message .= '</div>';
                $message .= '</div>';
                
                // $message = 'For your Username '.$admin_info['data']['username'].' Your New Password is '.$password;        
                $this->email->set_header('Content-type', 'text/html');
                $this->email->set_newline("\r\n");
                $this->email->from($from);
                $this->email->to($to);
                $this->email->subject($subject);
                $this->email->message($message);
        
                if ($this->email->send()) 
                { 
                    $this->LoginApiModel->changePassword($password,$email);
                    $this->response([
                    'status' => TRUE,
                    'message' => 'Your password send in email.'
                ],  REST_Controller::HTTP_OK); 
                } 
                else 
                {
                    
                     $this->response([
                    'status' => FALSE,
                    'message' => 'unable to send Email '
                ],  REST_Controller::HTTP_BAD_REQUEST); 
                }
              }   
         
                
    }
         public function Logout_post(){  
        $user_id = $this->post('User_ID');
        if($user_id){
            $this->response([
                'status' => TRUE,
                'message' => "logout sucessfully !!",
            ], REST_Controller::HTTP_OK);
        }else{
           $this->response([
                'status' => FALSE,
                'message' => "User not found.",               
            ], REST_Controller::HTTP_BAD_REQUEST); 
        }
    }  

}