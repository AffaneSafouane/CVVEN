<?php
/**
 * @var ?\App\Entities\Reservation[] $reservations
 * @var string $title
 * @var ?string $status
 * @var ?string $date
 */
?>
<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?><?= esc($title); ?><?= $this->endSection(); ?>
<?= $this->section('main'); ?>
<section class="container py-5">
    <!-- Notifications -->
    <?php if (session('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> <?= session('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    <?php endif; ?>

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0"><?= esc($title); ?></h1>
    </div>

    <!-- Filtres -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body bg-dark-subtle">
            <form class="row g-3" action="<?= site_url('admin/reservations'); ?>" method="GET">
                <div class="col-md-4">
                    <label for="status" class="form-label">Statut</label>
                    <select class="form-select" id="status" name="status">
                        <option value="" selected>Tous les statuts</option>
                        <option value="Confirmée" <?= $status === 'Confirmée' ? 'selected' : '' ?>>Confirmée</option>
                        <option value="En attente" <?= $status === 'En attente' ? 'selected' : '' ?>>En attente</option>
                        <option value="Annulée" <?= $status === 'Annulée' ? 'selected' : '' ?>>Annulée</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date" value="<?= $date ?? '' ?>">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2 w-100">
                        <i class="bi bi-search me-2"></i>Filtrer
                    </button>
                    <a href="<?= site_url('admin/reservations'); ?>" class="btn btn-outline-secondary w-auto">
                        <i class="bi bi-x-circle"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Liste des réservations -->
    <?php if ($reservations !== []): ?>
        <div class="row g-4">
            <?php foreach ($reservations as $reservation): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow">
                        <!-- En-tête avec statut -->
                        <div class="card-header border-bottom-0 pt-3 pb-0" style="background-color: #181a1b">
                            <?php
                            // Détermine la classe de couleur selon le statut
                            $statusLabel = $reservation->status->getLabel();
                            $statusClass = 'bg-warning'; // Par défaut
                            $statusIcon = 'bi-clock';

                            if (str_contains(strtolower($statusLabel), 'confirm')) {
                                $statusClass = 'bg-success';
                                $statusIcon = 'bi-check-circle';
                            } else if (str_contains(strtolower($statusLabel), 'annul')) {
                                $statusClass = 'bg-danger';
                                $statusIcon = 'bi-x-circle';
                            }
                            ?>
                            <div class="badge <?= $statusClass; ?> position-absolute top-0 end-0 mt-3 me-3 px-3 py-2">
                                <i class="bi <?= $statusIcon; ?> me-1"></i>
                                <?= $statusLabel; ?>
                            </div>
                            <h5 class="text-primary mb-1">
                                <i class="bi bi-buildings me-2"></i>Chambre #<?= $reservation->getRoom()->num; ?>
                            </h5>
                            <p class="text-muted small mb-3">Réservation #<?= esc($reservation->id); ?></p>
                        </div>

                        <!-- Corps de la carte -->
                        <div class="card-body pt-2 bg-dark-subtle">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-dark rounded-circle p-2 me-3">
                                    <i class="bi bi-person-circle fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">
                                        <?= isset($reservation->getUser) ? esc($reservation->getUser()->getFullName()) : 'Client'; ?>
                                    </h6>
                                    <span class="badge bg-info text-dark">
                                        <?= isset($reservation->numberOfPeople) ? $reservation->numberOfPeople : '?'; ?> personnes
                                    </span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-calendar-event text-primary me-2"></i>
                                    <h6 class="mb-0">Période de séjour</h6>
                                </div>
                                <p class="ms-4 mb-0">
                                    <?= $reservation->getStartDate() . " - " . $reservation->getEndDate(); ?>
                                </p>
                            </div>

                            <?php if (isset($reservation->totalPrice)) : ?>
                                <div class="mb-0">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-cash-coin text-primary me-2"></i>
                                        <h6 class="mb-0">Prix total</h6>
                                    </div>
                                    <p class="ms-4 mb-0 fw-bold">
                                        <?= esc($reservation->totalPrice); ?> €
                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Footer avec actions -->
                        <div class="card-footer border-top-0" style="background-color: #181a1b">
                            <div class="d-grid">
                                <a href="<?= site_url('admin/reservations/' . $reservation->id); ?>"
                                   class="btn btn-outline-primary">
                                    <i class="bi bi-eye me-2"></i>Voir les détails
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (isset($pager)) : ?>
            <div class="mt-4 d-flex justify-content">
                <?= $pager->links() ?>
            </div>
        <?php endif; ?>

    <?php else: ?>
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <i class="bi bi-calendar-x text-muted" style="font-size: 4rem;"></i>
                <h3 class="mt-3">Aucune réservation pour le moment</h3>
            </div>
        </div>
    <?php endif; ?>
</section>

<script>
    // CSS personnalisé pour améliorer les effets de survol
    document.head.innerHTML += `
<style>
.hover-shadow {
    transition: transform 0.2s, box-shadow 0.2s;
}
.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
}
</style>
`;
</script>
<?= $this->endSection(); ?>
