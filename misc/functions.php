<?php

use App\Models\User;
use System\Core\View;

if(!function_exists('config')){

    /**
    *Returns configuration value for the given key.
    */
    function config(string $key):string|bool {
        require BASEPATH."/misc/config.php";

        if (key_exists($key, $config)){
            return $config[$key];
        }
        return false;
    }
}

if(!function_exists('view')){

    /**NON OOP FUNCTION which Loads the given file */
    function view(string $view, ?array $data = null){
        new View($view, $data);
    }
}

if(!function_exists('url')){

    /** 
     * Returns uri with Base uri.
    */
    function url(string $uri = ''): string {
       return  config('base_url').$uri;
    }
}

if(!function_exists('redirect')){

    /** 
     * Redirects to the given URL.
    */    
    function redirect(string $url) {
       header("Location: $url");
       die;
    }
}

if(!function_exists('flash')){

    /**
     * Get/Set flash data in the session.
    */
    function flash(?string $message = null, string $type = 'info' ) {
        if(is_null($message)) {
            return $_SESSION['flash'] ?? false;
        } else {
            $_SESSION['flash'] = compact('message', 'type');
        }
    }
}

if(!function_exists('clear_flash')) {

    /** 
     * Clears Flash data from the session.
    */
    function clear_flash() {
        if(!empty($_SESSION['flash'])) {
            unset($_SESSION['flash']);
        }
    }
}


if(!function_exists('auth')) {

    /**
     * Cheks if any user id is authenticated.
    */
    function auth(): bool
    {
        if(!empty($_SESSION['user'])) {
            return true;
        } else if(!empty($_COOKIE['blog_user'])) {
            $_SESSION['user'] = $_COOKIE['blog_demo'];

            return true;
        }

        return false;
    }
}

if(!function_exists('user')) {

    /**
     * Returns data model of authenticated user.
    */
    function user(): User {
        return new User($_SESSION['user']);
    }
}

if(!function_exists('now')) {

    /** 
     * Returns the current date/time in the
     * given format.
    */
    function now(string $format = 'Y-m-d H:i:s'): string
    {
        return date($format);
    }
}

if(!function_exists('dt_format')) {

    /** 
     * Returns the given date/time in the 
     * given format.
    */
    function dt_format(string $dt, string $format= 'j M, Y [h:i A]'): string
    {
        return date($format, strtotime($dt));
    }
}