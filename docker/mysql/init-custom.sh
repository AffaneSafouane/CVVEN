#!/bin/bash
set -e

# Check if MySQL data directory is empty
if [ -z "$(ls -A /var/lib/mysql)" ]; then
    echo "Initializing MySQL database..."
    docker-entrypoint.sh mysqld & sleep 10

    echo "Importing initialization scripts..."
    mysql -uroot -p${MYSQL_ROOT_PASSWORD} < /docker-scripts/01_init.sql
    mysql -uroot -p${MYSQL_ROOT_PASSWORD} < /docker-scripts/02_data.sql
    echo "Database initialized."

    killall mysqld
fi

exec docker-entrypoint.sh "$@"
