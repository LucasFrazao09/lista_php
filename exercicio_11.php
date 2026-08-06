<?php

function formatarTexto(string $texto): array
{
    $maiusculas = mb_strtoupper($texto);
    $minusculas = mb_strtolower($texto);
    $primeiraLetraMaiuscula = mb_convert_case($texto, MB_CASE_TITLE);
    $qtdCaracteres = mb_strlen($texto);

    return [
        'maiusculas' => $maiusculas,
        'minusculas' => $minusculas,
        'capitalizado' => $primeiraLetraMaiuscula,
        'totalCaracteres' => $qtdCaracteres,
    ];
}

$texto = "relatório mensal de vendas da empresa";
$resultado = formatarTexto($texto);

echo "Maiúsculas: " . $resultado['maiusculas'] . "<br>";
echo "Minúsculas: " . $resultado['minusculas'] . "<br>";
echo "Capitalizado: " . $resultado['capitalizado'] . "<br>";
echo "Total de caracteres: " . $resultado['totalCaracteres'] . "<br>";