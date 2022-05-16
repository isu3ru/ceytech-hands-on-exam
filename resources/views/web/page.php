<?php require_once VIEWS_PATH . '/partials/web/head.php'; ?>
<div class="container p-3">
    <h1><?php echo $page->title; ?></h1>
    <div id="featured_image">
        <img width="100%" src="<?php echo $page->featured_image; ?>" alt="<?php echo $page->title; ?>">
    </div>
    <p><?php echo $page->description; ?></p>
</div>
<?php require_once VIEWS_PATH . '/partials/web/foot.php'; ?>