<?php $this->setSiteTitle("DB - Custom MVC Framework Docs"); ?>
<?php $this->start('body'); ?>

<div class="main">
    <a href="<?=APP_DOMAIN?>documentation/core" class="btn btn-xs btn-secondary">Core</a>
    <h1 class="text-center">DB Class</h1>
    <div class="row align-items-center justify-content-center my-3">
        <p class="text-center w-75">Support database operations.</p>
    </div>

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">Extends</th>
        </tr>
        <tr>
            <td colspan="2" class="text-center">None</td>
        </tr>
        <tr>
            <th colspan="2" class="text-center">Namespace</th>
        </tr>
        <tr>
            <td colspan="2" class="text-center">Core</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" rowspan="3">Use</th>
            <tr><td>\PDO</td></tr>
        </tr>  
        <tr><td>PDOException</td></tr>
        <tr>
            <th colspan="2" class="text-center">Instance Variables</th>
        </tr>
        <tr>
            <th class="text-center">Access Identifier / Name</th>
            <th class="text-center">Description</th>
        </tr>
        <tr>
            <td>private $_count</td>
            <td>The number of results returned from a SQL query</td>
        </tr>
        <tr>
            <td>private $_error</td>
            <td>Boolean flag that indicates if a SQL query has resulted in an error.  Default value is false.</td>
        </tr>
        <tr>
            <td>private $_fetchStyle</td>
            <td>Type of fetch to perform.  The default value is PDO::FETCH_OBJ.</td>
        </tr>
        <tr>
            <td>private static $_instance</td>
            <td>An instance of this class set as a variable.  To be used in other class because we can't use $this.</td>
        </tr>
        <tr>
            <td>private $_lastInsertID</td>
            <td>The primary key ID for last record inserted into the database.  Set to null by default.</td>
        </tr>
        <tr>
            <td>private $_pdo</td>
            <td>Set as an instance of the PDO class.</td>
        </tr>
        <tr>
            <td>private $_query</td>
            <td>The query we will submit to the database.</td>
        </tr>
        <tr>
            <td>private $_result</td>
            <td>An associated array of results returned from the database.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function construct</th>
        </tr>
        <tr>
            <td colspan="2">This constructor creates a new PDO object as an instance variable.  If there are any failures the application quits with an error message.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">None</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">protected function buildJoin</th>
        </tr>
        <tr>
            <td colspan="2">Constructs join statements for SQL queries.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$join Data such as table, conditions, and aliases needed to construct join query.  Default value is an empty array.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>The join component of a query.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function count</th>
        </tr>
        <tr>
            <td colspan="2">Getter function for the private _count variable.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">None</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">int</td>
            <td>The number of results found in an SQL query.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function delete</th>
        </tr>
        <tr>
            <td colspan="2">
                Performs delete operation against SQL database.
                <br><br>
                Example setup:
                <br>
<pre class="my-0">
<code class="language-php line-numbers">$contacts = $db->delete('contacts', 3);
</code>
</pre>
            </td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$table The name of the table that contains the record we want to delete.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">int</td>
            <td>$id The primary key for the record we want to remove from a 
            * database table.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">bool</td>
            <td>True if delete operation is successful.  Otherwise, we return false.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function error</th>
        </tr>
        <tr>
            <td colspan="2">Getter function for the $_error variable.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">None</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">bool</td>
            <td>The value for the $_error flag.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function find</th>
        </tr>
        <tr>
            <td colspan="2">
                Implements beforeSave function described in Model parent class.  Ensures password is not in plain text but a hashed one.
                <br><br>
                Example setup:
                <br>
<pre class="my-0">
<code class="language-php line-numbers">$contacts = $db->find('users', [
    'conditions' => ["email = ?"],
    'bind' => ['chad.chapman@email.com'],
    'order' => "username",
    'limit' => 5,
    'sort' => 'DESC'
]);
</code>
</pre>
            </td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$table The name or the table we want to perform our query against</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td> $params The values for the query.  They are the fields of the table in our database.  The default value is an empty array.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">bool|string</td>
            <td> $class A default value of false, it contains the name of the class we will build based on the name of a model.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">bool|array</td>
            <td>An array of object returned from an SQL query.</td>
        </tr>
    </table>


    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function findFirst</th>
        </tr>
        <tr>
            <td colspan="2">Returns the first result performed by an SQL query.  It is a wrapper for the _read function for this purpose.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$table The name or the table we want to perform our query against</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$params The values for the query.  They are the fields of the table in our database.  The default value is an empty array.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">bool|array</td>
            <td>An associative array of results returned from an SQL query.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function findTotal</th>
        </tr>
        <tr>
            <td colspan="2">Returns number of records in a table.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$table The name or the table we want to perform our query against</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$params The values for the query.  They are the fields of the table in our database.  The default value is an empty array.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">int</td>
            <td>$count The number of records in a table.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function first</th>
        </tr>
        <tr>
            <td colspan="2">Returns first result in the _result array.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">None</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array|object</td>
            <td>An associative array that first that is the first object in a _result.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function getColumns</th>
        </tr>
        <tr>
            <td colspan="2">Finds user by username in the Users table.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$table The name of the table we want to retrieve the column names.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>An array of objects where each one represents a column from a database table.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public static function getInstance</th>
        </tr>
        <tr>
            <td colspan="2">An instance of this class set as a variable.  To be used in other class because we can't use $this.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">None</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">self</td>
            <td>The instance of this class.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function insert</th>
        </tr>
        <tr>
            <td colspan="2">
                Finds user by username in the Users table.
                <br><br>
                Example setup:
                <br>
<pre class="my-0">
<code class="language-php line-numbers">$fields = [
    'fname' => 'John',
    'lname' => 'Doe',
    'email' => 'example@email.com'
    ];
$contacts = $db->insert('contacts', $fields);
</code>
</pre>
            </td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$table The name of the table we want to perform the insert operation.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$fields The field names and the respective values we will use to populate a database record.  The default value is an empty array.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">bool</td>
            <td>Report whether or not the operation was successful.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function lastID</th>
        </tr>
        <tr>
            <td colspan="2">The primary key ID of the last insert operation.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">None</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">int</td>
            <td>The primary key ID from the last insert operation.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function query</th>
        </tr>
        <tr>
            <td colspan="2">Performs database query operations that includes prepare, binding, execute, and fetch.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$sql The database query we will submit to the database.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$params The values for the query.  They are the fields of the table in our database.  The default value is an empty array.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">bool|string</td>
            <td>$class A default value of false, it contains the name of the class we will build based on the name of a model.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">DB</td>
            <td>The results of the database query.  If the operation is not successful the $_error instance variable is set to true and is returned.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">protected function _read</th>
        </tr>
        <tr>
            <td colspan="2">Supports SELECT operations that maybe ran against a SQL database.  It supports the ability to order and limit the number of results returned from a database query.  The user can use parameters such as conditions, bind, order, limit, and sort.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$table The name of the table that contains the record(s) we want to find.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$params The values for the query.  They are the fields of the table in our database.  The default value is an empty array.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">bool|string</td>
            <td>$class A default value of false, it contains the name of the class we will build based on the name of a model.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">bool</td>
            <td>$count Boolean switch for turning on support for count operations.  Default value is false.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>A true or false value depending on a successful operation.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm">
        <tr>
            <th colspan="2" class="text-center">public function results</th>
        </tr>
        <tr>
            <td colspan="2">Returns value of query results.</td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="text-center" colspan="2">None</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>An array of objects that contain results of a database query.</td>
        </tr>
    </table>

    <hr class="w-75 my-5 mx-auto">

    <table class="table table-striped table-condensed table-bordered table-hover w-75 mx-auto table-sm mb-5">
        <tr>
            <th colspan="2" class="text-center">public function update</th>
        </tr>
        <tr>
            <td colspan="2">
                Performs update operation on a SQL database record.
                <br><br>
                Example setup:
                <br>
<pre class="my-0">
<code class="language-php line-numbers">$fields = [
    'fname' => 'John',
    'email' => 'example@email.com'
];
$contacts = $db->update('contacts', 3, $fields);
</code>
</pre>
            </td>
        </tr>
        <tr>
            <th class="align-middle text-center" colspan="2">params</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">string</td>
            <td>$table The name of the table that contains the record we want to update.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">int</td>
            <td>$table The name of the table that contains the record we want to update.</td>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">array</td>
            <td>$fields The value of the fields we want to set for the database record.  The default value is an empty array.</td>
        </tr>
        <tr>
            <th class="align-middle text-center w-25" colspan="2">return</th>
        </tr>
        <tr>
            <td class="align-middle text-center w-25">bool</td>
            <td>True if the update operation is successful.  Otherwise, we return false.</td>
        </tr>
    </table>
    <a href="<?=APP_DOMAIN?>documentation/core" class="btn btn-xs btn-secondary mb-5">Core</a>
</div>
<?php $this->end(); ?>