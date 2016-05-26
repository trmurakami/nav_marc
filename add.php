<?php
  $tpTitle = 'Iusdata - Adicionar registro';

  include 'inc/config.php';
  include 'inc/header.php';
  include_once 'inc/functions.php';

  if (!empty($_POST)) {
    $doc = array(
    "type" => "ARTIGO DE PERIODICO",
    "title" => $_POST['title'],
    "ispartof" => $_POST['ispartof'],
    "issn_part" => $_POST['issn_part'],
    "publisher_place" => $_POST['publisher_place'],
    "year" => $_POST['year'],
    "volume" => $_POST['volume'],
    "numeracao" => $_POST['numeracao'],
    "paginacao" => $_POST['paginacao'],
    "mes" => $_POST['mes'],
    "language" => $_POST['language'],
    "producao" => $_POST['producao'],
    "authors" => $_POST['authors'],
    "subject" => $_POST['subject']
#    "authors" => array("0.9.7", "0.9.8", "0.9.9")
    );

    $c->insert( $doc );

  }
?>
<body>
<div class="ui container">

<h3>Adicionar registro</h3>

<form class="ui form" action="add.php" method="post">
  <div class="field">
    <label>Título</label>
    <input name="title" placeholder="Título" type="text">
  </div>
  <div class="field">
    <label>Autor(es)</label>
    <div class="input_fields_authors">
      <div><input type="text" id="Autores" name="authors[]" placeholder="Autores"><a href="#" class="remove_field">Remover</a></div>
    </div>
  </div>
  <button class="ui button autores">Adicionar um autor</button>
  <div class="field">
    <label>Nome do periódico</label>
    <input name="ispartof" placeholder="Nome do periódico" type="text">
  </div>
  <div class="field">
    <label>ISSN</label>
    <input name="issn_part" placeholder="ISSN" type="text">
  </div>
  <div class="field">
    <label>Local de publicação</label>
    <input name="publisher_place" placeholder="Local de publicação" type="text">
  </div>
  <div class="field">
    <label>Ano de publicação</label>
    <input name="year" placeholder="Ano" type="text">
  </div>
  <div class="field">
    <label>Volume</label>
    <input name="volume" placeholder="Volume" type="text">
  </div>
  <div class="field">
    <label>Número</label>
    <input name="numeracao" placeholder="Número" type="text">
  </div>
  <div class="field">
    <label>Páginas</label>
    <input name="paginacao" placeholder="Páginas" type="text">
  </div>
  <div class="field">
      <label>Mês</label>
      <select name="mes" class="ui dropdown">
        <option value="">Escolha um mês</option>
        <option value="jan">Janeiro</option>
        <option value="fev">Fevereiro</option>
        <option value="mar">Março</option>
        <option value="abr">Abril</option>
        <option value="mai">Maio</option>
        <option value="jun">Junho</option>
        <option value="jul">Julho</option>
        <option value="ago">Agosto</option>
        <option value="set">Setembro</option>
        <option value="out">Outubro</option>
        <option value="nov">Novembro</option>
        <option value="dez">Dezembro</option>
      </select>
    </div>

  <div class="field">
    <label>Assuntos</label>
    <div class="input_fields_subject">
      <div><input type="text" id="Assuntos" name="subject[]" placeholder="Assuntos"><a href="#" class="remove_field">Remover</a></div>
    </div>
  </div>
  <button class="ui button assuntos">Adicionar um assunto</button>

  <div class="field">
    <label>Idioma</label>
    <input name="language" placeholder="Idioma" type="text">
  </div>

  <div class="field">
    <div class="ui checkbox">
      <input class="hidden" tabindex="0" type="checkbox" name="producao">
      <label>Produção científica</label>
    </div>
  </div>
  <button class="ui button" type="submit">Salvar</button>





</form>

</div>
<script>
$('.ui.checkbox')
  .checkbox()
;
$('select.dropdown')
  .dropdown()
;
</script>
<script type="text/javascript">
$(document).ready(function() {
    var max_fields      = 100; //maximum input boxes allowed
    var wrapper         = $(".input_fields_authors"); //Fields wrapper
    var add_button      = $(".autores"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="text" id="Autores" name="authors[]" placeholder="Autores"><a href="#" class="remove_field">Remover</a></div>'); //add input box
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    var max_fields      = 100; //maximum input boxes allowed
    var wrapper         = $(".input_fields_subject"); //Fields wrapper
    var add_button      = $(".assuntos"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="text" id="Assuntos" name="subject[]" placeholder="Assuntos"><a href="#" class="remove_field">Remover</a></div>'); //add input box
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>

</body>
</html>
