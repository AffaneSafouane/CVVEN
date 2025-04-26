<?php
/**
 * @var ?\App\Entities\User $user
 * @var string $title
 */
?>
<?= $this->extend('layout'); ?>

<?= $this->section('main'); ?>
    <section class="container px-4">
        <!-- Notifications -->
        <?php if (session('success') !== null) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        <?php endif ?>
        <?php if (session('error') !== null) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
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
        <div class="d-flex justify-content-between">
            <h1><?= esc($title); ?></h1>
            <span class="align-content-center">
                <a href="<?= site_url('/'); ?>" class="link">Retour</a>
            </span>
        </div>
        <?php if ($user): ?>
            <div class="card mb-1 m-auto text-white bg-dark-subtle">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between">
                        <h4 class="mb-1"><?= esc($user->last_name . ' ' . $user->first_name); ?></h4>
                        <small class="text-muted"><?= esc($user->getEmail()); ?></small>
                        <?php if (!empty($user->username)): ?>
                            <small class="text-muted"><?= esc($user->username); ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex justify-content-between card-text">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text-white bg-dark-subtle">Date d'inscription: <?= $user->getCreatedAt(); ?></li>
                            <li class="list-group-item text-white bg-dark-subtle">Dernière connexion: <?= date("d/m/y - h:i:s", strtotime($user->last_active)); ?></li>
                            <li class="list-group-item text-white bg-dark-subtle">
                                Adresse: <?= esc($user->getClient()->address); ?>
                            </li>
                            <li class="list-group-item text-white bg-dark-subtle">
                                Date de naissance: <?= $user->getClient()->getBirthDate(); ?>
                            </li>
                            <?php if (!empty($user->getClient()->phone)): ?>
                                <li class="list-group-item text-white bg-dark-subtle">
                                    Téléphone: <?= esc($user->getClient()->phone); ?>
                                </li>
                            <?php endif; ?>
                        </ul>
                        <p><small><?= $user->active ? 'Votre compte est activé' : 'Votrce compte n\'est pas activé'; ?></small></p>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <a href="<?= site_url('users/form/' . $user->id); ?>" class="btn btn-warning">Éditer</a>
                        </div>
                        <div class="col">
                            <form action="<?= site_url('users/delete/' . $user->id); ?>" method="POST" id="delete-form" class="float-end">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirmDelete()">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger" role="alert">
                <p>Impossible de trouver l'utilisateur demandé</p>
            </div>
        <?php endif; ?>
    </section>
    <script>
        function confirmDelete() {
            return confirm('Êtes vous sûr de vouloir supprimer votre utilisateur ?');
        }
    </script>
<?= $this->endSection(); ?>