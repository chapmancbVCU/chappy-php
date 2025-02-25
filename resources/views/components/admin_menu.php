<?php
use Core\Router;
use Core\Helper;
$profileImage = Helper::getProfileImage();
$menu = Router::getMenu('admin_menu_acl');
$userMenu = Router::getMenu('user_menu');
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
      <a href="<?=APP_DOMAIN?>api-docs/index.html" target="_blank" class="nav-link">API</a>
      <a href="https://chapmancbvcu.github.io/chappy-php/" target="_blank" class="nav-link">Wiki</a>
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