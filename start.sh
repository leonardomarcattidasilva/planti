#!/bin/bash

CONFIG_FILE="/etc/mysql/mariadb.conf.d/50-server.cnf"

echo "🔧 Configurando MariaDB para aceitar conexões remotas..."

if grep -q "^bind-address" "$CONFIG_FILE"; then
    sed -i 's/^bind-address.*/bind-address = 0.0.0.0/' "$CONFIG_FILE"
else
    echo "bind-address = 0.0.0.0" >> "$CONFIG_FILE"
fi

echo "🚀 Iniciando MariaDB..."
service mariadb start

# Aguarda o MariaDB estar disponível
until mysqladmin ping --silent; do
  echo "Esperando MariaDB iniciar..."
  sleep 5
done

echo "✔ MariaDB iniciado!"

# Cria o banco e o usuário (se ainda não existirem)
mysql -uroot -e "CREATE DATABASE IF NOT EXISTS planti;"
mysql -uroot -e "CREATE USER IF NOT EXISTS 'admin'@'%' IDENTIFIED BY '9x*UwARA5@';"
mysql -uroot -e "GRANT ALL PRIVILEGES ON *.* TO 'admin'@'%';"
mysql -uroot -e "FLUSH PRIVILEGES;"

# Instala dependências se ainda não existirem
composer install

# Roda as migrations (opcional)
php spark migrate

# Inicia o servidor embutido do CodeIgniter
php spark serve --host 0.0.0.0 --port 8080
