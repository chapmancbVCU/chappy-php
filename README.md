# custom-php-mvc-framework
Model View Controller (MVC) framework based on tutorials I have been following from Freeskills on YT.

Beginning on Friday, June 15, 2024 all updates are driven by me unless other contributors are involved.

Complete documentation including the "Getting Started" guild describe below can be found within the framework after setup.

## About
The Model View Controller is a style of programming that allows developers to efficiently manage interactions between users, the user interface, and the database of a web application.  The models manages the data, logic and rules of the application.  The views are what the user sees and interacts with.  Finally, the controller manages interactions between the user, views, and models.

## What does this MVC support?
It supports everything described above.  This sample application natively comes with support for user login, registration, and sessions associated with each user.

## Getting Started
1. Navigate to where your development projects are located in CMD or Terminal.
2. Run the command ```git clone git@github.com:chapmancbVCU/custom-php-mvc-framework.git```
3. Make a copy of .env.sample in project root and name it .env.  Fill in the following information:
   * DB_USER
   * DB_PASSWORD
   * CURRENT_USER_SESSION_NAME: should be a long string of upper and lower case characters and numbers.
   * REMEMBER_ME_COOKIE_NAME:  should be a long string of upper and lower case characters and numbers.
4. profileImage directory:
   * In CMD or Terminal navigate to public/images from project root and make a directory called "profileImage".
   * In Linux and MacOS set the appropriate permissions by running the command: ```chmod 777 profileImage```
   * In Linux and MacOS you will need to modify the owner and group.
      ```sudo chown -R %USERNAME%:%GROUP% profileImage/```
      Where  %USERNAME% is the name of the account you are developing in and %GROUP% is the name of group associated with your server.  In XAMPP it would be daemon and in Nginx it maybe nginx or a something else depending on the instructions you followed to setup your server.
5. Import the database found in mvctutorial.sql.zip into SQL.
6. Initialize a composer project.
7. Install phpdotenv for environmental file support by running: ```composer require vlucas/phpdotenv```
8. Install TinyMCE for WYSIWYG rich text editor support: ```composer require tinymce/tinymce```
9. Navigate to http://localhost/custom-php-mvc-framework.  If you have any issues make sure your database is setup correctly and the .env file is correct.

## Goals
1. Add additional front-end and back-end form validation (Done)
2. Resolve issue for warnings about creating of dynamic properties so the framework is fully compatible with PHP 8
3. Test with nginx
4. Update jQuery and Bootstrap to modern builds and add support to maintain similar look and feel of front end (Done)
5. Add support for additional form elements in FormHelpers (In progress)
6. Add user guide (Update as needed)
7. Add management system for Users model to in include admin so administrators can manage other users, change user type, and perform password reset operations.
8. Add types to functions (Done)
9. Add types to instance variables
10. Add TinyMCE (Done)
11. Add file upload support (Done)
12. Add user's guide (In progress)

## Credits
1. “mvc” icon by iconixar, from thenounproject.com.
2. Freeskills on YT (https://www.youtube.com/playlist?list=PLFPkAJFH7I0keB1qpWk5qVVUYdNLTEUs3)
