<?php /** @var string $title */; ?>
<?= $this->extend('layout'); ?>

<?= $this->section('title') ?><?= esc($title) ?><?= $this->endSection() ?>

<?= $this->section('main'); ?>
<section class="container px-4">
    <div class="alert alert-success">
        <h2><?= esc($title); ?></h2>
        <p>Votre utilisateur a bien été créé.</p>
    </div>
</section>
<?= $this->endSection(); ?>
