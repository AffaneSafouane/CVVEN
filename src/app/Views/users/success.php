<?php /** @var string $title */; ?>
<?= $this->extend('base'); ?>

<?= $this->section('content'); ?>
<section class="container px-4">
    <div class="alert alert-success">
        <h2><?= esc($title); ?></h2>
        <p>Votre utilisateur a bien été créé.</p>
    </div>
</section>
<?= $this->endSection(); ?>
