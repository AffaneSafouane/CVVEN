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
        <div class="card bg-dark-subtle mb-4 shadow">
            <div class="card-header bg-dark py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0"><?= esc($title); ?></h1>
                    <a href="<?= site_url('admin/users'); ?>" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Retour
                    </a>
                </div>
            </div>

            <?php if ($user): ?>
                <div class="card-body">
                    <div class="row align-items-center mb-4">
                        <div class="col-auto">
                            <div class="bg-primary p-3 rounded-circle text-center">
                                <i class="fas fa-user fa-2x text-white"></i>
                            </div>
                        </div>
                        <div class="col">
                            <h4 class="mb-1"><?= esc($user->last_name . ' ' . $user->first_name); ?></h4>
                            <div class="text-secondary small">
                                <span class="me-3"><i class="fas fa-envelope me-1"></i><?= esc($user->getEmail()); ?></span>
                                <?php if (!empty($user->username)): ?>
                                    <span><i class="fas fa-user-tag me-1"></i><?= esc($user->username); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <?php if ($user->active): ?>
                                <span class="badge bg-success text-white rounded-pill px-3 py-2">
                                    <i class="fas fa-check-circle me-1"></i>Compte activé
                                </span>
                            <?php else: ?>
                                <span class="badge bg-danger text-white rounded-pill px-3 py-2">
                                    <i class="fas fa-times-circle me-1"></i>Compte non activé
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="card bg-dark mb-4">
                        <div class="card-header bg-dark-subtle">
                            <h5 class="mb-0"><i class="bi bi-person-circle fs-4"></i> Informations utilisateur</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item bg-dark text-light d-flex justify-content-between">
                                    <span><i class="fas fa-calendar me-2"></i>Date d'inscription</span>
                                    <span class="fw-bold"><?= $user->getCreatedAt(); ?></span>
                                </li>
                                <li class="list-group-item bg-dark text-light d-flex justify-content-between">
                                    <span><i class="fas fa-clock me-2"></i>Dernière connexion</span>
                                    <span class="fw-bold"><?= date("d/m/y - h:i:s", strtotime($user->last_active)); ?></span>
                                </li>

                                <?php if ($user->getClient()): ?>
                                    <li class="list-group-item bg-dark text-light d-flex justify-content-between">
                                        <span><i class="fas fa-map-marker-alt me-2"></i>Adresse</span>
                                        <span class="fw-bold"><?= esc($user->getClient()->address); ?></span>
                                    </li>
                                    <li class="list-group-item bg-dark text-light d-flex justify-content-between">
                                        <span><i class="fas fa-birthday-cake me-2"></i>Date de naissance</span>
                                        <span class="fw-bold"><?= $user->getClient()->getBirthDate(); ?></span>
                                    </li>
                                    <?php if (!empty($user->getClient()->phone)): ?>
                                        <li class="list-group-item bg-dark text-light d-flex justify-content-between">
                                            <span><i class="fas fa-phone me-2"></i>Téléphone</span>
                                            <span class="fw-bold"><?= esc($user->getClient()->phone); ?></span>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <li class="list-group-item bg-dark text-light d-flex justify-content-between">
                                    <span><i class="fas fa-users me-2"></i>Groupe</span>
                                    <span class="fw-bold"><?= implode(', ', $user->getGroups()); ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="<?= site_url('users/form/' . $user->id); ?>" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Éditer
                        </a>
                        <form action="<?= site_url('admin/users/delete' . $user->id); ?>" method="POST" id="delete-form">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger" onclick="return confirmDelete()">
                                <i class="bi bi-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="card-body">
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>Impossible de trouver l'utilisateur demandé
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <script>
        function confirmDelete() {
            return confirm('Êtes vous sûr de vouloir supprimer l\'utilisateur ?');
        }
    </script>
<?= $this->endSection(); ?>