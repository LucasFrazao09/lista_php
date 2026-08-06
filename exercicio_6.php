<?php

function converterTemperatura(float $valor, string $origem, string $destino): float
{
    $origem  = strtolower(trim($origem));
    $destino = strtolower(trim($destino));

    $escalasValidas = ['celsius', 'fahrenheit', 'kelvin'];

    if (!in_array($origem, $escalasValidas) || !in_array($destino, $escalasValidas)) {
        throw new InvalidArgumentException("Escala inválida. Use: celsius, fahrenheit ou kelvin.");
    }

    if ($origem === $destino) {
        return round($valor, 2);
    }

    switch ($origem) {
        case 'celsius':
            $celsius = $valor;
            break;
        case 'fahrenheit':
            $celsius = ($valor - 32) * 5 / 9;
            break;
        case 'kelvin':
            $celsius = $valor - 273.15;
            break;
    }

    switch ($destino) {
        case 'celsius':
            $resultado = $celsius;
            break;
        case 'fahrenheit':
            $resultado = ($celsius * 9 / 5) + 32;
            break;
        case 'kelvin':
            $resultado = $celsius + 273.15;
            break;
    }

    return round($resultado, 2);
}

echo converterTemperatura(100, 'celsius', 'fahrenheit') . "°F\n";
echo converterTemperatura(32, 'fahrenheit', 'celsius') . "°C\n";
echo converterTemperatura(0, 'celsius', 'kelvin') . "K\n";
echo converterTemperatura(300, 'kelvin', 'celsius') . "°C\n";
echo converterTemperatura(98.6, 'fahrenheit', 'kelvin') . "K\n";