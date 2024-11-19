<?php
namespace Console\App\Helpers;

class Controller {
    public static function defaultTemplate(string $controllerName, string $layout): string {
        return '<?php
namespace App\Controllers;
use Core\Controller;

/**
 * Undocumented class
 */
class '.$controllerName.'Controller extends Controller {
    /**
     * Runs when the object is constructed.
     *
     * @return void
     */
    public function onConstruct(): void{
        $this->view->setLayout(\''.$layout.'\');
    }
}
';
    }

    public static function resourceTemplate(string $controllerName, string $layout): string {
        return '<?php
namespace App\Controllers;
use Core\Controller;

/**
 * Undocumented class
 */
class '.$controllerName.'Controller extends Controller {
    /**
     * Runs when the object is constructed.
     *
     * @return void
     */
    public function onConstruct(): void{
        $this->view->setLayout(\''.$layout.'\');
    }

    public function indexAction(): void {
        //
    }
    
    public function addAction(): void {
        //
    }

    public function deleteAction(): void {
        //
    }

    public function editAction(): void {
        //
    }

    public function updateAction(): void {
        //
    }
}
';
    }
}