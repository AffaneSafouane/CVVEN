
<?php
/**
 * @var ?\CodeIgniter\Shield\Entities\User[] $users
 * @var string $title
 * @var ?string $group
 * @var ?bool $active
 * @var \CodeIgniter\Pager\Pager $pager
 */
?>
<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?><?= esc($title); ?><?= $this->endSection(); ?>

<?= $this->section('main'); ?>
<section class="container px-4 ">
    <h1 class="mb-3 mt-3"><?= esc($title); ?></h1>

    <!-- Filtres -->
    <div class="card shadow-sm border-secondary mb-4 bg-dark-subtle">
        <div class="card-header bg-dark-subtle  border-secondary">
            <i class="bi bi-funnel me-2"></i>Filtres de recherche
        </div>
        <div class="card-body bg-dark-subtle ">
            <form class="row g-3" action="<?= site_url('admin/users'); ?>" method="GET">
                <div class="col-md-4">
                    <label for="group" class="form-label">Groupes</label>
                    <select class="form-select form-select-sm bg-dark-subtle  border-secondary" id="group" name="group">
                        <option value="" selected>Tous les groupes</option>
                        <option value="admin" <?= $group === 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="developer" <?= $group === 'developer' ? 'selected' : '' ?>>Développeur</option>
                        <option value="user" <?= $group === 'user' ? 'selected' : '' ?>>Utilisateur</option>
                        <option value="beta" <?= $group === 'beta' ? 'selected' : '' ?>>Beta</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="available" class="form-label">État du compte</label>
                    <select class="form-select form-select-sm bg-dark-subtle  border-secondary" id="available" name="available">
                        <option value="" selected>Toutes</option>
                        <option value="1" <?= $active == '1' ? 'selected' : '' ?>>Actif</option>
                        <option value="0" <?= $active == '0' ? 'selected' : '' ?>>Inactif</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2 w-100">
                        <i class="bi bi-search me-2"></i>Filtrer
                    </button>
                    <a href="<?= site_url('admin/users'); ?>" class="btn btn-outline-secondary w-auto">
                        <i class="bi bi-x-circle"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Users List -->
    <?php if ($users !== []): ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
            <?php foreach ($users as $user): ?>
                <div class="col">
                    <div class="card border-secondary h-100 bg-dark-subtle ">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 42px; height: 42px;">
                                    <span class="fw-bold"><?= substr(esc($user->name), 0, 1) . substr(esc($user->last_name), 0, 1); ?></span>
                                </div>
                                <div>
                                    <h5 class="mb-0">
                                        <a href="<?= site_url('admin/users/' . esc($user->id, 'url')); ?>" class=" text-decoration-none"><?= esc($user->getEmail()); ?></a>
                                    </h5>
                                    <small class="text-secondary"><?= esc($user->name . " " . $user->last_name); ?></small>
                                </div>
                            </div>

                            <?php
                            // Display user badge if group info is available (you may need to adjust this according to your actual data structure)
                            if (isset($user->groups) && is_array($user->groups)) {
                                foreach ($user->groups as $userGroup) {
                                    $badgeClass = 'bg-secondary';
                                    if ($userGroup === 'admin') $badgeClass = 'bg-danger';
                                    if ($userGroup === 'developer') $badgeClass = 'bg-warning text-dark';
                                    if ($userGroup === 'beta') $badgeClass = 'bg-info text-dark';
                                    echo '<span class="badge ' . $badgeClass . ' me-1">' . esc($userGroup) . '</span>';
                                }
                            }
                            ?>

                            <div class="mt-3 d-grid">
                                <a href="<?= site_url('admin/users/' . esc($user->id, 'url')); ?>" class="btn btn-sm btn-outline-light">
                                    <i class="bi bi-person-badge me-1"></i>Voir le profil
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            <?= $pager->links(); ?>
        </div>

    <?php else: ?>
        <div class="alert alert-dark border-secondary" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>
            Aucun utilisateurs n'est repertoriés pour le moment.
        </div>
    <?php endif; ?>
</section>
<?= $this->endSection(); ?>
