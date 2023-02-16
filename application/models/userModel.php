<?php
namespace application\models;
use PDO;
use PDOException;
use application\configs\DB;

class UserModel{
    public static $table = 'user';

    public static function getUserDetails(){
        $data = [];
        $data = DB::getRecords(self::$table, $limit = 100);
        return $data;
    }
    public static function postUserDetails($args){
        $dataArr = [];
        $dataArr = $args->getParsedBody();
        
        $data = [];
        $data = DB::getSpecificRecords(self::$table, $dataArr, $limit = 100);
        return $data;
    }
    
    public static function getUserDetailsById($args = []){
        $data = [];
        if(isset($args) &&  !empty($args)){
            $data = DB::getSpecificRecords(self::$table, $args, $limit = 100);
        }
        return $data;
    }

    public static function addUserDetails($args = []){
        $result = false;
        $result = DB::addRecords(self::$table, $args);
        return $result;
    }

    public static function updateUserDetails($args = []){
        $result = false;
        $result = DB::updateRecords(self::$table, $args);
        return $result;
    }

    

    public static function deleteUserDetailsById($args = []){
        $result = false;
        if(isset($args['id']) && $args['id'] !=''){
            $whereClause = null;
            $whereClause = 'where id='.$args['id'];
            $result = DB::deleteRecord(self::$table, $whereClause);
        }
        return $result;
    }
}
?>