<?php

//Insira o caminho para seu arquivo txt com entradas válidas e em linhas.
$entrada_linhas=file('/caminho_completo/nome_arquivo.txt');
if (!$entrada_linhas || count($entrada_linhas) < 3) {
  echo "Arquivo inválido.";
  exit;
}

$qtde_entradas = $entrada_linhas[0];
$position = 1;
for ($i = 1; $i <= (int)$qtde_entradas; $i++ ){
  calculaResulado(array_slice($entrada_linhas, $position, 2));
  $position +=2;
}

function calculaResulado(array $entrada) {
  if (count($entrada) != 2){
    echo "Entrada inválida";
    exit;
  }

  $matriz = preencheMatriz($entrada);
  return retornaAcumulo($matriz, (int)$entrada[0]);
}

function retornaAcumulo(array $matriz, int $matriz_size) {
  $qtde_acumulo_total = 0;
  $acumulo_temporario = 0;
  $preenchimento_incial = false;

  for ($row = 0; $row < (int)$matriz_size; $row++) {
    $acumulo_temporario=0;
    $preenchimento_incial=false;
    for ($col = 0; $col < (int)$matriz_size; $col++) {
      if ($matriz[$row][$col] === '*' && !$preenchimento_incial){
        $preenchimento_incial = true;
      }elseif($preenchimento_incial && $matriz[$row][$col] === '-'){
        $acumulo_temporario += 1;
      }elseif($preenchimento_incial && $matriz[$row][$col] === '*' && $acumulo_temporario != 0){
        $qtde_acumulo_total +=$acumulo_temporario;
        $acumulo_temporario=0;
      }
    }
  }
  //echo "resultado \n".$qtde_acumulo_total ."\n _________________________ \n\n"; // resultado formatado
  echo $qtde_acumulo_total."\n";
}

function preencheMatriz(array $entrada){
  $matriz_size = (int)$entrada[0];
  $vector_values = explode(" ",$entrada[1]);
  $matriz = [];

  for($i=($matriz_size-1); $i >= 0 ; $i--){
    for($j=($matriz_size-1); $j >= 0; $j--){
      if($vector_values[$j] > $i){
        $matriz[$i][$j] = '*';
       // echo $matriz[$i][$j]; // exibir o desenho da matriz
      } else {
        $matriz[$i][$j] = '-';
      // echo $matriz[$i][$j]; // exibir o desenho da matriz
      }
    }
    // echo "\n"; // exibir o desenho da matriz
  }

  return $matriz;
}