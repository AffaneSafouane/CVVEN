<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?>
    <?= esc($title); ?>
<?= $this->endSection(); ?>

<?= $this->section('main'); ?>
<section class="container px-4 py-4">
    <h1 class="mb-4"><?= esc($title); ?></h1>

    <?php if (! $reservation): ?>
        <div class="alert alert-danger">Réservation introuvable.</div>
    <?php else: ?>
        <ul class="list-group mb-3">
            <li class="list-group-item">
                <strong>ID :</strong> <?= esc($reservation->id); ?>
            </li>
            <li class="list-group-item">
                <strong>Dates :</strong>
                <?= esc($reservation->getStartDate()); ?> &rarr;
                <?= esc($reservation->getEndDate()); ?>
            </li>
            <li class="list-group-item">
                <strong>Pension :</strong>
                <?php
                    $p = $reservation->pension;
                    if ($p instanceof \App\Enum\PensionType) {
                        echo esc($p->getLabel());
                    } else {
                        echo esc($p);
                    }
                ?>
            </li>
            <li class="list-group-item">
                <strong>Option ménage :</strong>
                <?= $reservation->cleaningOption ? 'Oui' : 'Non'; ?>
            </li>
            <li class="list-group-item">
                <strong>Personnes :</strong>
                <?= esc($reservation->numberOfPeople); ?>
            </li>
            <li class="list-group-item">
                <strong>Prix total :</strong>
                <?= number_format($reservation->totalPrice, 2, ',', ' '); ?> €
            </li>
            <li class="list-group-item">
                <strong>Statut :</strong>
                <?php
                    // Le statut est un enum ReservationStatus
                    $s = $reservation->status;
                    if ($s instanceof \App\Enum\ReservationStatus) {
                        echo esc($s->value);
                    } else {
                        echo esc($s);
                    }
                ?>
            </li>
            <li class="list-group-item">
                <strong>Chambre :</strong>
                Chambre <?= esc($reservation->getRoom()->num ?? 'N/A'); ?>
            </li>
        </ul>

        <div class="btn-group">
            <?php if ($reservation->status->value === 'En attente'): ?>
                <a href="<?= site_url("reservations/cancel/{$reservation->id}"); ?>"
                   class="btn btn-danger"
                   onclick="return confirm('Annuler cette réservation ?');">
                    Annuler
                </a>
            <?php endif; ?>
            <a href="<?= site_url('reservations'); ?>" class="btn btn-secondary">
                Retour
            </a>
        </div>
    <?php endif; ?>
</section>
<?= $this->endSection(); ?>
