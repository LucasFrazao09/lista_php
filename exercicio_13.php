<?php

function criptografarMensagem(string $texto, int $deslocamento = 3): string
{
    $resultado = '';
    $tamanho = mb_strlen($texto);

    for ($i = 0; $i < $tamanho; $i++) {
        $caractere = mb_substr($texto, $i, 1);

        if (ctype_upper($caractere)) {
            $posicao = ord($caractere) - ord('A');
            $novaPosicao = ($posicao + $deslocamento) % 26;
            $resultado .= chr($novaPosicao + ord('A'));
        } elseif (ctype_lower($caractere)) {
            $posicao = ord($caractere) - ord('a');
            $novaPosicao = ($posicao + $deslocamento) % 26;
            $resultado .= chr($novaPosicao + ord('a'));
        } else {
            $resultado .= $caractere;
        }
    }

    return $resultado;
}

function descriptografarMensagem(string $textoCriptografado, int $deslocamento = 3): string
{
    return criptografarMensagem($textoCriptografado, 26 - ($deslocamento % 26));
}

$mensagemOriginal = "Oss";
$chave = 3;

$mensagemCriptografada = criptografarMensagem($mensagemOriginal, $chave);
$mensagemDecifrada = descriptografarMensagem($mensagemCriptografada, $chave);

echo "Mensagem original: " . $mensagemOriginal . "<br>";
echo "Mensagem criptografada: " . $mensagemCriptografada . "<br>";
echo "Mensagem descriptografada: " . $mensagemDecifrada . "<br>";