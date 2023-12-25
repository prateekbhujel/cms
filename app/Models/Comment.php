<?php

namespace App\Models;

use System\Core\Model;

class Comment extends Model{
    protected string $table = 'comments';

    public function article():Model{
        return $this->relation(Article::class, 'articles', 'article_id', 'parent');
    }
}

 




