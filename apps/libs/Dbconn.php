<?php
try {
    include_once('Config.php');
} catch (Exception $ex) {

}
class apps_libs_Dbconn
{
    private $user;
    private $pass;
    private $host;
    private $database;

    public $queryParam;

    public $conn;

    public function __construct()
    {
        $data = new apps_libs_Config();
        $this->user = $data->GetUser();
        $this->pass = $data->GetPass();
        $this->host = $data->GetHost();
        $this->database = $data->GetDatabase();
    }

    public function Connect()
    {
        if ($this->conn == null)
        {
            $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->database) or die('Loi ket noi');
            mysqli_set_charset($this->conn,"utf8");
        }
            
    }

    public function DisConnect()
    {
        if ($this->conn != null) {
            mysqli_close($this->conn);
            $this->conn = null;
        }
    }
    public function BuildParams($params)
    {
        $this->queryParam = null;
        $default = [
            "select" => "*",
            "from" => "",
            "where" => "",
            "limit" => "",
            "param" => ""
        ];
        $this->queryParam = array_merge($default, $params);
        return $this;
    }

    public function Querry($query)
    {
            //echo $query."<br/>";
        if ($this->conn == null) {
            $this->Connect();
            $result = mysqli_query($this->conn, $query);
            $this->DisConnect();
            return $result;
        }
        
        return null;
    }

    public function Select($params, $return = null)
    {
        $this->BuildParams($params);
        $query = "select " . $this->queryParam["select"] . " from " . $this->queryParam["from"];
        if ($this->queryParam["where"]) $query .= " where " . $this->queryParam["where"];
        if ($this->queryParam["limit"]) $query .= " limit " . $this->queryParam["limit"];
            
            //echo $query ."<br/>";
        if (!$return)
            return $this->Querry($query);
        else return $query;
    }

    public function SelectOne($params, $return = null)
    {
        $params["limit"] = "1";
        return $this->Select($params, $return);
    }

    public function Delete($params, $return = null)
    {
        $this->BuildParams($params);
        $query = "delete from " . $this->queryParam["from"];
        if ($this->queryParam["where"]) $query .= " where " . $this->queryParam["where"];
        else return null;
            //echo $query;
        if (!$return) {
            try {
                $this->SaveLog($query, $params, "delete");
            } catch (Exception $exception) {
            }
            return $this->Querry($query);
        } else return $query;
    }

    public function Insert($params, $return = null)
    {
        $this->BuildParams($params);
        $query = "insert into " . $this->queryParam["from"];
        $query .= "(" . $params["param"]["col"];
        $query .= ") values (";

        foreach ($params["param"]["data"] as &$item) {
            if ($this->CheackStringParam($item)) {
                $count = strlen($item);
                $item = substr($item, 1, $count - 2);
                $uti = new apps_libs_Utilities();
                $item = $uti->EditDataImportDB($item, false);
                $item = "'" . $item . "'";
            }
            $query .= $item . ",";
        }

        $query = trim($query, ",");
        $query .= ")";
        
            //echo $query;
        if (!$return) {
            try {
                $this->SaveLog($query, $params, "insert");
            } catch (Exception $exception) {
            }
            return $this->Querry($query);
        } else return $query;
    }

    public function Update($params, $return = null)
    {
        $this->BuildParams($params);
        $query = "update " . $this->queryParam["from"] . " set ";
        $dem = 0;
        foreach ($this->queryParam['param']['col'] as $item) {
            if ($this->CheackStringParam($params['param']['data'][$dem])) {
                $count = strlen($params['param']['data'][$dem]);
                $params['param']['data'][$dem] = substr($params['param']['data'][$dem], 1, $count - 2);
                $uti = new apps_libs_Utilities();
                $params['param']['data'][$dem] = $uti->EditDataImportDB($params['param']['data'][$dem], false);
                $params['param']['data'][$dem] = "'" . $params['param']['data'][$dem] . "'";
            }
            $query .= $item . '=' . $params['param']['data'][$dem] . ',';
            $dem++;
        }
        $query = trim($query, ",");
        if ($this->queryParam['where'])
            $query .= " where " . $this->queryParam['where'];

        if (!$return) {
            try {
                $this->SaveLog($query, $params, "update");
            } catch (Exception $exception) {
            }
            return $this->Querry($query);
        } else return $query;
    }

    public function CreateID($table, $nameCl, $count = 15)
    {
        $id = '';
        $result = null;
        $row = null;
        $chars = 'ABCD0123456789';
        do {//strlen($chars)
            $id = '';
            for ($i = 0; $i < $count; $i++) $id .= $chars[rand(0, strlen($chars) - 1)];
            $query = [
                "from" => $table,
                "select" => $nameCl,
                "where" => $nameCl . '=' . "'" . $id . "'"
            ];
            $result = $this->SelectOne($query);
            $row = mysqli_fetch_assoc($result);

        } while ($row != null);
            //echo $id;
        return $id;
    }

    private function CheackStringParam($string)
    {
        if (is_numeric($string)) return false;
        $count = strlen($string);
        if (($string[0] == "'" && $string[$count - 1] == "'") || ($string[0] == '"' && $string[$count - 1] == '"'))
            return true;
        return false;
    }

    public function CheackValue($table, $nameCl, $valueCl)
    {
        if ($this->CheackStringParam($valueCl)) {
            $count = strlen($valueCl);
            $valueCl = substr($valueCl, 1, $count - 2);
            $uti = new apps_libs_Utilities();
            $valueCl = $uti->EditDataImportDB($valueCl, false);
            $valueCl = "'" . $valueCl . "'";
        }
        $param = [
            "select" => $nameCl,
            "from" => $table,
            "where" => $nameCl . "=" . $valueCl
        ];
        $result = $this->SelectOne($param);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if (isset($row[$nameCl])) return true;
            else return false;
        }
        return false;
    }

    public function CheackTable($name)
    {
        $query = 'select * from ' . $name;
        $result = $this->Querry($query);
        if ($result) return true;
        return false;
    }
    public function GetValue($table, $nameCl, $where)
    {
        $param = [
            "select" => $nameCl,
            "from" => $table,
            "where" => $where
        ];
            //echo $table;
        $result = $this->SelectOne($param);
        if ($result) return mysqli_fetch_assoc($result)[$nameCl];
        return null;
    }

    private function SaveLog($query, $param, $type)
    {
        $config = new apps_libs_Config();
        if ($config->GetSaveLog()) {
            $uti = new apps_libs_Utilities();
            $id = $this->CreateID("tb_log", "id", 30);
            $acc = new apps_libs_UserLogin();
            $id_acc = $acc->GetAcc();

            $query = $uti->EditDataImportDB($query, false);
            $query_in = "INSERT INTO tb_log(id, id_acc, type,tables, query, time) VALUES ('$id','$id_acc','$type','" . $param["from"] . "','$query',NOW())";

            $this->Querry($query_in);

            if ($type == "insert") {
                $col_list = explode(",", $param["param"]["col"]);
                $value_list = $param["param"]["data"];

                $count = sizeof($col_list);
                for ($i = 0; $i < $count; $i++) {
                    $value = $uti->EditDataImportDB($value_list[$i], false);
                    $query_in = "INSERT INTO tb_log_list(id_log, colum_name, value_colum) VALUES ('$id','" . $col_list[$i] . "','$value')";
                    $this->Querry($query_in);
                }
            } else if ($type == "update") {
                $col_list = $param["param"]["col"];
                $value_list = $param["param"]["data"];

                $count = sizeof($col_list);
                for ($i = 0; $i < $count; $i++) {
                    $value = $uti->EditDataImportDB($value_list[$i], false);
                    $query_in = "INSERT INTO tb_log_list(id_log, colum_name, value_colum) VALUES ('$id','" . $col_list[$i] . "','$value')";
                    $this->Querry($query_in);
                }
            } else if ($type == "delete") {
                $col_list = "where";
                $value_list = $param['where'];

                $value = $uti->EditDataImportDB($value_list, false);
                $query_in = "INSERT INTO tb_log_list(id_log, colum_name, value_colum) VALUES ('$id','" . $col_list . "','$value')";
                $this->Querry($query_in);
            }

        }
    }
}
?>