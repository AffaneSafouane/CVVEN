<?php /** @var array $users */; ?>
<p>Email: <?= esc($users['u_email']); ?></p>
<p>Nom: <?= esc($users['u_nom']); ?></p>
<p>Prénom: <?= esc($users['u_prenom']); ?></p>
<p>Adresse: <?= esc($users['u_adresse']); ?></p>
<p>Téléphone: <?= esc($users['u_telephone']); ?></p>
<p>Date d'inscription: <?= date("d/m/y h:i:s", strtotime($users['u_date_creation'])); ?></p>
<p><?= !$users['u_admin'] ? "Vous n'êtes pas administrateur" : "Vous êtes administrateur"; ?></p>