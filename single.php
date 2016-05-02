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
        <!--Unidades USP -->
        <div class="ui middle aligned selection list">
          <?php if (!empty($cursor["result"][0]['unidadeUSP'])): ?>
            <h4>Unidades USP:</h4>
            <?php foreach ($cursor["result"][0]['unidadeUSP'] as $unidadeUSP): ?>
              <div class="item">
                <i class="user icon"></i>
                <div class="content">
                  <a href="result.php?unidadeUSP=<?php echo $unidadeUSP;?>"><?php echo $unidadeUSP;?></a>
                  </div>
                </div>
            <?php endforeach;?>
          <?php endif; ?>
        </div>
        <!--Assuntos -->
        <div class="ui middle aligned selection list">
          <?php if (!empty($cursor["result"][0]['subject'])): ?>
            <h4>Assuntos:</h4>
            <?php foreach ($cursor["result"][0]['subject'] as $subject): ?>
              <div class="item">
                <i class="user icon"></i>
                <div class="content">
                  <a href="result.php?subject=<?php echo $subject;?>"><?php echo $subject;?></a>
                  </div>
                </div>
            <?php endforeach;?>
          <?php endif; ?>
        </div>
      </div>
      <div class="ui bottom attached tab segment" data-tab="second">
        <table class="ui celled table">
          <thead>
            <tr>
              <th>Campo</th>
              <th>Indicador 1</th>
              <th>Indicador 2</th>
              <th>Sub-Campo</th>
              <th>Conteúdo</th>
            </tr>
          </thead>
        <tbody>
        <?php foreach ($cursor["result"][0]["record"] as $fields){
          echo '<tr>';
          echo '<td>'.$fields[0].'';
          echo '<td>'.$fields[1].'';
          echo '<td>'.$fields[2].'';
          echo '<td>'.$fields[3].'';
          echo '<td>'.$fields[4].'';
          echo '</tr>';
          if (!empty($fields[5])){
            echo '<tr>';
            echo '<td>'.$fields[0].'';
            echo '<td>'.$fields[1].'';
            echo '<td>'.$fields[2].'';
            echo '<td>'.$fields[5].'';
            echo '<td>'.$fields[6].'';
            echo '</tr>';
          }
          if (!empty($fields[7])){
            echo '<tr>';
            echo '<td>'.$fields[0].'';
            echo '<td>'.$fields[1].'';
            echo '<td>'.$fields[2].'';
            echo '<td>'.$fields[7].'';
            echo '<td>'.$fields[8].'';
            echo '</tr>';
          }
          if (!empty($fields[9])){
            echo '<tr>';
            echo '<td>'.$fields[0].'';
            echo '<td>'.$fields[1].'';
            echo '<td>'.$fields[2].'';
            echo '<td>'.$fields[9].'';
            echo '<td>'.$fields[10].'';
            echo '</tr>';
          }
        if (!empty($fields[11])){
          echo '<tr>';
          echo '<td>'.$fields[0].'';
          echo '<td>'.$fields[1].'';
          echo '<td>'.$fields[2].'';
          echo '<td>'.$fields[11].'';
          echo '<td>'.$fields[12].'';
          echo '</tr>';
        }
        if (!empty($fields[13])){
          echo '<tr>';
          echo '<td>'.$fields[0].'';
          echo '<td>'.$fields[1].'';
          echo '<td>'.$fields[2].'';
          echo '<td>'.$fields[13].'';
          echo '<td>'.$fields[14].'';
          echo '</tr>';
        }
        if (!empty($fields[15])){
          echo '<tr>';
          echo '<td>'.$fields[0].'';
          echo '<td>'.$fields[1].'';
          echo '<td>'.$fields[2].'';
          echo '<td>'.$fields[15].'';
          echo '<td>'.$fields[16].'';
          echo '</tr>';
        }
        if (!empty($fields[17])){
          echo '<tr>';
          echo '<td>'.$fields[0].'';
          echo '<td>'.$fields[1].'';
          echo '<td>'.$fields[2].'';
          echo '<td>'.$fields[17].'';
          echo '<td>'.$fields[18].'';
          echo '</tr>';
        }
        if (!empty($fields[19])){
          echo '<tr>';
          echo '<td>'.$fields[0].'';
          echo '<td>'.$fields[1].'';
          echo '<td>'.$fields[2].'';
          echo '<td>'.$fields[19].'';
          echo '<td>'.$fields[20].'';
          echo '</tr>';
        }
        if (!empty($fields[21])){
          echo '<tr>';
          echo '<td>'.$fields[0].'';
          echo '<td>'.$fields[1].'';
          echo '<td>'.$fields[2].'';
          echo '<td>'.$fields[21].'';
          echo '<td>'.$fields[22].'';
          echo '</tr>';
        }
        if (!empty($fields[23])){
          echo '<tr>';
          echo '<td>'.$fields[0].'';
          echo '<td>'.$fields[1].'';
          echo '<td>'.$fields[2].'';
          echo '<td>'.$fields[23].'';
          echo '<td>'.$fields[24].'';
          echo '</tr>';
        }
        if (!empty($fields[25])){
          echo '<tr>';
          echo '<td>'.$fields[0].'';
          echo '<td>'.$fields[1].'';
          echo '<td>'.$fields[2].'';
          echo '<td>'.$fields[25].'';
          echo '<td>'.$fields[26].'';
          echo '</tr>';
        }
      };
        ?>
        </tbody>
      </table>
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
