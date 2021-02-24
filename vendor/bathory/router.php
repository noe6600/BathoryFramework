<?php

/**
 * Holds the registered routes
 *
 * @var array $routes
 */
$routes = [];

/**
 * Register a new route
 *
 * @param $action string
 * @param \Closure $callback Called when current URL matches provided action
 */
function route($action, $callback)
{
    global $routes;

    $action = explode('/', $action);

    $action_route = '';
    foreach ($action as $key => $route) {
    	if( ($route != '') && (strpos($route, '{') === false) ){
    		$action_route .= $route.'/';
    	}
    }
    $routes[$action_route] = $callback;
}

/**
 * Dispatch the router
 *
 * @param $action string
 */
function dispatch($action)
{
	global $routes;

	$action = substr($action, strpos($action, 'public/')+strlen('public/'));
	if($action == '') $action = '/';

	//Get method
	$action_array = explode('/', $action);
	$requested_method = '';
	$action_method = '';
	foreach ($action_array as $key => $method) {
		$action_method .= $method.'/';
		foreach ($routes as $r_method => $route) {
			if($action_method == $r_method) $requested_method = $r_method;
		}
	}
	$callback = $routes[$requested_method];

	//Get params
	$params = array();
	//Remove method route
	$parameters = str_replace($requested_method, '', $action);
	$parameters = explode('/', $parameters);
	foreach ($parameters as $key => $p) {
		array_push($params, $p);
	}

	$callback = explode('::', $callback);
	$class = 'App\Controllers\\'.$callback[0];
	$method = $callback[1];
	
	//Execute method
	call_user_func_array(array(new $class, $method), $params);
}