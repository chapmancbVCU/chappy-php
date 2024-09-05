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
            <li>PHP 7; PHP 8 has some issues with some things being deprecated such as dynamic creation of variables</li>
            <li>SQL/MariaDB</li>
            <li>OS: MacOS, Linux, Windows 10+</li>
            <li>SQL Management software</li>
            <li>Composer</li>
            <li>git</li>
        </ol>
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
php init-mvc
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
            <li>profileImage directory:
                <ol class="pl-4" type="a">
                    <li>In CMD or Terminal navigate to public/images from project root and make sure the <q>profileImage</q> directory exists.  If not create it.</li>
                    <li>In you needed to manually create the profileImage directory in MacOS or Linux:
                        <pre class="mb-1 pb-1">
                            <code>
chmod 755 profileImage
                            </code>
                        </pre>
                    </li>
                    <li>
                        In Linux and MacOS you will need to modify the owner and group. 
                        <pre class="mb-1 pb-1">
                            <code>
sudo chown -R %USERNAME%:%GROUP% profileImage/
                            </code>
                        </pre>
                        Where %USERNAME% is the name of the account you are developing in and %GROUP% is the name of group associated with your server.  In XAMPP it would be daemon and in Nginx it maybe nginx or a something else depending on the instructions you followed to setup your server.
                    </li>
                </ol>
            </li>
            <li>Navigate to http://localhost/custom-php-mvc-framework.  If you have any issues make sure your database is setup correctly and the .env file is correct.
                <ol class="pl-4" type="a">
                    <li>For production servers or remote access the path will be http://ip_address_or_domain_name/custom-php-mvc-framework.  You will need to make sure the ipaddress / hostname / domain name is set in APP_DOMAIN variable in .env file.</li>
                <ol>
            </li>
        </ol>
    </div>
</div>
<script src="<?=APP_DOMAIN?>public/js/docNavDropdown.js"></script>
<?php $this->end(); ?>