<?php

$jsonPath = __DIR__ . "/../storage/books.json";
$csvPath = __DIR__ . "/../storage/books.csv";

if (!file_exists($jsonPath)) {
    die("Erro: arquivo books.json não foi gerado.\n");
}

if (!file_exists($csvPath)) {
    die("Erro: arquivo books.csv não foi gerado.\n");
}

$data = json_decode(file_get_contents($jsonPath), true);

if (!is_array($data)) {
    die("Erro: JSON inválido.\n");
}

if (count($data) === 0) {
    die("Erro: nenhum livro foi encontrado.\n");
}

$firstBook = $data[0];

$requiredFields = ["title", "price", "availability", "rating", "page"];

foreach ($requiredFields as $field) {
    if (!array_key_exists($field, $firstBook)) {
        die("Erro: campo obrigatório ausente: $field\n");
    }
}

echo "Testes passaram com sucesso!\n";