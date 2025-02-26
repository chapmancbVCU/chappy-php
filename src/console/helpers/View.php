<?php
namespace Console\Helpers;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
/**
 * 
 */
class View {

    /**
     * Returns a string containing contents for a layout.
     *
     * @param string $layoutName The name of the layout.
     * @return string The contents of the layout.
     */
    public static function layout(string $layoutName): string {
        return '<?php use Core\Session; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?=$this->siteTitle()?></title>
    <link rel="icon" href="<?=APP_DOMAIN?>public/noun-mvc-5340614.png">
    <?php if ($_ENV[\'APP_ENV\'] === \'local\'): ?>
        <script type="module" src="http://localhost:5173/@vite/client"></script>
        <script type="module" src="<?= vite(\'resources/js/app.js\') ?>"></script>
    <?php else: ?>
      <!-- Production: Include compiled assets -->
      <link rel="stylesheet" href="<?= vite(\'resources/css/app.css\') ?>">
      <script type="module" src="<?= vite(\'resources/js/app.js\') ?>"></script>
    <?php endif; ?>
    <link rel="stylesheet" href="<?=APP_DOMAIN?>node_modules/bootstrap/dist/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="<?=APP_DOMAIN?>resources/css/alerts/alertMsg.min.css?v=<?=VERSION?>" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="<?=APP_DOMAIN?>resources/css/font-awesome-4.7.0/font-awesome.min.css" media="screen" title="no title" charset="utf-8">
    <script src="<?=APP_DOMAIN?>resources/js/jQuery-3.7.1/jQuery-3.7.1.min.js"></script>
    <script src="<?=APP_DOMAIN?>node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="<?=APP_DOMAIN?>node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?=APP_DOMAIN?>resources/js/alerts/alertMsg.min.js?v=<?=VERSION?>"></script>
    <?= $this->content(\'head\'); ?>

  </head>
  <body class="d-flex flex-column min-vh-100">
    <?php $this->component(\''.lcfirst($layoutName).'_menu\') ?>
    <div class="container-fluid" style="min-height:calc(100% - 125px);">
      <?= Session::displayMessage() ?>
      <?= $this->content(\'body\'); ?>
    </div>
  </body>
</html>        
';
    }        

    /**
     * Generates a new layout file.
     *
     * @param InputInterface $input The name of the layout.
     * @return int A value that indicates success, invalid, or failure.
     */
    public static function makeLayout(InputInterface $input): int {
        $layoutName = $input->getArgument('layout-name');
        if (php_sapi_name() != 'cli') die('Restricted');

        // Generate layout
        return Tools::writeFile(
            ROOT.DS.'resources'.DS.'views'.DS.'layouts'.DS.lcfirst($layoutName).".php", 
            self::layout($layoutName), 
            'Layout'
        );
    }
}
