<?= session()->getFlashdata('error'); ?>
<?= validation_list_errors(); ?>

<form action="/users" method="post">
    <?= csrf_field(); ?>

    <div>
        <label for="email">Email</label>
        <input type="email" name="email" value="<?= set_value('email'); ?>" required/>
        <br><br>
    </div>

    <div>
        <label for="lastName">Nom</label>
        <input type="text" name="lastName" value="<?= set_value('lastName'); ?>" required/>
        <br><br>
    </div>

    <div>
        <label for="name">Prénom</label>
        <input type="text" name="name" value="<?= set_value('name'); ?>" required/>
        <br><br>
    </div>

    <div>
        <label for="adresse">Adresse</label>
        <input type="text" name="address" value="<?= set_value('address'); ?>" required/>
        <br><br>
    </div>

    <div>
        <label for="phone">Téléphone</label>
        <input type="tel" name="phone" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" value="<?= set_value('phone'); ?>" required/>
        <br><br>
    </div>

    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" value="<?= set_value('password'); ?>" required/>
        <br><br>
    </div>

    <div>
        <label for="password_conf">Confirmation mot de passe</label>
        <input type="password" name="password_conf" value="<?= set_value('password_conf'); ?>" required/>
        <br><br>
    </div>

    <button type="submit" name="submit">Create user</button>
</form>