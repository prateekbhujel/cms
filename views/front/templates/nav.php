
<nav class="navbar navbar-expand-lg bg-success" data-bs-theme = "dark">
  <div class="container">
    <a class="navbar-brand" href="<?php echo url('page'); ?>"><i class="fa-regular fa-newspaper me-2 "></i>Blog CMS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav nav-underline ms-auto gap-lg-5">
        <?php
          $categories = (new \App\Models\Category)->where('status', 'Active')->select('id', 'name')->get();

          foreach($categories as $category):
        ?>

        <li class="nav-item">
          <a href="<?php echo url("page/category/{$category->id}"); ?>" class="nav-link text-decoration-none"><?php echo $category->name; ?></a>
        </li>
        
        <?php endforeach; ?>
             
      </ul>
    </div>
  </div>
</nav>