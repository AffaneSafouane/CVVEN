<header class="mb-auto shadow-sm sticky-top bg-dark-subtle">
    <nav class="navbar navbar-expand-lg">
        <div class="container px-4">
            <a class="navbar-brand" href="<?= site_url('/') ?>">CVVEN</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <div class="navbar-nav">
                    <a class="nav-link" href="<?= site_url('/'); ?>">Accueil</a>
                    <a class="nav-link" href="#">Réservations</a> <!-- @TODO menu déroulant (activités, transports, chambres, salle de réunions) -->
                    <!-- @TODO Vérifier si l'utilisateur est connecté ou non, si oui se déconnecter, si non se connecter -->
                    <!-- <a class="nav-link" href="#">Se connecter</a> -->
                    <!-- <a class="nav-link" href="#">Se déconnecter</a> -->
                </div>
            </div>
        </div>
    </nav>
</header>