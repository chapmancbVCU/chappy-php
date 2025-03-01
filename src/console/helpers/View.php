<?php
namespace Console\Helpers;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
/**
 * Supports ability to create views, layouts, components, and menu_acl 
 * json files.
 */
class View {

    public static function formComponent(string $content, string $method = 'post'): string {
        return '';
    }

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

    public static function makeFormComponent(string $componentContent, string $componentName, string $method): int {
        return Tools::writeFile(
          ROOT.DS.'resources'.DS.'views'.DS.'components'.DS.strtolower($componentName)."_menu.php",
          self::formComponent($componentContent, $method),
          "Menu file"
      );
    }

    /**
     * Generates a new layout file.
     *
     * @param string $layoutName The name of the layout.
     * @param string $menuName The name of the menu to be used.
     * @return int A value that indicates success, invalid, or failure.
     */
    public static function makeLayout(string $layoutName, string $menuName = 'main'): int {
        return Tools::writeFile(
            ROOT.DS.'resources'.DS.'views'.DS.'layouts'.DS.lcfirst($layoutName).".php", 
            self::layout($menuName), 
            'Layout'
        );
    }

    /**
     * Generates a new menu file.
     *
     * @param string $input The name of the menu.
     * @return int A value that indicates success, invalid, or failure.
     */
    public static function makeMenu(string $menuName): int {
        return Tools::writeFile(
            ROOT.DS.'resources'.DS.'views'.DS.'components'.DS.strtolower($menuName)."_menu.php",
            self::menu($menuName),
            "Menu file"
        );
    }

    /**
     * Generates a new menu_acl file.
     *
     * @param string $menuName The name of the menu_acl file.
     * @return int A value that indicates success, invalid, or failure.
     */
    public static function makeMenuAcl(string $menuName): int {
        return Tools::writeFile(
          ROOT.DS.'app'.DS.strtolower($menuName)."_menu_acl.json",
          self::menuAcl($menuName),
          "The menu_acl json"
        );
    }

    /**
     * Returns a string containing contents for a menu.
     *
     * @param string $menuName The name for a new menu.
     * @return string The contents for a new menu.
     */
    public static function menu(string $menuName): string {
        return '<?php
use Core\Router;
use Core\Helper;
$profileImage = Helper::getProfileImage();
$menu = Router::getMenu(\''.lcfirst($menuName).'_menu_acl\');
$userMenu = Router::getMenu(\'user_menu\');
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top mb-5">
  <!-- Brand and toggle get grouped for better mobile display -->
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_menu" aria-controls="main_menu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="<?=APP_DOMAIN?>home"><?=MENU_BRAND?></a>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="main_menu">
    <ul class="navbar-nav me-auto">
      <?= Helper::buildMenuListItems($menu); ?>
    </ul>
    <ul class="navbar-nav me-2">
      <?= Helper::buildMenuListItems($userMenu, "dropdown-menu-end"); ?>
      <a class="pt-1" href="<?=APP_DOMAIN?>profile">
        <?php if ($profileImage != null): ?>
          <img class="img-thumbnail profile-img ms-2 p-0" style="width: 50px" src="<?=APP_DOMAIN . $profileImage->url?>"></img>
        <?php endif; ?>
      </a>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>
';
    }

    /**
     * Returns a string containing contents of a json menu acl file.
     *
     * @param string $menuName The name of the acl file that matches your 
     * menu name
     * @return string The contents of the json menu acl file.
     */
    public static function menuAcl(string $menuName): string {
        return '
{
    "Home" : "home",
    "'.ucfirst($menuName).'" : ""     
}      
';
    }
 }
