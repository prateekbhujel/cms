<?php
    view('front/templates/header.php', ['title' => "{$category->name}: Category"]);
    view('front/templates/nav.php');
?>

<div class="container shadow rounded-2 bg-white py-3 mt-4 p-4">
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col-12 text-center">
                    <h1><?php echo $category->name; ?></h1>
                </div>
            </div>      
      
            <div class="row ">
                <?php foreach($articles['data'] as $article): ?>
                    <div class="col-4 mb-3">
                        <div class="row">
                            <div class="col-5">
                                <img src="<?php echo url("assets/images/".($article->image ?? 'placeholder.jpg')) ?>" 
                                class="img-fluid rounded-2 shadow-sm">
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col-12 fw-bold">
                                        <?php echo $article->name; ?>
                                    </div>
                                    <div class="col-12" mt-3>
                                        <a href="<?php echo url("page/article/{$article->id}"); ?>" class="btn btn-success btn-sm mt-2">
                                            Read Article <i class="fa-solid fa-book-open m-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php view("front/templates/pagination.php", ['pages' => $articles['pages'], "current" => $articles['current'], 'base' => url("page/category/{$category->id}")]); ?>
            </div>
        </div>
    </div>
</div>

<?php
    view('front/templates/footer.php');
?>