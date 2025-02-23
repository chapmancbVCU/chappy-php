<?php
namespace Core;
use Carbon\Carbon;
use App\Models\{ProfileImages, Users};
use Symfony\Component\VarDumper\VarDumper;

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
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <?=$key?>
        </a>
        <ul class="dropdown-menu <?=$dropdownClass?>">
            <?php foreach ($val as $k => $v): 
                $active = ($v == $currentPage) ? 'active' : ''; ?>
                <?php if ($k == 'separator'): ?>
                    <li><hr class="dropdown-divider"></li>
                <?php else: ?>
                    <li><a class="dropdown-item <?=$active?>" href="<?=$v?>"><?=$k?></a></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </li>
      <?php else:
        $active = ($val == $currentPage) ? 'active' : ''; ?>
        <li class="nav-item">
            <a class="nav-link <?=$active?>" href="<?=$val?>"><?=$key?></a>
        </li>
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
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    if($with_script_tags) $js_code = '<script>' . $js_code . '</script>';
      echo $js_code;
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


  /**
   * Dumps content but continues execution.
   *
   * @param mixed ...$var Contains the data we wan to print to the page.
   * @return void
   */
  public static function dump(...$vars): void {
    foreach ($vars as $var) {
      VarDumper::dump($var);
    }
  }

  /**
   * Performs var_dump of parameter and kills the page.
   * 
   * @param mixed ...$var Contains the data we wan to print to the page.
   * @return void
   */
  public static function dd(mixed ...$vars): void {
    foreach ($vars as $var) {
      VarDumper::dump($var);
    }
    die(1); // Terminate the script
  }

  /**
   * Returns string in Y-m-d H:i:s using correct timezone.
   *
   * @param string $time String in format Y-m-d H:i:s using UTC.
   * @return void
   */
  public static function formatTime(string $time): string { 
    return Carbon::parse($time, 'UTC')->timezone(TIME_ZONE)->format('Y-m-d H:i:s');  
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
   * Renders Bootstrap 5 pagination controls.
   *
   * @param int    $current_page The current page number.
   * @param int    $total_pages  The total number of pages.
   * @param string $base_url     The base URL for pagination links. Default is '?page='.
   *
   * @return string The HTML markup for the pagination controls.
   */
  public static function pagination($current_page, $total_pages, $base_url = '?page=') {
    $html = '<nav aria-label="Page navigation">';
    $html .= '<ul class="pagination justify-content-center">';

    // Previous Button
    if ($current_page <= 1) {
      $html .= '<li class="page-item disabled">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>';
    } else {
      $html .= '<li class="page-item">
                  <a class="page-link" href="' . $base_url . ($current_page - 1) . '" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>';
    }

    // Page Number Links
    for ($i = 1; $i <= $total_pages; $i++) {
      if ($i == $current_page) {
        $html .= '<li class="page-item active">
                    <a class="page-link" href="' . $base_url . $i . '">' . $i . '</a>
                  </li>';
      } else {
        $html .= '<li class="page-item">
                    <a class="page-link" href="' . $base_url . $i . '">' . $i . '</a>
                  </li>';
      }
    }

    // Next Button
    if ($current_page >= $total_pages) {
      $html .= '<li class="page-item disabled">
                  <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>';
    } else {
      $html .= '<li class="page-item">
                  <a class="page-link" href="' . $base_url . ($current_page + 1) . '" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>';
    }

    $html .= '</ul></nav>';
    return $html;
  }

  /**
   * Accepts UTC time in format Y-m-d H:i:s and returns a string describing  
   * how much time has elapsed.
   *
   * @param string $time String in format Y-m-d H:i:s using UTC
   * @return void
   */
  public static function timeAgo(string $time): string
  {
    return Carbon::parse(new \DateTime($time, new \DateTimeZone('UTC')))->diffForHumans();
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
