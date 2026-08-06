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

function analisarNumero(int $numero): array
{
    $paridade = ($numero % 2 === 0) ? 'Par' : 'Ímpar';

    $ehPrimo = true;
    if ($numero < 2) {
        $ehPrimo = false;
    } else {
        for ($i = 2; $i <= sqrt($numero); $i++) {
            if ($numero % $i === 0) {
                $ehPrimo = false;
                break;
            }
        }
    }

    $somaDivisores = 0;
    if ($numero > 1) {
        for ($i = 1; $i < $numero; $i++) {
            if ($numero % $i === 0) {
                $somaDivisores += $i;
            }
        }
    }
    $ehPerfeito = ($numero > 1 && $somaDivisores === $numero);

    return [
        'numero' => $numero,
        'paridade' => $paridade,
        'primo' => $ehPrimo ? 'Primo' : 'Não primo',
        'perfeito' => $ehPerfeito ? 'Perfeito' : 'Não perfeito',
    ];
}

$lista = "Carlos, ana , Bruno,  Fernanda,eduardo";
$listaOrganizada = ordenarNomes($lista);

echo "=== Lista de alunos organizada ===\n";
foreach ($listaOrganizada as $nome) {
    echo $nome . "\n";
}

echo "\n=== Análise de números ===\n";
$numeros = [6, 7, 28, 15, 2];

foreach ($numeros as $num) {
    $resultado = analisarNumero($num);
    echo "Número: " . $resultado['numero'] . "<br>";
    echo "Paridade: " . $resultado['paridade'] . "<br>";
    echo "Classificação: " . $resultado['primo'] . "<br>";
    echo "Perfeito: " . $resultado['perfeito'] . "<br>";
    echo "------------------------<br>";
}