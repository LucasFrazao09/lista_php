<?php

function calcularMedia(array $notas): array
{
    $maiorNota = max($notas);
    $menorNota = min($notas);
    $media = array_sum($notas) / count($notas);

    if ($media >= 7) {
        $situacao = 'Aprovado';
    } elseif ($media >= 5) {
        $situacao = 'Recuperação';
    } else {
        $situacao = 'Reprovado';
    }

    return [
        'maiorNota' => $maiorNota,
        'menorNota' => $menorNota,
        'media' => round($media, 2),
        'situacao' => $situacao,
    ];
}

$notasAluno1 = [8.5, 7.0, 9.0, 6.5];
$notasAluno2 = [4.0, 5.5, 6.0, 5.0];
$notasAluno3 = [2.0, 3.5, 4.0, 3.0];

foreach ([$notasAluno1, $notasAluno2, $notasAluno3] as $notas) {
    $resultado = calcularMedia($notas);
    echo "Maior nota: " . $resultado['maiorNota'] . "<br>";
    echo "Menor nota: " . $resultado['menorNota'] . "<br>";
    echo "Média: " . $resultado['media'] . "<br>";
    echo "Situação: " . $resultado['situacao'] . "<br>";
    echo "------------------------<br>";
}