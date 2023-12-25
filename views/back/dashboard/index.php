<?php
    $title = 'Dashboard';
    view('back/templates/header.php', compact('title'));
    view('back/templates/nav.php');
?>
<div class="container">
    <div class="row">
        <div class="col-12 bg-white py-3 my-3 rounded-3 shadow-sm">
            <div class="row">
                <div class="col">
                    <h1><?php echo $title ?></h1>
                </div>
            </div>
        </div>
    </div>
</div>

<?php view('back/templates/footer.php'); ?>





    