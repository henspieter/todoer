<?php

require_once 'controller.php';
require_once 'view.php';
require_once 'model.php';



$model = new Model();
$controller = new Controller($model);
$view = new View($controller, $model);

$controller->create_dummy();
echo $view->header();
echo $view->body();

?>