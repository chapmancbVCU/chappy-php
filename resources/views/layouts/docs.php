<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?=$this->siteTitle()?></title>
    <style>
      .sidenav {
        height: 100%;
        width: 250px;
        position: fixed;
        z-index: 1;
        top: 35px;
        left: 0;
        overflow-x: hidden;
        padding-top: 20px;
      }

      /* Style the sidenav links and the dropdown button */
      .sidenav a, .dropdown-btn {
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        font-size: 20px;
        color: #818181;
        display: block;
        border: none;
        width:100%;
        text-align: left;
        cursor: pointer;
        outline: none;
      }
      
      /* Ensure Bootstrap button background is preserved */
      .dropdown-btn {
        background-color: inherit; /* Inherit from Bootstrap */
      }
      
      /* On mouse-over */
      .sidenav a:hover, .dropdown-btn:hover {
        color: #f1f1f1;
        background-color: #495057;
      }
    </style>
    <link rel="icon" href="<?=APP_DOMAIN?>public/noun-mvc-5340614.png">
    <link rel="preload" href="<?=APP_DOMAIN?>node_modules/bootstrap/dist/css/bootstrap.min.css" as="style">
    <link rel="stylesheet" href="<?=APP_DOMAIN?>node_modules/bootstrap/dist/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="preload" href="<?=APP_DOMAIN?>resources/css/prism.css" as="style">
    <link rel="stylesheet" href="<?=APP_DOMAIN?>resources/css/prism.css" media="screen" title="no title" charset="utf-8">
    <script src="<?=APP_DOMAIN?>node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="<?=APP_DOMAIN?>node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?=APP_DOMAIN?>resources/js/prism.js"></script>

    <?php if ($_ENV['APP_ENV'] === 'local'): ?>
        <script type="module" src="http://localhost:5173/@vite/client"></script>
        <script type="module" src="<?= vite('resources/js/app.js') ?>"></script>
    <?php else: ?>
      <!-- Production: Include compiled assets -->
      <link rel="stylesheet" href="<?= vite('resources/css/app.css') ?>">
      <script type="module" src="<?= vite('resources/js/app.js') ?>"></script>
    <?php endif; ?>
    
    <?= $this->content('head'); ?>

  </head>
  <body class="d-flex flex-column min-vh-100">
    <?php $this->component('admin_menu') ?>
    <div class="container-fluid" style="min-height:calc(100% - 125px);">
      <?php $this->component('docs_nav'); ?>
      <?= $this->content('body'); ?>
    </div>
    
  </body>
</html>