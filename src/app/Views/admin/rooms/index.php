<?php
/**
 * @var ?\App\Entities\Room[] $rooms
 * @var string $title
 * @var \CodeIgniter\Pager\Pager $pager
 * @var ?string $type
 * @var ?bool $available
 */
?>
<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?><?= esc($title); ?><?= $this->endSection(); ?>
<?= $this->section('main'); ?>
<section class="container py-4">
    <?php if (session('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <?= session('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-light"><?= esc($title); ?></h1>
        <a href="<?= site_url('admin/rooms/form'); ?>" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Ajouter
        </a>
    </div>

    <!-- Filtres -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body bg-dark-subtle">
            <form class="row g-3" action="<?= site_url('admin/rooms'); ?>" method="GET">
                <div class="col-md-4">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-select" id="type" name="type">
                        <option value="" selected>Tous les types</option>
                        <option value="Logement" <?= $type === 'Logement' ? 'selected' : '' ?>>Logement</option>
                        <option value="Chambre Double" <?= $type === 'Chambre Double' ? 'selected' : '' ?>>Chambre Double</option>
                        <option value="Chambre Triple" <?= $type === 'Chambre Triple' ? 'selected' : '' ?>>Chambre Triple</option>
                        <option value="Chambre Quadruple" <?= $type === 'Chambre Quadruple' ? 'selected' : '' ?>>Chambre Quadruple</option>
                        <option value="Chambre Accessible" <?= $type === 'Chambre Accessible' ? 'selected' : '' ?>>Chambre Accessible</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="available" class="form-label">Disponible</label>
                    <select class="form-select" id="available" name="available">
                        <option value="" selected>Toutes</option>
                        <option value="1" <?= $available == '1' ? 'selected' : '' ?>>Disponible</option>
                        <option value="0" <?= $available == '0' ? 'selected' : '' ?>>Indisponible</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2 w-100">
                        <i class="bi bi-search me-2"></i>Filtrer
                    </button>
                    <a href="<?= site_url('admin/rooms'); ?>" class="btn btn-outline-secondary w-auto">
                        <i class="bi bi-x-circle"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <?php if ($rooms !== []): ?>
        <div class="card bg-dark-subtle text-light border-secondary p-3">
            <div class="list-group list-group-flush">
                <?php foreach ($rooms as $room): ?>
                    <div class="list-group-item bg-dark-subtle text-light border-secondary">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-0">
                                    <a href="<?= base_url('admin/rooms/' . $room->id); ?>">
                                        Chambre <?= esc($room->num); ?>
                                    </a>
                                </h5>
                                <small class="text-secondary">ID: <?= esc($room->id); ?></small>
                            </div>
                            <div class="d-flex">
                                <span class="badge <?= $room->available ? 'bg-success' : 'bg-danger' ?> me-2">
                                    <?= $room->available ? 'Disponible' : 'Indisponible' ?>
                                </span>
                                <a href="<?= base_url('admin/rooms/' . $room->id); ?>" class="btn btn-sm btn-outline-info">
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="d-flex justify-content mt-4">
            <?= $pager->links(); ?>
        </div>
    <?php else: ?>
        <div class="card bg-dark text-light border-secondary">
            <div class="card-body text-center py-4">
                <i class="bi bi-house-x text-secondary" style="font-size: 2rem;"></i>
                <p class="mt-3 mb-0">Aucune chambre n'est répertoriée pour le moment</p>
            </div>
        </div>
    <?php endif; ?>
</section>
<?= $this->endSection(); ?>
