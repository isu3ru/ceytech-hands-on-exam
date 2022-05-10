<?php

use App\Helpers\UrlHelper;

require_once VIEWS_PATH . '/partials/admin/head.php'; ?>
<main>
    <?php require_once VIEWS_PATH . '/partials/admin/sidebar.php'; ?>
    <div class="container-fluid p-5">
        <?php require_once VIEWS_PATH . '/partials/admin/alerts.php'; ?>
        <h2><?= $title ?></h2>
        <div class="row mt-3">
            <div class="col-lg-4">
                <div class="card border border-primary">
                    <div class="card-header bg-primary text-white">
                        Create New User
                    </div>
                    <div class="card-body">
                        <form action="<?= UrlHelper::siteUrl('/admin/users') ?>" method="post">
                            <div class="mb-2">
                                <label for="firstname">Firstname</label>
                                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Firstname" required>
                            </div>

                            <div class="mb-2">
                                <label for="lastname">Lastname</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Lastname" required>
                            </div>

                            <div class="mb-2">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                            </div>

                            <div class="mb-2">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                            </div>

                            <div class="mb-2">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control" required>
                                    <option value="">Select Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>

                            <div class="mb-2">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card card-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Registered At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($users) > 0) : ?>
                                <?php $i = 1;
                                foreach ($users as $user) : ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo sprintf('%s %s', $user->firstname, $user->lastname); ?></td>
                                        <td><?php echo $user->email; ?></td>
                                        <td><?php echo $user->role; ?></td>
                                        <td><?php echo date('Y-m-d h:iA', strtotime($user->registered_at)); ?></td>
                                        <td>
                                            <a href="<?php echo UrlHelper::siteUrl('/admin/users/edit') . '?id=' . $user->id ?>" class="btn btn-primary btn-sm">Edit</a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6">No users added.</td>
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