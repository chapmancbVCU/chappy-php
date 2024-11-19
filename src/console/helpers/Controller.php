<?php
namespace Console\App\Helpers;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Controller {
    public static function defaultTemplate($controllerName, $layout) {
        $content = '<?php
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
    return $content;
    }

    public static function resourceTemplate($controllerName, $layout) {
        $content = '<?php
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
    return $content;
    }
}