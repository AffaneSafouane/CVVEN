<?php
/**
 * @var string $title
 * @var ?\App\Entities\Reservation $reservation
 */
?>

<?= $this->extend('layout'); ?>

<?= $this->section('title') ?><?= esc($title) ?><?= $this->endSection() ?>

<?= $this->section('main'); ?>
<section class="container px-4">
    <h1 class="mb-3 mt-3"><?= esc($title); ?></h1>
    <!-- @TODO afficher les infos d'une réservation -->
</section>
<?= $this->endSection(); ?>
