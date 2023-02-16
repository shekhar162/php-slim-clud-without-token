<?php
namespace application\classes;
use application\classes\RequestCaller;

class Routes{
    public $app = null;
    public $db = null;
    function __construct()
    {
        $config['displayErrorDetails'] = true;
        $config['addContentLengthHeader'] = false;
        $this->app = new \Slim\App(['settings' => $config]);
        // $this->app = new \Slim\App;
    }

    function executeRequest(){
        # get Details
        $this->app->get('/user', function ($request, $response, $args) {
            return RequestCaller::callRequest('UserModel', 'getUserDetails',$request, $response, $args);
        });

        
        $this->app->get('/user/{id}', function ($request, $response, $args) {
            return RequestCaller::callRequest('UserModel', 'getUserDetailsById',$request, $response, $args);
        });

        $this->app->post('/user', function ($request, $response, $args) {
            return RequestCaller::callRequest('UserModel', 'postUserDetails',$request, $response, $args);
        });

        # add details
        $this->app->post('/user/add', function ($request, $response, $args) {
            return RequestCaller::callRequest('UserModel', 'addUserDetails',$request, $response, $args);
        });

        # update details
        $this->app->put('/user/update', function ($request, $response, $args) {
            return RequestCaller::callRequest('UserModel', 'updateUserDetails',$request, $response, $args);
        });

        # delete details
        $this->app->delete('/user/{id}', function ($request, $response, $args) {
            return RequestCaller::callRequest('UserModel', 'deleteUserDetailsById',$request, $response, $args);
        }); 
        
        $this->app->run();
    }
    
}
?>