<h1 style="font-size: 50px; text-align: center;">Getting Started</h1>

## Table of contents
1. [Overview](#overview)
2. [System Requirements](#requirements)

<br>
<br>

## 1. Overview <a id="overview"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Here we provide the resources needed to get your project up and running.
<br>

## 2. System Requirements <a id="requirements"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
1. Apache Server, development environment such as XAMPP, or Nginx (optional)
2. PHP 8.3
3. SQL/MariaDB (optional)
4. OS: MacOS, Linux, Windows 11+
5. SQL Management software (We use phpMyAdmin or adminer)(optional)
6. Composer
7. git
8. Node Package Manager (npm)


They will list out all PHP related dependencies needed for Apache and Nginx.
1. Navigate to where your development projects are located in CMD or Terminal.
2. Run the command 

   ```git clone git@github.com:chapmancbVCU/chappy-php.git```

3. cd to newly cloned directory.
3. From project root run the command: 

   ```composer run install-project```

4. .env file
   * For production edit the configuration file.
      ```
      # Set to mysql or mariadb for production
      DB_CONNECTION=mysql or mariadb
      DB_HOST='127.0.0.1'
      DB_PORT=3306
      # Set to your database name for production
      DB_DATABASE=dbname
      DB_USER=dbuser
      DB_PASSWORD=secure_password
      ```
   * For XAMPP set APP_DOMAIN to 'http://localhost/chappy-php'.  Otherwise keep it as '/'.
   * You can also configure password complexity requirements, MAX_LOGIN_ATTEMPTS, and name for S3_BUCKET here as well.
5. Database Setup:
   * Create your database and set it to what you entered for DB_NAME
   * Run the command from project root to create initial tables:
      
      ```php console migrate```

6. profile_images directory:
   * In CMD or Terminal navigate to public/images/uploads from project root and make sure the "profile_images" directory exists. If not create it.
   * Set the correct permissions for the profile_images directory in MacOS or Linux: 
   
      ```chmod 775 profile_images```

   * In Linux and MacOS you will need to modify the owner and group.

      ```sudo chown -R %USERNAME%:%GROUP% profile_images/```

      With XAMPP your username will work along with daemon as the group. Apache both has to be www-data. Nginx the user is `nginx`.
7. If the logs directory is not created perform the following steps at the project root run:
   
   ```chmod -R 777 logs```

8. For XAMPP navigate to http://localhost/chappy-php.  If you have any issues make sure your database is setup correctly and the .env file is correct.
   * For production servers or remote access the path will be http://ip_address_or_domain_name.  You will need to make sure the APP_DOMAIN variable is set to '/' in .env file.