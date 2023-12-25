<?php

namespace System\Core;

use App\Controllers\UsersController;
use System\Exceptions\NotControllerException;
use Throwable;

class Framework{

    public function __construct()
    {
        session_start(); // Starts the session as soon as project opens.
    }

    /**
     * Loads the framework 
    */
    public function load()
    {
        try{
            $this->loadController($this->getParts());
        }
        catch(Throwable $e){
            if(config('debug')){
                $whoops = new \Whoops\Run;
                $whoops->allowQuit(false);
                $whoops->writeToOutput(false);
                $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
                echo $whoops->handleException($e);           
            }
            else{
                echo "<h1>There seems to be problem in website. Please try again later</h1>";
            }
        }
    }

    /**
     * Generates array from URL to be used
     *  for loading Controller class 
    */
    private function getParts(): array
    {
        $fullUrl = "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}{$_SERVER['REQUEST_URI']}";

        if(!empty($_SERVER['QUERY_STRING'])){
            $fullUrl = str_replace("?{$_SERVER['QUERY_STRING']}", "", $fullUrl);
        }

        return explode('/', str_replace(config('base_url'), '', $fullUrl));
    }


    /**Loads a controller according 
     * to request in the URL 
    */
    private function loadController(array $parts){
        if(!empty($parts[0])){
            $controller = ucfirst($parts[0]);
        }
        else{
            $controller = ucfirst(config('default_controller'));
        }

        $class = "App\Controllers\\{$controller}Controller";
        $obj = new $class;

        if($obj instanceof Controller){
            if(!empty($parts[1])){
                $method = $parts[1];
            }
            else{
                $method = 'index';
            }

            if(!empty($parts[2])){
                $obj->{$method}($parts[2]);
            }
            else{
                $obj->{$method}();
            }
        }
        else{
            throw new NotControllerException("Class '$class' is not an instance of 'System\Core\Controller'. ");
        }
    }


}
  