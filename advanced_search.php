<?php
$tpTitle="BDPI USP - Busca avançada";
?>

<?php
  include 'inc/config.php';
  include 'inc/header.php';
  include_once 'inc/functions.php';
?>


    <div class="ui text container">
        <div class="ui vertical stripe segment" id="search">
          <h3 class="ui header" >Buscar</h3>
          <form class="ui form" role="form" action="result.php" method="get">
            <div class="inline fields">
              <div class="ui form">
                <div class="field">
                  <label>Número USP</label>
                  <input type="text" name="codpesbusca">
                </div>
              </div>
                <button type="submit" id="s" class="ui large button">Buscar</button>
              </div>
          </form>
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
