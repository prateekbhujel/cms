
        <?php
            $flash = flash();

            if($flash):
        ?>

        <div class="toast-container p-3 position-fixed bottom-0">
            <div class="toast align-items-center text-bg-<?php echo $flash['type']; ?> border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?php echo $flash['message'];  ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            </div>
        </div>

        <?php clear_flash();    ?>

        <?php endif; ?>


    <script src="<?php echo url('assets/js/jquery.js');  ?>"></script>
    <script src="<?php echo url('assets/js/bootstrap.js');  ?>"></script>
    <script src="<?php echo url('assets/plugins/trumbowyg/trumbowyg.js');  ?>"></script>
    <script src="<?php echo url('assets/js/back.js');  ?>"></script>

</body>
</html>