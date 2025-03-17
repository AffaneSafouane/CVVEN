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

                <form action="<?= auth()->loggedIn() ? url_to('admin/register') : url_to('register'); ?>" method="post">
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
                        <input class="form-control" type="text" name="last_name" id="floatingLastNameInput" inputmode="text" autocomplete="family-name" placeholder="Nom de famille" value="<?= old('last_name'); ?>" minlength="3" maxlength="100" required/>
                        <label for="floatingLastNameInput">Nom de famille*</label>
                    </div>

                    <!-- First Name -->
                    <div class="form-floating mb-2">
                        <input class="form-control" type="text" name="first_name" id="floatingFirstNameInput" inputmode="text" autocomplete="given-name" placeholder="Prénom" value="<?= old('first_name'); ?>" minlength="3" maxlength="100" required/>
                        <label for="floatingFirstNameInput">Prénom*</label>
                    </div>

                    <?php if(!auth()->loggedIn()): ?>
                        <!-- Address -->
                        <div class="form-floating mb-2">
                            <input class="form-control" type="text" name="address" id="floatingAddressInput" inputmode="text" autocomplete="street-address" placeholder="Adresse" value="<?= old('address'); ?>" minlength="3" maxlength="50" required/>
                            <label for="floatingAddressInput">Adresse*</label>
                        </div>

                        <!-- City -->
                        <div class="form-floating mb-2">
                            <input class="form-control" type="text" name="city" id="floatingCityInput" inputmode="text" autocomplete="address-level2" placeholder="Ville" value="<?= old('city'); ?>" minlength="1" maxlength="50" required/>
                            <label for="floatingCityInput">Ville*</label>
                        </div>

                        <!-- Postal Code -->
                        <div class="form-floating mb-2">
                            <input class="form-control" type="text" name="postal_code" id="floatingPostalCodeInput" inputmode="numeric" autocomplete="postal-code" placeholder="Code Postal" pattern="[0-9]{5}" value="<?= old('postal_code'); ?>" required/>
                            <label for="floatingPostalCodeInput">Code Postal*</label>
                        </div>

                        <!-- Quotient familial -->
                        <div class="form-floating mb-2">
                            <select id="floatingQfInput" name="family_quotient" class="form-control">
                                <option value="less_800">Moins de 800€</option>
                                <option value="800-1200">Entre 800€ et 1200€</option>
                                <option value="1200-1800">Entre 1200€ et 1800€</option>
                                <option value="1800-2500">Entre 1800€ et 2500€</option>
                                <option value="more_2500">Plus de 2500€</option>
                            </select>
                            <label for="floatingQfInput">Quotient Familial*</label>
                        </div>

                        <!-- Phone -->
                        <div class="form-floating mb-2">
                            <input class="form-control" type="tel" name="phone" id="floatingPhoneInput" inputmode="tel" autocomplete="tel" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" placeholder="Téléphone" value="<?= old('phone'); ?>"/>
                            <label for="floatingPhoneInput">Téléphone</label>
                        </div>

                        <!-- Birth Date -->
                        <div class="form-floating mb-2">
                            <input class="form-control" type="date" name="birth_date" id="floatingBirthDateInput" inputmode="text" value="<?= old('birthDate'); ?>" min="<?= $minDate; ?>" max="<?= $maxDate; ?>" required/>
                            <label for="floatingBirthDateInput">Date de naissance*</label>
                        </div>
                    <?php endif; ?>

                    <!-- Password -->
                    <div class="form-floating mb-2 mt-4">
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

                    <?php if(!auth()->loggedIn()): ?>
                        <p class="text-center"><?= lang('Auth.haveAccount') ?> <a href="<?= url_to('login') ?>"><?= lang('Auth.login') ?></a></p>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

<?= $this->endSection(); ?>
