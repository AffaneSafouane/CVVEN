#!/bin/bash
set -e

# Vérifier si le répertoire vendor existe avant d'installer les dépendances
if [ ! -d "vendor" ]; then
    echo "Le répertoire vendor n'existe pas. Installation des dépendances Composer..."
    composer install --no-scripts --no-interaction --optimize-autoloader
else
    echo "Les dépendances Composer sont déjà installées."
fi

# Démarrer Apache
exec apache2-foreground "$@" 