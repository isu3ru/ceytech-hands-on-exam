<?php require_once VIEWS_PATH . '/partials/web/head.php'; ?>
<div class="container">
    <?php require_once VIEWS_PATH . '/partials/admin/alerts.php'; ?>
    <div class="row">
        <div class="col-lg-12 text-center mt-5 mb-5">
            <h1>Hello and Welcome!</h1>
        </div>
        <div class="col-lg-6 p-5 border-end">
            <form action="<?php echo App\Helpers\UrlHelper::siteUrl('login') ?>" method="post" class="m-5">
                <h2>Log In</h2>
                <p class="mb-3">Welcome back! Please enter your username and password below to log in.</p>
                <div class="mb-2">
                    <label for="username">Username</label>
                    <input type="username" name="username" id="username" class="form-control" autofocus autocomplete="username" value="<?= App\Helpers\SessionHelper::old('username') ?>">
                </div>
                <div class="mb-2">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" autocomplete="current-password">
                </div>
                <div class="mb-2">
                    <button type="submit" class="btn btn-success w-100">Log In</button>
                </div>
            </form>
            <div class="text-center">
                <a href="<?php echo App\Helpers\UrlHelper::siteUrl('/register') ?>">Don't have an account? Register here..</a>
            </div>
        </div>
        <div class="col-lg-6 p-5">
            <div class="d-flex align-content-center flex-wrap">
                <img src="<?php echo App\Helpers\UrlHelper::baseUrl() ?>/assets/images/undraw_Login_re_4vu2.png" alt="" width="600">
            </div>
        </div>
    </div>
</div>
<?php require_once VIEWS_PATH . '/partials/web/foot.php'; ?>