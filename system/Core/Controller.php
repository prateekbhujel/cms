<?php

namespace System\Core;

class Controller {
    
    /**
     * Redirects To Login if no authenticated
     * user is found.
    */
    protected function authenticated()
    {
        if(!auth()) {
            
            flash('Please Login to Continue', 'danger');

            redirect(url('login'));
        }
    }
}