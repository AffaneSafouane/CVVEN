<?php
/**
 * @var $title string
 * @var $reservationType \App\Enum\ReservationType
 * @var $id string|int
 */
?>

<?= $this->extend('layout'); ?>

<?= $this->section('title') ?><?= esc($title) ?><?= $this->endSection() ?>

<?= $this->section('main'); ?>
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

    <?= form_open('reservation'); ?>
        <?= csrf_field() ?>

        <input type="hidden" name="reservationType" value="<?= esc($reservationType->getLabel()); ?>">

        <input type="hidden" name="id" value="<?= esc($id); ?>">

        <!-- Saisir le nombre de personnes -->
        <div class="mb-3">
            <label for="nbPeople" class="form-label">Nombre de personnes</label>
            <!-- @TODO Changer limite personnes dans le cas d'une salle de réunion ou d'une activités -->
            <input type="number" class="form-control" name="nbPeople" id="nbPeople" placeholder="Entrez le nombre de personnes" min="1" max="5"/>
        </div>

        <!-- Choisir l'option repas -->
        <div class="mb-3">
            <label for="mealOption" class="form-label">Option repas</label>
            <select class="form-select" id="mealOption" name="mealOption" required>
                <option value="" selected disabled>Choisissez une option</option>
                <option value="Pension-Compléte">Pension complète</option>
                <option value="Demi-Pension">Demi-pension</option>
                <option value="Sans-Pension">Pas de pension</option>
            </select>
        </div>

        <!-- @TODO date de début et fin uniquement pour salle de réunion et chambres (date prédéfinis pour activités) -->
        <!-- Ajouter date de début -->
        <div class="mb-3">
            <label for="startingDate" class="form-label">Date de début du séjour</label>
            <!-- @TODO Rendre dynamique les limites de la date de début (javascript) -->
            <input type="date" class="form-control" id="startingDate" value="2018-07-22" min="2018-01-01" max="2040-12-31" required/>
        </div>

        <!-- Ajouter date de fin -->
        <div class="mb-3">
            <label for="endingDate" class="form-label">Date de fin du séjour</label>
            <!-- @TODO Rendre dynamique les limites de la date de fin (javascript) -->
            <input type="date" class="form-control" id="endingDate" value="2018-07-22" min="2018-01-01" max="2040-12-31" required>
        </div>

        <?php if ($reservationType === "room"): ?>
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
        <?php endif; ?>

        <button type="submit" class="btn btn-primary">Soumettre</button>
    <?= form_close(); ?>
<?= $this->endSection(); ?>