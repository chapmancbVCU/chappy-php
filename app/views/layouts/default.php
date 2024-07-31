<?php 
use Core\Session;
use Core\FormHelper;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?=$this->siteTitle()?></title>
    <link rel="icon" href="<?=PROOT?>public/images/favicon/noun-mvc-5340614.png">
    <link rel="stylesheet" href="<?=PROOT?>public/css/bootstrap-4.6.2/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="<?=PROOT?>public/css/styles.css?v=<?=VERSION?>" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="<?=PROOT?>public/css/alerts/alertMsg.min.css?v=<?=VERSION?>" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="<?=PROOT?>public/css/font-awesome-4.7.0/font-awesome.min.css" media="screen" title="no title" charset="utf-8">

    <?= $this->content('head'); ?>

  </head>
  <body class="d-flex flex-column min-vh-100">
    <?php include 'main_menu.php' ?>
    <div class="container-fluid" style="min-height:cal(100% - 125px);">
      <?= Session::displayMessage() ?>
      <?= $this->content('body'); ?>
    </div>
    <?php include 'footer.php'; ?>
    <script src="<?=PROOT?>public/js/jQuery-3.7.1/jQuery-3.7.1.min.js"></script>
    <script src="<?=PROOT?>public/js/alerts/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="<?=PROOT?>public/js/bootstrap-4.6.2/bootstrap.min.js"></script>
    <script src="<?=PROOT?>public/js/alerts/alertMsg.min.js?v=<?=VERSION?>"></script>
  </body>
</html>