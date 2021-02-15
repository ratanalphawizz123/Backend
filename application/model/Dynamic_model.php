<?php
//require "application/Config.php";
class Dynamic_model
{
    public function Database()
    {

        $obj = new Config();
        return $obj->connect();
    }

    public function insert_data($table, $data)
    {
        $db = $this->Database();
        $count = 0;
        $fields = '';
        foreach ($data as $col => $val)
        {
            if ($count++ != 0) $fields .= ', ';
            $col = addslashes($col);
            $val = addslashes($val);
            $fields .= "`$col` = '$val'";
        }
          $query = "INSERT INTO $table SET $fields";
         mysqli_query($db, $query);
         $insert_status = mysqli_affected_rows($db);
         
        return $insert_status;
      
    }

  public function last_insert_data($table, $data)
    {
        $db = $this->Database();
        $count = 0;
        $fields = '';
        foreach ($data as $col => $val)
        {
            if ($count++ != 0) $fields .= ', ';
            $col = addslashes($col);
            $val = addslashes($val);
            $fields .= "`$col` = '$val'";
        }
          $query = "INSERT INTO $table SET $fields";
         mysqli_query($db, $query);
         $last_id = mysqli_insert_id($db);
        return (!empty($last_id)) ? $last_id : '';
      
    }



    public function deletedata($table = null, $whereData = array())
    {
        $db = $this->Database();
        //for where
        $wcount = 0;
        $where = '';
        foreach ($whereData as $wcol => $wheval)
        {
            $wcol = addslashes($wcol);
            $wval = addslashes($wheval);
            $where .= "`$wcol` = '$wval' AND ";

        }
          $query = "DELETE FROM  $table WHERE $where 1=1";
      
        mysqli_query($db, $query);
       $delete_status = mysqli_affected_rows($db);
        return $delete_status;
    }

    public function updateRowWhere($table, $whereData = "", $data = "")
    {
        $db = $this->Database();
        $count = 0;
        $fields = '';
        foreach ($data as $col => $val)
        {
            if ($count++ != 0) $fields .= ', ';
            $col = addslashes($col);
            $val = addslashes($val);
            $fields .= "`$col` = '$val'";
        }
        //for where
        $wcount = 0;
        $where = '';
        foreach ($whereData as $wcol => $wheval)
        {
            $wcol = addslashes($wcol);
            $wval = addslashes($wheval);
            $where .= "`$wcol` = '$wval' AND ";

        }
         $query = "UPDATE $table SET $fields where $where 1=1";

        mysqli_query($db, $query);
        $updated_status = mysqli_affected_rows($db);
        return $updated_status;

    }
    /*************** Get Table Data *******************/
    public function getdatafromtable($table, $condition = array() , $data = "*", $limit = "", $offset = "", $orderby = "", $ordertype = "ASC", $prepare = '')
    {

        $db = $this->Database();
        $query = "select $data from $table";

        //for where
        $wcount = 0;
        $where = '';
        if (!empty($condition))
        {
            // echo "hi";die;
            foreach ($condition as $wcol => $wheval)
            {
                $wcol = addslashes($wcol);
                $wval = addslashes($wheval);
                $where .= "`$wcol` = '$wval' AND ";

            }
            $query .= " where $where 1=1";
        }
        if ($limit != '')
        {
            $query .= "limit $limit, $offset";
        }
        if ($orderby != '')
        {
            $query .= "order by $orderby $ordertype";
        }

        // echo $query;die;
        // 		 $stmt = $db->prepare($query);
        //         $stmt->bind_param($prepare, $companycode);
        //         $stmt->execute();
        //         $result = $stmt->get_result();
        //         print_r($result);die;
        $result = mysqli_query($db, $query);
        if ($result->num_rows > 0)
        {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        else
        {
            return false;
        }
    }

    /*************** Get Table Data *******************/
    public function getdatafromtableorcondtion($table, $condition = "", $data = "*", $limit = "", $offset = "", $orderby = "", $ordertype = "ASC", $prepare = '')
    {

        $db = $this->Database();
        $query = "select $data from $table";

        //for where
        $wcount = 0;
        $where = '';
        if (!empty($condition))
        {
            // echo "hi";die;
            $query .= " where $condition";
        }
        if ($limit != '')
        {
            $query .= "limit $limit, $offset";
        }
        if ($orderby != '')
        {
            $query .= "order by $orderby $ordertype";
        }
        //echo $query;die;
        $result = mysqli_query($db, $query);
        if ($result->num_rows > 0)
        {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        else
        {
            return false;
        }
    }
    /*************** prepare function example *******************/
    public function getdatafromtableprepare($table, $condition = "", $data = "*", $limit = "", $offset = "", $orderby = "", $ordertype = "ASC", $prepare = '', $companycode, $REC_status)
    {

        $db = $this->Database();
        $query = "select $data from $table";

        //for where
        $wcount = 0;
        $where = '';
        if (!empty($condition))
        {
            $query .= " where $condition";
        }

        $stmt = $db->prepare($query);
        $stmt->bind_param($prepare, $companycode, $REC_status);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result1 = mysqli_fetch_all($result, MYSQLI_ASSOC);

    }
    /*************** prepare function example *******************/
    public function getCompanydata($table, $condition = "", $data = "*", $prepare = '', $company_id)
    {

        $db = $this->Database();
        $query = "select $data from $table";

        //for where
        $wcount = 0;
        $where = '';
        if (!empty($condition))
        {
            $query .= " where $condition";
        }

        $stmt = $db->prepare($query);
        $stmt->bind_param($prepare, $company_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result1 = mysqli_fetch_all($result, MYSQLI_ASSOC);

    }
    public function getCompanyUserdata($table, $condition = "", $data = "*", $prepare = '', $company_id = '', $email = '')
    {

        $db = $this->Database();
        $query = "select $data from $table";

        //for where
        $wcount = 0;
        $where = '';
        if (!empty($condition))
        {
            $query .= " where $condition";
        }

        $stmt = $db->prepare($query);
        $stmt->bind_param($prepare, $company_id, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result1 = mysqli_fetch_all($result, MYSQLI_ASSOC);

    }

    /*************** prepare update example *******************/
    public function updateDataPrepare($table, $condition = "", $updatedata = "", $prepare = "", $email, $companyId, $password, $Last5Passwords, $First_Login, $rec_datetime, $last_password_datetime, $cid)
    {

        $db = $this->Database();
        $query = "UPDATE  $table set $updatedata  where $condition";
        // echo $query;die;
        $stmt = $db->prepare($query);
        $stmt->bind_param('sssssiis', $password, $Last5Passwords, $First_Login, $rec_datetime, $last_password_datetime, $cid, $companyId, $email);
        $stmt->execute();
        return $stmt->affected_rows;

    }

    public function updateDefaultPassword($table, $condition = "", $updatedata = "", $prepare = "", $email, $companyId, $password, $Last5Passwords, $First_Login, $rec_datetime, $last_password_datetime, $cid)
    {

        $db = $this->Database();
        $query = "UPDATE  $table set $updatedata  where $condition";
        // echo $query;die;
        $stmt = $db->prepare($query);
        $stmt->bind_param('sssssiis', $password, $Last5Passwords, $First_Login, $rec_datetime, $last_password_datetime, $cid, $companyId, $email);
        $stmt->execute();
        return $stmt->affected_rows;

    }

    public function gettableexistsornot($table, $condition = "", $data = "")
    {

        $db = $this->Database();
        $query = "select $data from $table";

        //for where
        $wcount = 0;
        $where = '';
        if (!empty($condition))
        {
            $query .= " where $condition";
        }

        $result = mysqli_query($db, $query);

        if ($result->num_rows > 0)
        {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        else
        {
            return false;
        }

    }

    public function create_table($tablename, $id)
    {

        $db = $this->Database();
        $sql = "CREATE TABLE $tablename ($id)";
        $result = mysqli_query($db, $sql);
        return true;
    }

    public function rename_table($tablename, $rename)
    {

        $db = $this->Database();
        $sql = "RENAME TABLE $tablename TO $rename";
        $result = mysqli_query($db, $sql); 
        return true;
    }

    public function getLogicalDefinitionTabledata()
    {

         $db = $this->Database();
         $query = "select * from  LogicalDefinitionTableLanguage LEFT JOIN LogicalTable ON LogicalDefinitionTableLanguage.Logical_Table_ID=LogicalTable.Logical_Table_ID where LogicalTable.REC_status='1'";
         $result = mysqli_query($db, $query);

        if ($result->num_rows > 0)
        {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        else
        {
            return false;
        }

    }
      public function getLogicalTabledata($table, $condition = "", $data = "")
    {

        $db = $this->Database();
        $query = "select $data from $table";

        //for where
        $wcount = 0;
        $where = '';
        if (!empty($condition))
        {
             $query .= " where $condition";
        }

        $result = mysqli_query($db, $query);

        if ($result->num_rows > 0)
        {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        else
        {
            return false;
        }

    }
    
     public function getListconfigTabledata()
    {

         $db = $this->Database();
         $query = "select * from  ListConfiguration LEFT JOIN ListConfigurationLanguage ON ListConfigurationLanguage.ListConfiguration_ID=ListConfiguration.ListConfiguration_ID where ListConfiguration.REC_status='1'";
         $result = mysqli_query($db, $query);

        if ($result->num_rows > 0)
        {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        else
        {
            return false;
        }

    }

     public function getFormconfigTabledata()
    {

         $db = $this->Database();
         $query = "select * from  formconfiguration LEFT JOIN formconfigurationlanguage ON formconfigurationlanguage.FormConfiguration_ID=formconfiguration.FormConfiguration_ID where formconfiguration.REC_status='1'";
         $result = mysqli_query($db, $query);

        if ($result->num_rows > 0)
        {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        else
        {
            return false;
        }

    }
}

?>
