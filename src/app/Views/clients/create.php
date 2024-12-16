<h2><?= esc($title) ?></h2>

<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<form action="/news" method="post">
    <?= csrf_field() ?>

    <label for="email">Email</label>
    <input type="email" name="email" <?= set_value('email'); ?> />
    <br><br>

    <label for="name">Nom</label>
    <input type="text" name="name" value="<?= set_value('name'); ?>">
    <br><br>

    <label for="firstName">Prénom</label>
    <input type="text" name="firstName" <?= set_value('firstName'); ?> />
    <br><br>

    <label for="adresse">Adresse</label>
    <input type="text" name="address" <?= set_value('address'); ?> />
    <br><br>

    <label for="telephone">Téléphone</label>
    <input type="tel" name="phone" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" <?= set_value('phone'); ?> />
    <br><br>

    <label for="password">Mot de passe</label>
    <input type="password" name="password" <?= set_value('password'); ?> />
    <br><br>

    <label for="password_conf">Confirmation mot de passe</label>
    <input type="password" name="password_conf" <?= set_value('password_conf'); ?> />
    <br><br>

    <input type="submit" name="submit" value="Create news item">
</form>
