<?php

namespace App\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use System\Core\Controller;

class PageController extends Controller{
    public function index(){
        $article = new Article;

        $latest = $article->where('status', 'Published')->where('published_at', '<=', now())
                    ->orderBy('published_at','DESC')->first();

        $articles = $article->where('status', 'Published')->where('published_at', '<=', now())
                    ->orderBy('published_at','DESC')->limit(1, 9)->get();

        view('front/page/index.php', compact('latest', 'articles'));
    }

    public function category($id){
        $category = new Category($id);

        $articles = $category->articles()->where('status', 'Published')->where('published_at', '<=', now())
        ->orderBy('published_at','DESC')->paginate(12);

        view('front/page/category.php', compact('category', 'articles'));

    }

    public function article($id){
        $article = new Article($id);

        $category = $article->category()->first();
        $author = $article->user()->first();
        $comments = $article->comments()->get();

        view('front/page/article.php', compact('article', 'category', 'author', 'comments'));
    }

    public function comment(){
        $comment = new Comment();

        $comment->name = $_POST['name'];
        $comment->email = $_POST['email'];
        $comment->content = $_POST['content'];
        $comment->article_id = $_POST['id'];
        $comment->created_at = now();
        $comment->save();

        flash("Thank you for your comment", 'success');

        redirect(url("page/article/{$_POST['id']}"));
    }
}
