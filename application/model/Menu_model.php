<?php
//require "application/Config.php";
class Menu_model
{
    public function Database()
    {

        $obj = new Config();
        return $obj->connect();
    }

    public function getlistgenerator($table, $condition = "", $data = "", $limit = "", $offset = "", $orderby = "", $ordertype = "ASC", $prepare = '', $parameter, $Language, $REC_status)
    {

        $db = $this->Database();
        $query = "select $data from $table ListConfiguration INNER JOIN ListConfigurationLanguage ON ListConfiguration.ListConfiguration_ID = ListConfigurationLanguage.ListConfiguration_ID INNER JOIN LogicalTable on ListConfiguration.Logical_Table_Name= LogicalTable.Logical_Table_Name INNER JOIN LogicalDefinitionTable ON LogicalDefinitionTable.Logical_Table_ID =LogicalTable.Logical_Table_ID INNER JOIN LogicalDefinitionTableLanguage ON LogicalDefinitionTableLanguage.Logical_Table_ID= LogicalDefinitionTable.Logical_Table_ID";
        //for where
        $wcount = 0;
        $where = '';
        if (!empty($condition))
        {
            $query .= " where $condition";
        }

        $stmt = $db->prepare($query);
        $stmt->bind_param("$prepare", $parameter, $Language, $Language, $REC_status, $REC_status, $REC_status, $REC_status, $REC_status);
        $stmt->execute();
        $result = $stmt->get_result();
        $result1 = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result1;

    }

    public function getlistgeneratorheading($table, $condition = "", $data = "", $limit = "", $offset = "", $orderby = "", $ordertype = "ASC", $prepare = '', $TableName, $Language, $REC_status, $row1)
    {

        $db = $this->Database();
        $query = "select $data from $table LEFT JOIN LogicalDefinitionTableLanguage ON (LogicalDefinitionTable.Logical_Table_ID = LogicalDefinitionTableLanguage.Logical_Table_ID AND LogicalDefinitionTable.Field_no = LogicalDefinitionTableLanguage.Field_no) LEFT JOIN LogicalTable ON LogicalTable.Logical_Table_ID = LogicalDefinitionTable.Logical_Table_ID";
        //for where
        $wcount = 0;
        $where = '';
        if (!empty($condition))
        {
            $query .= " where $condition";
        }

        $stmt = $db->prepare($query);
        $stmt->bind_param("$prepare", $TableName, $row1, $Language, $REC_status, $REC_status);
        $stmt->execute();
        $result = $stmt->get_result();
        $result1 = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result1;

    }

    public function gettablecolnameresult($table, $condition = "", $data = "", $limit = "", $offset = "", $orderby = "", $ordertype = "ASC", $prepare = '', $tablescema, $TableName)
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
        $stmt->bind_param("$prepare", $tablescema, $TableName);
        $stmt->execute();
        $result = $stmt->get_result();
        $result1 = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result1;

    }

    public function getfiledname($table, $condition = "", $data = "", $limit = "", $offset = "", $orderby = "", $ordertype = "ASC", $prepare = '', $REC_status)
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
        $stmt->bind_param("$prepare", $REC_status);
        $stmt->execute();
        $result = $stmt->get_result();
        $result1 = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result1;

    }

    public function getformenater($table, $condition = "", $data = "", $limit = "", $offset = "", $orderby = "", $ordertype = "ASC", $prepare = '', $parameter, $tablename, $Language, $REC_status)
    {

        $db = $this->Database();
        $query = "select $data from $table INNER JOIN FormConfigurationLanguage ON FormConfiguration.FormConfiguration_ID = FormConfigurationLanguage.FormConfiguration_ID INNER JOIN LogicalTable on FormConfiguration.Logical_Table_Name= LogicalTable.Logical_Table_Name INNER JOIN LogicalDefinitionTable ON LogicalDefinitionTable.Logical_Table_ID =LogicalTable.Logical_Table_ID INNER JOIN LogicalDefinitionTableLanguage ON LogicalDefinitionTableLanguage.Logical_Table_ID= LogicalDefinitionTable.Logical_Table_ID";
        //for where
        $wcount = 0;
        $where = '';
        if (!empty($condition))
        {
            $query .= " where $condition";
        }

        $stmt = $db->prepare($query);
        $stmt->bind_param("$prepare", $parameter, $Language, $Language, $REC_status, $REC_status, $REC_status, $REC_status, $REC_status);
        $stmt->execute();
        $result = $stmt->get_result();
        $result1 = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result1;

    }

    public function checkvalidation($table, $condition = "", $data = "", $limit = "", $offset = "", $orderby = "", $ordertype = "ASC", $prepare = '', $Language, $TableName, $REC_status, $row1)
    {

        $db = $this->Database();
        $query = "select $data from $table LEFT JOIN LogicalDefinitionTableLanguage ON (LogicalDefinitionTable.Logical_Table_ID = LogicalDefinitionTableLanguage.Logical_Table_ID AND LogicalDefinitionTable.Field_no = LogicalDefinitionTableLanguage.Field_no) LEFT JOIN LogicalTable ON LogicalTable.Logical_Table_ID = LogicalDefinitionTable.Logical_Table_ID";
        //for where
        $wcount = 0;
        $where = '';
        if (!empty($condition))
        {
            $query .= " where $condition";
        }

        $stmt = $db->prepare($query);
        $stmt->bind_param("$prepare", $TableName, $row1, $Language, $REC_status, $REC_status);
        $stmt->execute();
        $result = $stmt->get_result();
        $result1 = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $result1;

    }

    public function insert_data($tablename, $columnname1, $capture_field_vals, $REC_create_datetime, $REC_lastUpdate_datetime, $REC_lastUpdate_by, $REC_status)
    {

        $db = $this->Database();
        $query = "INSERT INTO $tablename ($columnname1,REC_create_datetime,REC_lastUpdate_datetime,REC_lastUpdate_by,REC_status)values('" . $capture_field_vals . "" . $REC_create_datetime . "','" . $REC_lastUpdate_datetime . "','" . $REC_lastUpdate_by . "','" . $REC_status . "')";
        $sql = mysqli_query($db, $query);

        return true;
    }

}

