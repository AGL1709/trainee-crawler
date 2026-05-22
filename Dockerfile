# usando imagem oficial do PHP
FROM php:8.2-cli

# criando pasta da aplicação dentro do container
WORKDIR /app

# copiando arquivos do projeto
COPY . .

# comando que executa o scraper
CMD ["php", "scraper.php"]