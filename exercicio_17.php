<?php

function removerEspacosDuplicados(string $texto): string
{
    $textoLimpo = preg_replace('/\s+/', ' ', $texto);
    return trim($textoLimpo);
}

function separarPalavras(string $texto): array
{
    $textoLimpo = removerEspacosDuplicados($texto);

    $semPontuacao = preg_replace('/[^\p{L}\p{N}\s]/u', '', $textoLimpo);

    $palavras = explode(' ', $semPontuacao);

    $palavras = array_filter($palavras, fn($p) => $p !== '');

    return array_values($palavras);
}

function separarFrases(string $texto): array
{
    $textoLimpo = removerEspacosDuplicados($texto);

    $frases = preg_split('/(?<=[.!?])\s+/', $textoLimpo, -1, PREG_SPLIT_NO_EMPTY);

    return $frases;
}

function encontrarPalavraMaisLonga(array $palavras): string
{
    $maisLonga = '';

    foreach ($palavras as $palavra) {
        if (mb_strlen($palavra) > mb_strlen($maisLonga)) {
            $maisLonga = $palavra;
        }
    }

    return $maisLonga;
}

function encontrarPalavraMaisCurta(array $palavras): string
{
    if (empty($palavras)) {
        return '';
    }

    $maisCurta = $palavras[0];

    foreach ($palavras as $palavra) {
        if (mb_strlen($palavra) < mb_strlen($maisCurta)) {
            $maisCurta = $palavra;
        }
    }

    return $maisCurta;
}

function contarPalavrasRepetidas(array $palavras): int
{
    $palavrasMin = array_map('mb_strtolower', $palavras);

    $contagem = array_count_values($palavrasMin);

    $repetidas = 0;
    foreach ($contagem as $qtd) {
        if ($qtd > 1) {
            $repetidas++;
        }
    }

    return $repetidas;
}

function topCincoPalavras(array $palavras): array
{
    $palavrasMin = array_map('mb_strtolower', $palavras);
    $contagem = array_count_values($palavrasMin);

    arsort($contagem);

    return array_slice($contagem, 0, 5, true);
}

function formatarTexto(string $texto): string
{
    $textoLimpo = removerEspacosDuplicados($texto);
    return ucwords(mb_strtolower($textoLimpo));
}

function processarTexto(string $texto): array
{
    $textoSemEspacos = removerEspacosDuplicados($texto);
    $palavras = separarPalavras($texto);
    $frases = separarFrases($texto);

    return [
        'quantidade_caracteres'    => mb_strlen($textoSemEspacos),
        'quantidade_palavras'      => count($palavras),
        'quantidade_frases'        => count($frases),
        'palavra_mais_longa'       => encontrarPalavraMaisLonga($palavras),
        'palavra_mais_curta'       => encontrarPalavraMaisCurta($palavras),
        'palavras_repetidas'       => contarPalavrasRepetidas($palavras),
        'top_5_palavras'           => topCincoPalavras($palavras),
        'texto_sem_espacos_extras' => $textoSemEspacos,
        'texto_formatado'          => formatarTexto($texto),
    ];
}

$textoExemplo = "  Joao joao joao joao é muito burro ";

$resultado = processarTexto($textoExemplo);

echo "Quantidade de caracteres: {$resultado['quantidade_caracteres']}<br>";
echo "Quantidade de palavras: {$resultado['quantidade_palavras']}<br>";
echo "Quantidade de frases: {$resultado['quantidade_frases']}<br>";
echo "Palavra mais longa: {$resultado['palavra_mais_longa']}<br>";
echo "Palavra mais curta: {$resultado['palavra_mais_curta']}<br>";
echo "Quantidade de palavras repetidas (distintas): {$resultado['palavras_repetidas']}<br>";
 
echo "<br>Top 5 palavras mais frequentes:<br>";
foreach ($resultado['top_5_palavras'] as $palavra => $qtd) {
    echo "&nbsp;&nbsp;- \"$palavra\": $qtd vez(es)<br>";
}
 
echo "<br>Texto sem espaços duplicados:<br>";
echo $resultado['texto_sem_espacos_extras'] . "<br>";
 
echo "<br>Texto formatado (Primeira Letra Maiúscula):<br>";
echo $resultado['texto_formatado'] . "<br>";