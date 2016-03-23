<?php

  include 'inc/config.php';
  include 'inc/header.php';
/* Cria as consultas para o aggregate */

function generateFacetInit($c, $facet_name, $sort_name, $sort_value, $facet_display_name, $limit, $link)
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

generateFacetInit($c, '$unidadeUSP', '_id', 1, 'Unidade USP', 100, '#');
?>
