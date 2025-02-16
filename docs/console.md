# Console

## Overview
The console command is used to manage and perform tasks related to this framework. You can run a console command following the following syntax:

```php console ${command_name} ${argument}```

An example of a command that requires arguments is demonstrated below:

```php console test:run-test Test```

Where Test is the name of the file containing the test. Typing php console in the command line at project root will display all of the available commands. Each of the supported command will be covered in their respective sections in this user guide.

If there is a command you would like for us to support you can submit an issue [here](https://github.com/chapmancbVCU/chappy-php/issues).

## Summary of Available Commands
Below is a list of available commands. Most items in this list contains a link to the page that describes an individual command.

| Command | Description |
|:-------:|-------------|
| migrate | Runs a Database Migration |
| test | Performs a phpunit test |
| init:mk-profile-images-dir | Builds Profile Image Dir |
| make:api | Generates or updates api-docs |
| make:command | Generates a new command class |
| make:controller| Generates a new controller class |
| make:migration | Generates a Database Migration |
| make:model | Generates a new model file |
| make:test | Generates a new test class |
| migrate:drop-all | Drops all database tables |
| migrate:refresh | Drops all tables and runs a Database Migration |
| tools:mk-env | Creates the .env file |
| tools:rm-profile-images | Removes all profile images |