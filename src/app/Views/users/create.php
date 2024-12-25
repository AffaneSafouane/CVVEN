<?php /** @var $title string */ ?>
<?= $this->extend('base'); ?>

<?= $this->section('content'); ?>
<section class="container px-4">
    <?php if (!empty(session()->getFlashdata('error')) || !empty(trim(strip_tags(validation_list_errors())))): ?>
        <div class="alert alert-danger mt-4">
            <?= session()->getFlashdata('error'); ?>
            <?= validation_list_errors(); ?>
        </div>
    <?php endif; ?>

    <div class="w-50 m-auto py-4">
        <h2 class="mt-3 mb-3 text-center"><?= esc($title); ?></h2>
        <form action="/users" method="post">
            <?= csrf_field(); ?>

            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email" value="<?= set_value('email'); ?>" required/>
            </div>

            <div class="mb-3">
                <label class="form-label" for="lastName">Nom</label>
                <input class="form-control" type="text" name="lastName" id="lastName" value="<?= set_value('lastName'); ?>" required/>
            </div>

            <div class="mb-3">
                <label class="form-label" for="name">Prénom</label>
                <input class="form-control" type="text" name="name" id="name" value="<?= set_value('name'); ?>" required/>
            </div>

            <div class="mb-3">
                <label class="form-label" for="address">Adresse</label>
                <input class="form-control" type="text" name="address" id="address" value="<?= set_value('address'); ?>" required/>
            </div>

            <div class="mb-3">
                <label class="form-label" for="phone">Téléphone</label>
                <input class="form-control" type="tel" name="phone" id="phone" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" value="<?= set_value('phone'); ?>"/>
            </div>

            <div class="mb-3">
                <label class="form-label" for="password">Mot de passe</label>
                <input class="form-control" type="password" name="password" id="password" value="<?= set_value('password'); ?>" required/>
            </div>

            <div class="mb-3">
                <label class="form-label" for="password_conf">Confirmation mot de passe</label>
                <input class="form-control" type="password" name="password_conf" id="password_conf" value="<?= set_value('password_conf'); ?>" required/>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
</section>
<?= $this->endSection(); ?>
