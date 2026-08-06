<?php

function analisarProdutos(array $produtos, string $produtoPesquisado = ''): array
{
    $maisCaro = $produtos[0];
    $maisBarato = $produtos[0];
    $somaPrecos = 0;

    foreach ($produtos as $produto) {
        if ($produto['preco'] > $maisCaro['preco']) {
            $maisCaro = $produto;
        }
        if ($produto['preco'] < $maisBarato['preco']) {
            $maisBarato = $produto;
        }
        $somaPrecos += $produto['preco'];
    }

    $mediaPrecos = $somaPrecos / count($produtos);

    $produtoEncontrado = null;
    if ($produtoPesquisado !== '') {
        foreach ($produtos as $produto) {
            if (mb_strtolower($produto['nome']) === mb_strtolower($produtoPesquisado)) {
                $produtoEncontrado = $produto;
                break;
            }
        }
    }

    return [
        'maisCaro' => $maisCaro,
        'maisBarato' => $maisBarato,
        'mediaPrecos' => round($mediaPrecos, 2),
        'produtoPesquisado' => $produtoEncontrado,
    ];
}

$produtos = [
    ['nome' => 'Arroz', 'preco' => 25.90],
    ['nome' => 'Feijão', 'preco' => 8.50],
    ['nome' => 'Leite', 'preco' => 4.99],
    ['nome' => 'Carne', 'preco' => 45.00],
    ['nome' => 'Açúcar', 'preco' => 6.20],
];

$resultado = analisarProdutos($produtos, 'Leite');

echo "Produto mais caro: " . $resultado['maisCaro']['nome'] . " - R$ " . number_format($resultado['maisCaro']['preco'], 2, ',', '.') . "<br>";
echo "Produto mais barato: " . $resultado['maisBarato']['nome'] . " - R$ " . number_format($resultado['maisBarato']['preco'], 2, ',', '.') . "<br>";
echo "Média de preços: R$ " . number_format($resultado['mediaPrecos'], 2, ',', '.') . "<br>";

if ($resultado['produtoPesquisado'] !== null) {
    echo "Produto pesquisado encontrado: " . $resultado['produtoPesquisado']['nome'] . " - R$ " . number_format($resultado['produtoPesquisado']['preco'], 2, ',', '.') . "<br>";
} else {
    echo "Produto pesquisado não encontrado.<br>";
}