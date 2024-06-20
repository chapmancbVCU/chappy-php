<?php
namespace Core;
use Core\FormHelper;
use Core\Router;
use Core\Helper;
/**
 * Input class handles requests to the server.
 */
class Input {
    /**
     * Checks csrf token to determine if it was tampered with.  If the check 
     * fails the user is routed to a view stating access is restricted.
     *
     * @return bool Returns true if check passes.
     */
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
        return FormHelper::sanitize($_REQUEST[$input]);
    }

    /**
     * Returns the request element within the $_SERVER superglobal array.
     *
     * @return string The type of request stored in the REQUEST_METHOD element 
     * within the $_SERVER superglobal array.
     */
    public function getRequestMethod() {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    /**
     * Checks if the REQUEST_METHOD is GET.
     *
     * @return boolean True if the request method is GET.
     */
    public function isGet() {
        return $this->getRequestMethod() === 'GET';
    } 

    /**
     * Checks if the REQUEST_METHOD is POST.
     *
     * @return boolean True if the request method is POST.
     */
    public function isPost() {
        return $this->getRequestMethod() === 'POST';
    }

    /**
     * Checks if the REQUEST_METHOD is PUT.
     *
     * @return boolean True if the request method is PUT.
     */
    public function isPut() {
        return $this->getRequestMethod() === 'PUT';
    } 
}