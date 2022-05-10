<?php

use App\Helpers\SessionHelper;
?>

<?php if (!empty(SessionHelper::flashdata('warning'))) : ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Warning!</strong> <?php echo SessionHelper::flashdata('warning'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (!empty(SessionHelper::flashdata('success'))) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> <?php echo SessionHelper::flashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (!empty(SessionHelper::flashdata('error'))) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> <?php echo SessionHelper::flashdata('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>