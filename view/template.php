<DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />

  <title>BloomComics - <?=$page;?></title>

    <link rel="stylesheet" href='view/style/css/body.css'>
    <link rel="stylesheet" href='view/style/css/header.css'>
    <link rel="stylesheet" href='view/style/css/form.css'>
</head>
<body>
  <div class="header">
    <div class="menu">

    <?php
      require 'component/menu.php';
      echo write_menu($menu);
    ?>

    </div>
  </div>
  <div class="content">
  <?=$content;?>
  </div>
</body>
</html>
