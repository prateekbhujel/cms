<?php
    $title = 'Articles';
    view('back/templates/header.php', compact('title'));
    view('back/templates/nav.php');
?>

<div class="container">
    <div class="row">
        <div class="col-12 bg-white py-3 my-3 rounded-3 shadow-sm">
            <div class="row">
                <div class="col">
                    <h1><?php echo $title; ?></h1>
                </div>
                
                <div class="col-auto">
                    <a href="<?php  echo url('articles/create'); ?>" class="btn btn-dark">
                        <i class="fa-solid fa-plus me-2"></i>Add Article
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?php if(!empty($articles['data'])): ?>
                        <table class="table table-striped table-hover table-sm">
                            <thead class="table-dark">
                                <tr>
                                    <th>Name</th> 
                                    <th>Category</th>    
                                    <th>Image</th>     
                                    <th>Author</th>                          
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Published At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach($articles['data'] as $article): ?>
                                    <tr>
                                        <td><?php echo $article->name; ?></td>   
                                        <td><?php echo $article->category()->select('name')->first()->name;?></td>
                                        <td>
                                            <?php if(!is_null($article->image)): ?>
                                                <img src="<?php echo url("assets/images/{$article->image}"); ?>"  class="img-small">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $article->user()->select('name')->first()->name; ?></td>                                     
                                        <td><?php echo $article->status; ?></td>
                                        <td><?php echo dt_format($article->created_at); ?></td>
                                        <td><?php echo dt_format($article->updated_at) ?></td>
                                        <td><?php echo !is_null($article->published_at) ? dt_format($article->published_at) : '' ?></td>

                                        <td>
                                            <a href="<?php echo url("articles/edit/{$article->id}") ?>" class="btn btn-dark btn-sm">
                                                <i class="fa-solid fa-edit me-2"></i>Edit
                                            </a>
                                            <a href="<?php echo url("articles/destroy/{$article->id}") ?>" class="btn btn-danger btn-sm delete">
                                                <i class="fa-solid fa-times me-2"></i>Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php view('back/templates/pagination.php', ['pages' => $articles['pages'], 'current'=>$articles['current'], 
                        'base'=>url('articles')]); ?>
                    <?php else:  ?>
                        <h4 class="text-muted fst-italic">No data added</h4>
                    <?php endif;  ?>
                </div>
            </div>
        </div>
    </div>   
</div>

<?php view('back/templates/footer.php'); ?>





    