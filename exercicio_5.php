<?php

function analisarTexto(string $texto): array
{
    $palavras = preg_split('/\s+/', trim($texto), -1, PREG_SPLIT_NO_EMPTY);
    $qtdPalavras = count($palavras);

    $qtdCaracteres = mb_strlen($texto);

    $qtdVogais = preg_match_all('/[aeiouAEIOUáéíóúÁÉÍÓÚâêîôÂÊÎÔãõÃÕ]/u', $texto);

    $qtdConsoantes = preg_match_all('/[bcdfghjklmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZçÇ]/u', $texto);

    return [
        'palavras'    => $qtdPalavras,
        'caracteres'  => $qtdCaracteres,
        'vogais'      => $qtdVogais,
        'consoantes'  => $qtdConsoantes,
    ];
}

$texto = "A editora avalia textos com muito cuidado.";
$resultado = analisarTexto($texto);

echo "Palavras: " . $resultado['palavras'] . "\n";
echo "Caracteres: " . $resultado['caracteres'] . "\n";
echo "Vogais: " . $resultado['vogais'] . "\n";
echo "Consoantes: " . $resultado['consoantes'] . "\n";