<!-- Um sistema de cadastro precisa proteger informações sensíveis dos usuários.
Crie uma função chamada mascararCpf() que receba um CPF e substitua todos os caracteres por *, mantendo visíveis apenas os quatro últimos dígitos.
Retorne o CPF mascarado. -->

<?php

function mascararCpf($cpf) {
    
    $cpfLimpo = preg_replace('/\D/', '', $cpf);

    if (strlen($cpfLimpo) !== 11) {
        return "CPF inválido";
    }

    $ultimosDigitos = substr($cpfLimpo, -4);

  
    $mascara = str_repeat('*', strlen($cpfLimpo) - 4);


    return $mascara . $ultimosDigitos;
}


echo mascararCpf("123.456.789-01") . "\n"; 
echo mascararCpf("12345678901") . "\n";    