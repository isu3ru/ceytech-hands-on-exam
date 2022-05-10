<?php require_once VIEWS_PATH . '/partials/admin/head.php'; ?>
<main>
    <?php require_once VIEWS_PATH . '/partials/admin/sidebar.php'; ?>
    <div id="main-content" class=" container-fluid p-5">
        <?php require_once VIEWS_PATH . '/partials/admin/alerts.php'; ?>

        <h2><?= $title ?></h2>

        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card card-body border border-primary">
                    <form action="<?php echo App\Helpers\UrlHelper::siteUrl('/admin/pages/create') ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label for="title">Title</label>
                            <input type="text" class="form-control <?php echo App\Helpers\SessionHelper::error('title') ? 'is-invalid' : ''; ?>" 
                                name="title" id="title" placeholder="Title" required value="<?php echo App\Helpers\SessionHelper::old('title', ''); ?>">
                            <?php if (App\Helpers\SessionHelper::error('title')) : ?>
                                <div class="invalid-feedback">
                                    <?php echo App\Helpers\SessionHelper::error('title'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-2">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" rows="10" cols="80" required><?php echo App\Helpers\SessionHelper::old('description', ''); ?></textarea>
                            <?php if (App\Helpers\SessionHelper::error('description')) : ?>
                                <div class="invalid-feedback">
                                    <?php echo App\Helpers\SessionHelper::error('description'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-2">
                            <label for="image">Featured Image</label>
                            <input type="file" class="form-control <?php echo App\Helpers\SessionHelper::error('image')
                                ? 'is-invalid' : ''; ?>" name="image" id="image" placeholder="Featured Image">
                            <span class="form-text">Image must be in the resolution 1920 X 245</span>
                            <?php if (App\Helpers\SessionHelper::error('image')) : ?>
                                <div class="invalid-feedback">
                                    <?php echo App\Helpers\SessionHelper::error('image'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- is_published -->
                        <div class="mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="is_published" 
                                    name="is_published" <?php echo App\Helpers\SessionHelper::old('is_published', false) ? 'checked' : ''; ?>>
                                <label class=" form-check-label" for="is_published">
                                    Published Page
                                </label>
                            </div>
                        </div>
                        <div class="mb-2 border-top pt-3 clearfix">
                            <button type="submit" class="btn btn-primary">Create Page</button>
                            <a href="<?= App\Helpers\UrlHelper::siteUrl('/admin/pages') ?>" class="btn btn-outline-primary float-end">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once VIEWS_PATH . '/partials/admin/foot.php'; ?>