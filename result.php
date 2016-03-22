<?php
  include 'inc/config.php';
  include 'inc/header.php';
  /* Pegar a URL atual */
  if (strpos($_SERVER['REQUEST_URI'], '?') !== false) {
    $url = "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
  }
  else {
    $url = "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}?";
  }
    $escaped_url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
  /* Query */
  if (empty($_GET)) {
    $query = json_decode('{}');
  }
  else {
    $query = array();
    foreach ($_GET as $key=>$value) {
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
    /* Function to generate facets */
    function generateFacet($url, $c, $query, $facet_name, $sort_name, $sort_value, $facet_display_name, $limit)
    {
        $aggregate_facet = array(
        array(
          '$match'=>$query
        ),
        array(
          '$unwind' => $facet_name,
        ),
        array(
          '$group' => array(
            '_id' => $facet_name,
            'count' => array('$sum' => 1),
            ),
        ),
        array(
          '$sort' => array($sort_name => $sort_value),
        ),
      );
        $facet = $c->aggregate($aggregate_facet);

        echo '<div class="item">';
        echo '<a class="active title"><i class="dropdown icon"></i>'.$facet_display_name.'</a>';
        echo '<div class="content">';
        echo '<div class="ui list">';
        $i = 0;
        foreach ($facet['result'] as $facets) {
            echo '<div class="item">';
            echo '<a href="'.$url.'&'.substr($facet_name, 1).'='.$facets['_id'].'">'.$facets['_id'].'</a><span> ('.$facets['count'].')</span>';
            echo '</div>';
            if (++$i > $limit) {
                break;
            }
        };
        echo   '</div>
          </div>
      </div>';
    }
?>
</head>
<body>
  <div class="ui two column stackable grid">
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
        generateFacet($url, $c, $query, '$unidadeUSP', 'count', -1, 'Unidade USP', 50);
        generateFacet($url, $c, $query, '$departamento', 'count', -1, 'Departamento', 50);
        generateFacet($url, $c, $query, '$subject', 'count', -1, 'Assuntos', 50);
        generateFacet($url, $c, $query, '$authors', 'count', -1, 'Autores', 50);
        generateFacet($url, $c, $query, '$authorUSP', 'count', -1, 'Autores USP', 50);
        generateFacet($url, $c, $query, '$ispartof', 'count', -1, 'É parte de', 50);
        generateFacet($url, $c, $query, '$issn_part', 'count', -1, 'ISSN do todo', 50);
        generateFacet($url, $c, $query, '$year', "_id", -1, 'Ano de publicação', 50);
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
        <a href="result.php?ispartof=<?php echo $r["ispartof"];?>"><?php echo $r["ispartof"];?></a> |
        <?php endif; ?>
        <a href="result.php?type=<?php echo $r['type'];?>"><?php echo $r['type'];?></a>
      </h4>
    </div>
    <div class="content">
      <a class="header"><?php echo $r['title'];?> (<?php echo $r["year"]; ?>)</a>
    <!--List authors -->
    <div class="extra">
    <?php if (!empty($r['authors'])): ?>
      <?php foreach ($r['authors'] as $autores): ?>
        <div class="ui label" style="color:black;"><i class="user icon"></i><a href="result.php?authors=<?php echo $autores;?>"><?php echo $autores;?></a></div>
      <?php endforeach;?>
    <?php endif; ?>
  </div>
  <div class="extra">
    <?php if (!empty($r["subject"])): ?>
      <?php foreach ($r["subject"] as $assunto): ?>
        <div class="ui label" style="color:black;"><i class="globe icon"></i><a href="result.php?subject=<?php echo $assunto;?>"><?php echo $assunto;?></a></div>
      <?php endforeach;?>
    <?php endif; ?>
  <!--
  <a href="< ?php echo $r["url_principal"];?>">
  <div class="ui right floated primary button">
    Acesso online
    <i class="right chevron icon"></i>
  </div></a>
  -->
  </div>
  </div>
  </div>
<?php endforeach;?>
</div>
<script>
$('.ui.accordion')
  .accordion()
;
</script>
</body>
</html>
