

    <div class="container text-bg-dark my-3 px-4 py-2 rounded-2 shadow-sm">
        <div class="row">
            <div class="col-12 py-3">
                <div class="row">
                    <div class="col-4">
                        <div class="row">
                            <div class="col-12">
                                <h2>Project CMS</h2>
                            </div>
                            
                            <div class="col-12">
                                <address>
                                    Tinkune, Kathmandu
                                    Bagmati, Nepal
                                </address>
                            </div>

                            <div class="col-12">
                                <strong>Phone:</strong><a href="tel:9841236541" class="link-light text-decoration-none">
                                9841236541</a><br>
                                <strong>Email:</strong><a href="mailto:info@projectcms.com" class="link-light text-decoration-none" >
                                info@projectcms.com
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="row">
                            <div class="col-12">
                                <h3>Find Us</h3>
                            </div>
                            <div class="col-12">
                                <a href="https://facebook.com" class="link-light text-decoration-none" target="_blank">
                                    <i class="fa-brands fa-facebook-square fa-2x me-2"></i>
                                </a>

                                <a href="https://twitter.com" class="link-light text-decoration-none" target="_blank">
                                    <i class="fa-brands fa-twitter-square fa-2x me-2"></i>
                                </a>

                                <a href="https://instagram.com" class="link-light text-decoration-none" target="_blank">
                                    <i class="fa-brands fa-instagram-square fa-2x me-2"></i>
                                </a>

                                <a href="https://youtube.com" class="link-light text-decoration-none" target="_blank">
                                    <i class="fa-brands fa-youtube-square fa-2x me-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="row">
                            <div class="col-12">
                                <h3>Locate us</h3>
                            </div>
                            <div class="col-12">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3533.030085650093!2d85.344808!3d27.685464999999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb198d99470043%3A0x167d008efb47d64c!2sBroadway%20Infosys!5e0!3m2!1sen!2snp!4v1703338201547!5m2!1sen!2snp" class="w-100" style="border:0; height: 200px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    <script src="<?php echo url('assets/js/front.js');  ?>"></script>

</body>
</html>