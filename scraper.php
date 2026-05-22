<?php

$options = [
    "http" => [
        "method" => "GET",
        "header" => "User-Agent: AlanGabryel-TraineeCrawler/1.0\r\n"
    ]
];

$context = stream_context_create($options);

libxml_use_internal_errors(true);

function convertRatingToNumber(string $ratingClass): int
{
    $ratings = [
        'One' => 1,
        'Two' => 2,
        'Three' => 3,
        'Four' => 4,
        'Five' => 5,
    ];

    foreach ($ratings as $word => $number) {
        if (strpos($ratingClass, $word) !== false) {
            return $number;
        }
    }

    return 0;
}

$booksData = [];

// o site tem 50 páginas de livros
for ($page = 1; $page <= 50; $page++) {

    $url = "https://books.toscrape.com/catalogue/page-$page.html";

    echo "Lendo página $page..." . PHP_EOL;

    // aqui eu busco o HTML da página atual
    $html = file_get_contents($url, false, $context);

    if ($html === false) {
        echo "Erro ao acessar a página $page" . PHP_EOL;
        continue;
    }

    // transformo o HTML em DOM para conseguir pesquisar os elementos
    $dom = new DOMDocument();
    $dom->loadHTML($html);

    $xpath = new DOMXPath($dom);

    // busco todos os cards dos livros da página
    $books = $xpath->query("//article[@class='product_pod']");

    foreach ($books as $book) {

        $titleNode = $xpath->query(".//h3/a", $book);
        $priceNode = $xpath->query(".//p[@class='price_color']", $book);
        $availabilityNode = $xpath->query(".//p[contains(@class, 'availability')]", $book);
        $ratingNode = $xpath->query(".//p[contains(@class, 'star-rating')]", $book);

        $title = $titleNode->item(0)->getAttribute("title");
        $price = trim($priceNode->item(0)->textContent);
        $availability = trim($availabilityNode->item(0)->textContent);
        $ratingClass = $ratingNode->item(0)->getAttribute("class");
        $rating = convertRatingToNumber($ratingClass);

        $booksData[] = [
            "title" => $title,
            "price" => $price,
            "availability" => $availability,
            "rating" => $rating,
            "page" => $page
        ];
    }

    // delay para não fazer muitas requisições rápidas
    sleep(1);
}

echo "Total de livros coletados: " . count($booksData) . PHP_EOL;

// gera JSON
$json = json_encode($booksData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
file_put_contents("storage/books.json", $json);

echo "Arquivo JSON gerado com sucesso!" . PHP_EOL;

// gera CSV
$csvFile = fopen("storage/books.csv", "w");

fputcsv($csvFile, ["title", "price", "availability", "rating", "page"]);

foreach ($booksData as $book) {
    fputcsv($csvFile, [
        $book["title"],
        $book["price"],
        $book["availability"],
        $book["rating"],
        $book["page"]
    ]);
}

fclose($csvFile);

echo "Arquivo CSV gerado com sucesso!" . PHP_EOL;