<?php
$tpTitle="BDPI USP - Biblioteca Digital da Produção Intelectual da Universidade de São Paulo";
?>

<?php
  include 'inc/config.php';
  include 'inc/header.php';
  include_once 'inc/functions.php';
?>


    <div class="ui text container">
      <div class="overlay">
        <div class="ui labeled icon vertical menu">
          <a class="item"><i class="twitter icon"></i> Tweet</a>
          <a class="item"><i class="facebook icon"></i> Share</a>
        </div>
      </div>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed commodo luctus lacus, in laoreet erat pretium sed. Praesent ornare in erat sit amet sollicitudin. Vivamus et quam in lorem iaculis porta a posuere augue. Nam nec lorem pulvinar eros bibendum varius. Duis interdum justo in velit aliquam, vitae auctor nisl placerat. Nullam maximus nisl non ullamcorper gravida. Duis gravida urna non risus ultricies tristique. Maecenas ullamcorper vel justo at tempus. Quisque imperdiet vitae erat ac commodo. Vivamus et interdum risus. Ut vitae mollis tortor, non tincidunt justo. Etiam sollicitudin turpis metus. Sed cursus gravida est non tristique. Duis quis diam et nisi euismod rhoncus.

      Praesent neque dolor, commodo vitae justo vitae, suscipit dignissim velit. Nunc euismod porta enim et dapibus. Pellentesque volutpat justo sed ornare malesuada. Suspendisse porta dolor vitae nunc ornare, in facilisis ligula mattis. In tellus tortor, mollis et augue ut, bibendum dignissim orci. Praesent tincidunt sagittis mollis. Vestibulum dictum magna in accumsan lobortis. In dignissim nulla facilisis odio lobortis dignissim. Suspendisse felis nibh, viverra et pretium a, rutrum sit amet risus. Integer commodo fringilla sem, scelerisque accumsan dolor hendrerit condimentum.</p>

      <div class="ui vertical stripe segment" id="search">
          <h3 class="ui header" >Buscar</h3>
          <form class="ui form" role="form" action="result.php" method="get">
            <div class="ui form">
              <div class="field">
                <label>Número USP</label>
                <input type="text" name="codpesbusca">
              </div>
              <button type="submit" id="s" class="ui large button">Buscar</button>
            </div>
          </form>
      </div>
      <?php
        generateUnidadeUSPInit($c, '$unidadeUSPtrabalhos', '_id', 1, 'Unidade USP', 100, '#');
      ?>

    </div>
    <?php
      include 'inc/footer.php';
    ?>

</body>
</html>
