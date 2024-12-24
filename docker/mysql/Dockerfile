FROM mysql:8.0

# Copy SQL files for database creation and data insertion
# COPY ./docker/mysql/db_cvven.sql /docker-entrypoint-initdb.d/01_init.sql
# COPY ./docker/mysql/donnees_cvven.sql /docker-entrypoint-initdb.d/02_data.sql
COPY ./docker/mysql/cvven.sql /docker-entrypoint-initdb.d/init.sql

# Custom entrypoint script to import data
COPY ./docker/mysql/init-custom.sh /docker-entrypoint-initdb.d/init-custom.sh

# Expose MySQL default port
EXPOSE 3306