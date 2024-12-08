<?php $this->setSiteTitle("Controllers - User Guide"); ?>
<?php $this->start('body'); ?>

<div class="main">
    <div class="position-fixed">
        <a href="<?=APP_DOMAIN?>userguide/index" class="btn btn-xs btn-secondary">User Guide Home</a>
    </div>
    <h1 class="text-center">Controllers</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <ol class="pl-4">
            <li><a href="#overview">Overview</a></li>
            <li><a href="#controller-file">Controller File</a></li>
            <li><a href="#example">Example</a></li>
        </ol>
    </div>

    <h1 id="overview" class="text-center">Overview</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>This framework supports controllers to manage the interactions between views 
            and models.
        </p>
    </div>

    <h1 id="controller-file" class="text-center">Controller File</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>Let's begin by creating a new controller using all available 
            options and arguments: 
        </p>
<pre class="mb-1 pb-1">
<code class="language-php line-numbers">php console make:controller Foo --layout=admin --resource
</code>
</pre>  
        <p>The first argument is the name and the first letter should always be upper case.  It is
            used to create the name of the controller class.  The --layout option is optional.  If 
            you do not use this option the layout is set to default.  Finally, the --resource 
            option creates boilerplate functions that you can use.  The file created by running this 
            command is shown below:
        </p>
<pre class="mb-1 pb-1">
<code class="language-php line-numbers">namespace App\Controllers;
use Core\Controller;

/**
 * Undocumented class
 */
class FooController extends Controller {
    /**
     * Runs when the object is constructed.
     *
     * @return void
     */
    public function onConstruct(): void{
        $this->view->setLayout('admin');
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
</code>
</pre>
    <p>The first function you see is the onConstruct.  Any default settings you 
        need for the controller is set here.  It called by the Controller parent 
        class' constructor.  The value for the --layout option is used to 
        set the layout in this function.
    </p>
    <p>All of the other functions supports the default index action and the Create,
        Read, Update, and Delete (CRUD) operations.
    </p>
    </div>

    <h1 id="example" class="text-center">Example</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>We will be using a controller from an example contact management 
            system to tie how models, views, and controllers work together.
        </p>
    </div>
</div>
<?php $this->end(); ?>