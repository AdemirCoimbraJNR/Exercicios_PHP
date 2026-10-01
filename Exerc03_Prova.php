<?php
// Sistema de Controle de Colheita

// Recebe a quantidade produzida e o valor por kg de UMA cultura
// e devolve quanto essa cultura vale no total (multiplicação simples)
function calcularValorProducao(float $quantidade, float $valorKg): float
{
    return $quantidade * $valorKg;
}

// Recebe o valor TOTAL da colheita (soma de todas as culturas)
// e devolve uma string dizendo se é pequeno, médio ou grande porte
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

// Gera um código aleatório tipo "COL4821" pra identificar essa colheita
function gerarIdColheita(): string
{
    return "COL" . rand(1000, 9999); // concatena o texto "COL" com um número aleatório
}

// INICIO 

// Chama as funções pra criar o ID e pegar a data de hoje
$idColheita = gerarIdColheita();
$data = date('d/m/Y'); 

echo "=== Sistema de Controle de Colheita ===\n";
echo "Código da colheita: $idColheita\n";
echo "Data: $data\n";

// Nome do responsável
echo "Nome do responsável: ";
$responsavel = trim(fgets(STDIN));

// Quantidade de culturas cadastradas
echo "Quantas culturas serão registradas? ";
$quantidadeCulturas = (int) trim(fgets(STDIN));

$culturas = [];

// Laço para cada cultura que vai ser cadastrada
for ($i = 1; $i <= $quantidadeCulturas; $i++) {
    echo "\n--- Cultura $i ---\n";

    echo "Nome da cultura: ";
    $nome = trim(fgets(STDIN));

    echo "Quantidade produzida (kg): ";
    $quantidade = (float) trim(fgets(STDIN));

    echo "Valor por kg (R\$): ";
    $valorKg = (float) trim(fgets(STDIN));

    // Validação de quantidade e valor da cultura
    if ($quantidade <= 0 || $valorKg <= 0) {
        
        echo "Registro inválido para '$nome'. Cultura ignorada.\n";
        continue; 
    }

    // Se passou na validação, guarda a cultura no array $culturas
    // como um "array associativo" (tipo um mini registro com chave => valor)
    $culturas[] = [
        'nome'          => $nome,
        'quantidade'    => $quantidade,
        'valorKg'       => $valorKg,
        'valorProducao' => calcularValorProducao($quantidade, $valorKg), // chama a função aqui
    ];
}

// Percorre tudo que foi salvo 
echo "\n=== Relatório de Culturas ===\n";

$quantidadeTotal = 0; // vai somar o kg de todas as culturas
$valorTotal = 0;      // vai somar o valor (R$) de todas as culturas

// foreach percorre cada item do array $culturas, um de cada vez
foreach ($culturas as $cultura) {
    printf(
        "Nome: %s | Quantidade: %.2f kg | Valor/kg: R\$ %.2f | Valor estimado: R\$ %.2f\n",
        $cultura['nome'],
        $cultura['quantidade'],
        $cultura['valorKg'],
        $cultura['valorProducao']
    );

    // vai acumulando os totais a cada volta do foreach
    $quantidadeTotal += $cultura['quantidade'];
    $valorTotal += $cultura['valorProducao'];
}

// só depois de somar tudo é que dá pra classificar o porte da produção
$classificacao = classificarProducao($valorTotal);

echo "\n=== Resumo Geral ===\n";
echo "Código da colheita: $idColheita\n";
echo "Data: $data\n";
echo "Responsável: $responsavel\n";
echo "Quantidade de culturas válidas: " . count($culturas) . "\n"; // count() conta itens do array
printf("Quantidade total produzida: %.2f kg\n", $quantidadeTotal);
printf("Valor total estimado da colheita: R\$ %.2f\n", $valorTotal);
echo "Classificação: $classificacao\n";