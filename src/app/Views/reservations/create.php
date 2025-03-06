<?php
/**
 * @var $title string
 * @var $reservationType \App\Enum\ReservationType
 * @var $id string|int|null
 * @var $capacity int
 */
?>

<?= $this->extend('layout'); ?>

<?= $this->section('title') ?><?= esc($title) ?><?= $this->endSection() ?>

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
            <h2 class="mb-3"><?= esc($title); ?></h2>

            <?= form_open('reservations/create'); ?>
                <?= csrf_field() ?>

                <input type="hidden" name="id" value="<?= esc($id); ?>">

                <input type="hidden" name="userId" value="<?= auth()->id(); ?>">

                <!-- Saisir le nombre de personnes -->
                <div class="mb-3">
                    <label for="nbPeople" class="form-label">Nombre de personnes</label>
                    <input type="number" class="form-control" name="nbPeople" id="nbPeople" placeholder="Le nombre de personnes ne peut être supérieur à <?= $capacity; ?>" min="1" max="<?= $capacity; ?>"/>
                </div>

                <!-- Choisir l'option repas -->
                <div class="mb-3">
                    <label for="pensionType" class="form-label">Option repas</label>
                    <select class="form-select" id="pensionType" name="pensionType" required>
                        <option value="" selected disabled>Choisissez une option</option>
                        <option value="Pension-Compléte">Pension complète</option>
                        <option value="Demi-Pension">Demi-pension</option>
                        <option value="Sans-Pension">Pas de pension</option>
                    </select>
                </div>

                <!-- TODO date de fin déterminer avec la date de début, 7 jours plus tard (samedi au samedi), Si date de fin tombe en dehors des vacances scolaires alors date indisponible -->
                <!-- Ajouter date de séjour -->
                <div class="mb-3">
                    <label for="startingDate" class="form-label">Date de début séjour (vacances scolaires)</label>
                    <!-- @TODO Rendre dynamique les limites de la date de début (javascript) -->
                    <input type="date" class="form-control" id="startingDate" name="startingDate" value="<?= date('Y-m-d'); ?>>" min="2025-01-01" max="2026-01-04" required/>
                </div>

                <!-- TODO: Ajouter input quotient familial (min=1, max=6) -->

                <!-- Pour les chambres : choisir ou non l'option ménage -->
                <fieldset class="form-group border p-3">
                    <legend class="w-auto px-2">Option Ménage</legend>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="cleaning--yes" name="cleaningOption" value="1"/>
                        <label for="cleaning--yes" class="form-check-label">Oui</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="cleaning--no" name="cleaningOption" value="0"/>
                        <label for="cleaning--no" class="form-check-label">Non</label>
                    </div>
                </fieldset>

                <button type="submit" class="btn btn-primary">Soumettre</button>
            <?= form_close(); ?>
        </div>
    </section>
<?= $this->endSection(); ?>