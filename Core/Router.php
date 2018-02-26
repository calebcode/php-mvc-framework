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
    public function add($route, $params = []) {
        // escape slashes in route, convert to regex
        $route = preg_replace('/\//','\\/',$route);

        // convert variables
        $route = preg_replace('/\{([a-z]+)\}/','(?P<\1>[a-z]+)',$route);
        
        // add start and finish delimeters and case insensitivity :'(
        $route = '/^' . $route . '$/i';

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
        // match url that is formatted as /controller/action, all lower case
        //$regexp =  "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";

        foreach($this->routes as $route => $params){
            if(preg_match($route, $url, $matches)){
                // capture groups
                //$params = [];

                foreach($matches as $key => $match){
                    if(is_string($key)){
                        $params[$key] = $match;
                    }
                }

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