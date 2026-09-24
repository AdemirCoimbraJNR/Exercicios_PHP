<?php
// Questão 2 - Calculadora
// Dados: primeiro número, segundo número (convertidos para float)
// e a operação (string)
// Decisão: qual operação executar + validar divisão por zero

function calcular(float $n1, float $n2, string $operacao)
{
    switch ($operacao) {
        case '+':
            return $n1 + $n2;
        case '-':
            return $n1 - $n2;
        case '*':
            return $n1 * $n2;
        case '/':
            if ($n2 == 0) {
                return "Operação não pode ser realizada (divisão por zero).";
            }
            return $n1 / $n2;
        default:
            return "Operação inválida.";
    }
}

echo "Primeiro número: ";
$n1 = (float) trim(fgets(STDIN));

echo "Segundo número: ";
$n2 = (float) trim(fgets(STDIN));

echo "Operação (+, -, *, /): ";
$operacao = trim(fgets(STDIN));

$resultado = calcular($n1, $n2, $operacao);

echo "\nResultado:\n";
echo "$n1 $operacao $n2 = $resultado" . PHP_EOL;