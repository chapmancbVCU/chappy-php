<h1 style="font-size: 50px; text-align: center;">Models</h1>

## Table of contents
1. [Overview](#overview)
2. [Model File](#model-file)
<br>
<br>

## <a id="overview"></a>Overview <span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
This framework supports models for interacting with a database. Whenever you create a new table you will need to create a new model. Let's use the table 'foo' that was created under the Database Operations section. To create a new model run the the following command:

```sh
php console make:model Foo
```

Remember, models are classes and the first letter in the model's name needs to be upper case. After you run the command a new model file will be generated under `app/models`. The make:model command will guess what the name of your table is so be sure to double check the $table variable's value is correct. The output file for the command with modifications tailored to the foo table described above is shown below:

```php
namespace App\Models;
use Core\Model;

/**
 * 
 */
class Foo extends Model {

    // Fields you don't want saved on form submit
    public const blackList = ['id', 'deleted'];

    // Set to name of database table.
    protected static $_table = 'foo';

    // Soft delete
    protected static $_softDelete = true;
    
    // Fields from your database
    public bar;
    public created_at;
    public id;
    public updated_at;

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
```
<br>

## Model File <a id="model-file"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
The model class that is generated as a template for creating your models. First thing you need to do is add the fields associated with your database as instance variables. These instance variables need to use the 'public' access identifier. Commonly used functions are automatically generated when you create a new model class. Since all model classes extends the Model class you automatically get access to functions that assist with database operations. Functions you create and those from the Model class are commonly used within action functions within controller classes.

This class comes with a public const blackList variable that is an array. You can populate this array with fields you don't want updated inadvertently on POST. More on this in the controller's section.

Models also support functions for tasks you want to perform before and after delete and update operations. Finally, the validator function supports server side validation tasks. More information about validation can be found [here](server_side_validation).