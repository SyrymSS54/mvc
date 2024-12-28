<?php
require_once "application/core/view.php";
require_once "application/model/managermodel.php";
$model = new managermodel();

$viewer = new view();
$viewer->view($title = "My app",$main = 'templates/html/login_template.html',$main_set = True,$template = 'templates/html/template.html','');
?>