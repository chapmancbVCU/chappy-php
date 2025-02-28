<h1 style="font-size: 50px; text-align: center;">Layouts</h1>

## Table of contents
1. [Overview](#overview)
2. [Layouts](#layouts)
3. [Building Your Own Layout](#build-layout)

## Overview <a id="overview"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
The layouts feature supports the ability to present a consistent user experience across views in the framework.  We natively support Bootstrap 5 for the styling.  You can build your own layouts using a different framework such as Tailwind CSS.  We have not tested Tailwind CSS but this Laravel 11 Crash Course [video](https://www.youtube.com/watch?v=R00eTP8BiVI&list=PL38wFHH4qYZXH8Gb7PIbmyjdsWdEJLImp&index=3) might point you in the right direction.

Layouts are supported by layout files that are located at ```resources\views\layouts```, menus that can be found at ```resources\views\components```, and menu_acl json files within the ```app``` directory.

## Layouts <a id="layouts"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Let's look at the default layout.

```php
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
    <link rel="icon" href="<?=APP_DOMAIN?>public/noun-mvc-5340614.png">
    <?php if ($_ENV['APP_ENV'] === 'local'): ?>
        <script type="module" src="http://localhost:5173/@vite/client"></script>
        <script type="module" src="<?= vite('resources/js/app.js') ?>"></script>
    <?php else: ?>
      <!-- Production: Include compiled assets -->
      <link rel="stylesheet" href="<?= vite('resources/css/app.css') ?>">
      <script type="module" src="<?= vite('resources/js/app.js') ?>"></script>
    <?php endif; ?>
    <link rel="stylesheet" href="<?=APP_DOMAIN?>node_modules/bootstrap/dist/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="<?=APP_DOMAIN?>resources/css/alerts/alertMsg.min.css?v=<?=VERSION?>" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="<?=APP_DOMAIN?>resources/css/font-awesome-4.7.0/font-awesome.min.css" media="screen" title="no title" charset="utf-8">
    <script src="<?=APP_DOMAIN?>resources/js/jQuery-3.7.1/jQuery-3.7.1.min.js"></script>
    <script src="<?=APP_DOMAIN?>node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="<?=APP_DOMAIN?>node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?=APP_DOMAIN?>resources/js/alerts/alertMsg.min.js?v=<?=VERSION?>"></script>
    <?= $this->content('head'); ?>

  </head>
  <body class="d-flex flex-column min-vh-100">
    <?php $this->component('main_menu') ?>
    <div class="container-fluid" style="min-height:calc(100% - 125px);">
      <?= Session::displayMessage() ?>
      <?= $this->content('body'); ?>
    </div>
    <?php //$this->component(footer.php'); ?>
    
  </body>
</html>
```

Within the ```head``` element the first thing after the required meta tags you will see a call to the siteTitle() function.  This sets the title of the current page on a browser tab.  

The if statement that is in this section is where Vite is used for asset bundling.  During development, when you save a view file, any changes are automatically presented to the user without have to refresh the page.

The last function call, ```$this->content('head)```  is where additional information for ```head``` element is injected into your view.  More information about the ```content``` function can be found in the [View](view) page.

The ```body``` element contains a call to the ```component``` function for rendering menus.  For the admin layout we use the ```admin_menu``` instead and the framework is smart enough to display this menu for pages that uses the admin layout.

The next function call displays session or sometimes called flash messages depending on the framework.  Finally, we have a call to the content function for displaying ```body``` content.

## Building Your Own Layout <a id="build-layout"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>