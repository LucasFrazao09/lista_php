<!-- Uma empresa deseja gerar senhas temporárias para seus colaboradores.
Crie uma função chamada gerarSenha() que receba a quantidade de caracteres
desejada e retorne uma senha aleatória contendo letras maiúsculas, minúsculas,
números e caracteres especiais. -->

<?php

function gerarSenha($quantidade) {
    $letrasMinusculas = 'abcdefghijklmnopqrstuvwxyz';
    $letrasMaiusculas = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numeros = '0123456789';
    $caracteresEspeciais = '!@#$%^&*()_-+=<>?';

    $todosCaracteres = $letrasMinusculas . $letrasMaiusculas . $numeros . $caracteresEspeciais;

    $senha = '';
    $tamanhoTotal = strlen($todosCaracteres);

    for ($i = 0; $i < $quantidade; $i++) {
        $indiceAleatorio = random_int(0, $tamanhoTotal - 1);
        $senha .= $todosCaracteres[$indiceAleatorio];
    }

    return $senha;
}


echo gerarSenha(12) . "\n"; 