<?php
// Sistema de Controle de Colheita


// Armazenados: array $culturas (usado depois no relatório final).
// Validação: só entra nos cálculos se quantidade > 0 e valor/kg > 0.
// Cálculos que se repetem: valor da produção de cada cultura.
// Valores acumulados: quantidade total (kg) e valor total estimado.
// Responsabilidades separadas em funções: calcular valor de produção
// e classificar o porte da produção.

// Dados de entrada: quantidade de culturas, nome, quantidade produzida (kg)
// e valor por kg de cada uma.
function calcularValorProducao(float $quantidade, float $valorKg): float
{
    return $quantidade * $valorKg;
}

function classificarProducao(float $valorTotal): string
{
    if ($valorTotal < 5000) {
        return "PRODUÇÃO DE PEQUENO PORTE";
    } elseif ($valorTotal <= 19999.99) {
        return "PRODUÇÃO DE MÉDIO PORTE";
    } else {
        return "PRODUÇÃO DE GRANDE PORTE";
    }
}

function gerarIdColheita(): string
{
    return "COL" . rand(1000, 9999);
}

// ---- Início do sistema ----

$idColheita = gerarIdColheita();
$data = date('d/m/Y');

echo "=== Sistema de Controle de Colheita ===\n";
echo "Código da colheita: $idColheita\n";
echo "Data: $data\n";

echo "Nome do responsável: ";
$responsavel = trim(fgets(STDIN));

echo "Quantas culturas serão registradas? ";
$quantidadeCulturas = (int) trim(fgets(STDIN));

$culturas = [];

for ($i = 1; $i <= $quantidadeCulturas; $i++) {
    echo "\n--- Cultura $i ---\n";

    echo "Nome da cultura: ";
    $nome = trim(fgets(STDIN));

    echo "Quantidade produzida (kg): ";
    $quantidade = (float) trim(fgets(STDIN));

    echo "Valor por kg (R\$): ";
    $valorKg = (float) trim(fgets(STDIN));

    if ($quantidade <= 0 || $valorKg <= 0) {
        echo "Registro inválido para '$nome'. Cultura ignorada.\n";
        continue;
    }

    $culturas[] = [
        'nome'          => $nome,
        'quantidade'    => $quantidade,
        'valorKg'       => $valorKg,
        'valorProducao' => calcularValorProducao($quantidade, $valorKg),
    ];
}

// ---- Relatório de culturas cadastradas ----

echo "\n=== Relatório de Culturas ===\n";

$quantidadeTotal = 0;
$valorTotal = 0;

foreach ($culturas as $cultura) {
    printf(
        "Nome: %s | Quantidade: %.2f kg | Valor/kg: R\$ %.2f | Valor estimado: R\$ %.2f\n",
        $cultura['nome'],
        $cultura['quantidade'],
        $cultura['valorKg'],
        $cultura['valorProducao']
    );

    $quantidadeTotal += $cultura['quantidade'];
    $valorTotal += $cultura['valorProducao'];
}

// ---- Resumo geral ----

$classificacao = classificarProducao($valorTotal);

echo "\n=== Resumo Geral ===\n";
echo "Código da colheita: $idColheita\n";
echo "Data: $data\n";
echo "Responsável: $responsavel\n";
echo "Quantidade de culturas válidas: " . count($culturas) . "\n";
printf("Quantidade total produzida: %.2f kg\n", $quantidadeTotal);
printf("Valor total estimado da colheita: R\$ %.2f\n", $valorTotal);
echo "Classificação: $classificacao\n";