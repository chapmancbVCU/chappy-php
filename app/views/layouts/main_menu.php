<?php
  use Core\Router;
  use Core\Helper;
  use App\Models\Users;
  $menu = Router::getMenu('menu_acl');
  $currentPage = Helper::currentPage();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top mb-5">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_menu" aria-controls="main_menu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="<?=PROOT?>home"><?=MENU_BRAND?></a>
  <div class="collapse navbar-collapse" id="main_menu">
    <ul class="navbar-nav mr-auto">
      <?= Helper::buildMenuListItems($menu); ?>
    </ul>
    <ul class="navbar-nav ml-auto">
      <?php if(Users::currentUser()): ?>
        <li>
          <a class="nav-link" href="<?=PROOT?>profile">Hello <?=Users::currentUser()->fname ?>
            <img class="img-thumbnail ml-2 p-0"  style="width: 50px" src="<?=PROOT?>public/images/profileImage/<?=Users::currentUser()->profileImage?>"></img></a>
          </a>
        </li>
      <?php endif; ?>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>