<?php
  include ('inc/config.php');
  include ('inc/header.php');
  /* Pegar a URL atual */
    $url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
  /* Pagination variables */
    $page  = isset($_POST['page']) ? (int) $_POST['page'] : 1;
    $limit = 15;
    $skip  = ($page - 1) * $limit;
    $next  = ($page + 1);
    $prev  = ($page - 1);
    $sort  = array('facebook_url_total' => -1);
  /* Consultas */
    $cursor = $c->find()->skip($skip)->limit($limit)->sort($sort);
    $total= $cursor->count();
?>
</head>
<body>
  <div class="ui two column stackable grid">
    <div class="four wide column">
    </div>
  </div>
  <div class="ten wide column">
    <div class="page-header"><h3>Resultado da busca <small><?php print_r($total);?></small></h3></div>

  <?php
  /* Pagination - Start */
  echo '<div class="ui buttons">';
  if($page > 1){
    echo '<form method="post" action="'.$escaped_url.'">';
    echo '<input type="hidden" name="extra_submit_param" value="extra_submit_value">';
    echo '<button type="submit" name="page" class="ui labeled icon button active" value="'.$prev.'"><i class="left chevron icon"></i>Anterior</button>';
    if($page * $limit < $total) {
      echo '<button type="submit" name="page" value="'.$next.'" class="ui right labeled icon button active">Próximo<i class="right chevron icon"></i></button>';
    }
    else {
      echo '<button class="ui right labeled icon button disabled">Próximo<i class="right chevron icon"></i></button>';
    }
    echo '</form>';
  } else {
      if($page * $limit < $total) {
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
    <div class="content">
      <?php echo $r["title"];?>
    </div>
  </div>
<?php endforeach;?>
</div>
</body>
</html>
