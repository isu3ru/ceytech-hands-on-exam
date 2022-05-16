<?php require_once VIEWS_PATH . '/partials/admin/head.php'; ?>
<main>
    <?php require_once VIEWS_PATH . '/partials/admin/sidebar.php'; ?>
    <div id="main-content" class=" container-fluid p-5">
        <?php require_once VIEWS_PATH . '/partials/admin/alerts.php'; ?>
        <h2><?= $title ?></h2>

        <div class="row">
            <div class="col-lg-12">
                <div class="my-3">
                    <a href="<?= App\Helpers\UrlHelper::siteUrl('/admin/pages/create') ?>" class="btn btn-primary">Create New Page</a>
                </div>
                <div class="card card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Published At</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pages)) : ?>
                                <?php $num = 1;
                                foreach ($pages as $page) : ?>
                                    <tr>
                                        <td><?= $num ?></td>
                                        <td><?= $page->title ?></td>
                                        <td><?= $page->is_published ? 'Published' : 'Unpublished' ?></td>
                                        <td><?= $page->published_at ?? '-' ?></td>
                                        <td>
                                            <a href="<?= \App\Helpers\UrlHelper::siteUrl('/pages') ?>?<?= http_build_query(['id' => $page->id]) ?>" class="btn btn-success btn-sm" target="_blank">View</a> 
                                            <a href="<?= \App\Helpers\UrlHelper::siteUrl('/admin/pages/edit') ?>?<?= http_build_query(['id' => $page->id]) ?>" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="<?= \App\Helpers\UrlHelper::siteUrl('/admin/pages/delete') ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure you need to delete this page?')">
                                                <input type="hidden" name="id" value="<?= $page->id ?>">

                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php $num++;
                                endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5">No pages added yet.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once VIEWS_PATH . '/partials/admin/foot.php'; ?>