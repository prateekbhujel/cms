
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container">
    <a class="navbar-brand" href="#<?php echo url('dashboard') ?>">Project CMS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto">
        <?php if(user()->type == 'Admin'): ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo url('staffs'); ?>">
            <i class="fa-solid fa-users me-2"></i>Staffs
          </a>
        </li>
        <?php endif; ?>

        <li class="nav-item">
          <a class="nav-link" href="<?php echo url('categories'); ?>">
            <i class="fa-solid fa-th-large me-2"></i>Categories
          </a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="<?php echo url('articles'); ?>">
            <i class="fa-solid fa-newspaper me-2"></i>Articles
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?php echo url('comments'); ?>">
            <i class="fa-solid fa-comments me-2"></i>Comments
          </a>
        </li>
      </ul>
      
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-user-circle me-2"></i>
            <?php echo user()->name  ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="<?php echo url('profile/edit'); ?>">
              <i class="fa-solid fa-user-edit me-2"></i>Edit Profile</a></li>

            <li><a class="dropdown-item" href="<?php echo url('password/edit'); ?>">
              <i class="fa-solid fa-asterisk me-2"></i>Change Password</a></li>

            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?php echo url('logout');  ?>">
              <i class="fa-solid fa-arrow-right-from-bracket me-2"></i>Logout
            </a></li>
          </ul>
        </li>        
      </ul>
    </div>
  </div>
</nav>