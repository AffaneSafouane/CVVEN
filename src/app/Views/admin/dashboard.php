<?php
/**
 * @var ?int $todayBookings
 * @var ?int $weekBookings
 * @var ?int $monthBookings
 * @var ?int $totalRooms
 * @var ?\App\Entities\Reservation[] $upcomingBookings
 * @var ?\App\Entities\Room[] $popularRooms
 * @var string $title
 */
?>
<?= $this->extend('layout') ?>

<?= $this->section('main') ?>
    <section class="container px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Tableau de bord</h1>
        </div>

        <!-- Cartes des statistiques -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Réservations d'aujourd'hui</h5>
                        <p class="card-text display-6"><?= $todayBookings ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Réservations de cette semaine</h5>
                        <p class="card-text display-6"><?= $weekBookings ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Réservations de ce mois</h5>
                        <p class="card-text display-6"><?= $monthBookings ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total des chambres</h5>
                        <p class="card-text display-6"><?= $totalRooms ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Réservations à venir -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Réservations à venir</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                                <thead>
                                <tr>
                                    <th>Chambre</th>
                                    <th>Utilisateur</th>
                                    <th>Date</th>
                                    <th>Heure</th>
                                    <th>Statut</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($upcomingBookings as $booking): ?>
                                    <tr>
                                        <td><?= esc($booking->getRoom()->num) ?></td>
                                        <td><?= esc($booking->getUser()->last_name) ?></td>
                                        <td><?= esc($booking->getCreatedAt()) ?></td>
                                        <td><?= esc($booking->getStartDate()); ?> - <?= esc($booking->getEndDate()); ?></td>
                                        <td>
                                            <?php if ($booking->status == 'En attente'): ?>
                                                <span class="badge bg-warning">En attente</span>
                                            <?php elseif ($booking->status == 'Confirmée'): ?>
                                                <span class="badge bg-success">Confirmée</span>
                                            <?php elseif ($booking->status == 'Annulée'): ?>
                                                <span class="badge bg-danger">Annulée</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if (empty($upcomingBookings)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Aucune réservation à venir</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <a href="<?= site_url('admin/reservations') ?>" class="btn btn-sm btn-primary">Voir toutes les réservations</a>
                    </div>
                </div>
            </div>

            <!-- Chambres populaires -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Chambres les plus populaires</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                                <thead>
                                <tr>
                                    <th>Nom de la chambre</th>
                                    <th>Capacité</th>
                                    <th>Nombre de réservations</th>
                                    <th>Statut</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($popularRooms as $room): ?>
                                    <tr>
                                        <td><?= esc($room->num) ?></td>
                                        <td><?= esc($room->capacity) ?></td>
                                        <td><?= esc($room->booking_count) ?></td>
                                        <td>
                                            <?php if ($room->available): ?>
                                                <span class="badge bg-success">Disponible</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Indisponible</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if (empty($popularRooms)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Aucune donnée sur les chambres</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <a href="<?= site_url('admin/rooms') ?>" class="btn btn-sm btn-primary">Voir toutes les chambres</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?= $this->endSection() ?>