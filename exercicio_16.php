<?php

function contarPorRegex($senha, $regex) {
    preg_match_all($regex, $senha, $encontrados);
    return count($encontrados[0]);
}

function contarMaiusculas($senha) {
    return contarPorRegex($senha, '/[A-Z]/');
}

function contarMinusculas($senha) {
    return contarPorRegex($senha, '/[a-z]/');
}

function contarNumeros($senha) {
    return contarPorRegex($senha, '/[0-9]/');
}

function contarEspeciais($senha) {
    return contarPorRegex($senha, '/[^A-Za-z0-9]/');
}

function classificarSeguranca($senha, $maiusculas, $minusculas, $numeros, $especiais) {
    $criterios = [
        strlen($senha) >= 8,
        $maiusculas > 0,
        $minusculas > 0,
        $numeros > 0,
        $especiais > 0
    ];

    $totalCriterios = count(array_filter($criterios));

    if ($totalCriterios <= 2) return "Fraca";
    if ($totalCriterios === 3) return "Média";
    if ($totalCriterios === 4) return "Forte";
    return "Muito Forte";
}

function exibirRelatorio($senha) {
    $maiusculas = contarMaiusculas($senha);
    $minusculas = contarMinusculas($senha);
    $numeros = contarNumeros($senha);
    $especiais = contarEspeciais($senha);
    $tamanho = strlen($senha);
    $nivel = classificarSeguranca($senha, $maiusculas, $minusculas, $numeros, $especiais);

    echo "Senha: $senha<br>";
    echo "Letras maiúsculas: $maiusculas<br>";
    echo "Letras minúsculas: $minusculas<br>";
    echo "Números: $numeros<br>";
    echo "Caracteres especiais: $especiais<br>";
    echo "Tamanho da senha: $tamanho<br>";
    echo "Nível de segurança: $nivel<br>";
    echo "<br>";
}

exibirRelatorio("abc123");
exibirRelatorio("Abcdefg1");
exibirRelatorio("Abcdef1!");
exibirRelatorio("A1b2c3d4#\$");