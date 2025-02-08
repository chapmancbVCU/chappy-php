# chappy.php
chappy.php is a whole new Model View Controller framework tailored to all of the fellows of the internet. Our goal is to provide a light weight and easily expandable framework for any PHP developer. 

Originally a fork of the Ruah PHP MVC framework based on the MVC PHP Framework tutorial series on the Freeskills YouTube channel, we have worked hard to add additional support and features.  This framework includes the following features:
1. Custom form handling
2. Dynamic routing
3. Custom request handling
4. Session and flash messages
5. Symfony based Command Line Interface (CLI)
6. Server-side validation
7. User accounts
8. Administrator user role
9. Database migrations
10. Layouts and components
11. Access Control Levels (ACLs)
12. Unit test support
13. Debugging tools
14. Strong Security practices (CSRF protection, sanitization, and blacklist/whitelist filtering)
15. Single and multiple file upload support
16. API documentation
17. User guide

If you have a feature that you would like to be supported please create a request under the Issues tab.

Complete documentation including the "Getting Started" guild describe below can be found within the framework after setup.

## System Requirements
1. Apache Server, development environment such as XAMPP, or Nginx
2. PHP 8.3
3. SQL/MariaDB
4. OS: MacOS, Linux, Windows 10+
5. SQL Management software
6. Composer
7. git

If you need help search using a combination of keywords that include Laravel, server type such as Nginx or Apache, and name of OS.  They will list out all PHP related dependencies needed for Apache and Nginx.

## Getting Started
1. Navigate to where your development projects are located in CMD or Terminal.
2. Run the command ```git clone git@github.com:chapmancbVCU/chappy-php.git```
3. cd to newly cloned directory.
3. From project root run the command: ```php init-chappy```
4. If necessary, make a copy of .env.sample in project root and name it .env.  Fill in the following information:
   * DB_NAME
   * DB_USER
   * DB_PASSWORD
   * DB_HOST
   * CURRENT_USER_SESSION_NAME: should be a long string of upper and lower case characters and numbers.
   * REMEMBER_ME_COOKIE_NAME:  should be a long string of upper and lower case characters and numbers.
   * For XAMPP set APP_DOMAIN to 'http://localhost/chappy-php'.  On live servers set it to '/'.
   * You can also configure password complexity requirements, MAX_LOGIN_ATTEMPTS, and name for S3_BUCKET here as well.
5. Database Setup:
   * Create your database and set it to what you entered for DB_NAME
   * Run the command from project root to create initial tables:
      ```php console migrate```
   * Inspect database and make sure the following tables are created:
      * acl
      * contacts
      * migrations
      * profile_images
      * users
      * user_sessions
6. Vite support
   * Run command ```npm init```
   * Run command ```npm install```
7. profile_images directory:
   * In CMD or Terminal navigate to public/images/uploads from project root and make sure the "profile_images" directory exists. If not create it.
   * Set the correct permissions for the profile_images directory in MacOS or Linux: ```chmod 775 profile_images```
   * In Linux and MacOS you will need to modify the owner and group.
      ```sudo chown -R %USERNAME%:%GROUP% profile_images/```
      With XAMPP your username will work along with daemon as the group. Apache both has to be www-data. Not tested with nginx yet.
8. For XAMPP navigate to http://localhost/chappy-php.  If you have any issues make sure your database is setup correctly and the .env file is correct.
   * For production servers or remote access the path will be http://ip_address_or_domain_name.  You will need to make sure the APP_DOMAIN variable is set to '/' in .env file.

## Goals
1. Add additional front-end and back-end form validation (Done)
2. Resolve issue for warnings about creating of dynamic properties so the framework is fully compatible with PHP 8
3. Test with nginx (Done)
4. Update jQuery and Bootstrap to modern builds and add support to maintain similar look and feel of front end (Done)
5. Add support for additional form elements in FormHelpers (Done)
6. Add user guide (Update as needed)
7. Add management system for Users model to in include admin so administrators can manage other users, change user type, and perform password reset operations. (Done)
9. Add TinyMCE (Done)
10. Add file upload support (Done)
11. Add database migrations. (Done)
12. Update to match original tutorial project. (Done)
13. Add user profile (Done)
14. Additional console command support

## Contact
I can be reached regarding this framework at chad.chapman2010@gmail.com.  You are also welcome to open up an issue at https://github.com/chapmancbVCU/chappy-php/issues

## Credits
1. “mvc” icon by iconixar, from thenounproject.com.
2. Freeskills on YT (https://www.youtube.com/playlist?list=PLFPkAJFH7I0keB1qpWk5qVVUYdNLTEUs3)
