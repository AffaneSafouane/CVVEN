<?php
/**
 * @var ?\App\Entities\Reservation[] $reservations
 * @var string $title
 */
?>
<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?><?= esc($title); ?><?= $this->endSection(); ?>
<?= $this->section('main'); ?>
<section class="container px-4">
    <h1><?= esc($title); ?></h1>
    <?php if ($reservations !== []): ?>
        <?php foreach ($reservations as $reservation): ?>
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item"><?= $reservation->getStartingDate(); ?></li>
                <li class="list-group-item"><?= $reservation->getEndingDate(); ?></li>
                <li class="list-group-item"><a href="<?= site_url('users/' . $reservation->getUser()->id); ?>"><?= $reservation->getUser()->last_name . " " . $reservation->getUser()->name; ?></a></li>
            </ul>
        <?php endforeach; ?>
    <?php endif; ?>
</section>
<?= $this->endSection(); ?>
