<h2>Informations utilisateur</h2>
<p>Email: <?= esc($clients['email_client']); ?></p>
<p>Nom: <?= esc($clients['nom_client']); ?></p>
<p>Prénom: <?= esc($clients['prenom_client']); ?></p>
<p>Adresse: <?= esc($clients['adresse_client']); ?></p>
<p>Téléphone: <?= esc($clients['telephone_client']); ?></p>
<p><?= !$clients['admin'] ? "Vous n'êtes pas administrateur" : "Vous êtes administrateur"; ?></p>