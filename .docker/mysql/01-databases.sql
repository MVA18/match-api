# create databases
CREATE DATABASE IF NOT EXISTS `match_database`;

# create root user and grant rights
CREATE USER 'match_user'@'%' IDENTIFIED BY 'match_password';
GRANT ALL PRIVILEGES ON *.* TO 'match_user'@'%';
GRANT ALL PRIVILEGES ON *.* TO 'match_user'@'%';
