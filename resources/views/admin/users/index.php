<?php

use App\Helpers\UrlHelper;
use App\Helpers\SessionHelper;

require_once VIEWS_PATH . '/partials/admin/head.php'; ?>
<main>
    <?php require_once VIEWS_PATH . '/partials/admin/sidebar.php'; ?>
    <div id="main-content" class="container-fluid p-5">
        <?php require_once VIEWS_PATH . '/partials/admin/alerts.php'; ?>
        <h2><?= $title ?></h2>
        <div class="card card-body mt-3">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Registered At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($users) > 0) : ?>
                        <?php $i = 1;
                        foreach ($users as $user) : ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo sprintf('%s %s', $user->firstname, $user->lastname); ?></td>
                                <td><?php echo $user->username; ?></td>
                                <td><?php echo $user->email; ?></td>
                                <td><?php echo $user->role; ?></td>
                                <td><?php echo date('Y-m-d h:iA', strtotime($user->registered_at)); ?></td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5">No users added.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php require_once VIEWS_PATH . '/partials/admin/foot.php'; ?>