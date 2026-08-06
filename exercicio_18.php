<?php

function contarConsultas(array $consultas): int
{
    return count($consultas);
}

function contarPacientesDiferentes(array $consultas): int
{
    $pacientes = array_map(fn($c) => mb_strtolower(trim($c['paciente'])), $consultas);
    return count(array_unique($pacientes));
}

function contarPorEspecialidade(array $consultas): array
{
    $contagem = [];

    foreach ($consultas as $c) {
        $especialidade = $c['especialidade'];
        if (!isset($contagem[$especialidade])) {
            $contagem[$especialidade] = 0;
        }
        $contagem[$especialidade]++;
    }

    return $contagem;
}

function ordenarPorHorario(array $consultas): array
{
    $ordenadas = $consultas;

    usort($ordenadas, function ($a, $b) {
        return strcmp($a['horario'], $b['horario']);
    });

    return $ordenadas;
}

function obterPrimeiroAtendimento(array $consultasOrdenadas): array
{
    return $consultasOrdenadas[0] ?? [];
}

function obterUltimoAtendimento(array $consultasOrdenadas): array
{
    $total = count($consultasOrdenadas);
    return $total > 0 ? $consultasOrdenadas[$total - 1] : [];
}

function pesquisarPaciente(array $consultas, string $nomePaciente): array
{
    $nomeBusca = mb_strtolower(trim($nomePaciente));

    $encontradas = array_filter($consultas, function ($c) use ($nomeBusca) {
        return mb_strtolower(trim($c['paciente'])) === $nomeBusca;
    });

    return array_values($encontradas);
}

function verificarHorariosDuplicados(array $consultas): array
{
    $horarios = array_map(fn($c) => $c['data'] . ' ' . $c['horario'], $consultas);
    $contagem = array_count_values($horarios);

    $duplicados = [];
    foreach ($contagem as $horario => $qtd) {
        if ($qtd > 1) {
            $duplicados[] = $horario;
        }
    }

    return $duplicados;
}

function organizarAgenda(array $consultas, string $pacientePesquisado = ''): array
{
    $ordenadas = ordenarPorHorario($consultas);

    return [
        'total_consultas'         => contarConsultas($consultas),
        'pacientes_diferentes'    => contarPacientesDiferentes($consultas),
        'consultas_por_especialidade' => contarPorEspecialidade($consultas),
        'primeiro_atendimento'    => obterPrimeiroAtendimento($ordenadas),
        'ultimo_atendimento'      => obterUltimoAtendimento($ordenadas),
        'lista_ordenada'          => $ordenadas,
        'resultado_pesquisa'      => pesquisarPaciente($consultas, $pacientePesquisado),
        'horarios_duplicados'     => verificarHorariosDuplicados($consultas),
    ];
}

$consultasExemplo = [
    ['paciente' => 'João Silva', 'especialidade' => 'Cardiologia', 'data' => '2026-08-10', 'horario' => '09:00'],
    ['paciente' => 'Maria Souza', 'especialidade' => 'Dermatologia', 'data' => '2026-08-10', 'horario' => '08:30'],
    ['paciente' => 'Pedro Alves', 'especialidade' => 'Cardiologia', 'data' => '2026-08-10', 'horario' => '10:00'],
    ['paciente' => 'Ana Lima', 'especialidade' => 'Pediatria', 'data' => '2026-08-10', 'horario' => '09:00'],
    ['paciente' => 'João Silva', 'especialidade' => 'Ortopedia', 'data' => '2026-08-10', 'horario' => '11:30'],
    ['paciente' => 'Carla Melo', 'especialidade' => 'Dermatologia', 'data' => '2026-08-10', 'horario' => '08:00'],
];

$resultado = organizarAgenda($consultasExemplo, 'João Silva');

echo "Total de consultas: {$resultado['total_consultas']}<br>";
echo "Pacientes diferentes: {$resultado['pacientes_diferentes']}<br>";

echo "<br>Consultas por especialidade:<br>";
foreach ($resultado['consultas_por_especialidade'] as $especialidade => $qtd) {
    echo "&nbsp;&nbsp;- $especialidade: $qtd<br>";
}

echo "<br>Primeiro atendimento: {$resultado['primeiro_atendimento']['paciente']} às {$resultado['primeiro_atendimento']['horario']}<br>";
echo "Último atendimento: {$resultado['ultimo_atendimento']['paciente']} às {$resultado['ultimo_atendimento']['horario']}<br>";

echo "<br>Lista ordenada por horário:<br>";
foreach ($resultado['lista_ordenada'] as $c) {
    echo "&nbsp;&nbsp;- {$c['horario']} | {$c['paciente']} | {$c['especialidade']}<br>";
}

echo "<br>Resultado da pesquisa por 'João Silva':<br>";
foreach ($resultado['resultado_pesquisa'] as $c) {
    echo "&nbsp;&nbsp;- {$c['data']} às {$c['horario']} | {$c['especialidade']}<br>";
}

echo "<br>Horários duplicados encontrados:<br>";
if (empty($resultado['horarios_duplicados'])) {
    echo "&nbsp;&nbsp;Nenhum horário duplicado<br>";
} else {
    foreach ($resultado['horarios_duplicados'] as $h) {
        echo "&nbsp;&nbsp;- $h<br>";
    }
}