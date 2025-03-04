<?php
/**
 * @var ?\App\Entities\MeetingRoom[] $meetingRooms
 * @var string $title
 * @var \CodeIgniter\Pager\Pager $pager
 */
?>
<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?><?= esc($title); ?><?= $this->endSection(); ?>
<?= $this->section('main'); ?>
    <!-- @TODO ajouter une image -->
    <section class="container px-4">
        <h1 class="mb-3 mt-3"><?= esc($title); ?></h1>
        <?php if ($meetingRooms !== []): ?>
            <?php foreach ($meetingRooms as $meetingRoom): ?>
                <?php if ($meetingRoom->available == 1): ?>
                    <div class="card mb-3 bg-dark-subtle">
                        <div class="card-body">
                            <div class="card-title d-flex justify-content-between">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item bg-dark-subtle">Type de salle: <?= esc($meetingRoom->type); ?></li>
                                    <li class="list-group-item bg-dark-subtle">Prix de la salle: <?= esc($meetingRoom->price); ?>€</li>
                                </ul>
                                <small class="text-body-tertiary">Numéro de salle: <?= esc($meetingRoom->num); ?></small>
                            </div>
                            <a href="<?= site_url('meetingRooms/' . esc($meetingRoom->num)); ?>" class="btn btn-primary">Détails</a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="mb-3 mt-3">Aucune Salle de réunions n'est disponible.</p>
        <?php endif; ?>
        <!-- @TODO ajouter style -->
        <?= $pager->links(); ?>
    </section>
<?= $this->endSection(); ?>
