<?php
    view('front/templates/header.php', ["title" => "{$article->name}"]);
    view('front/templates/nav.php');
?>

<div class="container shadow rounded-2 bg-white py-3 mt-4 p-4">
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col-12 text-center">
                    <h1><?php echo $article->name; ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center text-secondary">
                    <i class="fa-solid fa-user-circle me-2"></i>
                    <?php echo $author->name; ?>
                    <i class="fa-solid fa-tags me-2 ms-3"></i>
                    <?php echo $category->name; ?>
                    <i class="fa-solid fa-clock me-2 ms-3"></i>
                    <?php echo dt_format($article->published_at);  ?>
                </div>
            </div>

            <div class="row m-3">
                <?php if(!is_null($article->image)): ?>
                    <div class="col-12">
                        <img src="<?php echo url("assets/images/{$article->image}")?>" class="img-fluid">
                    </div>
                <?php endif; ?>
                <div class="col-12 mt-4">
                    <?php echo ($article->content);?>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mb-2">
                    <hr>                   
                </div>
            </div>

            <div class="row">
               <div class="col-6">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <h3>
                                <i class="fa-solid fa-comment-dots me-2"></i>Add Comment
                            </h3>
                        </div>
                        <div class="col-12">
                            <form action="<?php echo url("page/comment"); ?>" method="post">
                                <input type="hidden" name="id" value="<?php echo $article->id; ?>">
                                <div class="mb-3">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" required>
                                </div>
                                <div class="mb-3">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                                </div>
                                <div class="mb-3">
                                    <textarea name="content" id="content" class="form-control" placeholder="Enter your comment" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-outline-success">
                                        <i class="fa-solid fa-comment me-2"></i>Add Comment
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
               </div>  
               <div class="col-6">
                    <div class="row">
                        <div class="col-12">
                            <h3>
                                <i class="fa-solid fa-comments me-2"></i>Comments
                            </h3>
                        </div>
                        <div class="col-12">
                            <?php if(!empty($comments)): ?>
                            <?php foreach($comments as $comment): ?>
                                <div class="bg-success-subtle border border-success py-2 px-3 mb-3 rounded-5 shadow-sm">
                                    <div class="row">
                                        <div class="col-12 text-success-emphasis">
                                            <?php echo $comment->content; ?>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <small class="fst-italic text-black-50">
                                                <i class="fa-solid fa-user me-2">
                                                <?php echo "{$comment->name} ({$comment->email})"; ?>
                                                </i>
                                                <i class="fa-solid fa-clock me-2">
                                                <?php echo dt_format($comment->created_at); ?>
                                                </i>
                                           </small>
                                        </div>
                                    </div>
                                </div>
                            
                            <?php endforeach; ?>
                            <?php else:  ?>
                                <div class="text-bg-success text-center p-2 mb-3 rounded-3 shadow-sm">
                                    <small class="fst-italic">No Comment Added.</small>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
               </div>               
            </div>
        </div>
    </div>
</div>

<?php
    view('front/templates/footer.php');
?>