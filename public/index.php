<?php
/**********************
 *  Front controller 
 * ********************/

require '../Core/Router.php';

$router = new Router();

// add routes
$router->add('',['controller' => 'Home','action' => 'index']);
$router->add('posts',['controller' => 'Posts','action' => 'index']);
//$router->add('posts/new',['controller' => 'Posts','action' => 'new']);
$router->add('{controller}/{action}');
$router->add('admin/{action}/{controller}');

// get the route from the url string
$url = $_SERVER['QUERY_STRING'];

// test
if($router->match($url)){
    echo '<pre>';
    echo htmlspecialchars(print_r($router->getRoutes(),true));
    var_dump($router->getParams());
    echo '</pre>';
} else {
    echo "No route found for URL '$url'";
}

?>