<?php
/**
 * @var array $user
 * @var string $title
 */
?>
<?= $this->extend('base'); ?>

<?= $this->section('content'); ?>
<section class="container px-4">
    <div class="d-flex justify-content-between">
        <h1><?= esc($title); ?></h1>
        <span class="align-content-center">
            <a href="<?= site_url('users'); ?>" class="link">Retour</a>
        </span>
    </div>
    <div class="card mb-1 m-auto text-white" style="background-color: #1b1e1f">
        <div class="card-body">
            <div class="card-title d-flex justify-content-between">
                <h4 class="mb-1"><?= esc($user['u_nom'] . " " . $user['u_prenom']); ?></h4>
                <small class="text-muted"><?= esc($user['u_email']); ?></small>
            </div>
            <div class="d-flex justify-content-between card-text">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-white" style="background-color: #1b1e1f; border-bottom: 1px solid gray">Date d'inscription: <?= date("d/m/y h:i:s", strtotime($user['u_date_creation'])); ?></li>
                    <li class="list-group-item text-white" style="background-color: #1b1e1f">
                        Adresse: <?= esc($user['u_adresse']); ?>
                    </li>
                    <li class="list-group-item text-white" style="background-color: #1b1e1f">
                        Téléphone: <?= esc($user['u_telephone']); ?>
                    </li>
                </ul>
                <p><small><?= !$user['u_admin'] ? "Vous n'êtes pas administrateur" : "Vous êtes administrateur"; ?></small></p>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>