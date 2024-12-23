<?php /** @var ?array $users */?>

<?php if ($users !== []): ?>

    <?php foreach ($users as $user): ?>

        <h3><?= esc($user['u_email']) ?></h3>

        <div class="main">
            <?= esc($user['u_nom']) ?> <?= esc($user['u_prenom']) ?>
        </div>
        <p><a href="/users/<?= esc($user['u_id'], 'url') ?>">View client</a></p>

    <?php endforeach ?>

<?php else: ?>

    <h3>Aucun utilisateurs</h3>

    <p>Aucun utilisateurs n'est repertoriés pour le moment.</p>

<?php endif ?>