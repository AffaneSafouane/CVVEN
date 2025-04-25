<?php
/**
 * @var ?\App\Entities\Room[] $rooms
 * @var string $title
 * @var \CodeIgniter\Pager\Pager $pager
 */
?>
<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?><?= esc($title); ?><?= $this->endSection(); ?>
<?= $this->section('main'); ?>
<section class="container px-4">
    <h1 class="mb-3 mt-3"><?= esc($title); ?></h1>
    <?php if ($rooms !== []): ?>
        <?php foreach ($rooms as $room): ?>
            <div class="card mb-1 bg-dark-subtle">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-dark-subtle">
                                    <h4 class="mb-1">
                                        <a href="<?= base_url('admin/rooms/' . $room->id); ?>">
                                            <?= esc($room->num); ?>
                                        </a>
                                    </h4>
                                <small class="text-muted">Identifiant : <?= esc($room->id); ?></small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune chambres n'est répertoriées pour le moment</p>
    <?php endif; ?>
    <div class="mt-3">
        <?= $pager->links(); ?>
    </div>
</section>
<?= $this->endSection(); ?>
