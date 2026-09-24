
//Tabuada
<?php
// Questão 1 - Tabuada
// Dado: número inteiro informado pelo usuário
// Repetição: laço de 1 até 10 (quantidade fixa de repetições)
 
echo "Informe um número: ";
$numero = (int) trim(fgets(STDIN));
 
for ($i = 1; $i <= 10; $i++) {
    $resultado = $numero * $i;
    echo "$numero x $i = $resultado" . PHP_EOL;
}
 

