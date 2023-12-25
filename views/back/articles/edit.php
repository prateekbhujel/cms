<?php
    $title = 'Edit Article';
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
                    <form action="<?php echo url("articles/update/{$article->id}"); ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo $article->name ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea name="content" id="content" class="form-control" required>
                            <?php echo $article->content  ?>
                            </textarea>
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                <?php foreach($categories as $category): ?> 
                                <option value="<?php echo $category->id; ?>" <?php echo $article->category_id == $category->id ? 'selected' : '' ;?>>

                                <?php echo $category->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*" >
                            <div class="row">
                                <div class="col-3" id="img-holder">
                                <?php if(!is_null($article->image)): ?>
                                    <img src="<?php echo url("assets/images/{$article->image}"); ?>" class="img-fluid">
                                <?php endif; ?>
                                </div>
                            </div>
                        </div> 
                                 
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="Draft" <?php echo $article->status == 'Draft' ? 'selected' :'' ?>>Draft</option>
                                <option value="Published" <?php echo $article->status == 'Published' ? 'selected' :'' ?>>Published</option>
                                <option value="Unpublished" <?php echo $article->status == 'Unpublished' ? 'selected' :'' ?>>Unpublished</option>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="published_at" class="form-label">Published At</label>
                            <input type="datetime-local" name="published_at" id="published_at" class="form-control"  >
                            <?php echo !is_null($article->published_at) ? dt_format($article->published_at, 'Y-m-d\TH:i:s') : '' ?>
                        </div> 

                        <div class="mb-3">
                            <button type="submit" class="btn btn-dark">
                                <i class="fa-solid fa-save me-2"></i>Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
</div>



<?php view('back/templates/footer.php'); ?>





    