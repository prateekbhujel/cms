
<?php if($pages > 1): ?>
<nav aria-label="...">
  <ul class="pagination">

    <?php if($current > 1): ?>
        <li class="page-item">
            <a class="page-link" href="<?php echo $base."?page=".($current-1) ?>">
              <i class="fa-solid fa-chevron-left"></i></i>
            </a>
        </li>

    <?php else: ?>
        <li class="page-item disabled">
            <a class="page-link">
              <i class="fa-solid fa-chevron-left"></i>
            </a>
        </li>
    <?php endif; ?>

    <?php for($i=1; $i<=$pages; $i++): ?>
      <li class="page-item <?php echo $i == $current ? 'active' : '' ?>">
            <a class="page-link" href="<?php echo $base."?page=$i";?>">
              <?php echo $i; ?>
          </a>
        </li>
    <?php endfor;  ?>

   
    <?php if($current < $pages): ?>
        <li class="page-item" >
            <a class="page-link" href="<?php echo $base."?page=".($current+1) ?>">
              <i class="fa-solid fa-chevron-right"></i>
            </a>
        </li>

    <?php else: ?>
      <li class="page-item disabled">
        <a class="page-link">
          <i class="fa-solid fa-chevron-right"></i>
        </a>
    </li>
    <?php endif; ?>
  </ul>
</nav>
<?php endif; ?>