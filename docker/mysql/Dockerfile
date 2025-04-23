FROM mysql:8.0

# Change permissions 
USER root
RUN chown -R mysql:mysql /var/lib/mysql && chmod -R 755 /var/lib/mysql

# Copy SQL files for database creation and data insertion
COPY ../cvven_v5_dev.sql /docker-entrypoint-initdb.d/init.sql
COPY ./docker/mysql/init-custom.sh /docker-entrypoint-initdb.d/init-custom.sh

# Ensure scripts have proper permissions
RUN chmod +x /docker-entrypoint-initdb.d/init-custom.sh

# Switch to MySQL's default user (mysql)
USER mysql

# Expose MySQL default port
EXPOSE 3306