## Getting Started

Here we provide the resources needed to get your project up and running.  While we work to improve out product and add content 
to the wiki you can search using a combination of keywords that include Laravel, server type such as Nginx or Apache, and name of OS.  
They will list out all PHP related dependencies needed for Apache and Nginx.
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
7. If the logs directory is not created perform the following steps at the project root run:
   * ```chmod -R 777 logs``
8. For XAMPP navigate to http://localhost/chappy-php.  If you have any issues make sure your database is setup correctly and the .env file is correct.
   * For production servers or remote access the path will be http://ip_address_or_domain_name.  You will need to make sure the APP_DOMAIN variable is set to '/' in .env file.