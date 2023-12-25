<?php

namespace App\Models;

use System\Core\Model;

class Article extends Model{
    protected string $table = 'articles';

    public function comments():Model{
        return $this->relation(Comment::class, 'comments', 'article_id');
    }

    public function category():Model{
        return $this->relation(Category::class, 'categories', 'category_id', 'parent');
    }

    public function user():Model{
        return $this->relation(User::class, 'users', 'users_id', 'parent');
    }
}






