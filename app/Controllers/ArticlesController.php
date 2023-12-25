<?php

namespace App\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use System\Core\Controller;

class ArticlesController extends Controller{
    private $user;

    public function __construct()
    {
        $this->authenticated();
        $this->user = user();
    }

    public function index(){
        $articles = (new Article)->orderBy('created_at', 'DESC');
        
        if($this->user->type == 'Staff'){
            $articles->where('users_id',  $this->user->id);
        }

        $articles = $articles->paginate();

        view('back/articles/index.php', compact('articles'));
    }

    public function create() {
        $categories = $this->getCategories();

        view('back/articles/create.php', compact('categories'));
    }

    public function store() {
        $article = new Article;

        $article->name = $_POST['name'];
        $article->content = $_POST['content'];
        $article->category_id = $_POST['category_id'];
        $article->status = $_POST['status'];
        $article->created_at = now();       //format: 2023-05-04 22:06:07
        $article->updated_at = now();
        $article->users_id = user()->id;

        if(!empty($_POST['published_at'])){
            $article->published_at = dt_format($_POST['published_at'], 'Y-m-d H:i:s');
        }
        else if($_POST['status'] == 'Published'){
            $article->published_at = now();
        }

        if(!empty($_FILES['image']) && $_FILES['image']['error'] == 0){
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        
            $filename = "img".now('YmdHis').rand(1000, 9999).".$ext";

            move_uploaded_file($_FILES['image']['tmp_name'], BASEPATH . "/assets/images/$filename");
        
            $article->image = $filename;
        }        

        $article->save();

        flash('Article Added', 'success');

        redirect(url('articles'));
    }

    public function edit($id){
        $article = new Article($id);

        $this->authorize($article);

        $categories = $this->getCategories();

        view('back/articles/edit.php', compact('article', 'categories'));
    }

    
    public function update($id){
        $article = new Article($id);

        $this->authorize($article);

        $article->name = $_POST['name'];
        $article->content = $_POST['content'];
        $article->category_id = $_POST['category_id'];
        $article->status = $_POST['status'];
        $article->updated_at = now();

        if(!empty($_POST['published_at'])){
            $article->published_at = dt_format($_POST['published_at'], 'Y-m-d H:i:s');
        }
        else if($_POST['status'] == 'Published'){
            $article->published_at = now();
        }

        if(!empty($_FILES['image']) && $_FILES['image']['error'] == 0){
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        
            $filename = "img".now('YmdHis').rand(1000, 9999).".$ext";

            move_uploaded_file($_FILES['image']['tmp_name'], BASEPATH . "/assets/images/$filename");
        
            if(!is_null($article->image)){
                @unlink(BASEPATH . "/assets/images/{$article->image}");
            }

            $article->image = $filename;
        }

        $article->save();

        flash('Article Updated', 'success');

        redirect(url('articles'));
    }

    public function destroy($id){
        $article = new Article($id);

        $this->authorize($article);

        if(!is_null($article->image)){
            @unlink(BASEPATH . "/assets/images/{$article->image}");
        }

        $article->delete();

        flash('Article removed', 'success');

        redirect(url("articles"));

    }

    private function getCategories(): array{
       return (new Category)->select('id', 'name')->where('status', 'Active')->get();

    }

    private function authorize($article){
        if($this->user->type == 'Staff' && $article->users_id != $this->user->id){
            flash('Access Denied', 'danger');
 
            redirect(url('articles'));
         }
    }
}

