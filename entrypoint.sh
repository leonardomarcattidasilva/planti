#!/bin/sh

# Aguarda MariaDB ficar disponível
echo "⏳ Aguardando MariaDB iniciar..."
/wait-for-it.sh 127.0.0.1:3306 --timeout=60 --strict -- echo "✅ MariaDB pronta!"

# Se quiser rodar migrations, descomente esta linha:
# php spark migrate

# Inicia o servidor PHP embutido do CodeIgniter
echo "🚀 Iniciando CodeIgniter na porta 8080..."
php spark serve --host=0.0.0.0 --port=8080
