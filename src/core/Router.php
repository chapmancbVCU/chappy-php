<?php
namespace Core;
use Exception;
use Core\Session;
use App\Models\Users;
use Core\Lib\Utilities\Env;
use Core\Lib\Logging\Logger;
use Core\Lib\Utilities\Arr;

/**
 * This class is responsible for routing between views.
 */
class Router {
    /**
     * Gets link based on value from acl.
     * 
     * @param string $value item in acl that will be used to create a 
     * link.  
     * @return bool|string False if the user does not have access to a 
     * controller or action.  Otherwise we return the value so we can create 
     * a link.
     */
    private static function get_link(string $value) {
        // Check if external link just return it.
        if(preg_match('/https?:\/\//', $value) == 1) {
            return $value;
        } else {
            $uArray = explode('/', $value);
            $controller_name = ucwords($uArray[0]);
            $action_name = (isset($uArray[1])) ? $uArray[1] : '';

            // Build link item only if the user has access.
            if(self::hasAccess($controller_name, $action_name)) {
                return Env::get('APP_DOMAIN', '/') . $value;
            } 
            return false;
        }
    }

    /**
     * Parses menu_acl.json file to determine menu contents depending on acl 
     * of user.
     * 
     * @param string $menu Name of menu acl file.
     * @return array The array of menu items.
     */
    public static function getMenu(string $menu): array {
        $menuArray = [];
        $menuFile = file_get_contents(ROOT . DS . 'app' . DS . $menu . '.json');
        $acl = json_decode($menuFile, true);
        
        foreach($acl as $key => $value) {
            // If array we will know if there is a dropdown or something else.
            if(is_array($value)) {
                $subMenu = [];
                foreach($value as $k => $v) {
                    /* Check if item is a separator and continue.  Don't what 
                     * to add separator as a link. */
                    if($k == 'separator' && !empty($subMenu)) {
                        $subMenu[$k] = '';
                        continue;
                    } else if($finalValue = self::get_link($v)) {
                        $subMenu[$k] = $finalValue;
                    }
                }
                if(!empty($subMenu)) {
                    $menuArray[$key] = $subMenu;
                }
            } else {
                if($finalValue = self::get_link($value)) {
                    $menuArray[$key] = $finalValue;
                }
            }
        }
        return $menuArray;
    }

    /**
     * Checks if user has access to a particular section of the site
     * and grants access if that is the case.
     * 
     * @param string $controller_name The name of the controller we want to 
     * test before granting the user access to a particular section of the 
     * site.
     * @param string $action_name The name of the action the user wants to 
     * perform.  The default value is "index".
     * @return bool $grantAccess True if we give access, otherwise false.
     */
    public static function hasAccess(string $controller_name, string $action_name = "index") {
        $acl_file = file_get_contents(ROOT . DS . 'app' . DS . 'acl.json');
        $acl = json_decode($acl_file, true) ?? [];
        $current_user_acls = ["Guest"];
        $grantAccess = false;

        // Bug here after migrate:refresh and cookie still exists.
        if(Session::exists(Env::get('CURRENT_USER_SESSION_NAME'))) {
            $current_user_acls[] = "LoggedIn";
            $currentUser = Users::currentUser();

            /**
             * Checks if session exists.  If app is loaded after a 
             * migrate:refresh and cookie still exists then cookie gets deleted.
             */
            if ($currentUser) { 
                foreach($currentUser->acls() as $userAcl) {
                    $current_user_acls[] = $userAcl;
                }
            } else {
                Session::delete(Env::get('CURRENT_USER_SESSION_NAME'));
            }
        }

        // Check access information.
        foreach ($current_user_acls as $level) {
            if (Arr::has($acl, "$level.$controller_name") &&
                (in_array($action_name, Arr::get($acl, "$level.$controller_name", [])) || 
                in_array("*", Arr::get($acl, "$level.$controller_name", [])))) {
                $grantAccess = true;
                break;
            }
        }

        // Check for denied.
        foreach ($current_user_acls as $level) {
            if (Arr::has($acl, "$level.denied.$controller_name") &&
                in_array($action_name, Arr::get($acl, "$level.denied.$controller_name", []))) {
                $grantAccess = false;
            }
        }

        return $grantAccess;
    }

    /**
     * Performs redirect operations.
     * 
     * @param string $location The view where we will redirect the user.
     * @return void
     */
    public static function redirect(string $location): void {
        if(!headers_sent()) {
            header('Location: '.Env::get('APP_DOMAIN', '/').$location);
            exit();
        } else {
            echo '<script type="text/javascript">';;
            echo 'window.location.href="'.Env::get('APP_DOMAIN', '/').$location.'";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url='.$location.'" />';
            echo '</noscript>';
            exit;
        }
    }

    /**
     * Supports operations for routing.  It parses the url to determine which 
     * page needs to be rendered.  That path is parsed to determine 
     * the correct controller and action to use.
     * 
     * @param array $url The path that contains information about the 
     * controller and action to use.
     * @param string $requestPath The original URL retrieved from the 
     * $_SERVER['PATH_INFO] $_SERVER['REQUEST_URI] elements in the 
     * global $_SERVER array.
     * @return void
     */
    public static function route(): void {   
        // Parse URLs
        $requestPath = Arr::exists($_SERVER, 'PATH_INFO') ? $_SERVER['PATH_INFO'] : $_SERVER['REQUEST_URI'];
        $url = isset($requestPath) ? explode('/', ltrim($requestPath, '/')) : [];
        
        try {
            // Log requests sent to server
            $userId = Session::exists(Env::get('CURRENT_USER_SESSION_NAME')) ? Session::get(Env::get('CURRENT_USER_SESSION_NAME')) : 'Guest';
            Logger::log("Incoming Request: Method: ".$_SERVER['REQUEST_METHOD']." | URL: $requestPath | IP: ".$_SERVER['REMOTE_ADDR']." | User: $userId", 'info');
            
            // Extract from URL our controllers
            $controller = (isset($url[0]) && $url[0] != '') ? ucwords($url[0]).'Controller' : Env::get('DEFAULT_CONTROLLER', 'Home').'Controller';
            $controller_name = str_replace('Controller', '', $controller);
            array_shift($url);
    
            // action - now first element of array.
            $action = (isset($url[0]) && $url[0] != '') ? $url[0] . 'Action' : 'indexAction';
            $action_name = (isset($url[0]) && $url[0] != '') ? $url[0] : 'index';
            array_shift($url);
    
            // ACL check
            $grantAccess = self::hasAccess($controller_name, $action_name);
            if(!$grantAccess) {
                $accessRestricted = Env::get('ACCESS_RESTRICTED', 'Restricted');
                Logger::log("Access Denied: User '$userId' attempted to use a controller that does not exists or access a restricted area '$controller_name/$action_name'", 'warning');
                $controller = $accessRestricted.'Controller';
                $controller_name = $accessRestricted;
                $action = 'indexAction';
            }
    
            // Params - any params will now be passed into our action.
            $queryParams = $url;
            $controller = 'App\Controllers\\' . $controller;

            // Use to pass in controller name and action
            $dispatch = new $controller($controller_name, $action);
            
            if(method_exists($controller, $action)) {
                /* Call method on dispatch object.  Our method is the action being called.
                 * $queryParams support ability to add parameters to our actions. */
                call_user_func_array([$dispatch, $action], $queryParams);
            } else {
                throw new Exception("Method '$action_name' does not exist in the controller '$controller_name'.");
            }
        } catch (Exception $e) {
            Logger::log("Unhandled Exception in Router: " . $e->getMessage(), 'error');
            throw $e;
        }  
    }
}