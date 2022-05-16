<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title><?= $title ?? 'Hands on Exam Blog' ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo App\Helpers\UrlHelper::siteUrl('/about') ?>">Web Developer Hands-on Exam</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo (App\Helpers\UrlHelper::isCurrentPath('/') ? 'active' : '') ?>" aria-current="page" href="<?php echo App\Helpers\UrlHelper::siteUrl('/') ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo App\Helpers\UrlHelper::siteUrl('/about') ?>" class="nav-link <?php echo (App\Helpers\UrlHelper::isCurrentPath('/about') ? 'active' : '') ?>">
                            About
                        </a>
                    </li>
                    <?php if (App\Helpers\SessionHelper::has('user')) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Pages
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <?php foreach ($pages as $menuPage) : ?>
                                    <li><a class="dropdown-item" href="<?php echo App\Helpers\UrlHelper::siteUrl('page') ?>?<?php echo http_build_query(['id' => $menuPage->id]) ?>"><?php echo $menuPage->title; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
                <?php if (App\Helpers\SessionHelper::has('user')) : ?>
                    <ul class="navbar-nav mb-2 me-2 mb-lg-0">
                        <li class="nav-item">
                            <a href="javascript:void;" class="nav-link">Welcome <?php echo App\Helpers\SessionHelper::get('user')['firstname']; ?>!</a>
                        </li>
                    </ul>
                    <form action="<?php echo App\Helpers\UrlHelper::siteUrl('logout') ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to log out?')">
                        <button type="submit" class="btn btn-outline-primary">Log Out</button>
                    </form>
                <?php else : ?>
                    <a href="<?php echo App\Helpers\UrlHelper::siteUrl('login') ?>" class="btn btn-outline-primary">Log In</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div class="container-fluid p-5">