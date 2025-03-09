<h1 style="font-size: 50px; text-align: center;">Env Class</h1>

## Table of contents
1. [Overview](#overview)
<br>
<br>

## 1. Overview <a id="overview"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
This class is used to manage environmental variables in a robust object oriented approach.  It contains a `get` function that accepts two arguments:
1. $key The key for the key value pair for env variables.
2. $default The default value for the env variable.

An example is shown below:
```php
Env::get('APP_DOMAIN', '/')
```

Here we access the **APP_DOMAIN** environment variable and set its default value to `'/'` in case it is not set properly in the .env file.