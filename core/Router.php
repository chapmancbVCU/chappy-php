<?php
namespace Core;
use App\Models\Users;
use Core\Session;

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
    private static function get_link($value) {
        // Check if external link just return it.
        if(preg_match('/https?:\/\//', $value) == 1) {
            return $value;
        } else {
            $uArray = explode('/', $value);
            $controller_name = ucwords($uArray[0]);
            $action_name = (isset($uArray[1])) ? $uArray[1] : '';

            // Build link item only if the user has access.
            if(self::hasAccess($controller_name, $action_name)) {
                return PROOT . $value;
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
    public static function getMenu($menu) {
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
     */
    public static function hasAccess($controller_name, $action_name = "index") {
        $acl_file = file_get_contents(ROOT . DS . 'app' . DS . 'acl.json');
        $acl = json_decode($acl_file, true);
        $current_user_acls = ["Guest"];
        $grantAccess = false;

        if(Session::exists(CURRENT_USER_SESSION_NAME)) {
            $current_user_acls[] = "LoggedIn";
            foreach(Users::currentUser()->acls() as $a) {
                $current_user_acls[] = $a;
            }
        }

        // Check access information.
        foreach($current_user_acls as $level) {
            if(array_key_exists($level, $acl) && array_key_exists($controller_name, $acl[$level])) {
                if(in_array($action_name, $acl[$level][$controller_name]) || in_array("*", $acl[$level][$controller_name])) {
                    $grantAccess = true;
                    break;
                }
            } 
        }

        // Check for denied.
        foreach($current_user_acls as $level) {
            $denied = $acl[$level]['denied'];
            if(!empty($denied) && array_key_exists($controller_name, $denied) && in_array($action_name, $denied[$controller_name])) {
                $grantAccess = false;
            } 
        }

        return $grantAccess;
    }

    /**
     * Performs redirect operations.
     * 
     * @param string $location The view where we will redirect the user.
     */
    public static function redirect($location) {
        if(!headers_sent()) {
            header('Location: '.PROOT.$location);
            exit();
        } else {
            echo '<script type="text/javascript">';;
            echo 'window.location.href="'.PROOT.$location.'";';
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
     * @param string $url The path that contains information about the 
     * controller and action to use.
     * @return void
     */
    public static function route($url) {
        // Extract from URL our controllers
        $controller = (isset($url[0]) && $url[0] != '') ? ucwords($url[0]).'Controller' : DEFAULT_CONTROLLER.'Controller';
        $controller_name = str_replace('Controller', '', $controller);
        array_shift($url);

        // action - now first element of array.
        $action = (isset($url[0]) && $url[0] != '') ? $url[0] . 'Action' : 'indexAction';
        $action_name = (isset($url[0]) && $url[0] != '') ? $url[0] : 'index';
        array_shift($url);

        // ACL check
        $grantAccess = self::hasAccess($controller_name, $action_name);
        if(!$grantAccess) {
            $controller = ACCESS_RESTRICTED.'Controller';
            $controller_name = ACCESS_RESTRICTED;
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
            die('That method does not exist in the controller \"' . $controller_name . '\"');
        }
    }
}