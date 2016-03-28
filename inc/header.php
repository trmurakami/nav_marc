<!DOCTYPE html>
<html lang="pt_BR">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8"></meta>
  <meta name="viewport" content="width=device-width, initial-scale=1"></meta>
  <!-- CSS - MetaSearch -->
  <link rel="stylesheet" href="inc/css/style.css" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="inc/semantic-ui/semantic.min.css">
<script src="inc/semantic-ui/semantic.min.js"></script>
<meta property="og:url"           content="" /></meta>
<meta property="og:type"          content="website" /></meta>
<meta property="og:title"         content="<?php echo $tpTitle ?>" /></meta>
<meta property="og:description"   content="" /></meta>
<meta property="og:image"         content="" /></meta>
<link type="image/x-icon" href="inc/images/faviconUSP.ico" rel="icon" />
<link type="image/x-icon" href="inc/images/faviconUSP.ico" rel="shortcut icon" />

<title><?php echo $tpTitle ?></title>

<script>
  $(document)
    .ready(function() {

      // fix main menu to page on passing
      $('.main.menu').visibility({
        type: 'fixed'
      });
      $('.overlay').visibility({
        type: 'fixed',
        offset: 80
      });

      // lazy load images
      $('.image').visibility({
        type: 'image',
        transition: 'vertical flip in',
        duration: 500
      });

      // show dropdown on hover
      $('.main.menu  .ui.dropdown').dropdown({
        on: 'hover'
      });
    })
  ;
  </script>

  <style type="text/css">

  body {
    background-color: #FFFFFF;
  }
  .main.container {
    margin-top: 2em;
  }

  .main.menu {
    margin-top: 4em;
    border-radius: 0;
    border: none;
    box-shadow: none;
    transition:
      box-shadow 0.5s ease,
      padding 0.5s ease
    ;
  }
  .main.menu .item img.logo {
    margin-right: 1.5em;
  }

  .overlay {
    float: left;
    margin: 0em 3em 1em 0em;
  }
  .overlay .menu {
    position: relative;
    left: 0;
    transition: left 0.5s ease;
  }

  .main.menu.fixed {
    background-color: #FFFFFF;
    border: 1px solid #DDD;
    box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2);
  }
  .overlay.fixed .menu {
    left: 800px;
  }

  .text.container .left.floated.image {
    margin: 2em 2em 2em -4em;
  }
  .text.container .right.floated.image {
    margin: 2em -4em 2em 2em;
  }

  .ui.footer.segment {
    margin: 5em 0em 0em;
    padding: 5em 0em;
  }
  </style>

</head>
<body>

  <div class="ui main container">
      <h1 class="ui header"><a href="index.php">BDPI USP</a></h1>
      <p>Biblioteca Digital da Produção Intelectual da Universidade de São Paulo</p>
    </div>


    <div class="ui borderless main menu">
      <div class="ui container">
        <div href="#" class="header item">
          <a href="index.php" class="item">BDPI USP</a>
        </div>
        <a href="#" class="item">Blog</a>
        <a href="#" class="item">Articles</a>
        <a href="#" class="ui right floated dropdown item">
          Dropdown <i class="dropdown icon"></i>
          <div class="menu">
            <div class="item">Link Item</div>
            <div class="item">Link Item</div>
            <div class="divider"></div>
            <div class="header">Header Item</div>
            <div class="item">
              <i class="dropdown icon"></i>
              Sub Menu
              <div class="menu">
                <div class="item">Link Item</div>
                <div class="item">Link Item</div>
              </div>
            </div>
            <div class="item">Link Item</div>
          </div>
        </a>
      </div>
    </div>
