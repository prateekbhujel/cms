<?php

namespace App\Controllers;

use App\Models\Comment;
use System\Core\Controller;

class CommentsController extends Controller{
    public function __construct()
    {
        $this->authenticated();
    }

    public function index(){
        $comments = (new Comment)->orderBy('created_at', 'DESC')->paginate();

        view('back/comments/index.php', compact('comments'));
    }

    public function destroy($id){
        $comment = new Comment($id);

        $comment->delete();

        flash('Comment removed', 'success');

        redirect(url("comments"));

    }
}