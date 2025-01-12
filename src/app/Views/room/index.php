<?php
/**
 * @var ?\App\Entities\Room[] $rooms
 * @var string $title
 */
?>
<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?><?= esc($title); ?><?= $this->endSection(); ?>

<?= $this->section('main'); ?>
<section class="container px-4">
    <h1><?= esc($title); ?></h1>
    <?php if ($rooms !== []): ?>
        <?php foreach ($rooms as $room): ?>
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item"><?= $room->type; ?></li>
                <li class="list-group-item"><?= $room->description; ?></li>
            </ul>
        <?php endforeach; ?>
    <?php endif; ?>
</section>
<?= $this->endSection(); ?>
