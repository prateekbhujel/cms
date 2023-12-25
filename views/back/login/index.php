<?php
    $title = 'Login';
    view('back/templates/header.php', compact('title'));
?>

<div class="container">
    <div class="row">
        <div class="col-4 bg-white py-3 my-5 mx-auto rounded-3 shadow-sm">
            <div class="row">
                <div class="col text-center">
                    <h1><?php echo $title;   ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <form action="<?php echo url('login/check'); ?>" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="passwprd" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" id="remember" value="yes" class="form-check-input" >
                            <label for="remember" class="form-ckheck-label">Remember Me</label>
                        </div>
                        <div class="mb-3 d-grid">
                            <button type="submit" class="btn btn-dark">
                                <i class="fa-solid fa-arrow-right-to-bracket me-2"></i> Log In
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php view('back/templates/footer.php'); ?>





    