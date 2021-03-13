<?php

//Insira o caminho para seu arquivo txt com entradas válidas e em linhas.
$entrada_linhas=file('teste.txt');

if (!$entrada_linhas || count($entrada_linhas) < 3) {
  echo "Arquivo inválido.";
  exit;
}

$qtde_entradas = $entrada_linhas[0];
$posicao = 1;
for ($i = 1; $i <= (int)$qtde_entradas; $i++ ) {
  calculaResulado(array_slice($entrada_linhas, $posicao, 2));
  $posicao +=2;
}

/*
* Recebe a entrada já filtrada, caso seja válida faz o cálculo e retorna o resultado final.
* @param array['string', 'string'] $entrada
* @return string
*/
function calculaResulado(array $entrada) {
  if (count($entrada) != 2){
    echo "Arquivo com uma ou mais entradas inválidas";
    exit;
  }

  $matriz = preencheMatriz($entrada);
  return retornaAcumulo($matriz, (int)$entrada[0]);
}

/*
* Recebe a matriz montada de acordo com as entradas informadas e cálcula capacidade de acúmulo
* @param array['string', 'string'] $matriz
* @param int $matriz_tamanho
* @return string
*/
function retornaAcumulo(array $matriz, int $matriz_tamanho) {
  $qtde_acumulo_total = 0;
  $acumulo_temporario = 0;
  $preenchimento_incial = false;

  for ($row = 0; $row < (int)$matriz_tamanho; $row++) {
    $acumulo_temporario=0;
    $preenchimento_incial=false;
    for ($col = 0; $col < (int)$matriz_tamanho; $col++) {
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

/*
* Recebe uma entrada, caso seja válida, preenche a matriz de acordo com os parâmetros informados
* @param array['string', 'string'] $entrada
* @return $matriz[][]
*/
function preencheMatriz(array $entrada) {
  if (count($entrada) != 2){
    echo "Arquivo com uma ou mais entradas inválidas";
    exit;
  }

  $matriz_tamanho = (int)$entrada[0];
  $valores_vetor = explode(" ",$entrada[1]);
  $matriz = [];

  for ($i=($matriz_tamanho-1); $i >= 0 ; $i--) {
    for ($j=($matriz_tamanho-1); $j >= 0; $j--) {
      if ($valores_vetor[$j] > $i) {
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