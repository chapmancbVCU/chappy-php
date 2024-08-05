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
    public function csrfCheck(): bool {
        if(!FormHelper::checkToken($this->get('csrf_token'))) 
            Router::redirect('restricted/badToken');
        return true;
    }
    
    /**
     * Supports operations related to handling POST and GET requests.
     *
     * @param mixed $input Values from POST and GET requests.  The default 
     * value is false.
     * @return array|string An array associated with a POST or GET request or 
     * an encoded HTML string.
     */
    public function get($input = false) {
        if(!$input){
            // return entire request array and sanitize it
            $data = [];
            foreach($_REQUEST as $field => $value){
                $data[$field] = trim(FormHelper::sanitize($value));
            }
            return $data;
        }
    
        return (array_key_exists($input,$_REQUEST))?trim(FormHelper::sanitize($_REQUEST[$input])) : '';
    }

    /**
     * Returns the request element within the $_SERVER superglobal array.
     *
     * @return string The type of request stored in the REQUEST_METHOD element 
     * within the $_SERVER superglobal array.
     */
    public function getRequestMethod(): string {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    /**
     * Checks if the REQUEST_METHOD is GET.
     *
     * @return bool True if the request method is GET.
     */
    public function isGet(): bool {
        return $this->getRequestMethod() === 'GET';
    } 

    /**
     * Checks if the REQUEST_METHOD is POST.
     *
     * @return boolean True if the request method is POST.
     */
    public function isPost(): bool {
        return $this->getRequestMethod() === 'POST';
    }

    /**
     * Checks if the REQUEST_METHOD is PUT.
     *
     * @return boolean True if the request method is PUT.
     */
    public function isPut(): bool {
        return $this->getRequestMethod() === 'PUT';
    } 
}