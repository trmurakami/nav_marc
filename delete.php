<?php

include 'inc/config.php';

if (is_numeric($_GET["_id"])) {
  $c->remove(array('_id' => $_GET["_id"]));
  echo "Registro excluído com sucesso!";
} else {
  $mongoid = $_GET["_id"];
  $realmongoid = new MongoId($mongoid);
  $c->remove(array('_id' => $realmongoid));
  echo "Registro excluído com sucesso!";
}
?>
