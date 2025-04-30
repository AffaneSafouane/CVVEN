<?php
/**
 * @var ?\App\Entities\Reservation[] $reservations
 * @var string $title
 */
?>
<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?>
    <?= esc($title); ?>
<?= $this->endSection(); ?>

<?= $this->section('main'); ?>
<section class="container py-4">
    <h1 class="mb-4"><?= esc($title); ?></h1>

    <?php if (session('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <?= session('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (! empty($reservations)) : ?>
        <?php foreach ($reservations as $res) : ?>
            <div class="card mb-3 bg-dark-subtle">
                <div class="card-body">
                    <h5 class="card-title">
                        Chambre <?= esc($res->getRoom()?->num ?? '-') ?>
                    </h5>
                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item bg-dark-subtle">
                            <strong>Dates :</strong>
                            <?= esc($res->getStartDate()) ?> — <?= esc($res->getEndDate()) ?>
                        </li>
                        <li class="list-group-item bg-dark-subtle">
                            <strong>Statut :</strong> <?= esc($res->status->value) ?>
                        </li>
                        <li class="list-group-item bg-dark-subtle">
                            <strong>Pension :</strong> <?= esc($res->pension->getLabel()) ?>
                        </li>
                        <li class="list-group-item bg-dark-subtle">
                            <strong>Option ménage :</strong> <?= $res->cleaningOption ? 'Oui' : 'Non' ?>
                        </li>
                        <!-- Si tu as persité séparément adultes/enfants/animaux -->
                        <?php if (isset($res->adults)) : ?>
                            <li class="list-group-item bg-dark-subtle">
                                <strong>Adultes :</strong> <?= esc($res->adults) ?>
                            </li>
                        <?php endif; ?>
                        <?php if (isset($res->children)) : ?>
                            <li class="list-group-item bg-dark-subtle">
                                <strong>Enfants :</strong> <?= esc($res->children) ?>
                            </li>
                        <?php endif; ?>
                        <?php if (isset($res->animals)) : ?>
                            <li class="list-group-item bg-dark-subtle">
                                <strong>Animaux :</strong> <?= esc($res->animals) ?>
                            </li>
                        <?php endif; ?>
                        <li class="list-group-item bg-dark-subtle">
                            <strong>Prix total :</strong>
                            <?= number_format($res->totalPrice, 2, ',', ' ') ?> €
                        </li>
                    </ul>
                    <a href="<?= site_url('reservations/' . $res->id) ?>"
                       class="btn btn-sm btn-outline-info">
                        Voir le détail
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Vous n'avez aucune réservation pour le moment.</p>
    <?php endif; ?>
</section>
<?= $this->endSection(); ?>
