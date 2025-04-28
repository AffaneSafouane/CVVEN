<?php
/**
 * @var ?\App\Entities\Reservation[] $reservations
 * @var string $title
 */
?>
<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?><?= esc($title); ?><?= $this->endSection(); ?>
<?= $this->section('main'); ?>
<section class="container px-4">
    <h1 class="mb-3 mt-3"><?= esc($title); ?></h1>
    <?php if (session('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
            <?= session('success'); ?>
        </div>
    <?php endif; ?>
    <?php if ($reservations !== []): ?>
        <?php foreach ($reservations as $reservation): ?>
            <div class="card mb-3 bg-dark-subtle">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between">
                        <ul class="list-group list-group-flush">
                            <!-- TODO: Ajouter le type de chambre -->
                            <li class="list-group-item bg-dark-subtle"><?= $reservation->pension->getLabel(); ?></li>
                            <li class="list-group-item bg-dark-subtle"><?= $reservation->getStartDate() . ' - ' . $reservation->getEndDate(); ?></li>
                            <li class="list-group-item bg-dark-subtle"><?= $reservation->getUser()->last_name." ".$reservation->getUser()->first_name; ?></li>
                        </ul>
                    </div>
                    <!-- TODO: ajouter un lien vers détails réservation (show() ReservationController) -->
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Vous n'avez aucune réservations pour le moment</p>
    <?php endif; ?>
</section>
<?= $this->endSection(); ?>
