<?php
/**
 * @var ?\App\Entities\User $user
 * @var string $title
 */
?>
<?= $this->extend('layout'); ?>

<?= $this->section('main'); ?>
    <section class="container py-4">
        <!-- Notifications -->
        <?php if (session('success') !== null) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i><?= session('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        <?php endif ?>

        <?php if (session('error') !== null) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i><?= session('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        <?php elseif (session('errors') !== null) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?php if (is_array(session('errors'))) : ?>
                    <?php foreach (session('errors') as $error) : ?>
                        <?= $error ?>
                        <br>
                    <?php endforeach ?>
                <?php else : ?>
                    <?= session('errors') ?>
                <?php endif ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        <?php endif ?>

        <!-- Header Section -->
        <div class="card bg-dark border-secondary mb-4">
            <div class="card-header d-flex justify-content-between align-items-center border-bottom border-secondary py-3">
                <h1 class="h3 mb-0"><?= esc($title); ?></h1>
                <a href="<?= site_url('/'); ?>" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Retour
                </a>
            </div>
        </div>

        <?php if ($user): ?>
            <div class="card bg-dark border-secondary shadow-sm mb-4">
                <div class="card-header bg-dark-subtle py-3 border-bottom border-secondary">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary rounded-circle p-2 me-3 text-center" style="width: 48px; height: 48px;">
                                    <i class="fas fa-user text-white" style="font-size: 1.5rem;"></i>
                                </div>
                                <h4 class="mb-0"><?= esc($user->last_name . ' ' . $user->first_name); ?></h4>
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end mt-3 mt-md-0">
                            <div class="d-flex flex-column flex-md-row justify-content-md-end gap-2">
                                <div class="text-secondary small mb-2 mb-md-0">
                                    <i class="fas fa-envelope me-1"></i> <?= esc($user->getEmail()); ?>
                                </div>
                                <?php if (!empty($user->username)): ?>
                                    <div class="text-secondary small">
                                        <i class="fas fa-user-tag me-1"></i> <?= esc($user->username); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card bg-dark-subtle border-secondary mb-3">
                                <div class="card-header bg-dark border-secondary">
                                    <h5 class="mb-0"><i class="bi bi-person-circle fs-4"></i> Informations personnelles</h5>
                                </div>
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item bg-dark-subtle text-white d-flex justify-content-between border-secondary">
                                            <span><i class="fas fa-calendar me-2"></i>Date d'inscription</span>
                                            <span class="fw-bold"><?= $user->getCreatedAt(); ?></span>
                                        </li>
                                        <li class="list-group-item bg-dark-subtle text-white d-flex justify-content-between border-secondary">
                                            <span><i class="fas fa-clock me-2"></i>Dernière connexion</span>
                                            <span class="fw-bold"><?= date("d/m/y - h:i:s", strtotime($user->last_active)); ?></span>
                                        </li>
                                        <li class="list-group-item bg-dark-subtle text-white d-flex justify-content-between border-secondary">
                                            <span><i class="fas fa-map-marker-alt me-2"></i>Adresse</span>
                                            <span class="fw-bold"><?= esc($user->getClient()->address); ?></span>
                                        </li>
                                        <li class="list-group-item bg-dark-subtle text-white d-flex justify-content-between border-secondary">
                                            <span><i class="fas fa-birthday-cake me-2"></i>Date de naissance</span>
                                            <span class="fw-bold"><?= $user->getClient()->getBirthDate(); ?></span>
                                        </li>
                                        <?php if (!empty($user->getClient()->phone)): ?>
                                            <li class="list-group-item bg-dark-subtle text-white d-flex justify-content-between border-secondary">
                                                <span><i class="fas fa-phone me-2"></i>Téléphone</span>
                                                <span class="fw-bold"><?= esc($user->getClient()->phone); ?></span>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card bg-dark-subtle border-secondary mb-3">
                                <div class="card-header bg-dark border-secondary">
                                    <h5 class="mb-0"><i class="fas fa-user-shield me-2"></i>Statut du compte</h5>
                                </div>
                                <div class="card-body text-center">
                                    <?php if ($user->active): ?>
                                        <div class="py-3">
                                            <i class="fas fa-check-circle text-success fa-4x mb-3"></i>
                                            <h5>Compte activé</h5>
                                            <p class="text-muted">Votre compte est actif et entièrement fonctionnel</p>
                                        </div>
                                    <?php else: ?>
                                        <div class="py-3">
                                            <i class="fas fa-times-circle text-danger fa-4x mb-3"></i>
                                            <h5>Compte non activé</h5>
                                            <p class="text-muted">Votre compte est en attente d'activation</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <a href="<?= site_url('users/form/' . $user->id); ?>" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Éditer
                        </a>
                        <form action="<?= site_url('users/delete/' . $user->id); ?>" method="POST" id="delete-form">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger" onclick="return confirmDelete()">
                                <i class="bi bi-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>Impossible de trouver l'utilisateur demandé
            </div>
        <?php endif; ?>
    </section>
    <script>
        function confirmDelete() {
            return confirm('Êtes vous sûr de vouloir supprimer votre utilisateur ?');
        }
    </script>
<?= $this->endSection(); ?>