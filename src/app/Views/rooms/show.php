<?php
/**
 * @var ?App\Entities\Room $room
 * @var string $title
 */
?>
<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?>
<?= esc($title); ?>
<?= $this->endSection(); ?>

<?= $this->section('main'); ?>
<section class="container px-4 py-4">
    <h1 class="mb-4"><?= esc($title); ?></h1>

    <div class="row">
        <?php if ($room->imgUrl): ?>
            <div class="col-md-6">
                <img src="<?= base_url($room->imgUrl); ?>" class="img-fluid" alt="Chambre <?= esc($room->num); ?>">
            </div>
        <?php endif; ?>
        <div class="col-md-6">
            <ul class="list-group mb-3">
                <li class="list-group-item"><strong>Numéro :</strong> <?= esc($room->num); ?></li>
                <li class="list-group-item"><strong>Type :</strong> <?= esc($room->type); ?></li>
                <li class="list-group-item"><strong>Capacité :</strong> <?= esc($room->capacity); ?> personnes</li>
                <li class="list-group-item"><strong>Prix :</strong> <?= esc($room->price); ?> € / nuit</li>
                <li class="list-group-item">
                    <strong>Statut :</strong>
                    <?php if ($room->available): ?>
                        <span class="badge bg-success">Disponible</span>
                    <?php else: ?>
                        <span class="badge bg-danger">Indisponible</span>
                    <?php endif; ?>
                </li>
            </ul>
            <?php if ($room->available): ?>
                <a href="<?= site_url("rooms/{$room->id}/reservation"); ?>" class="btn btn-success">Réserver</a>
            <?php endif; ?>
        </div>
        <a href="<?= base_url('comments/form/' . $room->id); ?>" class="btn btn-primary">Ajouter commentaire</a>
    </div>
</section>
<?= $this->endSection(); ?>
