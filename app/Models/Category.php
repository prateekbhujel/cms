<?php

namespace App\Models;

use System\Core\Model;

class Category extends Model{
    protected string $table = 'categories';

    public function articles():Model{
        return $this->relation(Article::class, 'articles', 'category_id');
    }
}






