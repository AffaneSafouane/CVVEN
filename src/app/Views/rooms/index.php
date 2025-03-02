<?php
/**
 * @var string $title
 * @var ?\App\Entities\Room[] $rooms
 */
?>

<?= $this->extend('layout'); ?>

<?= $this->section('title') ?><?= esc($title) ?><?= $this->endSection() ?>

<?= $this->section('main'); ?>
    <section class="container px-4">
        <h1 class="mb-3 mt-3"><?= esc($title); ?></h1>
        <!-- @TODO afficher la liste des chambres disponibles (avec filtres pour dates, types et nb de personnes) -->
    </section>
<?= $this->endSection(); ?>
