<?php

namespace App\Models;

use System\Core\Model;

class User extends Model{
    protected string $table = 'users';

    public function articles():Model{
        return $this->relation(Article::class, 'articles', 'users_id');
    }
}






