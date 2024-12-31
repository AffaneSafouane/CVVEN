<nav class="navbar navbar-expand-lg shadow-sm sticky-top bg-dark-subtle mb-auto">
    <div class="container px-4">
        <a class="navbar-brand" href="<?= site_url('/'); ?>">CVVEN</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav me-auto mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="<?= site_url('/'); ?>">Accueil</a></li>
                <li class="nav-item dropdown">
                    <!-- @TODO ajouter les liens pour les réservations -->
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Réservations</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Chambres</a></li>
                        <li><a class="dropdown-item" href="#">Activités</a></li>
                        <li><a class="dropdown-item" href="#">Salle de réunion</a></li>
                        <li><a class="dropdown-item" href="#">Transports</a></li>
                    </ul>
                </li>
                <?php if (auth()->loggedIn()): ?>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('users/' . auth()->id()); ?>">Profil</a></li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav d-flex">
                <?php if (auth()->loggedIn()): ?>
                    <li class="nav-item"><a class="nav-link link-primary" href="<?= site_url('logout'); ?>">Se déconnecter</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="btn btn-primary" role="button" href="<?= site_url('login'); ?>">Se connecter</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>