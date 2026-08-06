<?php

function calcularDesconto(float $valorTotal): array
{
    if ($valorTotal > 1000.00) {
        $percentual = 0.30;
    } elseif ($valorTotal > 500.00) {
        $percentual = 0.20;
    } elseif ($valorTotal > 100.00) {
        $percentual = 0.10;
    } else {
        $percentual = 0;
    }

    $valorDesconto = $valorTotal * $percentual;
    $valorFinal = $valorTotal - $valorDesconto;

    return [
        'valorOriginal' => round($valorTotal, 2),
        'percentualDesconto' => $percentual * 100,
        'valorDesconto' => round($valorDesconto, 2),
        'valorFinal' => round($valorFinal, 2),
    ];
}

$compra1 = calcularDesconto(80);
$compra2 = calcularDesconto(300);
$compra3 = calcularDesconto(700);
$compra4 = calcularDesconto(1500);

foreach ([$compra1, $compra2, $compra3, $compra4] as $compra) {
    echo "Valor original: R$ " . number_format($compra['valorOriginal'], 2, ',', '.') . "<br>";
    echo "Desconto aplicado: " . $compra['percentualDesconto'] . "% (R$ " . number_format($compra['valorDesconto'], 2, ',', '.') . ")<br>";
    echo "Valor final: R$ " . number_format($compra['valorFinal'], 2, ',', '.') . "<br>";
    echo "------------------------<br>";
}