<h2><?= esc($title) ?></h2>

<?php if ($clients_list !== []): ?>

    <?php foreach ($clients_list as $clients_item): ?>

        <h3><?= esc($clients_item['email_client']) ?></h3>

        <div class="main">
            <?= esc($clients_item['nom_client']) ?> <?= esc($clients_item['prenom_client']) ?>
        </div>
        <p><a href="/clients/<?= esc($clients_item['id_client'], 'url') ?>">View client</a></p>

    <?php endforeach ?>

<?php else: ?>

    <h3>No News</h3>

    <p>Unable to find any news for you.</p>

<?php endif ?>
