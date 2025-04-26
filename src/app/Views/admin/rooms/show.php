<?php
/**
 * @var ?App\Entities\Room $room
 * @var string $title
 */
?>
<?= $this->extend('layout'); ?>

<?= $this->section('main'); ?>
    <section class="container py-4">
        <?php if (session('success') !== null) : ?>
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <?= session('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>
        <?php if (session('error') !== null) : ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <?= session('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-light"><?= esc($title); ?></h1>
            <a href="<?= site_url('admin/rooms'); ?>" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>

        <?php if($room !== null): ?>
            <div class="card border-0 shadow mb-4 bg-dark-subtle text-light">
                <div class="card-header bg-dark-subtle border-secondary d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Chambre <?= esc($room->num); ?></h3>
                    <span class="badge bg-secondary">ID: <?= esc($room->id); ?></span>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-7">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item bg-dark-subtle text-light border-secondary">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="text-info">Type de chambre</h5>
                                        <span><?= esc($room->type); ?></span>
                                    </div>
                                </div>
                                <div class="list-group-item bg-dark-subtle text-light border-secondary">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="text-info">Prix</h5>
                                        <span><?= esc($room->price); ?>€</span>
                                    </div>
                                </div>
                                <div class="list-group-item bg-dark-subtle text-light border-secondary">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="text-info">Capacité</h5>
                                        <span><?= esc($room->capacity); ?> personnes</span>
                                    </div>
                                </div>
                                <div class="list-group-item bg-dark-subtle text-light border-secondary">
                                    <h5 class="text-info">Description</h5>
                                    <p><?= esc($room->description); ?></p>
                                </div>
                                <div class="list-group-item bg-dark-subtle text-light border-secondary">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="text-info">Statut</h5>
                                        <?php if($room->available): ?>
                                            <span class="badge bg-success">Disponible</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Indisponible</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card bg-dark-subtle border-secondary h-100">
                                <img src="<?= $room->imgUrl ? base_url($room->imgUrl) : base_url('images/placeholder.png'); ?>"
                                     alt="Image de la chambre"
                                     class="card-img-top img-fluid rounded object-fit-cover"
                                     style="max-height: 300px">
                                <div class="card-body text-center">
                                    <p class="card-text small text-secondary">Image de la chambre <?= esc($room->num); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-dark-subtle border-secondary">
                    <div class="d-flex justify-content-between">
                        <a href="<?= site_url('admin/rooms/form/' . $room->id); ?>" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Éditer
                        </a>
                        <form action="<?= site_url('admin/rooms/delete/' . $room->id); ?>" method="POST" id="delete-form">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger" onclick="return confirmDelete()">
                                <i class="bi bi-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                Impossible de trouver la chambre demandée
            </div>
        <?php endif; ?>
    </section>

    <!-- Make sure your Bootstrap theme is dark -->
    <script>
        function confirmDelete() {
            return confirm('Êtes vous sûr de vouloir supprimer les données ?');
        }
    </script>
<?= $this->endSection(); ?>