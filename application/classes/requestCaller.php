<?php
namespace application\classes;

class RequestCaller{
    public static function callRequest($modelClassName, $method,$request, $response, $args){
        try {
            $params = [];
            if($request->getMethod() == 'POST' || $request->getMethod() == 'PUT'){
                $params = $request;
            }else{
                $params = $args;
            }

            $modelClass = null;
            $result = null;
            
            $modelClass = 'application\models\\'.$modelClassName;
            $result = $modelClass::$method($params);
            if($result){
                return $response->withStatus(200)->write(json_encode($result));
            }else{
                return $response->withStatus(200)->write(json_encode('Record not found.')); 
            }
            

        } catch (\Throwable $th) {
            return $response->withStatus(500)->write($th->getMessage());
        }
    }
}