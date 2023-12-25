<?php
    $title = 'Comments';
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
            </div>

            <div class="row">
                <div class="col">
                    <?php if(!empty($comments['data'])): ?>
                        <table class="table table-striped table-hover table-sm">
                            <thead class="table-dark">
                                <tr>
                                    <th>User</th>                                    
                                    <th>Article</th>
                                    <th>Comment</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach($comments['data'] as $comment): ?>
                                    <tr>
                                        <td>
                                            <?php echo $comment->name; ?><br>
                                            <small class="text-muted"><?php echo $comment->email; ?></small>
                                        </td>                                       
                                        <td><?php echo $comment->article()->select('name')->first()->name; ?></td>
                                        <td><?php echo $comment->content; ?></td>
                                        <td><?php echo dt_format($comment->created_at); ?></td>
                                        <td>
                                            <a href="<?php echo url("categories/destroy/{$comment->id}") ?>" class="btn btn-danger btn-sm delete">
                                                <i class="fa-solid fa-times me-2"></i>Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php view('back/templates/pagination.php', ['pages' => $comments['pages'], 'current'=>$comments['current'], 
                        'base'=>url('categories')]); ?>
                    <?php else:  ?>
                        <h4 class="text-muted fst-italic">No data added</h4>
                    <?php endif;  ?>
                </div>
            </div>
        </div>
    </div>   
</div>

<?php view('back/templates/footer.php'); ?>





    