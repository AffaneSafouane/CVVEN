<?php
$minDate = date('Y-m-d', strtotime('90 years ago'));
$maxDate = date('Y-m-d', strtotime('18 years ago'));
?>

<?= $this->extend('layout'); ?>

<?= $this->section('title') ?><?= lang('Auth.register') ?> <?= $this->endSection() ?>

<?= $this->section('main'); ?>

    <div class="container d-flex justify-content-center p-5">
        <div class="card col-12 col-md-5 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-5"><?= lang('Auth.register') ?></h5>

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

                <form action="<?= url_to('register') ?>" method="post">
                    <?= csrf_field() ?>

                    <!-- Email -->
                    <div class="form-floating mb-2">
                        <input type="email" class="form-control" id="floatingEmailInput" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                        <label for="floatingEmailInput"><?= lang('Auth.email') ?>*</label>
                    </div>

                    <!-- Username -->
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="floatingUsernameInput" name="username" inputmode="text" autocomplete="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
                        <label for="floatingUsernameInput"><?= lang('Auth.username') ?></label>
                    </div>

                    <!-- Last Name -->
                    <div class="form-floating mb-2">
                        <input class="form-control" type="text" name="last_name" id="floatingLastNameInput" inputmode="text" autocomplete="lastName" placeholder="Nom de famille" value="<?= old('last_name'); ?>" minlength="3" maxlength="50" required/>
                        <label for="floatingLastNameInput">Nom de famille*</label>
                    </div>

                    <!-- Name -->
                    <div class="form-floating mb-2">
                        <input class="form-control" type="text" name="name" id="floatingNameInput" inputmode="text" autocomplete="name" placeholder="Prénom" value="<?= old('name'); ?>" minlength="3" maxlength="50" required/>
                        <label for="floatingNameInput">Prénom*</label>
                    </div>

                    <!-- Address -->
                    <div class="form-floating mb-2">
                        <input class="form-control" type="text" name="address" id="floatingAddressInput" inputmode="text" autocomplete="address" placeholder="Adresse" value="<?= old('address'); ?>" minlength="3" maxlength="50" required/>
                        <label for="floatingAddressInput">Adresse*</label>
                    </div>

                    <!-- City -->
                    <div class="form-floating mb-2">
                        <input class="form-control" type="text" name="city" id="floatingCityInput" inputmode="text" autocomplete="city" placeholder="Ville" value="<?= old('city'); ?>" minlength="1" maxlength="50" required/>
                        <label for="floatingCityInput">Ville*</label>
                    </div>

                    <!-- Postal Code -->
                    <div class="form-floating mb-2">
                        <input class="form-control" type="text" name="postal_code" id="floatingPostalCodeInput" inputmode="text" autocomplete="postal_code" placeholder="Code Postal" pattern="[0-9]{5}" value="<?= old('postal_code'); ?>" required/>
                        <label for="floatingPostalCodeInput">Code Postal*</label>
                    </div>

                    <!-- Phone -->
                    <div class="form-floating mb-2">
                        <input class="form-control" type="tel" name="phone" id="floatingPhoneInput" inputmode="tel" autocomplete="phone" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" placeholder="Téléphone" value="<?= old('phone'); ?>"/>
                        <label for="floatingPhoneInput">Téléphone</label>
                    </div>

                    <!-- Birth Date -->
                    <div class="form-floating mb-4">
                        <input class="form-control" type="date" name="birth_date" id="floatingBirthDateInput" inputmode="text" value="<?= old('birthDate'); ?>" min="<?= $minDate; ?>" max="<?= $maxDate; ?>" required/>
                        <label for="floatingBirthDateInput">Date de naissance*</label>
                    </div>

                    <!-- Password -->
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control" id="floatingPasswordInput" name="password" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.password') ?>" required>
                        <label for="floatingPasswordInput"><?= lang('Auth.password') ?>*</label>
                    </div>

                    <!-- Password (Again) -->
                    <div class="form-floating mb-5">
                        <input type="password" class="form-control" id="floatingPasswordConfirmInput" name="password_confirm" inputmode="text" autocomplete="new-password" placeholder="<?= lang('Auth.passwordConfirm') ?>" required>
                        <label for="floatingPasswordConfirmInput"><?= lang('Auth.passwordConfirm') ?>*</label>
                    </div>

                    <div class="d-grid col-12 col-md-8 mx-auto m-3">
                        <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.register') ?></button>
                    </div>

                    <p class="text-center"><?= lang('Auth.haveAccount') ?> <a href="<?= url_to('login') ?>"><?= lang('Auth.login') ?></a></p>

                </form>
            </div>
        </div>
    </div>

<?= $this->endSection(); ?>
