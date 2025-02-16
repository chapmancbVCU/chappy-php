# Database Operations
This page goes over the available ways users can manage a database with chappy.php Using the console, you can perform migrations, drop tables, and other tasks. A complete description of all Migration class function can be within the project API Documentation.

## Migration
Performing a database migration is the first task you will perform after establishing a new project. Before you begin you will need to open the .env file and enter some information about the database. An example is shown below:

```
DB_NAME=chappy
DB_USER=root
DB_PASSWORD=asecurepassword
DB_HOST='127.0.0.1'
```