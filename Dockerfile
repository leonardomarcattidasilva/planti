# Usa uma imagem PHP com Apache
FROM leonardomarcatti/lamp:latest


# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Cria diretório de trabalho
WORKDIR /app

# Copia arquivos do projeto para dentro do container
COPY . .
COPY wait-for-it.sh /wait-for-it.sh
COPY entrypoint.sh /start.sh
RUN chmod +x /start.sh /wait-for-it.sh

# Permissão para writable
RUN chown -R www-data:www-data /app/writable && chmod -R 775 /app/writable

# Expõe a porta usada pelo spark
EXPOSE 8080


# Copia script de inicialização
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Comando que inicia o MySQL e o servidor PHP
CMD ["/start.sh"]