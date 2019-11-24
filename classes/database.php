<?php

define("DB_HOST", "127.0.0.1");
define("DB_USER", "root");
define("DB_PASS", "");



class Database
{
    public $conn;

    public function Open($database)
    {
        $this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, $database);
        if($this->conn)
            return true;
        else
            return false;
    }

    public function Escape($string)
    {
        return mysqli_real_escape_string($this->conn, $string);
    }

    public function Execute($sql)
    {
        $result = mysqli_query($this->conn, $sql);
        if(mysql_affected_rows($result)) {
            return true;
        } else {
            return false;
        }
    }

    public function Query($sql)
    {
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }


    public function QueryToJson($query)
    {
        $jsonData = array();
        while ($array = mysqli_fetch_assoc($query)) {
            $jsonData[] = $array;
        }

        return json_encode($jsonData);
    }

    public function QueroToArray($query)
    {
        return mysqli_fetch_all($query);
    }

    public function RowsQuery($query)
    {
        return mysqli_num_rows($query);
    }

    public function Close()
    {
        if(isset($this->conn)) {
            mysqli_close($this->conn);
        }
    }

}



?>