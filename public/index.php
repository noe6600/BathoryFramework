<?php

define('ROOT_ROUTE', __DIR__);

include("../vendor/bathory/autoload.php");

$action = $_SERVER['REQUEST_URI'];
dispatch($action);