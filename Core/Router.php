<?php
/******************
 * Router class
 ******************/

 class Router {
    /************************************
     * Associative array of routes
     * @var array
     */
    protected $routes = [];

    /************************************
     * Parameters from the matched route
     * @var array
     */
    protected $params = [];

    /************************************
     * Add route to the routing table
     * 
     * @param string $route - this is from the url
     * @param array $params - Controller, action, etc. parameters
     * @return void
     */
    public function add($route, $params) {
        $this->routes[$route] = $params;
    } 

    /************************************
     * Get all the routes from the routing table
     * 
     * @return array
     */
    public function getRoutes(){
        return $this->routes;
    }

    /***********************************
     * Match route to the routes table
     * Set the params property if a match is found
     * @param string $url the route url
     * @return boolean true if match found, otherwise false
     */
    public function match($url){
        foreach($this->routes as $route => $params){
            if($url == $route){
                $this->params = $params;
                return true;
            }
        }

        return false;
    }

    /***********************************
     * Get the matched parameters
     * @return array
     */
    public function getParams(){
        return $this->params;
    }
 }
?>