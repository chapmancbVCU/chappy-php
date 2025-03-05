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
      <a href="https://chapmancbvcu.github.io/chappy-php/" target="_blank" class="nav-link">Wiki</a>
    </ul>
    <ul class="navbar-nav me-2 align-items-center"> <!-- Align items vertically -->
      <?= Helper::buildMenuListItems($userMenu, "dropdown-menu-end"); ?>
      <li class="nav-item">
        <a class="nav-link p-0" href="<?=APP_DOMAIN?>profile">
          <?php if ($profileImage != null): ?>
            <img class="rounded-circle profile-img ms-2"
              style="width: 40px; height: 40px; object-fit: cover; border: 2px solid #ddd; transition: opacity 0.3s;"
              src="<?=APP_DOMAIN . $profileImage->url?>"
              alt="Profile Picture">
          <?php endif; ?>
        </a>
      </li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>