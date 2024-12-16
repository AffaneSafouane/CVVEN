FROM mysql:8.0
COPY ./docker/mysql/db_cvven.sql /docker-entrypoint-initdb.d/init.sql
COPY ./docker/mysql/données_cvven.sql /docker-entrypoint-initdb.d/data.sql
EXPOSE 3306