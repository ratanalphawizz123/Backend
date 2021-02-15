<?php
class Ajax extends Controller
{
    public function __contruct()
    {
        parent::__construct();

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers,Authorization,Role,X-API-KEY,Origin,X-Requested-With");
        header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
    }
    //Company login function
    public function Company_login()
    {
        $companycode = $_POST['companycode'];
        $REC_status = 1;
        $model = $this->model("Dynamic_model");
        $where = "Company_ID= ? AND REC_status=?";
        $result = $model->getdatafromtableprepare('Company', $where, $data = "*", $limit = "", $offset = "", $orderby = "", $ordertype = "ASC", $prepare = 'ii', $companycode, $REC_status);

        if (empty($result))
        {
            $code_data = $model->getdatafromtable('SystemCode', array(
                "System_code" => 302,
                "Language" => "EN"
            ));
            $errorMessage = !empty($code_data[0]['System_message']) ? $code_data[0]['System_message'] : '';
            $response = array(
                "status" => false,
                "message" => $errorMessage,
                "data" => ''
            );
        }
        else
        {
            $row = $result;
            set_session('UserData', $row);
            $response = array(
                "status" => true,
                "message" => 'success',
                "data" => $row
            );
        }
        echo json_encode($response);
    }
    //Default Company login function
    public function Defalut_Company_login()
    {
        $model = $this->model("Dynamic_model");

        $companycode = $_POST['companycode'];
        if (!empty($companycode))
        {
            $REC_status = 1;

            $result = $model->getdatafromtable('Company', array(
                "Company_ID" => $companycode,
                "REC_status" => $REC_status
            ) , $data = "*", $limit = "", $offset = "", $orderby = "", $ordertype = "ASC", $prepare = 'ss');

            if (empty($result))
            {

                $code_data = $model->getdatafromtable('SystemCode', array(
                    "System_code" => 302,
                    "Language" => "EN"
                ));
                $errorMessage = !empty($code_data[0]['System_message']) ? $code_data[0]['System_message'] : '';
                $response = array(
                    "status" => false,
                    "message" => $errorMessage,
                    "data" => ''
                );
            }
            else
            {

                $row = $result;
                set_session('UserData', $row);
                setcookie("type", $companycode, time() + (86400 * 30) , "/");

                $response = array(
                    "status" => true,
                    "message" => 'success',
                    "data" => $row
                );
            }

        }
        else
        {
            $code_data = $model->getdatafromtable('SystemCode', array(
                "System_code" => 317,
                "Language" => "EN"
            ));
            $errorMessage = !empty($code_data[0]['System_message']) ? 'Comapany ' . $code_data[0]['System_message'] : '';
            $response = array(
                "status" => false,
                "message" => $errorMessage,
                "data" => ''
            );
        }

        echo json_encode($response);
    }
    //Default Company login Action
    public function Company_Login_Action()
    {
        $status = '0';
        $model = $this->model("Dynamic_model");
        $useremail = $_POST['useremail'];
        $password = $_POST['password'];
        $userlogin = $_POST['userlogin'];
        $REC_status = 1;
        $Retriesresult = $model->getdatafromtable('CompanyUser', array(
            "User_email_address" => $useremail,
            "REC_status" => $REC_status,
            "User_Status" => '1'
        ) , $data = "No_Of_Passsword_Retries", $limit = "", $offset = "", $orderby = "", $ordertype = "ASC", $prepare = 'ss');
        $No_Of_Passsword_Retries = $Retriesresult[0]['No_Of_Passsword_Retries'];
        $retriesallowedresult = $model->getdatafromtable('Company', array(
            "Company_ID" => $userlogin,
            "REC_status" => $REC_status
        ) , $data = "No_of_retries_allowed", $limit = "", $offset = "", $orderby = "", $ordertype = "ASC", $prepare = 'ss');
        $No_of_retries_allowed = $retriesallowedresult[0]['No_of_retries_allowed'];
        if ($No_of_retries_allowed == '0')
        {
            $verifyallowed = true;
        }
        elseif ($No_of_retries_allowed > $No_Of_Passsword_Retries)
        {
            $verifyallowed = true;
        }
        else
        {
            $verifyallowed = false;
        }
        if ($verifyallowed)
        {
            $Where = "User_email_address='$useremail' AND REC_status='$REC_status'";
            $userstatusresult = $model->getdatafromtableorcondtion('CompanyUser', $Where, $data = "User_Status", $limit = "", $offset = "", $orderby = "", $ordertype = "ASC", $prepare = 'ss');
            $User_Status = $userstatusresult[0]['User_Status'];
            $userdetails = $model->getdatafromtable('CompanyUser', array(
                "User_email_address" => $useremail,
                "REC_status" => $REC_status,
                "User_Status" => '1',
                "Company_ID" => $userlogin
            ) , $data = "*,count(*) as total_count", $limit = "", $offset = "", $orderby = "", $ordertype = "ASC", $prepare = 'ss');
            $User_ID = $userdetails[0]['User_ID'];
            $count = $userdetails[0]['total_count'];
            $getpass = $userdetails[0]['Current_Password'];
            $hashpassword = new PasswordHash();
            if ($hashpassword->CheckPassword($password, $getpass) && $count == 1)
            {
                $SignonDate = date("Y-m-d H:i:s");
                set_session('useremail', $useremail);
                set_session('User_ID', $User_ID);
                set_session('company_ID', $userlogin);
                set_session('loggedin_time', time());
                $date = date('yy-m-d h:i:s');
                //Genrate token
                $token = md5(rand());
                $auth_token = encode(json_encode(array(
                    "User_ID" => $User_ID,
                    "Token" => $token
                )));
                set_session('authorization', $auth_token);

                $update = $model->updateRowWhere('CompanyUser', array(
                    "User_email_address" => $useremail
                ) , $data = array(
                    "No_Of_Passsword_Retries" => 0,
                    "REC_lastUpdate_datetime" => $date,
                    "REC_lastUpdate_by" => $userlogin,
                    "Header_Token" => $token
                ));

                if ($update)
                {
                    $response = array(
                        "status" => true,
                        "message" => 'success',
                        "data" => ''
                    );
                }

            }
            else
            {

                $Count = ($No_Of_Passsword_Retries) + (1);
                $status = $User_Status;
                if ($status == 1)
                {
                    $code_data = $model->getdatafromtable('SystemCode', array(
                        "System_code" => 301,
                        "Language" => "EN"
                    ));
                    $errorMessage = !empty($code_data[0]['System_message']) ? $code_data[0]['System_message'] : '';
                    $response = array(
                        "status" => false,
                        "message" => $errorMessage,
                        "data" => ''
                    );
                }
                else
                {
                    $code_data = $model->getdatafromtable('SystemCode', array(
                        "System_code" => 303,
                        "Language" => "EN"
                    ));
                    $errorMessage = !empty($code_data[0]['System_message']) ? $code_data[0]['System_message'] : '';
                    $response = array(
                        "status" => false,
                        "message" => $errorMessage,
                        "data" => ''
                    );
                }
                $date = date('yy-m-d h:i:s');
                $update1 = $model->updateRowWhere('CompanyUser', array(
                    "User_email_address" => $useremail
                ) , $data = array(
                    "No_Of_Passsword_Retries" => $Count,
                    "REC_lastUpdate_by" => $userlogin
                ));
                if ($update1)
                {
                    $response = array(
                        "status" => false,
                        "message" => $errorMessage,
                        "data" => ''
                    );
                }

            }
        }
        else
        {
            if ($No_of_retries_allowed == '0' && $No_Of_Passsword_Retries == '0')
            {
                $code_data = $model->getdatafromtable('SystemCode', array(
                    "System_code" => 301,
                    "Language" => "EN"
                ));
                $errorMessage = !empty($code_data[0]['System_message']) ? $code_data[0]['System_message'] : '';
                $response = array(
                    "status" => false,
                    "message" => $errorMessage,
                    "data" => ''
                );
            }
            else
            {
                $date = date('yy-m-d h:i:s');
                $update2 = $model->updateRowWhere('CompanyUser', array(
                    "User_email_address" => $useremail
                ) , $data = array(
                    "User_Status" => '2',
                    "REC_lastUpdate_datetime" => $date,
                    "REC_lastUpdate_by" => $userlogin
                ));
                $update = $model->updateRowWhere('CompanyUser', array(
                    "User_email_address" => $useremail
                ) , $data = array(
                    "No_Of_Passsword_Retries" => 0,
                    "REC_lastUpdate_datetime" => $date,
                    "REC_lastUpdate_by" => $userlogin
                ));
                if ($status == 1)
                {
                    $code_data = $model->getdatafromtable('SystemCode', array(
                        "System_code" => 301,
                        "Language" => "EN"
                    ));
                    $errorMessage = !empty($code_data[0]['System_message']) ? $code_data[0]['System_message'] : '';
                    $response = array(
                        "status" => false,
                        "message" => $errorMessage,
                        "data" => ''
                    );
                }
                else
                {
                    $code_data = $model->getdatafromtable('SystemCode', array(
                        "System_code" => 303,
                        "Language" => "EN"
                    ));
                    $errorMessage = !empty($code_data[0]['System_message']) ? $code_data[0]['System_message'] : '';
                    $response = array(
                        "status" => false,
                        "message" => $errorMessage,
                        "data" => ''
                    );
                }
            }
        }
        echo json_encode($response);
    }

    public function listgenerator()
    {

        $tablename = $_POST['tablename'];
        $parameter = $_POST['parameter'];
        $Language = "EN";
        $REC_status = 1;
        $menumodel = $this->model("Menu_model");
        $model = $this->model("Dynamic_model");
        $cid = get_session('company_ID');
        $email = get_session('useremail');

        //Get header token
        $allheader = getallheaders();
        $auth_token = !empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With'] : '';
        $token_data = decode($auth_token);
        $jsondata = json_decode($token_data);
        $final_token = !empty($jsondata->Token) ? $jsondata->Token : '';

        if (empty($tablename && $parameter))
        {
            // $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => "No Record Found"
            );
            echo json_encode($response);
            exit;
        }

        $where = "Company_ID= ? AND User_email_address=?";
        $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*", $prepare = 'is', $cid, $email);
        $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token'] : '';
        //Match header token
        if ($Header_Token != $final_token)
        {
            $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );
            echo json_encode($response);
            exit;
        }

        $where = "ListConfiguration.List_Name= ? AND ListConfigurationLanguage.Language=? AND LogicalDefinitionTableLanguage.Language=? AND ListConfiguration.REC_status=? AND ListConfigurationLanguage.REC_status=? AND LogicalTable.REC_status=? AND LogicalDefinitionTable.REC_status=? AND LogicalDefinitionTableLanguage.REC_status=?";
        $datavale = 'ListConfigurationLanguage.Title,ListConfiguration.List_Name,LogicalTable.Logical_table_php_name as pagename,ListConfiguration.No_Show_Field, LogicalTable.Logical_Table_Name,LogicalTable.Logical_Table_Description,ListConfiguration.Shown_Field';
        $result = $menumodel->getlistgenerator('ListConfiguration', $where, $data = $datavale, $limit = "", $offset = "", $orderby = "", $ordertype = "ASC", $prepare = 'sssiiiii', $parameter, $Language, $REC_status);

        if (empty($result))
        {
            $code_data = $model->getdatafromtable('SystemCode', array(
                "System_code" => 302,
                "Language" => "EN"
            ));
            $errorMessage = !empty($code_data[0]['System_message']) ? $code_data[0]['System_message'] : '';
            $response = array(
                "status" => false,
                "message" => $errorMessage,
                "data" => ''
            );
        }
        else
        {
            $row = $result;
            $row[0]['Title'];
            $row[0]['pagename'];
            $filed = explode(",", $row[0]["Shown_Field"]);
            $table = '';
            $table = '<table class="table table-striped table-bordered"  id="example" width="100%" cellspacing="0">
                        <thead>
                            <tr>';
            $i = 1;
            foreach ($filed as $row1)
            {
                $rowfiled = $row[0]['No_Show_Field'];
                $Language = "EN";
                $REC_status = '1';
                $TableName = $tablename; // We need to assign which table do this program will generate from here. There is no relationship between list configuration and logical table in terms of content
                $where = "LogicalTable.Logical_Table_Name= ? AND LogicalDefinitionTable.Field_no= ? AND LogicalDefinitionTableLanguage.Language= ? AND LogicalDefinitionTable.REC_status= ? AND LogicalDefinitionTableLanguage.REC_status= ?";
                $getresult = $menumodel->getlistgeneratorheading("LogicalDefinitionTable", $where, $data = "*", $limit = "", $offset = "", $orderby = "", $ordertype = "ASC", $prepare = 'sisii', $TableName, $Language, $REC_status, $row1);
                $table .= '<th>' . $getresult[0]["Field_name"] . ' </th>';
                $term_arr[] = $getresult[0]['Field_name'];
                if ($i == $rowfiled)
                {
                    break;
                }
                $i++;
            }

            $table .= '<th>Action</th>
                            </tr>
                            </thead>
                            <tbody>';

            //$filed = implode(",",$term_arr);
            $filed1 = explode(",", $row[0]['No_Show_Field']);
            $array = [];
            $array1 = [];
            $where = "`TABLE_SCHEMA`= ? AND `TABLE_NAME`= ?";
            $tablescema = "alphafk6_BratPhase2";
            $TableName = $getresult[0]['Logical_Table_Name'];
            $gettablecolnameresult = $menumodel->gettablecolnameresult("`INFORMATION_SCHEMA`.`COLUMNS`", $where, $data = "`COLUMN_NAME`", $limit = "", $offset = "", $orderby = "", $ordertype = "ASC", $prepare = 'ss', $tablescema, $TableName);

            foreach ($gettablecolnameresult as $value)
            {

                $array[] = $TableName . '.' . $value["COLUMN_NAME"];
                $array1[] = $value["COLUMN_NAME"];
            }

            array_unshift($array, "");
            unset($array[0]);
            $array_new = [];
            $idname = @$array1[0];

            foreach ($filed as $key)
            {

                if (array_key_exists($key, $array))
                {
                    $array_new[$key] = $array[$key];
                    //unset($array_new[0]);
                    
                }
            }

            $newfiled = !empty($array_new) ? implode(",", $array_new) : '*';
            $where = "$TableName.REC_status= ?";
            $REC_status = 1;
            $getfiled = $menumodel->getfiledname($TableName, $where, $data = $newfiled, $limit = "", $offset = "", $orderby = "", $ordertype = "ASC", $prepare = 'i', $REC_status);

            if (!empty($getfiled))
            {
                foreach ($getfiled as $row3)
                {
                    $id = array_values($row3) [0];
                    $table .= '<tr>';
                    //print_r($sql3);die;
                    foreach ($row3 as $column)
                    {

                        $table .= '<td class="text-center"> ' . $column . ' </td>';
                    }

                    $table .= '<td class="text-center">
                            <a  href="#"><i class="fa fa-edit"></i></a>
                            <a href="#" onclick="deletedata(\'' . $id . '\',\'' . $TableName . '\', \'' . $idname . '\',\'' . $parameter . '\' )"><i class="fa fa-trash"></i></a>
                            </td>
                            </tr>';
                }

                $table .= '</tbody>';
                $table .= '<a href="#" class="add_button" onclick="createformenater(\'' . $tablename . '\', \'' . $parameter . '\')">+</a>';
                $table .= '</table>';
                $table .= '<script>$("#example").dataTable();</script>';

                $response = array(
                    "status" => true,
                    "message" => "success",
                    "data" => $table
                );
            }
            echo json_encode($response);
            die;
        }
    }

    public function createformenater()
    {

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $menumodel = $this->model("Menu_model");
        $model = $this->model("Dynamic_model");

        $cid = get_session('company_ID');
        $email = get_session('useremail');

        //Get header token
        $allheader = getallheaders();
        $auth_token = !empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With'] : '';
        $token_data = decode($auth_token);
        $jsondata = json_decode($token_data);
        $final_token = !empty($jsondata->Token) ? $jsondata->Token : '';

        $where = "Company_ID= ? AND User_email_address=?";
        $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*", $prepare = 'is', $cid, $email);
        $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token'] : '';
        //Match header token
        if ($Header_Token != $final_token)
        {
            $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );
            echo json_encode($response);
            exit;
        }

        $tablename = $_POST['tablename'];
        $parameter = $_POST['parameter'];
        $REC_status = 1;
        $Language = "EN";
        $where = 'FormConfiguration.Form_Name=? and FormConfigurationLanguage.Language = ? and LogicalDefinitionTableLanguage.Language =? and FormConfiguration.REC_status = ? and FormConfigurationLanguage.REC_status = ? and LogicalTable.REC_status = ? and LogicalDefinitionTable.REC_status = ? and LogicalDefinitionTableLanguage.REC_status = ?';
        $datavalue = 'FormConfigurationLanguage.Title,FormConfiguration.Form_Name,FormConfiguration.Logical_Table_Name as pagename,FormConfiguration.No_Show_Field, LogicalTable.Logical_Table_Name,LogicalTable.Logical_Table_Description,FormConfiguration.Shown_Field';
        $result = $menumodel->getformenater('FormConfiguration', $where, $data = $datavalue, $limit = "", $offset = "", $orderby = "", $ordertype = "ASC", $prepare = 'sssiiiii', $parameter, $tablename, $Language, $REC_status);

        $pagename = $result[0]['pagename'];
        $tablename = $result[0]['Logical_Table_Name'];
        $filed = explode(",", $result[0]['Shown_Field']);
        $array = [];
        $tablescema = "alphafk6_BratPhase2";
        $TableName = $result[0]['Logical_Table_Name'];
        $where = "`TABLE_SCHEMA`= ? AND `TABLE_NAME`= ?";
        $gettablecolnameresult = $menumodel->gettablecolnameresult("`INFORMATION_SCHEMA`.`COLUMNS`", $where, $data = "`COLUMN_NAME`", $limit = "", $offset = "", $orderby = "", $ordertype = "ASC", $prepare = 'ss', $tablescema, $TableName);
        foreach ($gettablecolnameresult as $value)
        {

            $array[] = $value['COLUMN_NAME'];
        }

        array_unshift($array, "");
        unset($array[0]);

        $array_new = [];
        foreach ($filed as $key)
        {
            if (array_key_exists($key, $array))
            {
                $array_new[$key] = $array[$key];
            }
        }

        $newfiled = implode(",", $array_new);
        $i = 1;
        $term_arr = [];
        $Field_Type = [];
        foreach ($filed as $row1)
        {
            $rowfiled = $result[0]['No_Show_Field'];
            $TableName = $tablename; // We need to assign which table do this program will generate from here. There is no relationship between list configuration and logical table in terms of content
            $REC_status = 1;
            $Language = "EN";
            $where = 'LogicalTable.Logical_Table_Name= ? and LogicalDefinitionTable.Field_no = ? and LogicalDefinitionTableLanguage.Language = ? and LogicalDefinitionTable.REC_status = ? and LogicalDefinitionTableLanguage.REC_status = ? ';
            $checkvalid = $menumodel->checkvalidation('LogicalDefinitionTable', $where, $data = '*', $limit = "", $offset = "", $orderby = "", $ordertype = "ASC", $prepare = 'sisii', $Language, $TableName, $REC_status, $row1);
            $Field_Type[] = $checkvalid[0]['Field_Type'];
            $Field_Validation[] = $checkvalid[0]['Field_Validation'];
            $Validation_type[] = $checkvalid[0]['Validation_type'];
            $Validation_parameter[] = $checkvalid[0]['Validation_parameter'];

            $term_arr[] = $checkvalid[0]['Field_name'];
            if ($i == $rowfiled)
            {
                break;
            }
            $i++;
        }
        $msg[] = '';

        $form1 = '<form  method="post" id="adddata" ata-parsley-validate="">';

        $j = 0;
        $k = 1;
        foreach ($array_new as $key => $value)
        {

            $form1 .= '<div class="col-md-6">
                          <div class="form-group">';

            $form1 .= '<label for="email">' . $term_arr[$j] . ' </label>';

            $filed = $Validation_parameter[$j];

            $form1 .= '<input type="text" class="form-control"   name="name[' . $key . ']" value="">';
            $form1 .= '<input type="hidden" class="form-control" id="filed" name="filed[' . $key . ']" value="' . $Field_Type[$j] . '">';
            $form1 .= '<input type="hidden" class="form-control" name="FieldValidation[' . $key . ']" value="' . $Field_Validation[$j] . '">';
            $form1 .= '<input type="hidden" class="form-control" name="Validationparameter[' . $key . ']" value="' . $Validation_parameter[$j] . '">';
            $form1 .= '<input type="hidden" class="form-control" name="titlename[' . $key . ']" value="' . $term_arr[$j] . '">';
            $form1 .= '<div class="err_msg"></div></div></div>';
            $k++;
            $j++;
        }

        $form1 .= '<div class="col-md-12">';

        $form1 .= '<input type="hidden" name="tablename"  value="' . $tablename . '">';
        $form1 .= '<input type="hidden" name="pagename" value="' . $pagename . '">';
        $form1 .= '<input type="hidden" name="Parameter" value="' . $parameter . '">';
        $form1 .= '<input type="hidden" name="columnname" value="' . $newfiled . '">';
        /*   $form1 .= '<button id="" class="btn btn-default">Add '.$tablename.'</button>';*/
        $form1 .= '<a href="#" id="" class="btn btn-default" onclick="adddatainsert();" >Add ' . $tablename . '</a>';
        $form1 .= '</div></form>';

        $response = array(
            "status" => true,
            "message" => "success",
            "data" => $form1
        );

        echo json_encode($response);
        die;
    }

    public function adddatainsert()
    {

        $menumodel = $this->model("Menu_model");
        $model = $this->model("Dynamic_model");
        $cid = get_session('company_ID');
        $email = get_session('useremail');

        //Get header token
        $allheader = getallheaders();
        $auth_token = !empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With'] : '';
        $token_data = decode($auth_token);
        $jsondata = json_decode($token_data);
        $final_token = !empty($jsondata->Token) ? $jsondata->Token : '';

        $where = "Company_ID= ? AND User_email_address=?";
        $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*", $prepare = 'is', $cid, $email);
        $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token'] : '';
        //Match header token
        if ($Header_Token != $final_token)
        {
            $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );
            echo json_encode($response);
            exit;
        }

        $capture_field_vals = "";
        $filed = $_POST["filed"];
        $FieldValidation = $_POST["FieldValidation"];
        $Validationparameter = $_POST["Validationparameter"];
        $titlename = $_POST["titlename"];
        $columnname1 = $_POST['columnname'];
        //$id = $_POST['id'];
        $pagename = $_POST['pagename'];
        $tablename = $_POST['tablename'];
        $Parameter = $_POST['Parameter'];
        date_default_timezone_set('Asia/Kolkata');
        $date = date('yy-m-d h:i:s');
        $REC_create_datetime = $date;
        $REC_lastUpdate_datetime = $date;
        $REC_lastUpdate_by = 'System';
        $REC_status = '1';
        $i = 1;
        $columnname = explode(",", $columnname1);
        array_unshift($columnname, "");
        unset($columnname[0]);
        $errorMessage = array();
        foreach ($_POST["name"] as $key => $text_field)
        {
            $capture_field_vals .= $text_field . "','";
            $filedval = $filed[$i];
            $Validationparameter1 = explode(",", $Validationparameter[$i]);
            if ($FieldValidation[$i] > 0)
            {
                if ($filedval == 'br_varchar')
                {
                    if (!preg_match("/^[a-zA-Z-' ]*$/", $text_field))
                    {
                        $error = GetSystemCode('310');
                        $title = !empty($titlename[$i]) ? $titlename[$i] : '';
                        $errorMessage[$i] .= $error . '&nbsp;' . $title;
                    }
                    else
                    {

                        if (strlen($text_field) < $Validationparameter1[0])
                        {

                            $error = GetSystemCode('312');
                            $title = !empty($titlename[$i]) ? $titlename[$i] : '';
                            $errorMessage[$i] .= $error . '&nbsp;' . $Validationparameter1[0] . '&nbsp;' . $title;
                        }
                        if (strlen($text_field) > $Validationparameter1[1])
                        {

                            $error = GetSystemCode('313');
                            $title = !empty($titlename[$i]) ? $titlename[$i] : '';
                            $errorMessage[$i] .= $error . '&nbsp;' . $Validationparameter1[1] . '&nbsp;' . $title;

                        }
                    }
                }
                else if ($filedval == 'br_int')
                {
                    if (!preg_match("#[0-9]+#", $text_field))
                    {
                        $error = GetSystemCode('311');
                        $title = !empty($titlename[$i]) ? $titlename[$i] : '';
                        $errorMessage[$i] .= $error . '&nbsp;' . $title;
                    }
                    else
                    {
                        if ($text_field < $Validationparameter1[0])
                        {

                            $error = GetSystemCode('314');
                            $title = !empty($titlename[$i]) ? $titlename[$i] : '';
                            $errorMessage[$i] .= $geterror . '&nbsp;' . $Validationparameter1[0] . '&nbsp;' . $title;
                        }
                        if ($text_field > $Validationparameter1[1])
                        {
                            $error = GetSystemCode('315');
                            $title = !empty($titlename[$i]) ? $titlename[$i] : '';
                            $errorMessage[$i] .= $error . '&nbsp;' . $Validationparameter1[1] . '&nbsp;' . $title;
                        }
                    }
                }
                else if ($filedval == 'br_boolean')
                {
                    if ($text_field == '0')
                    {
                        $error = GetSystemCode('316');
                        $title = !empty($titlename[$i]) ? $titlename[$i] : '';
                        $errorMessage[$i] .= $error . '&nbsp;' . $Validationparameter1[2] . '&nbsp;' . $title;

                    }
                }

            }
            $i++;
        }
        if ($errorMessage)
        {

            $response = array(
                "status" => false,
                "message" => '',
                "data" => $errorMessage
            );
        }
        else
        {
            /*  <!-- Insert Script For Company Table Start -->*/
            $result = $menumodel->insert_data($tablename, $columnname1, $capture_field_vals, $REC_create_datetime, $REC_lastUpdate_datetime, $REC_lastUpdate_by, $REC_status);

            if ($result === true)
            {
                $response = array(
                    "status" => true,
                    "message" => "Successfull Insert",
                    "data" => 'success'
                );

            }
            else
            {
                //die("else");
                
            }

        }

        echo json_encode($response);
        die;
    }

    public function deletedata()
    {
        $menumodel = $this->model("Menu_model");
        $model = $this->model("Dynamic_model");
        $cid = get_session('company_ID');
        $email = get_session('useremail');

        //Get header token
        $allheader = getallheaders();
        $auth_token = !empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With'] : '';
        $token_data = decode($auth_token);
        $jsondata = json_decode($token_data);
        $final_token = !empty($jsondata->Token) ? $jsondata->Token : '';

        $where = "Company_ID= ? AND User_email_address=?";
        $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*", $prepare = 'is', $cid, $email);
        $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token'] : '';
        //Match header token
        if ($Header_Token != $final_token)
        {
            $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );
            echo json_encode($response);
            exit;
        }

        $id = $_POST['id'];
        $tablename = $_POST['tablename'];
        $idname = $_POST['idname'];

        $where = array(
            "$idname" => "$id"
        );
        $updatedata = array(
            "REC_status" => "0"
        );
        $result = $model->updateRowWhere($tablename, $where, $updatedata);
        if ($result)
        {
            $response = array(
                "status" => true,
                "message" => "Delete SuccessFully",
                "data" => ''
            );
        }
        else
        {
            $response = array(
                "status" => false,
                "message" => "success",
                "data" => ''
            );
        }
        echo json_encode($response);
        die;
    }

    public function createtable()
    {

        $menumodel = $this->model("Menu_model");
        $model = $this->model("Dynamic_model");

        $cid = get_session('company_ID');
        $email = get_session('useremail');

        //Get header token
        $allheader = getallheaders();
        $auth_token = !empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With'] : '';
        $token_data = decode($auth_token);
        $jsondata = json_decode($token_data);
        $final_token = !empty($jsondata->Token) ? $jsondata->Token : '';
        $where = "Company_ID= ? AND User_email_address=?";
        $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*", $prepare = 'is', $cid, $email);
        $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token'] : '';
        //Match header token
        if ($Header_Token != $final_token)
        {
            $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );
            echo json_encode($response);
            exit;
        }

            $where = 'REC_status=1';
            $getfiledname = $model->getLogicalDefinitionTabledata();
             $table = '<table class="table table-striped table-bordered"  id="example" width="100%" cellspacing="0">
                        <thead>
                            <tr>';
             $table .= '<th>S No.</th><th>Logical Table Name</th><th>Field no</th><th>Language</th><th>Field name</th>  
                         <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>';
                    $i=1;        
                    foreach ($getfiledname as $column)
                    {

                        $table .= '<tr><td class="text-center"> ' . $i . ' </td>';
                        $table .= '<td class="text-center"> ' . $column['Logical_Table_Name'] . ' </td>';
                        $table .= '<td class="text-center"> ' . $column['Field_no']. ' </td>';
                        $table .= '<td class="text-center"> ' . $column['Language'] . ' </td>';
                        $table .= '<td class="text-center"> ' . $column['Field_name']. ' </td>';
                    $i++;

                    $table .= '<td class="text-center">
                            <a  href="#" onclick="editlogicaltabledata(\'' .$column['Field_no'] . '\',\'' . $column['Logical_Table_ID'] . '\')"><i class="fa fa-edit"></i></a>
                            <a href="#" onclick="deletelogicaltabledata(\'' .$column['Field_no'] . '\',\'' . $column['Logical_Table_ID'] . '\')"><i class="fa fa-trash"></i></a>
                            </td></tr>';
                        }
      
                

                $table .= '</tbody>';
                $table .= '<a href="#" class="add_button" onclick="addlogicalformenater();">+</a>'; 
                $table .= '</table>';
                $table .= '<script>$("#example").dataTable();</script>';                    

            $response = array(
                "status" => true,
                "message" => 'success',
                "data" => $table
            );
        echo json_encode($response);
        die;
    }

    public function checktablenameornot()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $menumodel = $this->model("Menu_model");
        $model = $this->model("Dynamic_model");
        $cid = get_session('company_ID');
        $email = get_session('useremail');

        //Get header token
        $allheader = getallheaders();
        $auth_token = !empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With'] : '';
        $token_data = decode($auth_token);
        $jsondata = json_decode($token_data);
        $final_token = !empty($jsondata->Token) ? $jsondata->Token : '';

        $where = "Company_ID= ? AND User_email_address=?";
        $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*", $prepare = 'is', $cid, $email);
        $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token'] : '';
        //Match header token
        if ($Header_Token != $final_token)
        {
            $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );
            echo json_encode($response);
            exit;
        }

        $tablename = $_POST["tablename"];
        $databasename = 'alphafk6_BratPhase2';
        $where = "table_schema= '$databasename' AND table_name='$tablename'";
        $gettableexist = $model->gettableexistsornot('information_schema.tables', $where, $data = "COUNT(*)");
        $gettableornot = $gettableexist[0]['COUNT(*)'];

        if ($gettableornot == '0')
        {

            //$id= 'id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY';
            //$createtable = $model->create_table($tablename, $id);
            $where = 'REC_status=1';
            $getfiledname = $model->getLogicalDefinitionTabledata('LogicalDefinitionTableLanguage', $where, $data = "Field_name");

            $form1 = '<ul id="sortable1" class="connectedSortable">';
            foreach ($getfiledname as $key => $filed)
            {

                $form1 .= '<li rel="' . $key . '" class="ui-state-default"><span>' . $filed['Field_name'] . '</span> <button class="add_btn" onclick="add(' . $key . ')"><i class="fas fa-plus"></i></button>
  
  <div class="inner_box" id="new_chq' . $key . '"><input type="hidden" value="' . $filed['Field_name'] . '" name="tfiledname" id="filedname' . $key . '"></div>
  <input type="hidden" value="' . $key . '" id="total_chq' . $key . '">
 
  </li>';

            }

            $form1 .= '</ul>
      <ul id="sortable2" class="connectedSortable"></ul>
     <div class="creat_table_btn"> <input type="hidden" value="' . $tablename . '" name="tablename" id="tablename"><button onclick="Createcolumntbale()">Create Table Column</button></div>';

            $response = array(
                "status" => true,
                "message" => 'success',
                "data" => $form1
            );
        }
        else
        {
            $date = date('m_d_Y');
            $rename = $tablename . '_old' . '_' . $date;
            $renametable = $model->rename_table($tablename, $rename);
            $where = 'REC_status=1';
            $getfiledname = $model->getLogicalDefinitionTabledata('LogicalDefinitionTableLanguage', $where, $data = "Field_name");

            $form1 = '<ul id="sortable1" class="connectedSortable">';
            foreach ($getfiledname as $key => $filed)
            {

                $form1 .= '<li rel="' . $key . '" class="ui-state-default"><span>' . $filed['Field_name'] . '</span> <button class="add_btn" onclick="add(' . $key . ')"><i class="fas fa-plus"></i></button>
  
  <div class="inner_box" id="new_chq' . $key . '" > <input type="hidden" value="' . $filed['Field_name'] . '" name="tfiledname" id="filedname' . $key . '"></div>
  <input type="hidden" value="' . $key . '" id="total_chq' . $key . '">
 
  </li>';

            }

            $form1 .= '</ul>
      <ul id="sortable2" class="connectedSortable"></ul>
     <div class="creat_table_btn"><input type="hidden" value="' . $tablename . '" name="tablename" id="tablename"> <button onclick="Createcolumntbale()">Create Table Column</button></div>';

            if ($getfiledname)
            {
                $response = array(
                    "status" => true,
                    "message" => "success",
                    "data" => $form1
                );

            }
            else
            {
                //die("else");
                
            }

        }

        echo json_encode($response);
        die;
    }

    public function dynamiccreatetable()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $menumodel = $this->model("Menu_model");
        $model = $this->model("Dynamic_model");
        $cid = get_session('company_ID');
        $email = get_session('useremail');

        //Get header token
        $allheader = getallheaders();
        $auth_token = !empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With'] : '';
        $token_data = decode($auth_token);
        $jsondata = json_decode($token_data);
        $final_token = !empty($jsondata->Token) ? $jsondata->Token : '';

        $where = "Company_ID= ? AND User_email_address=?";
        $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*", $prepare = 'is', $cid, $email);
        $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token'] : '';
        //Match header token
        if ($Header_Token != $final_token)
        {
            $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );
            echo json_encode($response);
            exit;
        }

        $datatype = $_POST['datatype'];
        $tlength = $_POST['tlength'];
        $filedname = $_POST['filedname'];
        $tablename = $_POST['tablename'];

        $tablefiledname = explode(',', $filedname);
        $tabletlength = explode(',', $tlength);
        $tabledatatype = explode(',', $datatype);
        $i = 0;
        $id = array();
        foreach ($tablefiledname as $value)
        {

            if (!empty($tabledatatype[0]) && $tabledatatype[$i] == 'int(auto)')
            {
                $id[] = "`$value`" . ' int(11) unsigned NOT NULL AUTO_INCREMENT';
                $id[] .= "PRIMARY KEY (`$value`)";
            }
            else
            {
                if ($tabletlength[0] == '' || $tabledatatype[0] == '')
                {

                    $id[] .= "`$value`" . ' varchar(255) NOT NULL';
                }
                else
                {
                    $id[] .= "`$value`" . ' ' . $tabledatatype[$i] . '(' . $tabletlength[$i] . ')' . 'NOT NULL';
                }
            }

            $i++;
        }

        $filed = implode(',', $id);

        $createtable = $model->create_table($tablename, $filed);
        if($createtable){
        $response = array(
            "status" => true,
            "message" => "Create Table $tablename Successfull",
        );
        }else{
            $errorMessage = GetSystemCode('318');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );    
            
        }
        echo json_encode($response);
        exit;
    }
    
    
 public function createlogicalformenater()
    { 
 
    
        $menumodel = $this->model("Menu_model");
        $model = $this->model("Dynamic_model");

        $cid = get_session('company_ID');
        $email = get_session('useremail');

        //Get header token
        $allheader = getallheaders();
        $auth_token = !empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With'] : '';
        $token_data = decode($auth_token);
        $jsondata = json_decode($token_data);
        $final_token = !empty($jsondata->Token) ? $jsondata->Token : '';

        $where = "Company_ID= ? AND User_email_address=?";
        $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*", $prepare = 'is', $cid, $email);
        $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token'] : '';
        //Match header token
        if ($Header_Token != $final_token)
        {
            $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );
            echo json_encode($response);
            exit;
        }

        
        
        $form1 = '<form  method="post" id="adddata" ata-parsley-validate="">';
         $form1 .= '<div class="col-md-6">
                          <div class="form-group">';
         $form1 .= '<select name="logicaltname" class="form-control"><option name="0">Logical Table Name</option>';
         $where = 'REC_status=1';
          $getlogicaltablename = $model->getLogicalTabledata('LogicalTable', $where, $data = "Logical_Table_Name,Logical_Table_ID");
             foreach ($getlogicaltablename as  $tname)
            {
             $form1 .= '<option value="'.$tname['Logical_Table_ID'].'">'.$tname['Logical_Table_Name'].'</option>';
            }
           $form1 .= '</select>';
         $form1 .= '<div class="err_msg"></div>';
         $form1 .= '<label for="email">Field no</label>';
         $form1 .= '<input type="text" class="form-control"   name="filedno" value="">';
         $form1 .= '<div class="err_msg"></div>';
         $form1 .= '<label for="email">Language</label>';
         $form1 .= '<input type="text" class="form-control"   name="language" value="">';
         $form1 .= '<div class="err_msg"></div>';
         $form1 .= '<label for="email">Field name</label>';
         $form1 .= '<input type="text" class="form-control"   name="filedname" value="">';
         $form1 .= '<div class="err_msg"></div>';
         $form1 .= '<label for="email">Field Type</label>';
         $form1 .= '<input type="text" class="form-control"   name="field_type" value="">';
         $form1 .= '<div class="err_msg"></div>';
         $form1 .= '<label for="email" class="field_vali">Field Validation</label>';
         $form1 .= '<label for="email" class="yes_label">YES <input type="radio"    name="Field_Validation" value="1"> </label> ';
         $form1 .= '<label for="email" class="yes_label">NO <input type="radio"    name="Field_Validation" value="0"></label>';
         $form1 .= '<div class="err_msg"></div>';
         $form1 .= '<label for="email">Validation Type</label>';
         $form1 .= '<input type="text" class="form-control"   name="validation_type" value="">';
         $form1 .= '<div class="err_msg"></div></div></div>';
     

        $form1 .= '<div class="col-md-12">'; 
        $form1 .= '<a href="#" id="" class="btn btn-default" onclick="addlogicaldatainsert();" >Add </a>';
        $form1 .= '</div></form>';

        $response = array(
            "status" => true,
            "message" => "success",
            "data" => $form1
        );

        echo json_encode($response);
        die;
    }
    
    
 public function addlogicaldatainsert()
    {

        $menumodel = $this->model("Menu_model");
        $model = $this->model("Dynamic_model");
        $cid = get_session('company_ID');
        $email = get_session('useremail');

        //Get header token
        $allheader = getallheaders();
        $auth_token = !empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With'] : '';
        $token_data = decode($auth_token);
        $jsondata = json_decode($token_data);
        $final_token = !empty($jsondata->Token) ? $jsondata->Token : '';

        $where = "Company_ID= ? AND User_email_address=?";
        $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*", $prepare = 'is', $cid, $email);
        $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token'] : '';
        //Match header token
        if ($Header_Token != $final_token)
        {
            $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );
            echo json_encode($response);
            exit;
        }


        $logicaltname = $_POST["logicaltname"];
        $filedno = $_POST["filedno"];
        $language = $_POST["language"];
        $filedname = $_POST["filedname"];
        $field_type = $_POST["field_type"];
        $Field_Validation = $_POST["Field_Validation"];
        $validation_type = $_POST["validation_type"];
        date_default_timezone_set('Asia/Kolkata');
        $date = date('yy-m-d h:i:s');
        $REC_create_datetime = $date;
        $REC_lastUpdate_datetime = $date;
        $REC_lastUpdate_by = 'System';
        $REC_status = '1';
        $tablename1='LogicalDefinitionTable';
        $columnname1=array("Logical_Table_ID"=>$logicaltname,"Field_no"=>$filedno,"compulsory"=>0,"Field_Type"=>$field_type,"Field_Validation"=>$Field_Validation,"Validation_type"=>$validation_type,"REC_create_datetime"=>$REC_create_datetime,"REC_lastUpdate_datetime"=>$REC_lastUpdate_datetime,"REC_lastUpdate_by"=>$REC_lastUpdate_by,"REC_status"=>$REC_status);
        /*  <!-- Insert Script For Company Table Start -->*/ 
        $result1 = $model->insert_data($tablename1, $columnname1);
        $tablename='LogicalDefinitionTableLanguage';
        $columnname=array("Logical_Table_ID"=>$logicaltname,"Field_no"=>$filedno,"Language"=>$language,"Field_name"=>$filedname,"REC_create_datetime"=>$REC_create_datetime,"REC_lastUpdate_datetime"=>$REC_lastUpdate_datetime,"REC_lastUpdate_by"=>$REC_lastUpdate_by,"REC_status"=>$REC_status);
        /*  <!-- Insert Script For Company Table Start -->*/ 
        $result = $model->insert_data($tablename, $columnname);

            if ($result === 1)
            { 
                $response = array(
                    "status" => true,
                    "message" => "Successfull Insert",
                    "data" => 'success',
                );

            }
            else
            {
                   $response = array(
                    "status" => false,
                    "message" => "Please Check Duplicate Field", 
                    "data" => 'false',
                );
                
            }

        

        echo json_encode($response);
        die;
    }
    
    public function updatelogicaldatainsert()
    {

        $menumodel = $this->model("Menu_model");
        $model = $this->model("Dynamic_model");
        $cid = get_session('company_ID');
        $email = get_session('useremail');

        //Get header token
        $allheader = getallheaders();
        $auth_token = !empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With'] : '';
        $token_data = decode($auth_token);
        $jsondata = json_decode($token_data);
        $final_token = !empty($jsondata->Token) ? $jsondata->Token : '';

        $where = "Company_ID= ? AND User_email_address=?";
        $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*", $prepare = 'is', $cid, $email);
        $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token'] : '';
        //Match header token
        if ($Header_Token != $final_token)
        {
            $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );
            echo json_encode($response);
            exit;
        }


        $logicaltname = $_POST["logicaltname"];
        $filedno = $_POST["filedno"];
        $language = $_POST["language"];
        $filedname = $_POST["filedname"];
        $field_type = $_POST["field_type"];
        $Field_Validation = $_POST["Field_Validation"];
        $validation_type = $_POST["validation_type"];
        date_default_timezone_set('Asia/Kolkata');
        $date = date('yy-m-d h:i:s');
        $REC_create_datetime = $date;
        $REC_lastUpdate_datetime = $date;
        $REC_lastUpdate_by = 'System';
        $REC_status = '1';
        $tablename1='LogicalDefinitionTable';
        $where=array("Logical_Table_ID"=>$logicaltname,"Field_no"=>$filedno);
        $columnname1=array("Logical_Table_ID"=>$logicaltname,"Field_no"=>$filedno,"compulsory"=>0,"Field_Type"=>$field_type,"Field_Validation"=>$Field_Validation,"Validation_type"=>$validation_type,"REC_create_datetime"=>$REC_create_datetime,"REC_lastUpdate_datetime"=>$REC_lastUpdate_datetime,"REC_lastUpdate_by"=>$REC_lastUpdate_by,"REC_status"=>$REC_status);
        /*  <!-- Insert Script For Company Table Start -->*/ 
        $result1 = $model->updateRowWhere($tablename1,$where, $columnname1);
        $tablename='LogicalDefinitionTableLanguage';
        $columnname=array("Logical_Table_ID"=>$logicaltname,"Field_no"=>$filedno,"Language"=>$language,"Field_name"=>$filedname,"REC_create_datetime"=>$REC_create_datetime,"REC_lastUpdate_datetime"=>$REC_lastUpdate_datetime,"REC_lastUpdate_by"=>$REC_lastUpdate_by,"REC_status"=>$REC_status);
        /*  <!-- Insert Script For Company Table Start -->*/ 
        $result = $model->updateRowWhere($tablename,$where, $columnname);

            if ($result === 1)
            { 
                $response = array(
                    "status" => true,
                    "message" => "Successfull Insert",
                    "data" => 'success',
                );

            }
            else
            {
                   $response = array(
                    "status" => false,
                    "message" => "Please Check Duplicate Field", 
                    "data" => 'false',
                );
                
            }

        

        echo json_encode($response);
        die;
    }
    
    
        public function createlistconftable()
    {

        $menumodel = $this->model("Menu_model");
        $model = $this->model("Dynamic_model");

        $cid = get_session('company_ID');
        $email = get_session('useremail');

        //Get header token
        $allheader = getallheaders();
        $auth_token = !empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With'] : '';
        $token_data = decode($auth_token);
        $jsondata = json_decode($token_data);
        $final_token = !empty($jsondata->Token) ? $jsondata->Token : '';
        $where = "Company_ID= ? AND User_email_address=?";
        $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*", $prepare = 'is', $cid, $email);
        $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token'] : '';
        //Match header token
        if ($Header_Token != $final_token)
        {
            $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );
            echo json_encode($response);
            exit;
        }

            $where = 'REC_status=1';
            $getfiledname = $model->getListconfigTabledata();
             $table = '<table class="table table-striped table-bordered"  id="example" width="100%" cellspacing="0">
                        <thead>
                            <tr>';
             $table .= '<th>S No.</th><th>Logical Table Name</th><th>No Show Field</th><th>Show Filed</th><th>Language</th>  
                         <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>';
                    $i=1;        
                    foreach ($getfiledname as $column)
                    {

                        $table .= '<tr><td class="text-center"> ' . $i . ' </td>';
                        $table .= '<td class="text-center"> ' . $column['Logical_Table_Name'] . ' </td>';
                        $table .= '<td class="text-center"> ' . $column['No_Show_Field']. ' </td>';
                        $table .= '<td class="text-center"> ' . $column['Shown_Field']. ' </td>';
                         $table .= '<td class="text-center"> ' . $column['Language'] . ' </td>';
                    $i++;

                    $table .= '<td class="text-center">
                            <a  href="#" onclick="getvalue(\'' .$column['Logical_Table_Name'] . '\',\'' . $column['ListConfiguration_ID'] . '\',\'' . $column['Shown_Field'] . '\',\'' . $column['No_Show_Field'] . '\');"><i class="fa fa-edit"></i></a>
                            <a href="#" onclick="deletelistconfigdata(\'' . $column['ListConfiguration_ID'] . '\')"><i class="fa fa-trash"></i></a>
                            </td></tr>';
                        }
      
                

                $table .= '</tbody>';
                $table .= '<a href="#" class="add_button" onclick="addlistconfigformenater();">+</a>'; 
                $table .= '</table>';
                $table .= '<script>$("#example").dataTable();</script>';                    

            $response = array(
                "status" => true,
                "message" => 'success',
                "data" => $table
            );
        echo json_encode($response);
        die;
    }

     public function createlistconfigformenater()
    { 
 
    
        $menumodel = $this->model("Menu_model");
        $model = $this->model("Dynamic_model");

        $cid = get_session('company_ID');
        $email = get_session('useremail');

        //Get header token
        $allheader = getallheaders();
        $auth_token = !empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With'] : '';
        $token_data = decode($auth_token);
        $jsondata = json_decode($token_data);
        $final_token = !empty($jsondata->Token) ? $jsondata->Token : '';

        $where = "Company_ID= ? AND User_email_address=?";
        $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*", $prepare = 'is', $cid, $email);
        $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token'] : '';
        //Match header token
        if ($Header_Token != $final_token)
        {
            $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );
            echo json_encode($response);
            exit;
        }

        
        
        $form1 = '<form  method="post" id="adddata" ata-parsley-validate="">';
         $form1 .= '<div class="col-md-12">
                          <div class="form-group">';
         $form1 .= '<select name="logicaltname" id="logicaltname" onchange="gettablevalue();" class="form-control"><option name="0">Logical Table Name</option>';
         $where = 'REC_status=1';
          $getlogicaltablename = $model->getLogicalTabledata('LogicalTable', $where, $data = "Logical_Table_Name,Logical_Table_ID");
             foreach ($getlogicaltablename as  $tname)
            {
             $form1 .= '<option value="'.$tname['Logical_Table_ID'].'">'.$tname['Logical_Table_Name'].'</option>';
            }
           $form1 .= '</select></div></div></form>';

        $response = array(
            "status" => true,
            "message" => "success",
            "data" => $form1
        );

        echo json_encode($response);
        die;
    }
    
  public function addlistconfigtable()
    {

        $menumodel = $this->model("Menu_model");
        $model = $this->model("Dynamic_model");

        $cid = get_session('company_ID');
        $email = get_session('useremail');

        //Get header token
        $allheader = getallheaders();
        $auth_token = !empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With'] : '';
        $token_data = decode($auth_token);
        $jsondata = json_decode($token_data);
        $final_token = !empty($jsondata->Token) ? $jsondata->Token : '';
        $where = "Company_ID= ? AND User_email_address=?";
        $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*", $prepare = 'is', $cid, $email);
        $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token'] : '';
        //Match header token
        if ($Header_Token != $final_token)
        {
            $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );
            echo json_encode($response);
            exit;
        }
            $tablename = $_POST["tablename"];
            $id = $_POST["id"];
            $Shown_Field = $_POST["Shown_Field"];
            $No_Show_Field = $_POST["No_Show_Field"];
            $ShownField = explode(',',$Shown_Field);
            $where = 'REC_status=1 AND Logical_Table_ID="'.$id.'"' ;
            $getfiledname = $model->getLogicalTabledata('LogicalDefinitionTableLanguage', $where, $data = "Field_name,Field_no");
            $form1 = '<div><span class="filed_logical">'.$tablename.'</span></div><ul id="sortable1" class="connectedSortable"><span class="filed_logical">Fields of Logical Table</span>';
            foreach ($getfiledname as $key => $filed)
            {

                $form1 .= '<li rel="' . $key . '" class="ui-state-default"><span>' . $filed['Field_no'] . ') ' . $filed['Field_name'] . '</span><input type="hidden" value="' . $filed['Field_no'] . '" name="tfiledno" id="tfiledno'.$key.'"></li> 
                ';

            }

            $form1 .= '</ul>
          <ul id="sortable2" class="connectedSortable"><span class="filed_confi">Fields of List configuration</span>';
                   $k=0; 
                   $count=0;
              foreach ($getfiledname as $key => $filed)
            {       
               

                      if($filed['Field_no'] == $ShownField[$k]){
                          $form1 .= '<li  class="ui-state-default"><span>' . $ShownField[$k] . ') ' . $filed['Field_name'] . '</span><input type="hidden" value="' . $ShownField[$k] . '" name="tfiledno" ></li> ';      
                       }else{
                         $form1 .= '<li  class="ui-state-default"><span>' . $ShownField[$k] . ') ' . $filed['Field_name'] . '</span><input type="hidden" value="' . $ShownField[$k] . '" name="tfiledno" ></li> ';         
                       }


             $k++;}
          $form1 .= '</ul>';
       
          $form1 .= '<input type="hidden" value="'.$tablename.'" id="tablename"><input type="hidden" value="'.$id.'" id="ListConfiguration_ID">
          
          
          <div class="creat_table_btn"><button onclick="editupdatelistcong()">Update Field List</button></div>';
       
           
            $response = array(
                "status" => true,
                "message" => 'success',
                "data" => $form1
            );
        echo json_encode($response);
        die;
    }    
    
    
        public function deletelogicaltabledata()
    {
        $menumodel = $this->model("Menu_model");
        $model = $this->model("Dynamic_model");
        $cid = get_session('company_ID');
        $email = get_session('useremail');

        //Get header token
        $allheader = getallheaders();
        $auth_token = !empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With'] : '';
        $token_data = decode($auth_token);
        $jsondata = json_decode($token_data);
        $final_token = !empty($jsondata->Token) ? $jsondata->Token : '';

        $where = "Company_ID= ? AND User_email_address=?";
        $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*", $prepare = 'is', $cid, $email);
        $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token'] : '';
        //Match header token
        if ($Header_Token != $final_token)
        {
            $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );
            echo json_encode($response);
            exit;
        }

        $id = $_POST['id'];
        $Field_no = $_POST['Field_no'];
        $tablename='LogicalDefinitionTable';
        $tablename1='LogicalDefinitionTableLanguage';
        $where = array(
            "Logical_Table_ID" => "$Field_no",
            "Field_no" => "$id"
        );
     
        $result = $model->deletedata($tablename1, $where);
        $result1 = $model->deletedata($tablename, $where);
    
        if ($result1== '1')
        {
            $response = array(
                "status" => true,
                "message" => "Delete SuccessFully",
                "data" => ''
            );
        }
        else
        {
            $response = array(
                "status" => false,
                "message" => "error",
                "data" => ''
            );
        }
        echo json_encode($response);
        die;
    }
    
     public function editlogicaltabledata()
    { 
 
    
        $menumodel = $this->model("Menu_model");
        $model = $this->model("Dynamic_model");

        $cid = get_session('company_ID');
        $email = get_session('useremail');

        //Get header token
        $allheader = getallheaders();
        $auth_token = !empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With'] : '';
        $token_data = decode($auth_token);
        $jsondata = json_decode($token_data);
        $final_token = !empty($jsondata->Token) ? $jsondata->Token : '';

        $where = "Company_ID= ? AND User_email_address=?";
        $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*", $prepare = 'is', $cid, $email);
        $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token'] : '';
        //Match header token
        if ($Header_Token != $final_token)
        {
            $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );
            echo json_encode($response);
            exit;
        }

        
         $id = $_POST['id'];
         $Field_no = $_POST['Field_no'];
         $form1 = '<form  method="post" id="adddata" ata-parsley-validate="">';
         $form1 .= '<div class="col-md-6">
                          <div class="form-group">';
         $form1 .= '<select name="logicaltname" class="form-control"><option name="0">Logical Table Name</option>';
         $where = 'REC_status=1';
          $getlogicaltablename = $model->getLogicalTabledata('LogicalTable', $where, $data = "Logical_Table_Name,Logical_Table_ID");
             $valsel="";
             foreach ($getlogicaltablename as  $tname)
            {
    
                if($tname['Logical_Table_ID'] == $Field_no){
                   //echo $tname['Logical_Table_ID'];
                   $valsel= "selected";
                   //echo $Field_no;
                }else{
                    $valsel= "";
                }
             $form1 .= '<option value="'.$tname['Logical_Table_ID'].'" '.$valsel.'>' .$tname['Logical_Table_Name'].'</option>';
            }
           $form1 .= '</select>';
          $where = 'Logical_Table_ID='.$Field_no.' and Field_no='.$id.' and  REC_status=1';
          $getlogicaltabledata = $model->getLogicalTabledata('LogicalDefinitionTable', $where, $data = "Field_Type,Field_Validation,Validation_type");
          $getlogicaltablelangdata = $model->getLogicalTabledata('LogicalDefinitionTableLanguage', $where, $data = "*"); 

         $form1 .= '<div class="err_msg"></div>';
         $form1 .= '<label for="email">Field no</label>';
         $form1 .= '<input type="text" class="form-control"   name="filedno" value="'.$getlogicaltablelangdata[0]['Field_no'].'">';
         $form1 .= '<div class="err_msg"></div>';
         $form1 .= '<label for="email">Language</label>';
         $form1 .= '<input type="text" class="form-control"   name="language" value="'.$getlogicaltablelangdata[0]['Language'].'">';
         $form1 .= '<div class="err_msg"></div>';
         $form1 .= '<label for="email">Field name</label>';
         $form1 .= '<input type="text" class="form-control"   name="filedname" value="'.$getlogicaltablelangdata[0]['Field_name'].'">';
         $form1 .= '<div class="err_msg"></div>';
         $form1 .= '<label for="email">Field Type</label>';
         $form1 .= '<input type="text" class="form-control"   name="field_type" value="'.$getlogicaltabledata[0]['Field_Type'].'">';
         $form1 .= '<div class="err_msg"></div>';
         $form1 .= '<label for="email" class="field_vali">Field Validation</label>';
           if($getlogicaltabledata[0]['Field_Validation'] == 1){
                   $valyes= "checked";
                }else{
                   $valno= "checked"; 
                }
                
         $form1 .= '<label for="email" class="yes_label">YES <input type="radio"    name="Field_Validation"  '.$valyes.' value="'.$getlogicaltabledata[0]['Field_Validation'].'"> </label> ';
         $form1 .= '<label for="email" class="yes_label">NO <input type="radio"    name="Field_Validation" '.$valno.' value="'.$getlogicaltabledata[0]['Field_Validation'].'"></label>';
         $form1 .= '<div class="err_msg"></div>';
         $form1 .= '<label for="email">Validation Type</label>';
         $form1 .= '<input type="text" class="form-control"   name="validation_type" value="'.$getlogicaltabledata[0]['Validation_type'].'">';
         $form1 .= '<div class="err_msg"></div></div></div>';
     

        $form1 .= '<div class="col-md-12">'; 
        $form1 .= '<a href="#" id="" class="btn btn-default" onclick="updatelogicaldatainsert();" > Add</a>';
        $form1 .= '</div></form>';

        $response = array(
            "status" => true,
            "message" => "success",
            "data" => $form1
        );

        echo json_encode($response);
        die;
    }
    
    
       public function editListConfiguration()
    {

        $menumodel = $this->model("Menu_model");
        $model = $this->model("Dynamic_model");
        $cid = get_session('company_ID');
        $email = get_session('useremail');

        //Get header token
        $allheader = getallheaders();
        $auth_token = !empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With'] : '';
        $token_data = decode($auth_token);
        $jsondata = json_decode($token_data);
        $final_token = !empty($jsondata->Token) ? $jsondata->Token : '';

        $where = "Company_ID= ? AND User_email_address=?";
        $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*", $prepare = 'is', $cid, $email);
        $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token'] : '';
        //Match header token
        if ($Header_Token != $final_token)
        {
            $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );
            echo json_encode($response);
            exit;
        }


        $tablename = $_POST["tablename"];
        $filedname = $_POST["filedname"];
        $id = $_POST["ListConfiguration_ID"];
        $filed_name = explode(',',$filedname);
        $No_Show_Field=count($filed_name);
        date_default_timezone_set('Asia/Kolkata');
        $date = date('yy-m-d h:i:s');
        $REC_create_datetime = $date;
        $REC_lastUpdate_datetime = $date;
        $REC_lastUpdate_by = 'System';
        $REC_status = '1';
        $tablename1='ListConfiguration';
        $where=array("ListConfiguration_ID"=>$id,"REC_status"=>1);
        $columnname1=array("No_Show_Field"=>$No_Show_Field,"Shown_Field"=>$filedname,"REC_create_datetime"=>$REC_create_datetime,"REC_lastUpdate_datetime"=>$REC_lastUpdate_datetime,"REC_lastUpdate_by"=>$REC_lastUpdate_by,"REC_status"=>$REC_status);
        /*  <!-- Insert Script For Company Table Start -->*/ 
         $result1 = $model->updateRowWhere($tablename1,$where, $columnname1);
    
            if ($result1 === 1)
            { 
                $response = array(
                    "status" => true,
                    "message" => "Successfull Update",
                    "data" => 'success',
                );

            }
            else
            {
                   $response = array(
                    "status" => false,
                    "message" => "Please Check", 
                    "data" => 'false',
                );
                
            }

        

        echo json_encode($response);
        die;
    }
    
    
          public function deletelistconfigdata()
    {
        $menumodel = $this->model("Menu_model");
        $model = $this->model("Dynamic_model");
        $cid = get_session('company_ID');
        $email = get_session('useremail');

        //Get header token
        $allheader = getallheaders();
        $auth_token = !empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With'] : '';
        $token_data = decode($auth_token);
        $jsondata = json_decode($token_data);
        $final_token = !empty($jsondata->Token) ? $jsondata->Token : '';

        $where = "Company_ID= ? AND User_email_address=?";
        $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*", $prepare = 'is', $cid, $email);
        $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token'] : '';
        //Match header token
        if ($Header_Token != $final_token)
        {
            $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );
            echo json_encode($response);
            exit;
        }

        $id = $_POST['id'];
        $tablename='ListConfiguration';
        $tablename1='ListConfigurationLanguage';
        $where = array(
            "ListConfiguration_ID" => "$id"
        );
     
        $result1 = $model->deletedata($tablename1, $where);
        $result = $model->deletedata($tablename, $where);
    
        if ($result1== '1')
        {
            $response = array(
                "status" => true,
                "message" => "Delete SuccessFully",
                "data" => ''
            );
        }
        else
        {
            $response = array(
                "status" => false,
                "message" => "error",
                "data" => ''
            );
        }
        echo json_encode($response);
        die;
    }


  public function getlistconfigtablevalue()
    {

        $menumodel = $this->model("Menu_model");
        $model = $this->model("Dynamic_model");

        $cid = get_session('company_ID');
        $email = get_session('useremail');

        //Get header token
        $allheader = getallheaders();
        $auth_token = !empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With'] : '';
        $token_data = decode($auth_token);
        $jsondata = json_decode($token_data);
        $final_token = !empty($jsondata->Token) ? $jsondata->Token : '';
        $where = "Company_ID= ? AND User_email_address=?";
        $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*", $prepare = 'is', $cid, $email);
        $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token'] : '';
        //Match header token
        if ($Header_Token != $final_token)
        {
            $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );
            echo json_encode($response);
            exit;
        }
            $tablename = $_POST["tablename"];
            $where = 'REC_status=1 AND Logical_Table_ID="'.$tablename.'"' ;
            $getfiledname = $model->getLogicalTabledata('LogicalDefinitionTableLanguage', $where, $data = "Field_name,Field_no");
            $form1 = '<div class="listconfigul"><ul><li><span class="filed_logical">Language</span><input class="form-control" type="text" value="" id="language"></li>
            <li><span class="filed_logical">Title</span><input class="form-control" type="text" value="" id="title"></li>
            <li><span class="filed_logical">List_Name</span><input  class="form-control" type="text" value="" id="listname"></li></ul>
           </div><ul id="sortable1" class="connectedSortable"><span class="filed_logical">Fields of Logical Table</span>';
            foreach ($getfiledname as $key => $filed)
            {

                $form1 .= '<li rel="' . $key . '" class="ui-state-default"><span>' . $filed['Field_no'] . ') ' . $filed['Field_name'] . '</span><input type="hidden" value="' . $filed['Field_no'] . '" name="tfiledno" id="tfiledno'.$key.'"></li> 
                ';

            }

            $form1 .= '</ul>
          <ul id="sortable2" class="connectedSortable"><span class="filed_confi">Fields of List configuration</span></ul>';
       
          $form1 .= '<input type="hidden" value="'.$tablename.'" id="tablename"><input type="hidden" value="" id="ListConfiguration_ID">
          
          
          <div class="creat_table_btn"><button onclick="savelistcongtable()">Save List</button></div>';
       
           
            $response = array(
                "status" => true,
                "message" => 'success',
                "data" => $form1
            );
        echo json_encode($response);
        die;
    }    
      
      public function savelistcongtable()
    {

        $menumodel = $this->model("Menu_model");
        $model = $this->model("Dynamic_model");
        $cid = get_session('company_ID');
        $email = get_session('useremail');

        //Get header token
        $allheader = getallheaders();
        $auth_token = !empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With'] : '';
        $token_data = decode($auth_token);
        $jsondata = json_decode($token_data);
        $final_token = !empty($jsondata->Token) ? $jsondata->Token : '';

        $where = "Company_ID= ? AND User_email_address=?";
        $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*", $prepare = 'is', $cid, $email);
        $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token'] : '';
        //Match header token
        if ($Header_Token != $final_token)
        {
            $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );
            echo json_encode($response);
            exit;
        }


        $tablename = $_POST["tablename"];
        $language = $_POST["language"];
        $listname = $_POST["listname"];
        $title = $_POST["title"];
        $filednoArray = $_POST["filednoArray"]; 
        $filed_name = explode(',',$filednoArray);
        $No_Show_Field=count($filed_name);
        date_default_timezone_set('Asia/Kolkata');
        $date = date('yy-m-d h:i:s');
        $REC_create_datetime = $date;
        $REC_lastUpdate_datetime = $date;
        $REC_lastUpdate_by = 'System';
        $REC_status = '1';
        $tablename1='listconfiguration';
        $columnname1=array("List_Name"=>$listname,"No_Show_Field"=>$No_Show_Field,"Shown_Field"=>$filednoArray,"Logical_Table_Name"=>$tablename,"REC_create_datetime"=>$REC_create_datetime,"REC_lastUpdate_datetime"=>$REC_lastUpdate_datetime,"REC_lastUpdate_by"=>$REC_lastUpdate_by,"REC_status"=>$REC_status);
        /*  <!-- Insert Script For Company Table Start -->*/ 
       $result1 = $model->last_insert_data($tablename1, $columnname1);
       $tablename ='listconfigurationlanguage';
       $columnname=array("ListConfiguration_ID"=>$result1,"Language"=>$language,"Title"=>$title,"REC_create_datetime"=>$REC_create_datetime,"REC_lastUpdate_datetime"=>$REC_lastUpdate_datetime,"REC_lastUpdate_by"=>$REC_lastUpdate_by,"REC_status"=>$REC_status);
           $result = $model->insert_data($tablename, $columnname);
            if ($result === 1)
            { 
                $response = array(
                    "status" => true,
                    "message" => "Successfull Insert List Configuration",
                    "data" => 'success',
                );

            }
            else
            {
                   $response = array(
                    "status" => false,
                    "message" => "Please Check", 
                    "data" => 'false',
                );
                
            }

        

        echo json_encode($response);
        die;
    }



           public function createformconftable()
    {

        $menumodel = $this->model("Menu_model");
        $model = $this->model("Dynamic_model");

        $cid = get_session('company_ID');
        $email = get_session('useremail');

        //Get header token
        $allheader = getallheaders();
        $auth_token = !empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With'] : '';
        $token_data = decode($auth_token);
        $jsondata = json_decode($token_data);
        $final_token = !empty($jsondata->Token) ? $jsondata->Token : '';
        $where = "Company_ID= ? AND User_email_address=?";
        $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*", $prepare = 'is', $cid, $email);
        $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token'] : '';
        //Match header token
        if ($Header_Token != $final_token)
        {
            $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );
            echo json_encode($response);
            exit;
        }

            $where = 'REC_status=1';
            $getfiledname = $model->getFormconfigTabledata();
             $table = '<table class="table table-striped table-bordered"  id="example" width="100%" cellspacing="0">
                        <thead>
                            <tr>';
             $table .= '<th>S No.</th><th>Logical Table Name</th><th>No Show Field</th><th>Show Filed</th><th>Language</th>  
                         <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>';
                    $i=1;        
                    foreach ($getfiledname as $column)
                    {

                        $table .= '<tr><td class="text-center"> ' . $i . ' </td>';
                        $table .= '<td class="text-center"> ' . $column['Logical_Table_Name'] . ' </td>';
                        $table .= '<td class="text-center"> ' . $column['No_Show_Field']. ' </td>';
                        $table .= '<td class="text-center"> ' . $column['Shown_Field']. ' </td>';
                         $table .= '<td class="text-center"> ' . $column['Language'] . ' </td>';
                    $i++;

                    $table .= '<td class="text-center">
                            <a  href="#" onclick="getformvalue(\'' .$column['Logical_Table_Name'] . '\',\'' . $column['FormConfiguration_ID'] . '\',\'' . $column['Shown_Field'] . '\',\'' . $column['No_Show_Field'] . '\');"><i class="fa fa-edit"></i></a>
                    <a href="#" onclick="deleteformconfigdata(\'' . $column['FormConfiguration_ID'] . '\')"><i class="fa fa-trash"></i></a>
                            </td></tr>';
                        }
      
                

                $table .= '</tbody>';
                $table .= '<a href="#" class="add_button" onclick="addformconfigformenater();">+</a>'; 
                $table .= '</table>';
                $table .= '<script>$("#example").dataTable();</script>';                    

            $response = array(
                "status" => true,
                "message" => 'success',
                "data" => $table
            );
        echo json_encode($response);
        die;
    }



     public function createformconfigformenater()
    { 
 
    
        $menumodel = $this->model("Menu_model");
        $model = $this->model("Dynamic_model");

        $cid = get_session('company_ID');
        $email = get_session('useremail');

        //Get header token
        $allheader = getallheaders();
        $auth_token = !empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With'] : '';
        $token_data = decode($auth_token);
        $jsondata = json_decode($token_data);
        $final_token = !empty($jsondata->Token) ? $jsondata->Token : '';

        $where = "Company_ID= ? AND User_email_address=?";
        $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*", $prepare = 'is', $cid, $email);
        $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token'] : '';
        //Match header token
        if ($Header_Token != $final_token)
        {
            $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );
            echo json_encode($response);
            exit;
        }

        
        
        $form1 = '<form  method="post" id="adddata" ata-parsley-validate="">';
         $form1 .= '<div class="col-md-12">
                          <div class="form-group">';
         $form1 .= '<select name="logicaltname" id="logicaltname" onchange="getformlogicaltablevalue();" class="form-control"><option name="0">Logical Table Name</option>';
         $where = 'REC_status=1';
          $getlogicaltablename = $model->getLogicalTabledata('LogicalTable', $where, $data = "Logical_Table_Name,Logical_Table_ID");
             foreach ($getlogicaltablename as  $tname)
            {
             $form1 .= '<option value="'.$tname['Logical_Table_ID'].'">'.$tname['Logical_Table_Name'].'</option>';
            }
           $form1 .= '</select></div></div></form>';

        $response = array(
            "status" => true,
            "message" => "success",
            "data" => $form1
        );

        echo json_encode($response);
        die;
    }
    

public function getformconfigtablevalue()
    {

        $menumodel = $this->model("Menu_model");
        $model = $this->model("Dynamic_model");

        $cid = get_session('company_ID');
        $email = get_session('useremail');

        //Get header token
        $allheader = getallheaders();
        $auth_token = !empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With'] : '';
        $token_data = decode($auth_token);
        $jsondata = json_decode($token_data);
        $final_token = !empty($jsondata->Token) ? $jsondata->Token : '';
        $where = "Company_ID= ? AND User_email_address=?";
        $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*", $prepare = 'is', $cid, $email);
        $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token'] : '';
        //Match header token
        if ($Header_Token != $final_token)
        {
            $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );
            echo json_encode($response);
            exit;
        }
            $tablename = $_POST["tablename"];
            $where = 'REC_status=1 AND Logical_Table_ID="'.$tablename.'"' ;
            $getfiledname = $model->getLogicalTabledata('LogicalDefinitionTableLanguage', $where, $data = "Field_name,Field_no");
            $form1 = '<div class="listconfigul"><ul><li><span class="filed_logical">Language</span><input class="form-control" type="text" value="" id="language"></li>
            <li><span class="filed_logical">Title</span><input class="form-control" type="text" value="" id="title"></li>
            <li><span class="filed_logical">List_Name</span><input  class="form-control" type="text" value="" id="listname"></li></ul>
           </div><ul id="sortable1" class="connectedSortable"><span class="filed_logical">Fields of Logical Table</span>';
            foreach ($getfiledname as $key => $filed)
            {

                $form1 .= '<li rel="' . $key . '" class="ui-state-default"><span>' . $filed['Field_no'] . ') ' . $filed['Field_name'] . '</span><input type="hidden" value="' . $filed['Field_no'] . '" name="tfiledno" id="tfiledno'.$key.'"></li> 
                ';

            }

            $form1 .= '</ul>
          <ul id="sortable2" class="connectedSortable"><span class="filed_confi">Fields of Form configuration</span></ul>';
       
          $form1 .= '<input type="hidden" value="'.$tablename.'" id="tablename"><input type="hidden" value="" id="ListConfiguration_ID">
          
          
          <div class="creat_table_btn"><button onclick="saveformcongtable()">Save List</button></div>';
       
           
            $response = array(
                "status" => true,
                "message" => 'success',
                "data" => $form1
            );
        echo json_encode($response);
        die;
    }    
      




    public function saveformcongtable()
    {

        $menumodel = $this->model("Menu_model");
        $model = $this->model("Dynamic_model");
        $cid = get_session('company_ID');
        $email = get_session('useremail');

        //Get header token
        $allheader = getallheaders();
        $auth_token = !empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With'] : '';
        $token_data = decode($auth_token);
        $jsondata = json_decode($token_data);
        $final_token = !empty($jsondata->Token) ? $jsondata->Token : '';

        $where = "Company_ID= ? AND User_email_address=?";
        $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*", $prepare = 'is', $cid, $email);
        $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token'] : '';
        //Match header token
        if ($Header_Token != $final_token)
        {
            $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );
            echo json_encode($response);
            exit;
        }


        $tablename = $_POST["tablename"];
        $language = $_POST["language"];
        $listname = $_POST["listname"];
        $title = $_POST["title"];
        $filednoArray = $_POST["filednoArray"]; 
        $filed_name = explode(',',$filednoArray);
        $No_Show_Field=count($filed_name);
        date_default_timezone_set('Asia/Kolkata');
        $date = date('yy-m-d h:i:s');
        $REC_create_datetime = $date;
        $REC_lastUpdate_datetime = $date;
        $REC_lastUpdate_by = 'System';
        $REC_status = '1';
        $tablename1='formconfiguration';
        $columnname1=array("Form_Name"=>$listname,"No_Show_Field"=>$No_Show_Field,"Shown_Field"=>$filednoArray,"Logical_Table_Name"=>$tablename,"REC_create_datetime"=>$REC_create_datetime,"REC_lastUpdate_datetime"=>$REC_lastUpdate_datetime,"REC_lastUpdate_by"=>$REC_lastUpdate_by,"REC_status"=>$REC_status);
        /*  <!-- Insert Script For Company Table Start -->*/ 
       $result1 = $model->last_insert_data($tablename1, $columnname1);
       $tablename ='formconfigurationlanguage';
       $columnname=array("FormConfiguration_ID"=>$result1,"Language"=>$language,"Title"=>$title,"REC_create_datetime"=>$REC_create_datetime,"REC_lastUpdate_datetime"=>$REC_lastUpdate_datetime,"REC_lastUpdate_by"=>$REC_lastUpdate_by,"REC_status"=>$REC_status);
           $result = $model->insert_data($tablename, $columnname);
            if ($result === 1)
            { 
                $response = array(
                    "status" => true,
                    "message" => "Successfull Insert Form Configuration",
                    "data" => 'success',
                );

            }
            else
            {
                   $response = array(
                    "status" => false,
                    "message" => "Please Check", 
                    "data" => 'false',
                );
                
            }

        

        echo json_encode($response);
        die;
    }


         public function deleteformconfigdata()
    {
        $menumodel = $this->model("Menu_model");
        $model = $this->model("Dynamic_model");
        $cid = get_session('company_ID');
        $email = get_session('useremail');

        //Get header token
        $allheader = getallheaders();
        $auth_token = !empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With'] : '';
        $token_data = decode($auth_token);
        $jsondata = json_decode($token_data);
        $final_token = !empty($jsondata->Token) ? $jsondata->Token : '';

        $where = "Company_ID= ? AND User_email_address=?";
        $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*", $prepare = 'is', $cid, $email);
        $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token'] : '';
        //Match header token
        if ($Header_Token != $final_token)
        {
            $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );
            echo json_encode($response);
            exit;
        }

        $id = $_POST['id'];
        $tablename='formconfiguration';
        $tablename1='formconfigurationlanguage';
        $where = array(
            "FormConfiguration_ID" => "$id"
        );
     
        $result1 = $model->deletedata($tablename1, $where);
        $result = $model->deletedata($tablename, $where);
    
        if ($result1== '1')
        {
            $response = array(
                "status" => true,
                "message" => "Delete SuccessFully",
                "data" => ''
            );
        }
        else
        {
            $response = array(
                "status" => false,
                "message" => "error",
                "data" => ''
            );
        }
        echo json_encode($response);
        die;
    }



     public function addformconfigtable()
    {

        $menumodel = $this->model("Menu_model");
        $model = $this->model("Dynamic_model");

        $cid = get_session('company_ID');
        $email = get_session('useremail');

        //Get header token
        $allheader = getallheaders();
        $auth_token = !empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With'] : '';
        $token_data = decode($auth_token);
        $jsondata = json_decode($token_data);
        $final_token = !empty($jsondata->Token) ? $jsondata->Token : '';
        $where = "Company_ID= ? AND User_email_address=?";
        $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*", $prepare = 'is', $cid, $email);
        $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token'] : '';
        //Match header token
        if ($Header_Token != $final_token)
        {
            $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );
            echo json_encode($response);
            exit;
        }
            $tablename = $_POST["tablename"];
            $id = $_POST["id"];
            $Shown_Field = $_POST["Shown_Field"];
            $No_Show_Field = $_POST["No_Show_Field"];
            $ShownField = explode(',',$Shown_Field);
            $where = 'REC_status=1 AND Logical_Table_ID="'.$id.'"' ;
            $getfiledname = $model->getLogicalTabledata('LogicalDefinitionTableLanguage', $where, $data = "Field_name,Field_no");
            $form1 = '<div><span class="filed_logical">'.$tablename.'</span></div><ul id="sortable1" class="connectedSortable"><span class="filed_logical">Fields of Logical Table</span>';
            foreach ($getfiledname as $key => $filed)
            {

                $form1 .= '<li rel="' . $key . '" class="ui-state-default"><span>' . $filed['Field_no'] . ') ' . $filed['Field_name'] . '</span><input type="hidden" value="' . $filed['Field_no'] . '" name="tfiledno" id="tfiledno'.$key.'"></li> 
                ';

            }

            $form1 .= '</ul>
          <ul id="sortable2" class="connectedSortable"><span class="filed_confi">Fields of Form configuration</span>';
                   $k=0; 
           
              foreach ($getfiledname as $key => $filed)
            {       
 
                      if($filed['Field_no'] == $ShownField[$k]){
                          $form1 .= '<li  class="ui-state-default"><span>'.$ShownField[$k].') ' . $filed['Field_name'] . '</span><input type="hidden" value="' . $ShownField[$k] . '" name="tfiledno" ></li> ';      
                       }else{
        $form1 .= '<li  class="ui-state-default"><span>'.$ShownField[$k].') ' . $filed['Field_name'] . '</span><input type="hidden" value="' . $ShownField[$k] . '" name="tfiledno" ></li> ';         
                       }


             $k++;}
          $form1 .= '</ul>';
       
          $form1 .= '<input type="hidden" value="'.$tablename.'" id="tablename"><input type="hidden" value="'.$id.'" id="FormConfiguration_ID">
          
          
          <div class="creat_table_btn"><button onclick="editupdateformcong()">Update Field Form</button></div>';
       
           
            $response = array(
                "status" => true,
                "message" => 'success',
                "data" => $form1
            );
        echo json_encode($response);
        die;
    } 


        public function editFormConfiguration()
    {

        $menumodel = $this->model("Menu_model");
        $model = $this->model("Dynamic_model");
        $cid = get_session('company_ID');
        $email = get_session('useremail');

        //Get header token
        $allheader = getallheaders();
        $auth_token = !empty($allheader['X-Requested-With']) ? $allheader['X-Requested-With'] : '';
        $token_data = decode($auth_token);
        $jsondata = json_decode($token_data);
        $final_token = !empty($jsondata->Token) ? $jsondata->Token : '';

        $where = "Company_ID= ? AND User_email_address=?";
        $rowretrive = $model->getCompanyUserdata('CompanyUser', $where, $data = "*", $prepare = 'is', $cid, $email);
        $Header_Token = !empty($rowretrive[0]['Header_Token']) ? $rowretrive[0]['Header_Token'] : '';
        //Match header token
        if ($Header_Token != $final_token)
        {
            $errorMessage = GetSystemCode('317');
            $response = array(
                "status" => false,
                "message" => $errorMessage
            );
            echo json_encode($response);
            exit;
        }


        $tablename = $_POST["tablename"];
        $filedname = $_POST["filedname"];
        $id = $_POST["FormConfiguration_ID"];
        $filed_name = explode(',',$filedname);
        $No_Show_Field=count($filed_name);
        date_default_timezone_set('Asia/Kolkata');
        $date = date('yy-m-d h:i:s');
        $REC_create_datetime = $date;
        $REC_lastUpdate_datetime = $date;
        $REC_lastUpdate_by = 'System';
        $REC_status = '1';
        $tablename1='formconfiguration';
        $where=array("FormConfiguration_ID"=>$id,"REC_status"=>1);
        $columnname1=array("No_Show_Field"=>$No_Show_Field,"Shown_Field"=>$filedname,"REC_create_datetime"=>$REC_create_datetime,"REC_lastUpdate_datetime"=>$REC_lastUpdate_datetime,"REC_lastUpdate_by"=>$REC_lastUpdate_by,"REC_status"=>$REC_status);
        /*  <!-- Insert Script For Company Table Start -->*/ 
         $result1 = $model->updateRowWhere($tablename1,$where, $columnname1);
    
            if ($result1 === 1)
            { 
                $response = array(
                    "status" => true,
                    "message" => "Successfull Update",
                    "data" => 'success',
                );

            }
            else
            {
                   $response = array(
                    "status" => false,
                    "message" => "Please Check", 
                    "data" => 'false',
                );
                
            }

        

        echo json_encode($response);
        die;
    }   
    
}
?>
