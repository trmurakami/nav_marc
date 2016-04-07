<?php
  $tpTitle="BDPI USP - Resultado da Busca";

  include 'inc/config.php';
  include 'inc/header.php';
  include_once 'inc/functions.php';
  /* Pegar a URL atual */
  if (strpos($_SERVER['REQUEST_URI'], '?') !== false) {
      $url = "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
  } else {
      $url = "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}?";
  }
    $escaped_url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
  /* Query */
  if (empty($_GET)) {
      $query = json_decode('{}');
  } elseif (!empty($_GET["category"])) {
      unset ($_GET["category"]);
      $q = str_replace('"','\\"',$_GET["q"]);
      unset ($_GET["q"]);
      $consult = "";
      foreach ($_GET as $key => $value) {
        $consult .= '"'.$key.'":"'.$value.'",';
      }
      $query = json_decode('{'.$consult.'"$text": {"$search":"'.$q.'"}}');
  } else {
      $query = array();
      foreach ($_GET as $key => $value) {
          $query[$key] = $value;
      }
  }
  /* Pagination variables */
    $page = isset($_POST['page']) ? (int) $_POST['page'] : 1;
    $limit = 15;
    $skip = ($page - 1) * $limit;
    $next = ($page + 1);
    $prev = ($page - 1);
    $sort = array('year' => -1);
  /* Consultas */
    $cursor = $c->find($query)->skip($skip)->limit($limit)->sort($sort);
    $total = $cursor->count();

?>
</head>
<body>
  <div class="ui container">
  <div class="ui main two column stackable grid">
    <div class="four wide column">
      <div class="ui fluid vertical accordion menu">
        <div class="item">
          <a class="active title">
            <i class="dropdown icon"></i>
            Filtros ativos
          </a>
          <div class="active content">
            <div class="ui form">
              <div class="grouped fields">
                <?php foreach ($_GET as $filters): ?>
                    <div class="field">
                    <div class="ui checkbox">
                      <input type="checkbox" name="<?php echo $filters;?>">
                    <label><?php echo $filters;?></label>
                    </div>
                </div>
                <?php endforeach;?>
              </div>
            </div>
          </div>
        </div>
      <?php
      /* Gerar facetas */
        generateFacet($url, $c, $query, '$type', 'count', -1, 'Tipo de publicação', 50);
        generateFacet($url, $c, $query, '$unidadeUSP', 'count', -1, 'Unidade USP - Participações', 100);
        generateFacet($url, $c, $query, '$unidadeUSPtrabalhos', 'count', -1, 'Unidade USP - Trabalhos', 100);
        generateFacet($url, $c, $query, '$departamento', 'count', -1, 'Departamento - Participações', 50);
        generateFacet($url, $c, $query, '$departamentotrabalhos', 'count', -1, 'Departamento - Trabalhos', 50);
        generateFacet($url, $c, $query, '$subject', 'count', -1, 'Assuntos', 50);
        if (strpos($_SERVER['REQUEST_URI'], 'unidadeUSPtrabalhos') !== false) {
            generateFacet($url, $c, $query, '$authors', 'count', -1, 'Autores', 50);
        }
        generateFacet($url, $c, $query, '$colab', 'count', -1, 'País dos autores externos à USP', 50);
        generateFacet($url, $c, $query, '$authorUSP', 'count', -1, 'Autores USP', 50);
        generateFacet($url, $c, $query, '$codpesbusca', 'count', -1, 'Número USP', 50);
        generateFacet($url, $c, $query, '$codpes', 'count', -1, 'Número USP / Unidade', 50);
        generateFacet($url, $c, $query, '$ispartof', 'count', -1, 'É parte de', 50);
        generateFacet($url, $c, $query, '$issn_part', 'count', -1, 'ISSN do todo', 50);
        generateFacet($url, $c, $query, '$evento', 'count', -1, 'Nome do evento', 50);
        generateFacet($url, $c, $query, '$year', '_id', -1, 'Ano de publicação', 50);
        generateFacet($url, $c, $query, '$language', 'count', -1, 'Idioma', 50);
        generateFacet($url, $c, $query, '$internacionalizacao', 'count', -1, 'Internacionalização', 50);
        generateFacet($url, $c, $query, '$country', 'count', -1, 'País de publicação', 50);
      ?>
    </div>
  </div>
  <div class="ten wide column">
    <div class="page-header"><h3>Resultado da busca <small><?php print_r($total);?></small></h3></div>

  <?php
  /* Pagination - Start */
  echo '<div class="ui buttons">';
  if ($page > 1) {
      echo '<form method="post" action="'.$escaped_url.'">';
      echo '<input type="hidden" name="extra_submit_param" value="extra_submit_value">';
      echo '<button type="submit" name="page" class="ui labeled icon button active" value="'.$prev.'"><i class="left chevron icon"></i>Anterior</button>';
      if ($page * $limit < $total) {
          echo '<button type="submit" name="page" value="'.$next.'" class="ui right labeled icon button active">Próximo<i class="right chevron icon"></i></button>';
      } else {
          echo '<button class="ui right labeled icon button disabled">Próximo<i class="right chevron icon"></i></button>';
      }
      echo '</form>';
  } else {
      if ($page * $limit < $total) {
          echo '<form method="post" action="'.$escaped_url.'">';
          echo '<input type="hidden" name="extra_submit_param" value="extra_submit_value">';
          echo '<button class="ui labeled icon button disabled"><i class="left chevron icon"></i>Anterior</button>';
          echo '<button type="submit" name="page" value="'.$next.'" class="ui right labeled icon button active">Próximo<i class="right chevron icon"></i></button>';
          echo '</form>';
      }
  }
  echo '</div>';
  /* Pagination - End */
  ?>
<div class="ui divided items">
<?php foreach ($cursor as $r): ?>
  <div class="item">
    <div class="image">
      <h4 class="ui center aligned icon header">
        <i class="circular file icon"></i>
        <?php if (!empty($r['ispartof'])): ?>
        <a href="result.php?ispartof=<?php echo $r['ispartof'];?>"><?php echo $r['ispartof'];?></a> |
        <?php endif; ?>
        <a href="result.php?type=<?php echo $r['type'];?>"><?php echo $r['type'];?></a>
      </h4>
    </div>
    <div class="content">
      <a class="header" href="single.php?_id=<?php echo $r['sysno'];?>"><?php echo $r['title'];?> (<?php echo $r['year']; ?>)</a> <a class="ui blue label" href="http://dedalus.usp.br/F/?func=direct&doc_number=<?php echo $r['sysno'];?>">DEDALUS</a>
    <!--List authors -->
    <div class="extra">
    <?php if (!empty($r['authors'])): ?>
      <?php foreach ($r['authors'] as $autores): ?>
        <div class="ui label" style="color:black;"><i class="user icon"></i><a href="result.php?authors=<?php echo $autores;?>"><?php echo $autores;?></a></div>
      <?php endforeach;?>
    <?php endif; ?>
  </div>
  <div class="extra">
    <?php if (!empty($r['subject'])): ?>
      <?php foreach ($r['subject'] as $assunto): ?>
        <div class="ui label" style="color:black;"><i class="globe icon"></i><a href="result.php?subject=<?php echo $assunto;?>"><?php echo $assunto;?></a></div>
      <?php endforeach;?>
    <?php endif; ?>
    <?php if (!empty($r['url'])): ?>
      <?php foreach ($r['url'] as $url): ?>
        <?php if ($url != ""): ?>
        <a href="<?php echo $url;?>">
          <div class="ui right floated primary button">
            Acesso online
            <i class="right chevron icon"></i>
          </div>
        </a>
        <?php endif; ?>
      <?php endforeach;?>
    <?php endif; ?>
  <?php if (!empty($r['doi'])): ?>
    <a href="http://dx.doi.org/<?php echo $r['doi'][0];?>">
    <div class="ui right floated primary button">
      Acesso online
      <i class="right chevron icon"></i>
    </div></a>
    <object height="50" data="http://api.elsevier.com/content/abstract/citation-count?doi=<?php echo $r['doi'][0];?>&apiKey=c7af0f4beab764ecf68568961c2a21ea&httpAccept=text/html"></object>
  <?php endif; ?>
  </div>
  </div>
  </div>
<?php endforeach;?>
</div>
<?php
/* Pagination - Start */
echo '<div class="ui buttons">';
if ($page > 1) {
    echo '<form method="post" action="'.$escaped_url.'">';
    echo '<input type="hidden" name="extra_submit_param" value="extra_submit_value">';
    echo '<button type="submit" name="page" class="ui labeled icon button active" value="'.$prev.'"><i class="left chevron icon"></i>Anterior</button>';
    if ($page * $limit < $total) {
        echo '<button type="submit" name="page" value="'.$next.'" class="ui right labeled icon button active">Próximo<i class="right chevron icon"></i></button>';
    } else {
        echo '<button class="ui right labeled icon button disabled">Próximo<i class="right chevron icon"></i></button>';
    }
    echo '</form>';
} else {
    if ($page * $limit < $total) {
        echo '<form method="post" action="'.$escaped_url.'">';
        echo '<input type="hidden" name="extra_submit_param" value="extra_submit_value">';
        echo '<button class="ui labeled icon button disabled"><i class="left chevron icon"></i>Anterior</button>';
        echo '<button type="submit" name="page" value="'.$next.'" class="ui right labeled icon button active">Próximo<i class="right chevron icon"></i></button>';
        echo '</form>';
    }
}
echo '</div>';
/* Pagination - End */
?>
</div>
</div>
</div>
<?php
  include 'inc/footer.php';
?>
<script>
$('.ui.accordion')
  .accordion()
;
</script>
</body>
</html>
