<?php

use App\Helpers\UrlHelper;
?>
<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
    <a href="<?= UrlHelper::siteUrl('/admin') ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">Admin Panel</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="<?= UrlHelper::siteUrl('/admin') ?>" class="nav-link <?= UrlHelper::isCurrentPath('/admin') ? 'active' : 'text-white' ?>">
                Home
            </a>
        </li>
        <li>
            <a href="<?= UrlHelper::siteUrl('/admin/users') ?>" class="nav-link <?= UrlHelper::isCurrentPath('/admin/users') ? 'active' : 'text-white' ?>">
                Users
            </a>
        </li>
        <li>
            <a href="<?= UrlHelper::siteUrl('/admin/pages') ?>" class="nav-link <?= UrlHelper::isCurrentPath('/admin/pages') ? 'active' : 'text-white' ?>">
                Pages Management
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <strong><?= ucwords('Welcome ' . App\Helpers\SessionHelper::get('admin')['firstname']) ?></strong>!
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <!-- <li><a class="dropdown-item" href="#">Profile</a></li>
            <li>
                <hr class="dropdown-divider">
            </li> -->
            <li>
                <form action="<?php echo App\Helpers\UrlHelper::siteUrl('/admin/logout'); ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure?')">
                    <button type="submit" class="dropdown-item">Sign out</button>
                </form>
            </li>
        </ul>
    </div>
</div>
<div class="b-example-divider"></div>