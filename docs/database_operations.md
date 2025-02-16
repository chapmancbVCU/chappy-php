# Database Operations
This page goes over the available ways users can manage a database with chappy.php Using the console, you can perform migrations, drop tables, and other tasks. A complete description of all Migration class function can be within the project API Documentation.

## Migration
Performing a database migration is the first task you will perform after establishing a new project. Before you begin you will need to open the .env file and enter some information about the database. An example is shown below:

```
DB_NAME=my_db_name
DB_USER=my_db_user_name
DB_PASSWORD=my_secure_password
DB_HOST='127.0.0.1'
```

Next, create the database using your preferred method.  We like to use phpMyAdmin and Adminer.

Finally, you can run the migrate command shown below:

```php console migrate```

If you make a mistake or need a fresh start you can perform a refresh as described below:

```php console migrate:refresh```

Performing a the migrate and refresh commands will add a new record to a migrations table whose purpose is to track all previous migrations. When you create a one or more new migrations only those will be executed. You can also modify an existing table with a new migration. More one building your own migrations will be covered in the next section called Create Migration.

Finally, if you just want to drop tables perform the following command:

```php console migrate:drop-all```

Performing either of these commands will result in status messages being displayed in the console.

## Creating A New Migration