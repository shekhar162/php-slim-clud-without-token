<?php
namespace application;
require_once '../vendor/autoload.php';

use application\classes\Routes;

$routes = new Routes();
$routes->executeRequest();
?>