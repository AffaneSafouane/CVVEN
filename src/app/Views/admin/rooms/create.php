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
        <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
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

    <div class="w-50 mx-auto bg-dark-subtle p-4 rounded-lg border">
        <h5 class="mb-3"><?= esc($title); ?></h5>

        <form action="<?= $room ? url_to('admin/rooms/edit/' . $room->id) : url_to('admin/rooms/create/'); ?>" method="post">
            <?= csrf_field() ?>

            <!-- Room Number -->
            <div class="mb-3">
                <label class="form-label" for="emailInput">Numéro de chambre*</label>
                <input type="text" class="form-control" id="emailInput" name="room_number" pattern="B[0-9]{4}" value="<?= old('room_number', $room->num ?? ''); ?>" required>
            </div>

            <!-- Type -->
            <div class="mb-3">
                <label class="form-label" for="typeInput">Type de chambre*</label>
                <input type="text" class="form-control" id="typeInput" name="type" inputmode="text" placeholder="Type de la chambre" value="<?= old('type', $room->type ?? ''); ?>">
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label class="form-label" for="descriptionInput">Description*</label>
                <textarea name="description" id="descriptionInput" cols="10" rows="10" minlength="5" maxlength="500" required>
                        <?= old('description', $room->description ?? ''); ?>
                    </textarea>
            </div>

            <!-- Price -->
            <div class="mb-3">
                <label class="form-label" for="priceInput">Prix</label>
                <input class="form-control" type="number" name="price" id="priceInput" inputmode="number" placeholder="Prix de la chambre" value="<?= old('price', $room->price ?? ''); ?>" required/>
            </div>

            <!-- Available -->
            <fieldset class="form-group border p-3">
                <legend class="w-auto px-2">Disponible*</legend>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="available--yes" name="available" value="1" <?= old('available', $room->available ?? '') == '1' ? 'checked' : '' ?> />
                    <label for="available--yes" class="form-check-label">Oui</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="available--no" name="available" value="0" <?= old('available', $room->available ?? '') == '0' ? 'checked' : '' ?> />
                    <label for="available--no" class="form-check-label">Non</label>
                </div>
            </fieldset>

            <!-- Capacity -->
            <div class="mb-3">
                <label class="form-label" for="capacityInput">Capacité*</label>
                <input class="form-control" type="number" name="capacity" id="capacityInput" inputmode="text" placeholder="Capacité de la chambre" value="<?= old('capacity', $room->capacity ?? ''); ?>" min="1" max="5" required/>
            </div>

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
