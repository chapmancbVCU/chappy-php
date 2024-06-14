<?php
namespace Core;
use Core\FormHelper;
use Core\Router;

class Input {
    public function csrfCheck() {
        if(!FormHelper::checkToken($this->get('csrf_token'))) 
            Router::redirect('restricted/badtoken');
        return true;
    }
    
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