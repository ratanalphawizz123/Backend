<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Firebase
{
        protected $ci;

        public function __construct()
        {
                $this->ci =& get_instance();
                $this->ci->load->database();
        }

        public function send_notification($message,$token)
        {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $api_key = 'AAAAe5l-I64:APA91bEquuscgODDJwrx7qQZQ4pWeAmXuy-wesbLR1KB404r_N9pUeBIthAjii__svTAGLZm0foCibM8OZNRZcmeT-Uz9YEzZccmy9TOKvQbJinAeDyqKF1WmnxqbXbmrvgQw2jUUsSm';

        $fields = array (
        'registration_ids' => array (
        $token
        ),
        'data' => array (
        "title" => 'DoctorApplication',
        "message" => $message
        )
        );


        $field_object = (object)$fields;
        // print_r(json_encode($field_object));exit;
        //header includes Content type and api key
        $headers = array(
        'Content-Type:application/json',
        'Authorization:key='.$api_key
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($field_object));
        $result = curl_exec($ch);

        // print_r($result);exit;

        if ($result === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        }



        public function getFirebaseToken($tblname,$id)
        {
          $this->ci->db->select('Firebase_token');
          $this->ci->db->from($tblname);
          $this->ci->db->where('id',$id);
          $data = $this->ci->db->get()->row();
          return empty($data->Firebase_token)?false:$data->Firebase_token;
        }


        public function insertMessage($data)
        {
           $this->ci->db->insert('Notification',$data);
        }


        public function getAppointmentDetailByTokenNumber($token_number)
        {
            $this->ci->db->select('*');
            $this->ci->db->from('Appointment');
            $this->ci->db->where('appointment_id',$token_number);
            $row = $this->ci->db->get()->row();
            return $row;
        }

}


