<?php
namespace application\classes;
use PDO;
use PDOException;
use application\models\User;
use Exception;

class User{
    function getUserDetails($request, $response, $args){
        
        try{
            $data = [];
            $data  = User::getDetails();
            return $response->withStatus(200)->write(json_encode($data));
        
        }catch(Exception $e){
            $error = [
                'message' => $e->getMessage()
            ];
        
            return $response->withStatus(500)->write(json_encode($error));
        
        }
    }
}
?>