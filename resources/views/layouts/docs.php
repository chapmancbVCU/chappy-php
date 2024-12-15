<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?=$this->siteTitle()?></title>
    <link rel="icon" href="<?=APP_DOMAIN?>public/noun-mvc-5340614.png">
    <?php if ($_ENV['APP_ENV'] === 'local'): ?>
        <script type="module" src="http://localhost:5173/@vite/client"></script>
        <script type="module" src="<?= vite('resources/js/app.js') ?>"></script>
    <?php else: ?>
        <!-- Production: Include compiled assets -->
        <link rel="stylesheet" href="<?= vite('resources/css/app.css') ?>">
        <script type="module" src="<?= vite('resources/js/app.js') ?>"></script>
    <?php endif; ?>
    <link rel="stylesheet" href="<?=APP_DOMAIN?>resources/css/bootstrap-4.6.2/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="<?=APP_DOMAIN?>resources/css/prism.css" media="screen" title="no title" charset="utf-8">
    <script src="<?=APP_DOMAIN?>resources/js/jQuery-3.7.1/jQuery-3.7.1.min.js"></script>
    <script src="<?=APP_DOMAIN?>resources/js/bootstrap-4.6.2/bootstrap.min.js"></script>
    <script src="<?=APP_DOMAIN?>resources/js/prism.js"></script>
    <?= $this->content('head'); ?>

  </head>
  <body class="d-flex flex-column min-vh-100">
    <?php include 'main_menu.php' ?>
    <div class="container-fluid" style="min-height:cal(100% - 125px);">
      <?php include(ROOT . DS . 'resources' . DS . 'views' . DS . 'layouts' . DS . 'docs_nav.php'); ?>
      <?= $this->content('body'); ?>
    </div>
    <script src="<?=APP_DOMAIN?>resources/js/docNavDropdown.js"></script>
  </body>
</html>