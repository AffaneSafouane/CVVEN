<?php
/**
 * @var ?array $users
 * @var string $title
 */
?>
<?= $this->extend('layout'); ?>

<?= $this->section('title') ?><?= esc($title); ?> <?= $this->endSection() ?>

<?= $this->section('main'); ?>
<section class="container px-4">
    <h1><?= esc($title); ?></h1>
    <?php if ($users !== []): ?>
        <ul class="list-group list-group-flush">
            <?php foreach ($users as $user): ?>
                <div class="card text-white mb-1 bg-body-tertiary">
                    <div class="card-body">
                        <div class="card-title d-flex justify-content-between">
                            <li class="list-group-item text-white">
                                <a href="<?= site_url('users/' . esc($user['u_id'], 'url')); ?>">
                                    <h3><?= esc($user['u_email']) ?></h3>
                                </a>
                                <small class="text-muted">
                                    <?= esc($user['u_nom'] . " " . $user['u_prenom']); ?>
                                </small>
                            </li>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <h3>Aucun utilisateurs</h3>
        <p>Aucun utilisateurs n'est repertoriés pour le moment.</p>
    <?php endif; ?>
</section>
<?= $this->endSection(); ?>
