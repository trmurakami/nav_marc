<?php

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

/* Cria as consultas para o aggregate de Unidade USP*/

function generateUnidadeUSPInit($c, $facet_name, $sort_name, $sort_value, $facet_display_name, $limit, $link)
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
    echo '<div class="ui relaxed horizontal list">
    <div class="ui ten column doubling grid" style="padding:15px;">';
    $i = 0;
    foreach ($facet_init['result'] as $facets) {
        echo '<div class="column"><div class="item">
              <div class="ui fluid image">
                <a href="result.php?'.substr($facet_name, 1).'='.$facets['_id'].'">
                <div id="imagelogo" class="floating ui mini teal label" style="z-index:0;" data-title="'.trim($facets['_id']).'">
                '.$facets['count'].'
                </div>';
                $file = 'inc/images/logosusp/'.$facets['_id'].'.jpg';
                if (file_exists($file)) {
                echo '<img src="inc/images/logosusp/'.$facets['_id'].'.jpg"></a>';
                } else {
                  echo ''.$facets['_id'].'</a>';
              };
              echo'</div></div>
            </div>';
        if (++$i > $limit) {
            break;
        }
    };
    echo '</div></div>';
};




/* Function to generate facets */
function generateFacet($url, $c, $query, $facet_name, $sort_name, $sort_value, $facet_display_name, $limit)
{
    $aggregate_facet = array(
    array(
      '$match' => $query,
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
    $options = array('allowDiskUse' => true);
    $facet = $c->aggregate($aggregate_facet, $options);

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
};


?>
