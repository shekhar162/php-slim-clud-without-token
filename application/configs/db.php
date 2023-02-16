<?php
namespace application\configs;

use PDO;
class DB{
    public static $user   = 'root';
    public static $pass   = '';
    public static $connection = null;

    public static function connect(){
        $conStr = "mysql:host=localhost;dbname=slim37";
        self::$connection = new PDO($conStr, self::$user, self::$pass);
        self::$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return self::$connection;
    }

    public static function getDbConnection(){
        if (isset(self::$connection) && self::$connection instanceof DB) {
            return self::$connection;
        } else {
            self::connect();
        }
        return self::$connection;
    }

    public static function getRecords($atble, $limit = null){
        $data = [];
        $connection  = self::getDbConnection();

        $query = null;
        $query = "SELECT * from ".$atble;
        $stmt = $connection->query($query);
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        return $data;

    }

    public static function getSpecificRecords($table, $wheres = [], $limit){
        $data = [];
        $connection  = self::getDbConnection();

        $query = null;
        $query = "select * from ".$table;

        $whereStr = null;
        if(!empty($wheres)){
            foreach ($wheres as $key => $value) {
                $whereStr .= $key . "='".$value."' and ";
            }unset($value);
        }
        if($whereStr){
            $whereClause = null;
            $whereClause = substr($whereStr, 0, -5);
            $query .= ' Where '.$whereClause;
        }

        $stmt = $connection->query($query);
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        return $data;
    }

    public static function getQueryRecords($query){
        $data = [];
        $connection  = self::getDbConnection();
        $stmt = $connection->query($query);
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        return $data;

    }

    public static function addRecords($table, $request){
        $result = false;
        $dataArr = [];
        $dataArr = $request->getParsedBody();
        
        if(isset($dataArr) && !empty($dataArr)){
            foreach ($dataArr as $key=>$value){
                $tblKey[] = $key;
                $tblVal[$key] = $value;
                $bindKey[] = ':'.$key;
            }unset($value);

            $query = null;
            $query = 'Insert into '.$table.'('.implode(',',$tblKey).') values ('.implode(',',$bindKey).')';
            $connection  = self::getDbConnection();
            $stmt = $connection->prepare($query);
            
            $result = $stmt->execute($tblVal);
        }
        return $result;
    }

    public static function updateRecords($table, $request){
        $result = false;
        $dataArr = [];
        $dataArr = $request->getParsedBody();
        
        if(isset($dataArr['identifier'])  && isset($dataArr['data']) && !empty($dataArr['identifier'])){
            foreach ($dataArr['data'] as $key=>$value){
                $bindKey[] = $key."='".$value."'";
            }unset($value);

            $whereStr = null;
            foreach ($dataArr['identifier'] as $key=>$value){
                $whereStr .= $key . "='".$value."' and ";
            }unset($value);

            $query = null;
            $query = "UPDATE ".$table." SET ".implode(' ',$bindKey);

            if($whereStr){
                $whereClause = null;
                $whereClause = substr($whereStr, 0, -5);
                $query .= ' where '.$whereClause;
            }
            
            $connection  = self::getDbConnection();
            $stmt = $connection->prepare($query);
            
            $result = $stmt->execute();
        }
        return $result;
    }

    public static function deleteRecord($table, $whereClause){
        $result = false;

        $query = null;
        $query = 'delete from '.$table.' '.$whereClause;

        $connection  = self::getDbConnection();
        $stmt = $connection->prepare($query);
        $stmt->execute();

        $result = $stmt->rowCount();
        return $result;
    }

}

?>