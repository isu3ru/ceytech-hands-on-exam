<?php require_once VIEWS_PATH . '/partials/web/head.php'; ?>
<div class="container">
    <?php require_once VIEWS_PATH . '/partials/admin/alerts.php'; ?>
    <div class="row">
        <div class="col-lg-12 text-center mt-5 mb-5">
            <h1>Hello and Welcome!</h1>
        </div>
        <div class="col-lg-6 p-5 border-end">
             <div class="d-flex align-content-center flex-wrap">
                <img src="<?php echo App\Helpers\UrlHelper::baseUrl() ?>/assets/images/undraw_Authentication_re_svpt.png" alt="" width="400">
            </div>
        </div>
        <div class="col-lg-6 p-5">
            <form action="<?php echo App\Helpers\UrlHelper::siteUrl('register') ?>" method="post" id="register_form">
                <h2>Register</h2>
                <p class="mb-3">Welcome back! Please enter your email and password below to log in.</p>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-2">
                            <label for="firstname">Firstname</label>
                            <input type="text" class="form-control 
                            <?php if (App\Helpers\SessionHelper::error('firstname')) {
                                echo 'is-invalid';
                            } ?>" id="firstname" name="firstname" value="<?php echo App\Helpers\SessionHelper::old('firstname') ?>">
                            <?php if (App\Helpers\SessionHelper::error('firstname')) : ?>
                                <div class="invalid-feedback">
                                    <?php echo App\Helpers\SessionHelper::error('firstname'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-2">
                            <label for="lastname">Lastname</label>
                            <input type="text" class="form-control 
                            <?php if (App\Helpers\SessionHelper::error('lastname')) {
                                echo 'is-invalid';
                            } ?>" id="lastname" name="lastname" value="<?= App\Helpers\SessionHelper::old('lastname') ?>">
                            <?php if (App\Helpers\SessionHelper::error('lastname')) : ?>
                                <div class="invalid-feedback">
                                    <?php echo App\Helpers\SessionHelper::error('lastname'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-2">
                            <label for="username">Username</label>
                            <input type="text" class="form-control 
                            <?php if (App\Helpers\SessionHelper::error('username')) {
                                echo 'is-invalid';
                            } ?>" id="username" name="username" value="<?= App\Helpers\SessionHelper::old('username') ?>">
                            <?php if (App\Helpers\SessionHelper::error('username')) : ?>
                                <div class="invalid-feedback">
                                    <?php echo App\Helpers\SessionHelper::error('username'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-2">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control 
                            <?php if (App\Helpers\SessionHelper::error('email')) {
                                echo 'is-invalid';
                            } ?>" value="<?= App\Helpers\SessionHelper::old('email') ?>">
                            <?php if (App\Helpers\SessionHelper::error('email')) : ?>
                                <div class="invalid-feedback">
                                    <?php echo App\Helpers\SessionHelper::error('email'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-2">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control 
                            <?php if (App\Helpers\SessionHelper::error('password')) {
                                echo 'is-invalid';
                            } ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-2">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control 
                            <?php if (App\Helpers\SessionHelper::error('password')) {
                                echo 'is-invalid';
                            } ?>">
                        </div>
                    </div>
                    <?php if (App\Helpers\SessionHelper::error('password')) : ?>
                        <div class="invalid-feedback d-block">
                            <?php echo App\Helpers\SessionHelper::error('password'); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mt-3 mb-5">
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </div>
            </form>
            <div class="text-center">
                <a href="<?php echo App\Helpers\UrlHelper::siteUrl('/login') ?>">Already have an account? Log in here..</a>
            </div>
        </div>
    </div>
</div>
<?php require_once VIEWS_PATH . '/partials/web/foot.php'; ?>