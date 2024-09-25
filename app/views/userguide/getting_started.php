<?php $this->setSiteTitle("Getting Started - User Guide"); ?>
<?php $this->start('body'); ?>

<div class="main">
    <div class="position-fixed">
        <a href="<?=APP_DOMAIN?>userguide/index" class="btn btn-xs btn-secondary">User Guide Home</a>
    </div>
    <h1 class="text-center">Getting Started</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <ol class="pl-4">
            <li><a href="#system-requirements">System Requirements</a></li>
            <li><a href="#setup">Setup</a></li>
        </ol>
    </div>

    <h1 id="system-requirements" class="text-center">System Requirements</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <ol class="pl-4">
            <li>Apache Server, development environment such as XAMPP, or Nginx</li>
            <li>PHP 8.3</li>
            <li>SQL/MariaDB</li>
            <li>OS: MacOS, Linux, Windows 10+</li>
            <li>SQL Management software</li>
            <li>Composer</li>
            <li>git</li>
        </ol>

        <p>If you need help search using a combination of keywords that include Laravel, server type such as Nginx or Apache, and name of OS.  They will list out all PHP related dependencies needed for Apache and Nginx.</p>
    </div>

    <h1 id="setup" class="text-center">Setup</h1>
    <div class="mb-5 mt-3 w-75 bg-light mx-auto border rounded p-4">
        <ol class="pl-4">
            <li>Navigate to where your development projects are located in CMD or Terminal</li>
            <li>Run the command:
<pre class="mb-1 pb-1">
                    <code>
git clone git@github.com:chapmancbVCU/custom-php-mvc-framework.git
                    </code>
</pre>
            </li>
            <li>Run the command:
<pre class="mb-1 pb-1">
                    <code>
php init-chappy
                    </code>
</pre>               
            </li>
            <li>If necessary, make a copy of .env.sample in project root and name it .env.  Fill in the following information:
                <ol class="pl-4" type="a">
                    <li>DB_NAME</li>
                    <li>DB_USER</li>
                    <li>DB_PASSWORD</li>
                    <li>DB_HOST</li>
                    <li>CURRENT_USER_SESSION_NAME: should be a long string of upper and lower case characters and numbers.</li>
                    <li>REMEMBER_ME_COOKIE_NAME:  should be a long string of upper and lower case characters and numbers.</li>
                    <li>For XAMPP set APP_DOMAIN to 'http://localhost/chappy-php'.  On live servers set it to '/'.</li>
                    <li>Set SERVER_TYPE to 'apache' on Apache and XAMPP.  For Nginx make sure it is set to 'nginx' if you are using $_['PATH_INFO'] instead of $_SERVER['REQUEST_URI'].</li>
                    <li>You can also configure password complexity requirements, MAX_LOGIN_ATTEMPTS, and name for S3_BUCKET here as well.</li>
                </ol>
            </li>
            <li>Database Setup:
                <ol class="pl-4" type="a">
                    <li>Create your database and set it to what you entered for DB_NAME</li>
                    <li>Apache and Nginx:
                        <ol class="pl-4">
                            <li>Run the command from project root:
<pre class="mb-1 pb-1">
                    <code>
php console tools:run-migration
                    </code>
</pre>
                            </li>
                        </ol>
                    </li>
                    <li>XAMPP
                        <ol class="pl-4" type="a">
                        <li>Run the command from project root:
<pre class="mb-1 pb-1">
                    <code>
php console tools:run-migration
                    </code>
</pre>
                            </li>
                        </ol>
                    </li>
                    <li>Inspect database and make sure the following tables are created:
                        <ol class="pl-4" type="a">
                            <li>acl</li>
                            <li>contacts</li>
                            <li>migrations</li>
                            <li>profile_images</li>
                            <li>users</li>
                            <li>user_sessions</li>
                        </ol>
                    </li>
                </ol>
            </li>
            <li>profile_images directory:
                <ol class="pl-4" type="a">
                    <li>In CMD or Terminal navigate to public/images/uploads from project root and make sure the <q>profile_images</q> directory exists.  If not create it.</li>
                    <li>Set the correct permissions for the profile_images directory in MacOS or Linux:
                        <pre class="mb-1 pb-1">
                            <code>
chmod 755 profile_images
                            </code>
                        </pre>
                    </li>
                    <li>
                        In Linux and MacOS you will need to modify the owner and group. 
                        <pre class="mb-1 pb-1">
                            <code>
sudo chown -R %USERNAME%:%GROUP% profile_images/
                            </code>
                        </pre>
                        With XAMPP your username will work along with daemon as the group.  Apache both has to be www-data.  Not tested with nginx yet.
                    </li>
                </ol>
            </li>
            <li>For XAMPP navigate to http://localhost/chappy-php.  If you have any issues make sure your database is setup correctly and the .env file is correct.
                <ol class="pl-4" type="a">
                    <li>For production servers or remote access the path will be http://ip_address_or_domain_name.</li>
                <ol>
            </li>
        </ol>
    </div>
</div>
<?php $this->end(); ?>