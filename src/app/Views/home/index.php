<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?>
<?= esc($title); ?>
<?= $this->endSection(); ?>

<?= $this->section('main'); ?>
<style>
    #intro {
        background-image: url('<?= base_url('images/summer.jpg'); ?>');
        background-size: cover;
        background-position: center;
        height: 100vh;
    }
</style>

<header id="intro" class="bg-image shadow-2-strong">
    <div class="d-flex align-items-center justify-content-center h-100" style="background-color: rgba(0,0,0,0.6);">
        <div class="text-center text-white p-4">
            <h1 class="fw-bolder">CVVEN</h1>
            <p class="lead mb-4">Site de vacances</p>
            <a href="<?= site_url('rooms'); ?>" class="btn btn-success btn-lg">Parcourez nos offres</a>
        </div>
    </div>
</header>

<section class="py-5">
    <div class="container px-4">
        <div class="row gx-4 justify-content-center py-5">
            <div class="col-lg-8">
                <h2>CVVEN : qu'est-ce que c'est ?</h2>
                <p class="lead">CVVEN est une plateforme de réservations de vacances en ligne. Explorez nos offres avec une recherche efficace, vérifiez la disponibilité des chambres en temps réel, et effectuez des réservations en toute simplicité. CVVEN s'engage pour rendre agréable l'expérience utilisateur et faciliter vos vacances.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-body-tertiary">
    <div class="container px-4">
        <div class="row gx-4 justify-content-center py-5">
            <div class="col-lg-8">
                <h2>Fonctionnalités clés :</h2>
                <ul>
                    <li>Recherche avancée d'offres</li>
                    <li>Consultation en temps réel du statut des réservations (disponible, indisponible)</li>
                    <li>Affichage détaillé des informations sur les offres proposées</li>
                    <li>Processus de réservation simplifié</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>
