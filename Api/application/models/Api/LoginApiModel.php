<?php

	class LoginApiModel extends CI_Model {
		public function __construct(){
          $this->response=array();	
		}


    public function getcompany($Company_ID){
     // print_r($Company_ID);die();
      $this->db->select('Company_ID,Company_Logo');
      $this->db->from('Company');
      $this->db->where('Company_ID ',$Company_ID);
     $data = $this->db->get()->result();
     if($data){
        return $data;
      }else{
        return array( 
        );
      }


    }
public function login($User_email_address)
{
   $this->db->select('*');
    $this->db->from('CompanyUser');
    $this->db->where('User_email_address',$User_email_address);
    $this->db->where('REC_status ','1');
    $this->db->where('User_Status','1');
    $data = $this->db->get()->row();
   if($data){
        return $data;
      }else{
        return array( 
        );
      }

}
public function logincomp($Company_ID)
{
   $this->db->select('*');
    $this->db->from('Company');
    $this->db->where('Company_ID',$Company_ID);
    $this->db->where('REC_status ','1');
     $data = $this->db->get()->row();
   if($data){
        return $data;
      }else{
        return array( 
        );
      }

}
public function checkpass($User_email_address,$Current_Password,$Company_ID)
{
    $this->db->select("*");
    $this->db->from('CompanyUser');
    $this->db->where('User_email_address',$User_email_address);
    $this->db->where('Current_Password',$Current_Password);
    $this->db->where('REC_status','1');
    $this->db->where('User_Status','1');
   $this->db->where('Company_ID',$Company_ID);
   $data = $this->db->get()->row();
  // print_r($data);die();
   if($data){
        return $data;
      }else{
        return array( 
        );
      }
   
}
public function checkupdate($User_email_address,$date){
  $sql = "UPDATE CompanyUser SET No_Of_Passsword_Retries='0',REC_lastUpdate_datetime='".$date."',REC_lastUpdate_by='system' Where User_email_address='".$User_email_address."'";
  //print_r($sql);
  return  $sql;
}
public function checkpassretives($Count,$User_email_address)
{
   $sql = "UPDATE CompanyUser SET No_Of_Passsword_Retries='".$Count."',REC_lastUpdate_by='system' WHERE User_email_address='".$User_email_address."'"; 
   return  $sql; 
}
public function checkuserstatus2($date,$User_email_address)
{
   $sql = "UPDATE CompanyUser SET User_Status='2',REC_lastUpdate_datetime='".$date."',REC_lastUpdate_by='system' Where User_email_address='".$User_email_address."'";   
   return  $sql; 
}


 public function checkEmailAvailable($email){
        $response = array();
        $this->db->select('*');
        $this->db->from('CompanyUser');
        $this->db->where('User_email_address',$email);
        $data = $this->db->get()->row();
        
        $response['User_first_name'] = $data->User_first_name;
        // $response['full_name'] = $data->full_name;
        if($data){
            $response['status']=true;
        }
        else {
            $response['status']=false;
        }

        return $response;
    }

 public function changePassword($password,$email){
        $update_data = array('Password'=>md5($password));
        $this->db->where('User_email_address',$email);
        $this->db->update('CompanyUser',$update_data);
        // echo $this->db->last_query();exit;
        return true;
    }
public function first_login($email,$Company_ID)
{
  $this->db->select('First_Login,Last_SignOn_DateTime,Last_Changed_Password_DateTime');
   $this->db->from('CompanyUser');
   $this->db->where('Company_ID',$Company_ID);
   $this->db->where('User_email_address',$email);
   $data = $this->db->get()->row();
  // print_r($data);die();
   if($data){
        return $data;
      }else{
        return array( 
        );
      }
}

public function SignOnActivity($Company_ID){
  $this->db->select('Company_Language,Automatic_SignOnActivity_Lockout,Force_change_password_days');
  $this->db->from('Company');
  $this->db->where('Company_ID',$Company_ID);
    $data = $this->db->get()->row();
  // print_r($data);die();
   if($data){
        return $data;
      }else{
        return array( 
        );
      }


}
public function SignOnActivityupdate($date,$Company_ID,$email )
{
   $sql ="UPDATE CompanyUser SET User_Status='2',REC_lastUpdate_datetime='".$date."',REC_lastUpdate_by='".$Company_ID."' Where User_email_address='".$email."'";  
   //print_r($sql);die();   
   return  $sql; 
}


	}