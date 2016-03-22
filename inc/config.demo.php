<?php
/* Banco de dados */
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);
$m  = new MongoClient();
$d  = $m->NOME_DO_BANCO_DE_DADOS;
$c = $d->NOME_DA_COLEÇÃO;
?>
