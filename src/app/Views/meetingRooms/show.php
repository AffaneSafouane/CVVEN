<?php
/**
 * @var string $title
 * @var ?\App\Entities\MeetingRoom $meetingRoom
 */
?>

<?= $this->extend('layout'); ?>

<?= $this->section('title') ?><?= esc($title) ?><?= $this->endSection() ?>

<?= $this->section('main'); ?>
    <!-- @TODO ajouter une image -->
    <section class="container px-4">
        <div class="d-flex justify-content-between">
            <h1><?= esc($title); ?></h1>
            <span class="align-content-center">
            <a href="<?= site_url('meetingRooms'); ?>" class="link">Retour</a>
        </span>
        </div>
        <?php if ($meetingRoom !== null): ?>
            <div class="card bg-dark-subtle">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between">
                        <h4 class="mb-1"><?= esc($meetingRoom->type); ?></h4>
                        <small class="text-body-tertiary">Numéro de salle: <?= esc($meetingRoom->num); ?></small>
                    </div>
                    <div class="d-flex justify-content-between card-text mb-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-dark-subtle"><?= esc($meetingRoom->description); ?></li>
                            <li class="list-group-item bg-dark-subtle">Capacité: <?= esc($meetingRoom->capacity); ?></li>
                            <li class="list-group-item bg-dark-subtle">Prix: <?= esc($meetingRoom->price); ?>€</li>
                        </ul>
                    </div>
                    <a href="<?= site_url('meetingRooms/new/' . $meetingRoom->num); ?>" class="btn btn-primary">Réserver</a>
                </div>
            </div>
        <?php else: ?>
            <p>Salle de réunion introuvable.</p>
        <?php endif; ?>
    </section>
<?= $this->endSection(); ?>