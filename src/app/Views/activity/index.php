<?php
/**
 * @var ?\App\Entities\Activity[] $activities
 * @var string $title
 */
?>
<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?><?= esc($title); ?><?= $this->endSection(); ?>
<?= $this->section('main'); ?>
<section class="container px-4">
    <h1><?= esc($title); ?></h1>
    <?php if ($activities !== []): ?>
        <?php foreach ($activities as $activity): ?>
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item"><?= esc($activity->type); ?></li>
                <li class="list-group-item"><?= $activity->getStartingDate(); ?></li>
                <li class="list-group-item"><?= $activity->getEndingDate(); ?></li>
            </ul>
        <?php endforeach; ?>
    <?php endif; ?>
</section>
<?= $this->endSection(); ?>
