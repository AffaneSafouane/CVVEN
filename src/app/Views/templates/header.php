<nav class="navbar navbar-expand-lg sticky-top bg-dark-subtle mb-auto shadow-sm">
    <div class="container px-4">
        <a class="navbar-brand" href="<?= site_url('/'); ?>">CVVEN</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav me-auto mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('/'); ?>">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('rooms'); ?>">Chambres</a>
                </li>
                <?php if (auth()->loggedIn()): ?>
                    <?php if (auth()->user()->inGroup('user')): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userMenu" data-bs-toggle="dropdown">Utilisateur</a>
                            <ul class="dropdown-menu" aria-labelledby="userMenu">
                                <li><a class="dropdown-item" href="<?= site_url('reservations'); ?>">Mes réservations</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('users/' . auth()->id()); ?>">Profil</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if (auth()->user()->inGroup('admin')): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="adminMenu" data-bs-toggle="dropdown">Admin</a>
                            <ul class="dropdown-menu" aria-labelledby="adminMenu">
                                <li><a class="dropdown-item" href="<?= site_url('admin/dashboard'); ?>">Dashboard</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('admin/users'); ?>">Utilisateurs</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('admin/register'); ?>">Créer Admin</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('admin/rooms'); ?>">Chambres</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('admin/reservations'); ?>">Réservations</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav d-flex">
                <?php if (auth()->loggedIn()): ?>
                    <li class="nav-item">
                        <a class="nav-link link-success" href="<?= site_url('logout'); ?>">Se déconnecter</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="btn btn-success" href="<?= site_url('login'); ?>">Se connecter</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
