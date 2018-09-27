<?php
use Elasticsearch\ClientBuilder;

require 'vendor/autoload.php';
include 'const_file.php';
$client = ClientBuilder::create()->build();
$dir_file = './dir/';
$arquivos = glob("$dir_file{*.pdf}", GLOB_BRACE);
foreach ($arquivos as $file) {
    print("$file<br>");
    $params = [
        'index' => 'ingest_index',
        'type' => 'attachment',
        'pipeline' => 'attachment',
        'body' => [
            'data' => base64_encode(file_get_contents($file)),
            'file_path' => $file,
        ]
    ];
    $client->index($params);
}

