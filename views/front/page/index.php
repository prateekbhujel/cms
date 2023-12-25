<?php
view('front/templates/header.php', ['title' => 'Welcome']);
view('front/templates/nav.php');
?>

<div class="container shadow rounded-2 bg-white py-3 mt-4 p-4">
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col-12 text-center">
                    <h1><?php echo isset($latest) ? $latest->name : 'Blog'; ?></h1>
                </div>
            </div>

            <div class="row m-3">
            <?php if (!is_null($latest) && !is_null($latest->image)): ?>
                    <div class="col-6">
                    <img src="<?php echo url("assets/images/{$latest->image}")?>" class="img-fluid">
                    </div>
                <?php endif; ?>
                <div class="col m-auto">
                    <?php echo substr(strip_tags($latest->content ?? ''), 0, 800); ?>....
                    <br>
                    <?php if (!is_null($latest)): ?>
                        <a href="<?php echo url("page/article/{$latest->id}"); ?>" class="btn btn-outline-success mt-3">Continue Reading
                            <i class="fa-solid fa-book-open m-2"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mb-2">
                    <hr>
                </div>
            </div>

            <div class="container m-4">
                <div class="row mt-5">
                    <?php if (!empty($articles)): ?>
                        <?php foreach ($articles as $article): ?>
                            <div class="col-4 mb-3">
                                <div class="row">
                                    <div class="col-5">
                                        <img src="<?php echo url("assets/images/".($article->image ?? 'placeholder.jpg')); ?>" 
                                             class="img-fluid rounded-2 shadow-sm">
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-12 fw-bold">
                                                <?php echo $article->name; ?>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <a href="<?php echo url("page/article/{$article->id}"); ?>" class="btn btn-success btn-sm mt-2">
                                                    Read Article <i class="fa-solid fa-book-open m-2"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</div>

<?php view('front/templates/footer.php'); ?>
