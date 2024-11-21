<?php
namespace Core;
use App\Models\{ProfileImages, Users};

/**
 * Helper and utility functions.
 */
class Helper {
  /**
   * Creates list of menu items.
   *
   * @param array $menu The list of menu items containing the name and the 
   * URL path.
   * @param string $dropdownClass The name of the classes that maybe set 
   * depending on user input.
   * @return string|false Returns the contents of the active output buffer on 
   * success or false on failure.
   */
  public static function buildMenuListItems($menu,$dropdownClass=""){
    ob_start();
    $currentPage = self::currentPage();
    foreach($menu as $key => $val):
      $active = '';
      if($key == '%USERNAME%'){
        $key = (Users::currentUser())? "Hello " .Users::currentUser()->fname : $key;
        
      }
      if(is_array($val)): ?>
        <li class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$key?></a>
        <div class="dropdown-menu <?=$dropdownClass?>">
          <?php foreach($val as $k => $v):
          $active = ($v == $currentPage)? 'active':''; ?>
          <?php if($k == 'separator'): ?>
              <div role="separator" class="dropdown-divider"></div>
          <?php else: ?>
              <a class="dropdown-item <?=$active?>" href="<?=$v?>"><?=$k?></a>
          <?php endif; ?>
          <?php endforeach; ?>
        </div>
        </li>
      <?php else:
        $active = ($val == $currentPage)? 'active':''; ?>
        <li class="nav-item"><a class="nav-link <?=$active?>" href="<?=$val?>"><?=$key?></a></li>
      <?php endif; ?>
    <?php endforeach;
    return ob_get_clean();
  }

  /**
   * Prints to console using JavaScript.
   * 
   * @param mixed $output The information we want to print to console.
   * @param bool $with_script_tags - Determines if we will use script tabs in 
   * our output.  Default value is true.
   * @return void
   */
  public static function cl(mixed $output, bool $with_script_tags = true): void {
    if(CONSOLE_LOGGING) {
      $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
      if($with_script_tags) $js_code = '<script>' . $js_code . '</script>';
        echo $js_code;
    }
  }

  /**
   * Determines current page based on REQUEST_URI.
   * 
   * @return string $currentPage  The current page.
   */
  public static function currentPage(): string {
    $currentPage = $_SERVER['REQUEST_URI'];
    if($currentPage == APP_DOMAIN || $currentPage == APP_DOMAIN.'home/index') {
      $currentPage = APP_DOMAIN . 'home';
    }
    return $currentPage;
  }

  public static function diffForHumans($time) {
    Helper::cl($time);
    Helper::cl(TIME_ZONE);
    $dt = new \DateTime($time, new \DateTimeZone(TIME_ZONE)); 
    Helper::cl($dt->format('F jS, Y h:i:s'));
    return $dt->format('F jS, Y h:i:s');  
  }

  /**
   * Performs var_dump of parameter and kills the page.
   * 
   * @param mixed $data Contains the data we wan to print to the page.
   * @return void
   */
  public static function dnd(mixed $data): void {
    echo "<pre>";
    var_dump($data);
    echo "<pre>";
    die();
  }

  /**
   * Gets the properties of the given object
   *
   * @param object $object An object instance.
   * @return array An associative array of defined object accessible 
   * non-static properties for the specified object in scope. If a property 
   * have not been assigned a value, it will be returned with a null value.
   */
  public static function getObjectProperties(object $object): array {
    return get_object_vars($object);
  }

  /**
   * Retrieves URL user's current profile image.
   * 
   * @return bool|array The associative array for the profile image's 
   * record.
   */
  public static function getProfileImage() {
    $user = Users::currentUser();
    if($user) {
      return ProfileImages::findCurrentProfileImage($user->id);
    }
  }

  /**
   * Generates a timestamp.
   *
   * @return string A timestamp in the format Y-m-d H:i:s UTC time.
   */
  public static function timeStamps() {
    $dt = new \DateTime("now", new \DateTimeZone("UTC"));
    return $dt->format('Y-m-d H:i:s');
  }
}
