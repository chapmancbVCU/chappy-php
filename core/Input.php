<?php
namespace Core;
use Core\FormHelper;
use Core\Router;
use Core\Helper;
/**
 * Input class handles requests to the server.
 */
class Input {
    public function csrfCheck() {
        if(!FormHelper::checkToken($this->get('csrf_token'))) 
            Router::redirect('restricted/badToken');
        return true;
    }
    
    /**
     * Supports operations related to handling POST and GET requests.
     *
     * @param boolean $input Values from POST and GET requests.  The default 
     * value is false;
     * @return array|string An array associated with a POST or GET request or 
     * an encoded HTML string.
     */
    public function get($input = false) {
        
        if(!$input) {
            // Return and sanitize entire request array.
            $data = [];
            foreach($_REQUEST as $field => $value) {
                $data[$field] = FormHelper::sanitize($value);
            }
            return $data;
        }
        return FormHelper::sanitize(($_REQUEST[$input]));
    }

    public function getRequestMethod() {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    public function isGet() {
        return $this->getRequestMethod() === 'GET';
    } 

    public function isPost() {
        return $this->getRequestMethod() === 'POST';
    }

    public function isPut() {
        return $this->getRequestMethod() === 'PUT';
    } 
}