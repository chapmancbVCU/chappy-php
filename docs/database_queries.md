<h1 style="font-size: 50px; text-align: center;">Database Queries</h1>

## Table of contents
1. [Overview](#overview)
2. [DB Class](#db)
    * A. [Create](#create)
    * B. [Read](#read)
    * C. [Update](#update)
    * D. [Delete](#delete)
    * E. [DB Summary](#db-summary)
3. [Using Models](#models)
<br>
<br>

## 1. Overview <a id="overview"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
There are two ways to perform database queries in this framework.  You can use queries or the functions that comes with your models or base model classes.
<br>

## 2. DB Class <a id="db"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
You can perform a query within this framework by using the `query` function from the `DB` class.  The query function has 3 parameters:
1. $sql - The database query we will submit to the database.
2. $params - The values for the query.  They are the fiends of the table in our database.  The default value is an empty array.
3. $class - A default value of false, it contains the name of the class we will build based on the name of a model.

An example can be found in the findUserByAcl function from the Users model.  An example is shown below:

```php
/**
 * Retrieves a list of users who are assigned to a particular acl.
 *
 * @param string $acl The ACL we want to use in our query.
 * @return object Users who are assigned to a specific acl.
 */
public static function findUserByAcl($acl) {
    $aclName = '["'.$acl.'"]';
    return self::$_db->query("SELECT * FROM users WHERE acl = ?", [$aclName]);
}
```

All the user has to do is create a classic SQL query as the first parameter.  Since we want to find a list of ACLs we use `aclName` as the parameter that we will bind using the PDO class.  By using the built in `query` function the user does not have to be concerned with the actual binding of values or calling the execute function of the PDO class.
<br>

Here is another example shown below:

```php
use Core\DB;
use Core\Helper;
$db = DB::getInstance();
$sql = "SELECT * FROM contacts";
$contacts = $db->query($sql);
Helper::dd($contacts);
```

Below is the result using the `dd` function:

<div style="text-align: center;">
  <img src="assets/sql-query.png" alt="SQL query example">
  <p style="font-style: italic;">Figure 1 - SQL query example</p>
</div>

As shown in Figure 1 all the information returned from the database is represented as an object.  The `PDOStatement` value has been expanded to show the actual query.  The `_result` section shows all of your contacts.

You can learn more about SQL through this [link](https://www.theodinproject.com/paths/full-stack-javascript/courses/databases) to The Odin Project's Database Course.
<br>

#### A. Create <a id="read">
The **insert** function performs our create operation on our database.  An example is shown below:

```php
use Core\DB;
use Core\Helper;
$db = DB::getInstance();

$fields = [
    'fname' => 'John',
    'lname' => 'Doe',
    'email' => 'example@email.com'
];
$contacts = $db->insert('contacts', $fields);
Helper::dd($contacts);
<br>

#### B. Read <a id="read">
Users can perform find operations using the DB class with the `find` function using parameters such as conditions, bind, order, limit, and sort.  An example is shown below:

```php
use Core\DB;
use Core\Helper;
$db = DB::getInstance();

$contacts = $db->find('contacts', [
    'conditions' => ["user_id = ?"],
    'bind' => ['1'],
    'limit' => 2,
    'sort' => 'DESC'
]);
Helper::dd($contacts);
```

<div style="text-align: center;">
  <img src="assets/db-find.png" alt="DB Class Find Function">
  <p style="font-style: italic;">Figure 2 - DB Class Find Function</p>
</div>

As shown above in figure 2, we need to first specify the table.  In this case we want to look through our contacts table.  Next, we set our parameters.  Here we use the `user_id` field as the condition, bind to it the `id` of 1, limit the results to the first 2, and sort in descending order.
<br>

This function accepts the following parameters:
1. $table - The name of the table that contains the records we want to retrieve.
2. $params - An associative array that contains key value pair parameters for our query such as conditions, bind, limit, offset, join, order, and sort.  The default value is an empty array.
3. $class A default value of false, it contains the name of the class we will build based on the name of a model.

#### C. Update <a id="update">
You can used the DB class' `update` function to update a record as shown below:

```php
use Core\DB;
use Core\Helper;
$db = DB::getInstance();

$fields = [
    'fname' => 'John',
    'email' => 'example@email.com'
];
$contacts = $db->update('contacts', 3, $fields);
```

This function accepts 3 parameters:
1. $table - The name of the table that contains the record we want to update.
2. $id - The primary key for the record we want to remove from the database table.
3. $fields - An associative array containing key value pairs containing information we want to update.
<br>

#### D. Delete <a id="delete">
The delete function performs delete operations.  This is the simples of all our functions to use as shown below:

```php
$contacts = $db->delete('contacts', 3);
```

It accepts the following arguments:
1. $table - The name of the table that contains the record we want to delete.
2. $id The primary key for the record we want to remove from a database table.
<br>

#### E. Summary  <a id="db-summary">
All of these functions have their equivalent wrapper functions that will be described in the **Using Models** section.  Here are the descriptions for additional functions:
1. count - Getter function for the private _count variable.
2. findFirst - Returns the first result performed by an SQL query.
3. findTotal - Returns number of records in a table.
4. first - Returns first result in the _result array.
5. lastID - The primary key ID of the last insert operation.
6. results - Returns value of query results.  We usually chain this as a call with another function for our Model classes.
<br>

## 2. Using Models <a id="models"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>