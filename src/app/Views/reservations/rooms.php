<?php /** @var $title string */ ?>

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

    <form action="<?php url_to('/reservation/room'); ?>" method="POST">
        <?= csrf_field() ?>
        <!-- Saisir nb personnes -->

        <div class="mb-3">
            <label for="nbPeople" class="form-label">Nombre de personnes</label>
            <input type="number" class="form-control" name="nbPeople" id="nbPeople" placeholder="Entrez le nombre de personnes" maxlength="2"/>
        </div>


            <!-- choisir l'option repas -->
            <div class="mb-3">
            <label for="mealOoption" class="form-label">Option repas</label> 
            <select class="form-select" id="mealOption" name="mealOption" required>
                <option value="" selected disabled>Choisissez une option</option>
                <option value="Full Pension">Pension complète</option>
                <option value="Half Pension">Demi-pension</option>
                <option value="No Pension">Pas de pension</option>
            </select>
            </div>

        <!-- Choisir ou non l'option menage -->


        <fieldset>
            <legend>Option menage</legend>

            <div>
                <input type="radio" name="oui" value="1"/>
                <label for="Oui">Oui</label>
            </div>

            <div>
                <input type="radio" name="non" value="0" />
                <label for="non">Non</label>
            </div>
        </fieldset>


        <!-- Ajouter date début et fin -->
        <div class="mb-3">
            <label for="startingDate" class="form-label">Date de début du séjour</label>
            <input type="date" class="form-control" id="startingDate" value="2018-07-22" min="2018-01-01" max="2040-12-31" required/>
        </div>

        <div class="mb-3">
            <label for="endingDate" class="form-label">Date de fin du séjour</label>
            <input type="date" class="form-control" id="endingDate" value="2018-07-22" min="2018-01-01" max="2040-12-31" required>
        </div>
        
        <!-- Ajouter nombre de personnes -->


        <button type="submit" name="ok" class="btn btn-primary">Soumettre</button> 

    </form>

<?= $this->endSection(); ?>