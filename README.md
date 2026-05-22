# Trainee Crawler - Books to Scrape

Projeto desenvolvido para o desafio técnico do Programa Trainee Crawler/RPA & IA.

O objetivo do projeto é coletar dados do site https://books.toscrape.com/ e salvar essas informações em arquivos JSON e CSV.

## Tecnologias utilizadas

- PHP
- DOMDocument
- DOMXPath
- Docker
- GitLab CI/CD

## Dados coletados

O scraper coleta:

- título
- preço
- disponibilidade
- rating
- página de origem

## Como executar localmente

No terminal, execute:

```bash
php scraper.php

## Como rodar com Docker

```bash
docker build -t trainee-crawler .
docker run --rm trainee-crawler
```

## Arquivos gerados

Após a execução serão gerados:

```txt
storage/books.json
storage/books.csv
```

## Estrutura JSON

```json
[
  {
    "title": "A Light in the Attic",
    "price": "£51.77",
    "availability": "In stock",
    "rating": 3,
    "page": 1
  }
]
```

## Estrutura CSV

```csv
title,price,availability,rating,page
A Light in the Attic,£51.77,In stock,3,1
```

## Como funciona

O scraper percorre as 50 páginas do site books.toscrape.com.

Para cada página ele faz uma requisição HTTP utilizando User-Agent personalizado.

Depois disso o HTML é convertido para DOM utilizando DOMDocument e os elementos são encontrados utilizando DOMXPath.

Os dados dos livros são armazenados em um array PHP e depois exportados para JSON e CSV.

Também foi utilizado sleep(1) entre as páginas para evitar muitas requisições seguidas.

## Algumas decisões que tomei

Escolhi PHP porque atualmente é a linguagem que tenho mais familiaridade.

Utilizei DOMDocument e DOMXPath porque facilitam bastante a leitura do HTML e a busca dos elementos da página.

O rating do livro foi convertido para número porque no HTML ele vem como classe CSS.

Exemplo:

```txt
star-rating Three
```

convertido para:

```txt
3
```

## Pipeline CI/CD

O pipeline possui 4 etapas:

### lint

Verifica a sintaxe do código PHP.

### test

Executa o scraper e roda os testes básicos do projeto.

### build

Constrói a imagem Docker do scraper.

### deploy

Simula um deploy para AWS ECS utilizando echo e executa apenas na branch main.

## Como utilizei IA

Utilizei IA durante o desenvolvimento para:

- entender melhor scraping com PHP
- aprender DOMDocument e XPath
- organizar a estrutura do projeto
- tirar dúvidas durante o desenvolvimento
- melhorar a documentação

O projeto foi desenvolvido passo a passo, realizando testes durante cada etapa.

## Melhorias futuras

Se tivesse mais tempo eu adicionaria:

- logs mais completos
- tratamento de erros mais robusto
- persistência em banco de dados
- melhorias no pipeline CI/CD
- observabilidade
- docker-compose
- cache no pipeline