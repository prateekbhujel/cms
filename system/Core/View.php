<?php

namespace System\Core;

class View{

    /**Load the given view file */
    public function __construct(string $view, ?array $data=null)
    {
        if(!is_null($data)){
            extract($data);
        }
    
        require (BASEPATH."/views/$view");
    }
}