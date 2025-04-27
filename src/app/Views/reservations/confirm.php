<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?><?= esc($title); ?><?= $this->endSection(); ?>

<?= $this->section('main'); ?>
<section class="container py-4">
    <h2 class="mb-4"><?= esc($title); ?></h2>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Chambre :</strong> <?= esc($room->num); ?></p>
            <p><strong>Date d'arrivée :</strong> <?= esc($data['start_date']); ?></p>
            <p><strong>Date de départ :</strong> <?= esc($data['end_date']); ?></p>
            <p><strong>Nuits :</strong> <?= esc($nights); ?></p>
            <p><strong>Adultes :</strong> <?= esc($data['adults']); ?></p>
            <p><strong>Enfants :</strong> <?= esc($data['children']); ?></p>
            <p><strong>Animaux :</strong> <?= esc($data['animals']); ?></p>
            <p><strong>Option pension :</strong> <?= esc($data['meal_option']); ?></p>
            <p><strong>Extra pension :</strong> +<?= esc($pensionExtra); ?> €</p>
            <p><strong>Option ménage :</strong> <?= ! empty($data['cleaning_option']) ? 'Oui' : 'Non'; ?></p>
            <p><strong>Frais ménage :</strong> +<?= esc($cleaningFee); ?> €</p>
            <hr>
            <p><strong>Prix de base (<?= esc($nights); ?>×<?= number_format($room->price,2,',',' '); ?> €) :</strong>
                <?= number_format($basePrice,2,',',' '); ?> €
            </p>
            <p><strong>Réduction quotient familial :</strong> −<?= number_format($discount,2,',',' '); ?> €</p>
            <h4><strong>Total à payer :</strong>
                <?= number_format($totalPrice,2,',',' '); ?> €
            </h4>
        </div>
    </div>

    <form action="<?= site_url('reservations/create') ?>" method="post">
        <?= csrf_field(); ?>
        <button type="submit" class="btn btn-success">Confirmer ma réservation</button>
        <a href="<?= site_url("rooms/{$room->id}/reservation") ?>"
           class="btn btn-secondary">Modifier mes choix</a>
    </form>
</section>
<?= $this->endSection(); ?>
