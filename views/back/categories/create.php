<?php
    $title = 'Add Category';
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
                    <form action="<?php echo url('categories/store'); ?>" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <?php ?>

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





    