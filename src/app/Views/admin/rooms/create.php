<?php
/**
 * @var ?\App\Entities\Room $room
 * @var string $title
 */
?>

<?= $this->extend('layout'); ?>

<?= $this->section('title') ?><?= esc($title); ?><?= $this->endSection() ?>

<?= $this->section('main'); ?>
<section class="container px-4">
    <?php if (session('error') !== null) : ?>
        <div class="alert alert-danger mt-3" role="alert"><?= session('error') ?></div>
    <?php elseif (session('errors') !== null) : ?>
        <div class="alert alert-danger mt-3" role="alert">
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

    <div class="w-50 mx-auto bg-dark-subtle p-4 rounded-lg border m-3">
        <h5 class="mb-3"><?= esc($title); ?></h5>

        <form action="<?= $room ? site_url('admin/rooms/edit/' . $room->id) : site_url('admin/rooms/create/'); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <?php if($room): ?>
                <input type="hidden" name="_method" value="PUT">
            <?php endif; ?>

            <!-- Room Number -->
            <div class="mb-3">
                <label class="form-label" for="emailInput">Numéro de chambre*</label>
                <input type="text" class="form-control" id="emailInput" name="room_number" pattern="B[0-9]{3}" placeholder="Numéro de chambre" value="<?= old('room_number', $room ? safe($room->num) : ''); ?>" required>
            </div>

            <!-- Type -->
            <div class="mb-3">
                <label class="form-label" for="typeInput">Type de chambre*</label>
                <input type="text" class="form-control" id="typeInput" name="type" value="<?= old('type', $room ? safe($room->type) : ''); ?>" placeholder="Type de la chambre" required>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label class="form-label" for="descriptionInput">Description*</label>
                <textarea name="description" id="descriptionInput" cols="10" rows="10" minlength="5" maxlength="500" placeholder="Description de la chambre" class="form-control" required><?= old('description', $room ? safe($room->description) : ''); ?></textarea>
            </div>

            <!-- Price -->
            <div class="mb-3">
                <label class="form-label" for="priceInput">Prix*</label>
                <input class="form-control" type="number" name="price" id="priceInput" placeholder="Prix de la chambre" value="<?= old('price', $room ? safe($room->price) : ''); ?>" required/>
            </div>

            <!-- Available -->
            <fieldset class="form-group mb-3 w-auto px-2">
                <legend>Disponible*</legend>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="available--yes" name="available" value="1" <?= old('available', $room ? safe($room->available) : '') == '1' ? 'checked' : '' ?> />
                    <label for="available--yes" class="form-check-label">Oui</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="available--no" name="available" value="0" <?= old('available', $room ? safe($room->available) : '') == '0' ? 'checked' : '' ?> />
                    <label for="available--no" class="form-check-label">Non</label>
                </div>
            </fieldset>

            <!-- Capacity -->
            <div class="mb-3">
                <label class="form-label" for="capacityInput">Capacité*</label>
                <input class="form-control" type="number" name="capacity" id="capacityInput" placeholder="Capacité de la chambre" value="<?= old('capacity', $room ? safe($room->capacity) : ''); ?>" min="1" required/>
            </div>

            <?php if ($room && !is_null($room->imgUrl)): ?>
                <div class="mb-3">
                    <label class="form-label">Image actuelle</label><br>
                    <img src="<?= base_url($room->imgUrl); ?>" alt="Image actuelle" class="img-thumbnail" width="200">
                </div>
            <?php endif; ?>

            <!-- Image -->
            <div class="mb-3">
                <label class="form-label" for="imageInput">Image</label>
                <input class="form-control" type="file" name="img_url" id="imageInput" />
            </div>

            <button type="submit" class="btn btn-primary btn-block">Soumettre</button>
        </form>
    </div>
</section>

<?= $this->endSection(); ?>
