#!/bin/bash
set -e

# Installer les dépendances Composer si elles n'existent pas
echo "Installation des dépendances Composer..."
composer install --no-scripts --no-interaction --optimize-autoloader

# Démarrer Apache
exec apache2-foreground "$@"