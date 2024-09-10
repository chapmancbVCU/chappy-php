<?php
  use Core\Router;
  use Core\Helper;
  $profileImage = Helper::getProfileImage();
  $menu = Router::getMenu('admin_menu_acl');
  $userMenu = Router::getMenu('user_menu');
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top mb-5">
  <!-- Brand and toggle get grouped for better mobile display -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_menu" aria-controls="main_menu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="<?=APP_DOMAIN?>home"><?=MENU_BRAND?></a>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="main_menu">
    <ul class="navbar-nav mr-auto">
      <?= Helper::buildMenuListItems($menu); ?>
    </ul>
    <ul class="navbar-nav mr-2">
      <?= Helper::buildMenuListItems($userMenu,"dropdown-menu-right"); ?>
      <a class="pt-1" href="<?=APP_DOMAIN?>profile">
        <?php if($profileImage != null): ?>
          <img class="img-thumbnail profile-img ml-2 p-0"  style="width: 50px" src="<?=APP_DOMAIN.$profileImage->url?>"></img>
        <?php endif; ?>
      </a>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>