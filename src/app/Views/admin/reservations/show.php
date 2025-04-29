<?php
/**
 * @var ?App\Entities\Reservation $reservation
 * @var string $title
 */
?>
<?= $this->extend('layout'); ?>

<?= $this->section('main'); ?>
<section class="container py-5">
    <!-- Notifications -->
    <?php if (session('success') !== null) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    <?php endif ?>
    <?php if (session('error') !== null) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    <?php elseif (session('errors') !== null) : ?>
        <div class="alert alert-danger" role="alert">
            <?php if (is_array(session('errors'))) : ?>
                <?php foreach (session('errors') as $error) : ?>
                    <?= $error ?>
                    <br>
                <?php endforeach ?>
            <?php else : ?>
                <?= session('errors') ?>
            <?php endif ?>
        </div>
    <?php endif ?>

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0"><?= esc($title); ?></h1>
        <a href="<?= site_url('admin/reservations'); ?>" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left me-1"></i> Retour
        </a>
    </div>

    <?php if($reservation !== null): ?>
        <div class="card shadow-sm border-0 mb-4 bg-dark-subtle">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                <h3 class="mb-0">Réservation #<?= esc($reservation->id); ?></h3>
                <span class="badge bg-dark rounded-pill fs-6">
                    <?= $reservation->status->getLabel(); ?>
                </span>
            </div>

            <div class="card-body">
                <!-- Client info -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-dark rounded-circle p-3 me-3">
                                <i class="bi bi-person-circle fs-3"></i>
                            </div>
                            <div>

                                <h4 class="mb-0"><a href="<?= base_url('admin/user/' . $reservation->getUser()->id); ?>" class="text-decoration-none"><?= esc($reservation->getUser()->last_name . ' ' . $reservation->getUser()->first_name); ?></a></h4>

                                <small class="text-muted">Client</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="badge bg-info text-dark fs-6 mb-2">
                            <i class="bi bi-calendar-event me-1"></i> <?= esc($reservation->getStartDate() . " - " . $reservation->getEndDate()); ?>
                        </div>
                        <div class="d-block text-muted small">
                            <span class="me-3">Créée le: <?= esc($reservation->getCreatedAt()); ?></span>
                            <span>Modifiée le: <?= esc($reservation->getUpdatedAt()); ?></span>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- Chambre image -->
                    <?php if($reservation->getRoom()): ?>
                        <div class="col-lg-5">
                            <div class="card h-100 border-0 shadow-sm">
                                <img src="<?= $reservation->getRoom()->imgUrl ? base_url($reservation->getRoom()->imgUrl) : base_url('images/placeholder.png'); ?>"
                                     alt="Image de la chambre"
                                     class="card-img-top img-fluid rounded-top"
                                     style="object-fit: cover; height: 300px;">
                                <div class="card-body bg-dark">
                                    <h5 class="card-title d-flex justify-content-between">
                                        <span>Chambre #<?= esc($reservation->getRoom()->num); ?></span>
                                        <span class="badge bg-primary rounded-pill"><?= esc($reservation->numberOfPeople); ?> personnes</span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Détails de la réservation -->
                    <div class="col-lg-7">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-header bg-dark">
                                <h4 class="mb-0">Détails de la réservation</h4>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="p-3 bg-dark-subtle rounded">
                                            <h5 class="text-primary"><i class="bi bi-calendar3 me-2"></i>Dates du séjour</h5>
                                            <p class="mb-0"><?= esc($reservation->getStartDate() . " - " . $reservation->getEndDate()); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="p-3 bg-dark-subtle rounded">
                                            <h5 class="text-primary"><i class="bi bi-people me-2"></i>Nombre de personnes</h5>
                                            <p class="mb-0"><?= esc($reservation->numberOfPeople); ?> personnes</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="p-3 bg-dark-subtle rounded">
                                            <h5 class="text-primary"><i class="bi bi-cup-hot me-2"></i>Type de pension</h5>
                                            <p class="mb-0"><?= esc($reservation->pension->getLabel()); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="p-3 bg-dark-subtle rounded">
                                            <h5 class="text-primary"><i class="bi bi-cash-coin me-2"></i>Prix total</h5>
                                            <p class="mb-0 fw-bold"><?= esc($reservation->totalPrice); ?> €</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="p-3 bg-dark-subtle rounded">
                                            <h5 class="text-primary"><i class="bi bi-brush me-2"></i>Option ménage</h5>
                                            <p class="mb-0">
                                                <?php if ($reservation->cleaningOption): ?>
                                                    <span class="text-success"><i class="bi bi-check-circle me-1"></i> Avec ménage de fin de séjour</span>
                                                <?php else: ?>
                                                    <span class="text-danger"><i class="bi bi-x-circle me-1"></i> Sans ménage de fin de séjour</span>
                                                <?php endif; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="p-3 bg-dark-subtle rounded">
                                            <h5 class="text-primary"><i class="bi bi-tag me-2"></i>Statut</h5>
                                            <p class="mb-0">
                                                <?php
                                                $statusClasses = [
                                                    'Confirmée' => 'text-success',
                                                    'En attente' => 'text-warning',
                                                    'Annulée' => 'text-danger'
                                                ];
                                                $statusClass = $statusClasses[$reservation->status->getLabel()] ?? 'text-secondary';
                                                ?>
                                                <span class="<?= $statusClass; ?> fw-bold">
                                                    <?= $reservation->status->getLabel(); ?>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="card-footer p-4 bg-dark-subtle">
                <div class="row">
                    <?php if($reservation->status->getLabel() !== "Confirmée" && $reservation->status->getLabel() !== "Annulée"): ?>
                        <div class="col-md-6 d-grid">
                            <form action="<?= site_url('admin/reservations/confirm/' . $reservation->id); ?>" method="POST" id="confirm-form">
                                <?= csrf_field(); ?>
                                <button type="submit" class="btn btn-success btn-lg w-100" onclick="return confirm('Êtes-vous sûr de vouloir confirmer cette réservation ?')">
                                    <i class="bi bi-check-circle me-2"></i> Confirmer la réservation
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>
                    <?php if($reservation->status->getLabel() !== "Annulée"): ?>
                        <div class="col-md-6 d-grid mt-3 mt-md-0">
                            <form action="<?= site_url('admin/reservations/cancel/' . $reservation->id); ?>" method="POST" id="cancel-form">
                                <?= csrf_field(); ?>
                                <button type="submit" class="btn btn-danger btn-lg w-100" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')">
                                    <i class="bi bi-x-circle me-2"></i> Annuler la réservation
                                </button>
                            </form>
                        </div>
                    <?php else: ?>
                        <div class="col-md-6 d-grid mt-3 mt-md-0">
                            <form action="<?= site_url('admin/reservations/delete/' . $reservation->id); ?>" method="POST" id="delete-form">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-lg w-100" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')">
                                    <i class="bi bi-trash me-2"></i> Supprimer la réservation
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <p class="mb-0"><i class="bi bi-exclamation-triangle-fill me-2"></i> Impossible de trouver la réservation demandée</p>
        </div>
    <?php endif; ?>
</section>
<?= $this->endSection(); ?>

