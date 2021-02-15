<?php
class Dashboard extends Controller{
    
     public function __contruct(){
        parent::__construct();
    
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }
    public function index(){
        if (!empty(get_session('useremail')))
        {
            $base_url = base_url().'Dashboard/welcome';
            redirect($base_url);
        }else{
            $this->Logout();
        }
    }
    //Welcome page
	public function welcome(){
 	$model=$this->model("Dynamic_model");
    $company_ID = get_session('company_ID');
    $useremail = get_session('useremail');
    $userlogin = get_session('company_ID');
    $companydata= $model->getdatafromtable('Company',array("Company_ID"=>$company_ID), $data = "Company_Language,Automatic_SignOnActivity_Lockout,Force_change_password_days", $limit = "", $offset= "", $orderby = "", $ordertype = "ASC",$prepare='ss');
    $companyuserdata= $model->getdatafromtable('CompanyUser',array("Company_ID"=>$company_ID,"User_email_address"=>$useremail), $data = "First_Login,Last_SignOn_DateTime,Last_Changed_Password_DateTime", $limit = "", $offset= "", $orderby = "", $ordertype = "ASC",$prepare='ss');
    $data=array("companydata"=>$companydata,"companyuserdata"=>$companyuserdata);
       date_default_timezone_set('Asia/Kolkata');
        $date = date('yy-m-d h:i:s');
        $days = $data['companydata'][0]['Force_change_password_days'];
        $NewDate = date('yy-m-d h:i:s', strtotime("-".$days." days"));
        $logoutdays = $companydata[0]['Automatic_SignOnActivity_Lockout'];
        $NewDate1 = date('yy-m-d h:i:s', strtotime("-".$logoutdays." days"));
        $Last_SignOn_DateTime = $data['companyuserdata'][0]['Last_SignOn_DateTime'];
        $First_Login = $data['companyuserdata'][0]['First_Login'];
        if($First_Login==1){
         $base_url=base_url().'Home/forgetpassword';
	     redirect($base_url);
        }
       if($days>0){ 
       if($lastdate < $NewDate){
        
         $base_url=base_url().'Home/forgetpassword';
	     redirect($base_url);
         }
         
        }
        if($logoutdays > 0 ){ 
          if($Last_SignOn_DateTime < $NewDate1){
             $date = date('yy-m-d h:i:s');
             $update = $model->updateRowWhere('CompanyUser',array("User_email_address"=>$useremail), $data = array("User_Status"=>2,"REC_lastUpdate_datetime"=>$date,"REC_lastUpdate_by"=>$userlogin));
             $code_data= $model->getdatafromtable('SystemCode',array("System_code"=>303,"Language"=>"EN"));
             $errorMessage= !empty($code_data[0]['System_message']) ? $code_data[0]['System_message'] :'';
              if($update){
                  $base_url=base_url().'Home/login';
	              redirect($base_url);
                 }
              }
         else{
             $update1 = $model->updateRowWhere('CompanyUser',array("User_email_address"=>$useremail), $data = array("REC_lastUpdate_datetime"=>$date,"Last_SignOn_DateTime"=>$date,"REC_lastUpdate_by"=>$userlogin));
             }
        }
        
       $this->view("includes/sidebar");
       $this->view("includes/header");
	   $this->view("welcome",$data);
	   $this->view("includes/footer");
	}
	 //Company List
	public function Company(){
 	   //$model=$this->model("Dynamic_model");
 	   $data=array();
       $this->view("includes/sidebar");
       $this->view("includes/header");
	   $this->view("company",$data);
	   $this->view("includes/footer");
	}
	 //Add Company
	public function add_company(){
 	   //$model=$this->model("Dynamic_model");
 	   $data=array();
       $this->view("includes/sidebar");
       $this->view("includes/header");
	   $this->view("add_company",$data);
	   $this->view("includes/footer");
	}
	 //Edit Company
	public function edit_company(){
 	   //$model=$this->model("Dynamic_model");
 	   $data=array();
       $this->view("includes/sidebar");
       $this->view("includes/header");
	   $this->view("edit_company",$data);
	   $this->view("includes/footer");
	}
    //Company User
	public function Companyuser(){
 	   //$model=$this->model("Dynamic_model");
 	   $data=array();
       $this->view("includes/sidebar");
       $this->view("includes/header");
	   $this->view("companyuser",$data);
	   $this->view("includes/footer");
	}
	//Add Company User
	public function add_companyuser(){
 	   //$model=$this->model("Dynamic_model");
 	   $data=array();
       $this->view("includes/sidebar");
       $this->view("includes/header");
	   $this->view("add_companyuser",$data);
	   $this->view("includes/footer");
	}
	 //Edit Company User
	public function edit_companyuser(){
 	   //$model=$this->model("Dynamic_model");
 	   $data=array();
       $this->view("includes/sidebar");
       $this->view("includes/header");
	   $this->view("edit_companyuser",$data);
	   $this->view("includes/footer");
	}
	//Country
	public function Country(){
 	   //$model=$this->model("Dynamic_model");
 	   $data=array();
       $this->view("includes/sidebar");
       $this->view("includes/header");
	   $this->view("country",$data);
	   $this->view("includes/footer");
	}
	//add country
	public function add_country(){
 	   //$model=$this->model("Dynamic_model");
 	   $data=array();
       $this->view("includes/sidebar");
       $this->view("includes/header");
	   $this->view("add_country",$data);
	   $this->view("includes/footer");
	}
    //Logout
 	public function Logout(){
        destroy_session();
        $base_url=base_url().'Home';
	    redirect($base_url);
	}


}


?>