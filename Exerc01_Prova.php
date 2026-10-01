<?php
// Tabuada

// número inteiro informado pelo usuário
echo "Informe um número: ";
$numero = (int) trim(fgets(STDIN));
 
// Repetição 
for ($i = 1; $i <= 10; $i++) {
    $resultado = $numero * $i;

// Mostra o resultado
    echo "$numero x $i = $resultado" . PHP_EOL;
}