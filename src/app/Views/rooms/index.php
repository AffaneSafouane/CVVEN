<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?>
<?= esc($title); ?>
<?= $this->endSection(); ?>

<?= $this->section('main'); ?>
<section class="container px-4 py-4">
    <h1 class="mb-4"><?= esc($title); ?></h1>

    <form class="row g-3 mb-4" action="<?= site_url('rooms'); ?>" method="GET">
        <div class="col-md-4">
            <label for="start" class="form-label">Date d'arrivée</label>
            <input type="date" id="start" name="start" value="<?= esc($start ?? ''); ?>" class="form-control">
        </div>
        <div class="col-md-4">
            <label for="end" class="form-label">Date de départ</label>
            <input type="date" id="end" name="end" value="<?= esc($end ?? ''); ?>" class="form-control">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filtrer</button>
        </div>
    </form>

    <?php if (! empty($rooms)): ?>
        <div class="row">
            <?php foreach ($rooms as $room): ?>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <?php if ($room->imgUrl): ?>
                            <img src="<?= base_url('images/' . $room->imgUrl); ?>" class="card-img-top" alt="Chambre <?= esc($room->num); ?>">
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Chambre <?= esc($room->num); ?></h5>
                            <p class="card-text"><?= esc($room->description); ?></p>
                            <p class="mt-auto">
                                <a href="<?= site_url("rooms/{$room->id}"); ?>" class="btn btn-outline-primary">Voir</a>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            Aucune chambre disponible pour ces dates.
        </div>
    <?php endif; ?>
</section>
<?= $this->endSection(); ?>
