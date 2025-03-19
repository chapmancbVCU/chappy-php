<h1 style="font-size: 50px; text-align: center;">LAMP Stack</h1>

## Table of contents
1. [Overview](#overview)
2. [Install System Dependencies](#dependencies)
3. [Install Apache](#apache)
4. [Install MySQL/MariaDB](#mysql)
5. [Install PHP 8.3+](#php)
6. [Configure Apache and PHP](#configure-apache-php)
7. [Install phpMyAdmin](#phpMyAdmin)
8. [Install Composer](#composer)
9. [Install Node.js & NPM](#nodejs)
10. [Project Setup](#project-setup)
<br>
<br>

## 1. Overview <a id="overview"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
This guide walks through setting up a LAMP stack (Linux, Apache, MySQL/MariaDB, PHP) on Ubuntu (22.04 LTS) for deploying PHP applications, including the Chappy.php framework.

**Requirements**
- Apache 2.x
- PHP 8.3+
- MySQL or MariaDB
- Composer
- Node.js & NPM
- Git (for cloning the repository)
<br>

## 2. Install System Dependencies <a id="dependencies"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
First, update your system and install essential dependencies:

**Ubuntu**
```sh
sudo apt update && sudo apt upgrade -y
sudo apt install -y curl wget git unzip software-properties-common
```
<br>

## 3. Install Apache <a id="apache"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
#### A. Install Apache and enable it to start on boot:
**Ubuntu**
```sh
sudo apt install -y apache2
sudo systemctl enable apache2
sudo systemctl start apache2
```

#### B. Verify Apache is running:
**Ubuntu**
```sh
systemctl status apache 2
```

#### C. Apache should now be accessible at:
```
http://localhost
```
<br>

## 4. Install MySQL/MariaDB <a id="mysql"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
**Ubuntu**
For MySQL:
```sh
sudo apt install -y mysql-server
sudo systemctl enable mysql
sudo systemctl start mysql
```

For MariaDB:
```sh
sudo apt install -y mariadb-server
sudo systemctl enable mariadb
sudo systemctl start mariadb
```

Verify installation:
```sh
mysql -V
```
<br>

### **Steps for Running** `mysql_secure_installation`
#### A. Run the command:
```sh
sudo mysql_secure_installation
```

#### B. Set or Change the Root Password (For MySQL 8+)
- If you haven’t set a root password yet, it will ask you to set one.
- If a password is already set, enter the current root password.
- For MySQL 8+, the default authentication plugin is auth_socket, which means the root user may not have a password set.
- You may be prompted:
```rust
Would you like to set up a root password? [Y/n]
```
Type `Y` and press **Enter**, then enter a strong password.

#### C. Remove Anonymous Users
- You’ll see this prompt:
```rust
Remove anonymous users? (Press y|Y for Yes, any other key for No) :
```
- Type `Y` and press **Enter** to improve security.

#### D. Disable Remote Root Login
- You’ll see this prompt:
```rust
Disallow root login remotely? (Press y|Y for Yes, any other key for No) :
```
- Type `Y` and press **Enter** to prevent unauthorized remote access.

#### E. Remove the Test Database
- You'll see:
```rust
Remove test database and access to it? (Press y|Y for Yes, any other key for No) :
```
- Type `Y` and press **Enter**.

#### F. Reload Privilege Tables
- Finally, MySQL will ask:
```rust
Reload privilege tables now? (Press y|Y for Yes, any other key for No) :
```
- Type `Y` and press **Enter** to apply all changes.

#### G. Secure Installation Complete
- You should see a message like:
```rust
All done! If you've completed all of the above steps, your MySQL installation should now be secure.
```
<br>

### **Verify MySQL is Secure**
After running `mysql_secure_installation`, you can verify your settings by logging in:
```sh
sudo mysql -u root -p
```
- If prompted, enter the **root password** you set earlier.
- Run this SQL command to check users:
```sql
SELECT user, host FROM mysql.user;
```
- Ensure that root@localhost exists and that anonymous users were removed.
<br>
<br>

### **For MariaDB Users**
- The process is almost identical, except that MariaDB may not require a root password by default.
- If you’re using MariaDB and sudo mysql -u root logs in without asking for a password, you may need to manually set a root password:
```sql
ALTER USER 'root'@'localhost' IDENTIFIED BY 'your-secure-password';
FLUSH PRIVILEGES;
```
<br>

### **Ubuntu Specific Considerations**
You will see the following message when running the `mysql_secure_installation` script:
```rust
Securing the MySQL server deployment.

Connecting to MySQL using a blank password.

VALIDATE PASSWORD COMPONENT can be used to test passwords
and improve security. It checks the strength of password
and allows the users to set only those passwords which are
secure enough. Would you like to setup VALIDATE PASSWORD component?

Press y|Y for Yes, any other key for No: y

There are three levels of password validation policy:

LOW    Length >= 8
MEDIUM Length >= 8, numeric, mixed case, and special characters
STRONG Length >= 8, numeric, mixed case, special characters and dictionary                  file

Please enter 0 = LOW, 1 = MEDIUM and 2 = STRONG: 0

Skipping password set for root as authentication with auth_socket is used by default.
If you would like to use password authentication instead, this can be done with the "ALTER_USER" command.
See https://dev.mysql.com/doc/refman/8.0/en/alter-user.html#alter-user-password-management for more information.
```

**How to Switch MySQL Root to Password Authentication**
If you want to **use a password for the root user instead of auth_socket**, follow these steps:
#### A. Log into MySQL as Root
Since `auth_socket` is enabled, use **sudo** to access MySQL without a password:
```sh
sudo mysql
```

#### B. Check Current Authentication Method
Run this SQL command:
```sql
SELECT user, host, plugin FROM mysql.user;
```

You should see `root@localhost` using **auth_socket**, like this:
```sql
+------+-----------+-------------+
| user | host     | plugin      |
+------+-----------+-------------+
| root | localhost | auth_socket |
+------+-----------+-------------+
```

#### C. Change Root to Use Password Authentication
To switch from `auth_socket` to `mysql_native_password`, run:
```sql
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'your-secure-password';
FLUSH PRIVILEGES;
```

#### D. Verify the Change
Run the authentication check again:
```sql
SELECT user, host, plugin FROM mysql.user;
```
It should now show `mysql_native_password` instead of `auth_socket`.

#### E. Exit and Test
Exit MySQL:
```sql
EXIT;
```

Now try logging in with your new password:
```sh
mysql -u root -p
```
<br>

### **Final Notes**
- For production servers, always use a strong root password and disable remote root login.
- If you forget your MySQL root password, you’ll need to reset it manually via mysqld_safe mode.

<br>

## 5. Install PHP 8.3+ <a id="php"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
**Ubuntu**
```sh
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
sudo apt install -y php8.3 php8.3-cli php8.3-mbstring php8.3-xml php8.3-curl php8.3-zip php8.3-mysql libapache2-mod-php8.3 php8.4-xml
```

Verify installation:
```sh
php -v
```
<br>

## 6. Configure Apache and PHP <a id="config-apache-php"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Restart Apache to apply PHP settings:
```sh
sudo systemctl restart apache2
```

Test PHP:
- Create a test file:
```sh
echo "<?php phpinfo(); ?>" | sudo tee /var/www/html/info.php
```

- Open in a browser:
```rust
http://localhost/info.php
```

- Remove the file after testing:
```sh
sudo rm /var/www/html/info.php
```
<br>
<br>

## 7. Install phpMyAdmin <a id="phpMyAdmin"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
phpMyAdmin provides a web interface to manage MySQL or MariaDB databases.
#### A. Install phpMyAdmin
```sh
sudo apt install -y phpmyadmin
```

During installation:
- Select Apache2 when prompted.
- Choose Yes to configure dbconfig-common for automatic database setup.
- Set a phpMyAdmin password (or leave blank to generate one).

#### B. Configure Apache for phpMyAdmin
Enable phpMyAdmin in Apache:
```sh
sudo ln -s /usr/share/phpmyadmin /var/www/html/phpmyadmin
sudo systemctl restart apache2
```

#### C. Verify phpMyAdmin Installation
Open your browser and visit:
```rust
http://localhost/phpmyadmin
```

Log in using:
- **Username**: root
- **Password**: (set during MySQL/MariaDB setup)
If you used **auth_socket authentication**, switch root to password authentication as described earlier.

#### D. Setup Your Database
* In the left panel click on the **New** link.
* E. In the main panel under **Create Database** enter the name for your database.  This will be the database you will set to `DB_DATABASE` in your `.env` file.
* F. Click create.
<br>

## 8. Install Composer <a id="composer"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Composer is required to manage PHP dependencies.
#### A. Download and Install Composer
```sh
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

#### B. Verify Installation
```sh
composer -v
```
<br>

## 9. Install Node.js & NPM <a id="nodejs"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Use NodeSource to install the latest stable Node.js version.
#### A. Add Node.js Repository
**Ubuntu**
```sh
curl -fsSL https://deb.nodesource.com/setup_lts.x | sudo -E bash -
```

#### B. Install Node.js & NPM
**Ubuntu**
```sh
sudo apt install -y nodejs
```

#### C. Verify Installation
```sh
node -v
npm -v
```
<br>

## 10. Project Setup <a id="project-setup"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Navigate to your your root directory:
```sh
cd ~/
sudo git clone git@github.com:chapmancbVCU/chappy-php.git
sudo mv chappy-php /var/www/html
cd var/www/html/chappy-php
```

Set proper permissions:
```sh
sudo chown -R your-username:www-data /var/www/html/chappy-php
sudo chmod -R 755 /var/www/html/chappy-php
```
Open your preferred IDE (We use VSCode) and edit the `.env` file:
- Set `APP_DOMAIN` TO `http://localhost/chappy-php/`.  If you renamed your project directory then the second portion of the URL must match.  The URL must have the last forward slash.  Otherwise, the page and routing will not work correctly.
- Update the database section:
```php
# Set to mysql or mariadb for production
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
# Set to your database name for production
DB_DATABASE=your_db_name
DB_USER=root
DB_PASSWORD=your_password
```
**Use a user other than `root` on a production environment**

Install dependencies:
```sh
composer run install-project
```

Restart Apache:
```sh
sudo systemctl restart apache2
```

Your project should now be accessible at:
```rust
http://localhost/chappy-php/
```
