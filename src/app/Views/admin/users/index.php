<?php
/**
 * @var ?\CodeIgniter\Shield\Entities\User[] $users
 * @var string $title
 * @var \CodeIgniter\Pager\Pager $pager
 */
?>
<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?><?= esc($title); ?><?= $this->endSection(); ?>

<?= $this->section('main'); ?>
<section class="container px-4">
    <h1 class="mb-3 mt-3"><?= esc($title); ?></h1>
    <?php if ($users !== []): ?>
        <?php foreach ($users as $user): ?>
            <div class="card mb-3 bg-dark-subtle">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-dark-subtle">
                                <h3><a href="<?= site_url('admin/users/' . esc($user->id, 'url')); ?>"><?= esc($user->getEmail()); ?></a></h3>
                                <small class="text-muted"><?= esc($user->name . " " . $user->last_name); ?></small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun utilisateurs n'est repertoriés pour le moment.</p>
    <?php endif; ?>
    <?= $pager->links(); ?>
</section>
<?= $this->endSection(); ?>
