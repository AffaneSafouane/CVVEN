<?php
/**
 * @var ?App\Entities\Room $room
 * @var string $title
 */
?>
<?= $this->extend('layout'); ?>

<?= $this->section('main'); ?>
<section class="container px-4">
    <?php if (session('success') !== null) : ?>
        <div class="alert alert-success mt-3" role="alert"><?= session('success') ?></div>
    <?php endif ?>
    <?php if (session('error') !== null) : ?>
        <div class="alert alert-danger mt-3" role="alert"><?= session('error') ?></div>
    <?php endif ?>
    <div class="d-flex justify-content-between">
        <h1><?= esc($title); ?></h1>
        <span class="align-content-center">
            <a href="<?= site_url('admin/rooms'); ?>" class="link">Retour</a>
        </span>
    </div>
    <?php if($room !== null): ?>
        <div class="card mb-1 m-auto bg-dark-subtle">
            <div class="card-body">
                <div class="card-title d-flex justify-content-between">
                    <h4 class="mb-1"><?= esc($room->num); ?></h4>
                    <small class="text-muted">Identifiant : <?= esc($room->id); ?></small>
                </div>
                <div class="d-flex justify-content-between card-text">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-dark-subtle">
                            <h5>Type de chambre</h5><?= esc($room->type); ?>
                        </li>
                        <li class="list-group-item bg-dark-subtle">
                            <h5>Prix</h5><?= esc($room->price); ?>€
                        </li>
                        <li class="list-group-item bg-dark-subtle">
                            <h5>Capacité</h5><?= esc($room->capacity); ?> personnes
                        </li>
                        <li class="list-group-item bg-dark-subtle">
                            <h5>Description</h5><?= esc($room->description); ?>
                        </li>
                        <li class="list-group-item bg-dark-subtle">
                            <?= $room->available ? 'Cette chambre est disponible' : 'Cette chambre est indisponible'; ?>
                        </li>
                    </ul>
                    <div>
                        <img src="<?= $room->imgUrl ? base_url($room->imgUrl) : base_url('images/placeholder.png') ; ?>" alt="Image de la chambre" class="img-fluid img-thumbnail" width="450rem">
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <a href="<?= site_url('admin/rooms/form/' . $room->id); ?>" class="btn btn-warning">Éditer</a>
            </div>
            <div class="col">
                <form action="<?= site_url('admin/rooms/delete/' . $room->id); ?>" method="POST" class="float-end" id="delete-form">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger" onclick="return confirmDelete()">Supprimer</button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <p>Impossible de trouver la chambre demandée</p>
        </div>
    <?php endif; ?>
</section>
    <script>
        function confirmDelete() {
            return confirm('Êtes vous sûr de vouloir supprimer les données ?');
        }
    </script>
<?= $this->endSection(); ?>