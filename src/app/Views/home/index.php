<?php /** @var $title string */ ?>

<?= $this->extend('layout'); ?>

<?= $this->section('title') ?><?= esc($title) ?><?= $this->endSection() ?>

<?= $this->section('main'); ?>

<!-- Header-->
<header class="bg-gradient text-white bg-primary-subtle py-5">
    <div class="container px-4 text-center py-5">
        <h1 class="fw-bolder">CVVEN</h1>
        <p class="lead">Site de vacance</p>
        <a href="#" class="btn btn-dark">Parcourez nos offres</a> <!-- @TODO ajouter lien pour accueil réservations -->
    </div>
</header>

<!-- Definition section-->
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

<!-- Services section-->
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
