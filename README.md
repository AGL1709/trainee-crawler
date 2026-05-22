# Trainee Crawler - Books to Scrape

Projeto desenvolvido para o desafio técnico do Programa Trainee Crawler/RPA & IA.

O objetivo do projeto é coletar dados do site https://books.toscrape.com/ e salvar essas informações em arquivos JSON e CSV.

## Tecnologias utilizadas

- PHP
- DOMDocument
- DOMXPath

## Dados coletados

O scraper coleta:

- título
- preço
- disponibilidade
- rating
- página de origem

## Como executar

No terminal, execute:

```bash
php scraper.php

Como utilizei IA

Utilizei IA durante o desenvolvimento para:

entender melhor scraping com PHP
aprender DOMDocument e XPath
organizar a estrutura do projeto
tirar dúvidas durante o desenvolvimento
melhorar a documentação

O projeto foi desenvolvido passo a passo, realizando testes durante cada etapa.

Como funciona:

O scraper percorre as 50 páginas do site books.toscrape.com.

Para cada página ele faz uma requisição HTTP, lê o HTML da página e procura os livros utilizando DOMXPath.

Depois disso os dados são organizados em um array PHP e exportados para JSON e CSV.

Algumas decisões que tomei

Escolhi PHP porque atualmente é a linguagem que tenho mais familiaridade.

Utilizei DOMDocument e DOMXPath porque facilitam bastante a leitura do HTML e a busca dos elementos da página.

Também utilizei sleep(1) para evitar muitas requisições rápidas seguidas.

O rating do livro foi convertido para número porque no HTML ele vem como classe CSS.