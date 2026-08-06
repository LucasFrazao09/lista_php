<?php

function ordenarNomes(string $nomes): array
{
    $vetorNomes = explode(',', $nomes);

    $vetorNomes = array_map('trim', $vetorNomes);

    $vetorNomes = array_filter($vetorNomes, function ($nome) {
        return $nome !== '';
    });

    sort($vetorNomes);

    return $vetorNomes;
}

$lista = "Lucas, jango , Felipe,  Caio,arthur";
$listaOrganizada = ordenarNomes($lista);

foreach ($listaOrganizada as $nome) {
    echo $nome . "\n";
}