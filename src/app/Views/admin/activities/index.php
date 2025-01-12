<?php
/**
 * @var ?\App\Entities\Activity[] $activities
 * @var string $title
 */
?>
<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?><?= esc($title); ?><?= $this->endSection(); ?>
<?= $this->section('main'); ?>
<section class="container px-4">
    <h1 class="mb-3 mt-3"><?= esc($title); ?></h1>
    <?php if ($activities !== []): ?>
        <?php foreach ($activities as $activity): ?>
            <div class="card mb-3 bg-dark-subtle">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-dark-subtle"><h3><?= esc($activity->type); ?></h3></li>
                            <li class="list-group-item bg-dark-subtle"><?= $activity->getStartingDate(); ?></li>
                            <li class="list-group-item bg-dark-subtle"><?= $activity->getEndingDate(); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune activitiés n'est répertoriées pour le moment</p>
    <?php endif; ?>
</section>
<?= $this->endSection(); ?>
