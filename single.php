<?php
  $tpTitle="BDPI USP - Detalhes do registro";

  include 'inc/config.php';
  include 'inc/header.php';

  #Consultas
  $query = json_decode('[{"$match":{"_id":"'.$_GET["_id"].'"}},{"$lookup":{"from": "producao_bdpi", "localField": "_id", "foreignField": "_id", "as": "files"}}]');
  $cursor = $c->aggregate($query);
?>
</head>
<body>
<div class="ui container">
  <div class="ui main two column stackable grid">
    <div class="four wide column">
      <h3>Exportar</h3>
    </div>
    <div class="ten wide column">
      <h2 class="ui center aligned icon header">
        <i class="circular file icon"></i>
        Detalhes do registro / <?php echo ''.$cursor["result"][0]["type"].''; ?>
      </h2>
      <div class="ui top attached tabular menu">
        <a class="item active" data-tab="first">Visualização</a>
        <a class="item" data-tab="second">Registro Completo</a>
      </div>
      <div class="ui bottom attached tab segment active" data-tab="first">
        <h2><?php echo $cursor["result"][0]['title'];?> (<?php echo $cursor["result"][0]['year']; ?>)</h2>
        <!--List authors -->
        <div class="ui middle aligned selection list">
          <?php if (!empty($cursor["result"][0]['authors'])): ?>
            <h4>Autor(es):</h4>
            <?php foreach ($cursor["result"][0]['authors'] as $autores): ?>
              <div class="item">
                <i class="user icon"></i>
                <div class="content">
                  <a href="result.php?autor=<?php echo $autores;?>"><?php echo $autores;?></a>
                  </div>
                </div>
            <?php endforeach;?>
          <?php endif; ?>
        </div>
      </div>
      <div class="ui bottom attached tab segment" data-tab="second">
        Second
      </div>
    </div>
  </div>
</div>
<?php
  include 'inc/footer.php';
?>
<script>
$('.menu .item')
  .tab()
;
</script>
</body>
</html>
