<?php
/**
 * @var ?\App\Entities\MeetingRoom $meetingRooms
 * @var string $title
 */
?>
<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?><?= esc($title); ?><?= $this->endSection(); ?>

<?= $this->section('main'); ?>
<section class="container px-4">
    <h1><?= esc($title); ?></h1>
    <?php if ($meetingRooms !== []): ?>
        <?php foreach ($meetingRooms as $meetingRoom): ?>
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item"><?= $meetingRoom->id; ?></li>
                <li class="list-group-item"><?= $meetingRoom->type; ?></li>
                <li class="list-group-item"><?= $meetingRoom->description; ?></li>
                <li class="list-group-item"><?= $meetingRoom->price; ?></li>
                <li class="list-group-item"><?= $meetingRoom->capacity; ?></li>
                <li class="list-group-item"><?= $meetingRoom->available ? 'Disponible' : 'Indisponible'; ?></li>
                <?php if ($meetingRoom->reservation): ?>
                    <li class="list-group-item">
                        <a class="link-primary" href="#">Réservation</a>
                    </li>
                <?php endif; ?>
            </ul>
        <?php endforeach; ?>
    <?php endif; ?>
</section>
<?= $this->endSection(); ?>
