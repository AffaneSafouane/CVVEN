<?php
/**
 * @var array $user
 * @var string $title
 */
?>
<?= $this->extend('layout'); ?>

<?= $this->section('main'); ?>
<section class="container px-4">
    <div class="d-flex justify-content-between">
        <h1><?= esc($title); ?></h1>
        <span class="align-content-center">
            <a href="<?= site_url('/'); ?>" class="link">Retour</a>
        </span>
    </div>
    <div class="card mb-1 m-auto text-white">
        <div class="card-body">
            <div class="card-title d-flex justify-content-between">
                <h4 class="mb-1"><?= esc($user['name'] . " " . $user['last_name']); ?></h4>
                <small class="text-muted"><?= esc($user['email']); ?></small>
                <?php if (!empty($user['username'])): ?>
                    <small class="text-muted"><?= esc($user['username']); ?></small>
                <?php endif; ?>
            </div>
            <div class="d-flex justify-content-between card-text">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-white">Date d'inscription: <?= date("d/m/y h:i:s", strtotime($user['created_at'])); ?></li>
                    <li class="list-group-item text-white">
                        Adresse: <?= esc($user['address']); ?>
                    </li>
                    <li class="list-group-item text-white">
                        Date de naissance: <?= date("d/m/y", strtotime($user['birth_date'])); ?>
                    </li>
                    <?php if (!empty($user['phone'])): ?>
                        <li class="list-group-item text-white">
                            Téléphone: <?= esc($user['phone']); ?>
                        </li>
                    <?php endif; ?>
                </ul>
                <p><small><?= !$user['active'] ? "Votre compte n'est pas activé." : "Votre compte est activé."; ?></small></p>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>