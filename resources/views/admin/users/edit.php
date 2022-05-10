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
                <div class="card border border-warning">
                    <div class="card-header bg-warning">
                        Edit User Details
                    </div>
                    <div class="card-body">
                        <form action="<?= UrlHelper::siteUrl('/admin/users/edit') ?>" method="post">
                            <input type="hidden" name="id" value="<?php echo $user->id; ?>">

                            <div class="mb-2">
                                <label for="firstname">Firstname</label>
                                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Firstname" required value="<?= $user->firstname ?>">
                            </div>

                            <div class="mb-2">
                                <label for="lastname">Lastname</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Lastname" required value="<?= $user->lastname ?>">
                            </div>

                            <div class="mb-2">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required value="<?= $user->email ?>">
                            </div>

                            <div class="mb-2">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                <span class="form-text">Enter text for the field only if you wish to update the password.</span>
                            </div>

                            <div class="mb-5">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control" required>
                                    <option value="">Select Role</option>
                                    <option value="admin" <?php echo ($user->role == 'admin') ? 'selected' : '' ?>>Admin</option>
                                    <option value="user" <?php echo ($user->role == 'user') ? 'selected' : '' ?>>User</option>
                                </select>
                            </div>

                            <div class="mb-2 clearfix">
                                <button type="submit" class="btn btn-warning float-start">Update</button>
                                <a href="<?= UrlHelper::siteUrl('/admin/users') ?>" class="btn btn-primary float-end">Reset</a>
                            </div>

                        </form>
                    </div>
                </div>

                <div class="card border border-danger mt-5">
                    <div class="card-header bg-danger text-white">
                        Delete User
                    </div>
                    <div class="card-body">
                        <p>Are you sure you need to delete the user? Click the button below to delete the user.</p>
                        <form action="<?php echo UrlHelper::siteUrl('/admin/users/delete') ?>" method="post" onsubmit="return confirm('Are you sure?')">
                            <input type="hidden" name="id" value="<?= $user->id ?>">

                            <button type="submit" class="btn btn-danger">Delete</button>
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