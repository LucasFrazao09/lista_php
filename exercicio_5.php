<!-- Uma editora deseja obter algumas informações sobre os textos enviados pelos autores.
Crie uma função chamada analisarTexto() que receba um texto e retorne:
● Quantidade de palavras;
● Quantidade de caracteres;
● Quantidade de vogais;
● Quantidade de consoantes. -->

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

$texto = "Não aguento mais essa matérias";
$resultado = analisarTexto($texto);

echo "Palavras: " . $resultado['palavras'] . "\n";
echo "Caracteres: " . $resultado['caracteres'] . "\n";
echo "Vogais: " . $resultado['vogais'] . "\n";
echo "Consoantes: " . $resultado['consoantes'] . "\n";