<?php $this->setSiteTitle("Models - User Guide"); ?>
<?php $this->start('body'); ?>

<div class="main">
    <div class="position-fixed">
        <a href="<?=APP_DOMAIN?>userguide/index" class="btn btn-xs btn-secondary">User Guide Home</a>
    </div>
    <h1 class="text-center">Models</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <ol class="pl-4">
            <li><a href="#overview">Overview</a></li>
            <li><a href="#model-file">Model File</a></li>
        </ol>
    </div>

    <h1 id="overview" class="text-center">Overview</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>This framework supports models for interacting with a database.  Whenever you create a new 
            table you will need to create a new model.  To create a new model run the the following 
            command:
        </p>

<pre class="mb-1 pb-1">
<code class="language-php line-numbers">php console make:model ModelName
</code>
</pre>
        <p>Remember, models are classes and the first letter in the model's name needs to be upper case.  
            After you run the command a new model file will be generated under app\models.  The make:model 
            command will guess what the name of your table is so be sure to double check the $table variable's 
            value is correct.  The output file for the command described above is shown below:
        </p>

<pre class="mb-1 pb-1">
<code class="language-php line-numbers">namespace App\Models;
use Core\Model;

/**
 * 
 */
class ModelName extends Model {

    // Fields you don't want saved on form submit
    // public const blackList = [];

    // Set to name of database table.
    protected static $_table = 'modelName';

    // Soft delete
    // protected static $_softDelete = true;
    
    // Fields from your database

    public function afterDelete(): void {
        //
    }

    public function afterSave(): void {
        //
    }

    public function beforeDelete(): void {
        //
    }

    public function beforeSave(): void {
        //
    }

    /**
     * Performs validation for the ModelName model.
     *
     * @return void
     */
    public function validator(): void {
        //
    }
}
</code>
</pre>
    </div>

    <h1 id="model-file" class="text-center">Model File</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <p>The model class that is generated as a template for creating your models.  First thing you 
            need to do is add the fields associated with your database as instance variables.  These 
            instance variables need to use the 'public' access identifier.  Commonly used functions are 
            automatically generated when you create a new model class.  Since all model classes extends the 
            Model class you automatically get access to functions that assist with database operations.  
            Functions you create and those from the Model class are commonly used within action functions within 
            controller classes.
        </p>

        <p>This class comes with a public const blackList variable that is an array.  You can populate this 
            array with fields you don't want updated inadvertently on POST.  More on this in the controller's section.
        </p>
    </div>
</div>
<?php $this->end(); ?>