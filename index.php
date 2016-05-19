<?php
$tpTitle = 'BDPI USP - Biblioteca Digital da Produção Intelectual da Universidade de São Paulo';
?>
<?php
  include 'inc/config.php';
  include 'inc/header.php';
  include_once 'inc/functions.php';
?>
<div class="ui main container">
<div class="ui two column stackable grid">
  <div class="ten wide column">
    <p>Iusdata é uma base de artigos em direito...</p>
    <div class="ui vertical stripe segment" id="search">
      <div class="ui main container">
        <h3 class="ui header">Buscar</h3>
        <form class="ui form" role="form" action="result.php" method="get">
          <div class="inline fields">
            <div class="eight wide field">
              <input name="q" type="text" placeholder="Digite os termos de busca">
            </div>
            <div class="six wide field">
              <select class="ui fluid dropdown" name="category">
                <option value="buscaindice">Título, autores e assuntos</option>
              </select>
              </div>
            <button type="submit" id="s" class="ui large button">Buscar</button>
        </div>
        </form>
        </div>
    </div>
    <?php get_last_records($c,15); ?>
  </div>

  <div class="six wide column">
  <?php
  /* Cria as consultas para o aggregate */

  function generateFacetInitIusdata($c, $facet_name, $sort_name, $sort_value, $facet_display_name, $limit, $link)
  {
      $aggregate_facet_init = array(
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

      $facet_init = $c->aggregate($aggregate_facet_init);

      echo '<h3><a href="'.$link.'">'.$facet_display_name.'</a></h3>';
      echo '<div class="ui horizontal list">';
      $i = 0;
      foreach ($facet_init['result'] as $facets) {
          echo '<div class="item">
          <div class="content">
          <div class="ui labeled button" tabindex="0">
          <div class="header">
            <a href="result.php?'.substr($facet_name, 1).'='.$facets['_id'].'">'.$facets['_id'].'</a>
          </div>
          ('.$facets['count'].')
          </div></div>
          </div>';
          if (++$i > $limit) {
              break;
          }
      };
      echo '</div>';
  };

  generateFacetInitIusdata($c, '$ispartof', 'count', -1, 'Periódicos indexados', 50, '#');
  generateFacetInitIusdata($c, '$year', '_id', -1, 'Ano de publicação', 100, '#');
  generateFacetInitIusdata($c, '$subject', 'count', -1, 'Principais assuntos', 20, '#');


  ?>




  </div>
</div>
</div>
<?php
  include 'inc/footer.php';
?>
<script>
$('.activating.element')
  .popup()
;
</script>
<script>
$(document).ready(function()
{
  $('div#logosusp').attr("style", "z-index:0;");
});
</script>

</body>
</html>
