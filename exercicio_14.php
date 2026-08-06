<?php

function estatisticasNumericas(array $numeros): array
{
    $soma = array_sum($numeros);
    $quantidade = count($numeros);
    $media = $soma / $quantidade;
    $maiorValor = max($numeros);
    $menorValor = min($numeros);

    $numerosOrdenados = $numeros;
    sort($numerosOrdenados);
    $meio = intdiv($quantidade, 2);

    if ($quantidade % 2 === 0) {
        $mediana = ($numerosOrdenados[$meio - 1] + $numerosOrdenados[$meio]) / 2;
    } else {
        $mediana = $numerosOrdenados[$meio];
    }

    $qtdPares = 0;
    $qtdImpares = 0;

    foreach ($numeros as $numero) {
        if ($numero % 2 === 0) {
            $qtdPares++;
        } else {
            $qtdImpares++;
        }
    }

    return [
        'soma' => $soma,
        'media' => round($media, 2),
        'maiorValor' => $maiorValor,
        'menorValor' => $menorValor,
        'mediana' => $mediana,
        'qtdPares' => $qtdPares,
        'qtdImpares' => $qtdImpares,
    ];
}

$numeros = [10, 4, 7, 15, 3, 8, 22, 9];
$resultado = estatisticasNumericas($numeros);

echo "Soma: " . $resultado['soma'] . "<br>";
echo "Média: " . $resultado['media'] . "<br>";
echo "Maior valor: " . $resultado['maiorValor'] . "<br>";
echo "Menor valor: " . $resultado['menorValor'] . "<br>";
echo "Mediana: " . $resultado['mediana'] . "<br>";
echo "Quantidade de pares: " . $resultado['qtdPares'] . "<br>";
echo "Quantidade de ímpares: " . $resultado['qtdImpares'] . "<br>";