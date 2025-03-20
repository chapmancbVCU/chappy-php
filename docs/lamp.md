<h1 style="font-size: 50px; text-align: center;">LAMP Stack</h1>

## Table of contents
1. [Overview](#overview)
2. [Install System Dependencies](#dependencies)
3. [Install Apache](#apache)
4. [Install MySQL/MariaDB](#mysql)
5. [Install PHP 8.4](#php)
6. [Configure Apache and PHP](#configure-apache-php)
7. [Install phpMyAdmin](#phpMyAdmin)
8. [Install Composer](#composer)
9. [Install Node.js & NPM](#nodejs)
10. [Project Setup](#project-setup)
11. [Troubleshooting](#troubleshooting)
13. [References](#references)
<br>
<br>

## 1. Overview <a id="overview"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
This guide walks through setting up a LAMP stack (Linux, Apache, MySQL/MariaDB, PHP) on Ubuntu (22.04 LTS), Debian (LMDE), and RHEL (Rocky Linux) for deploying PHP applications, including the Chappy.php framework.

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
sudo apt install -y curl wget git unzip software-properties-common net-tools
```
<br>

## 3. Install Apache <a id="apache"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
### A. Install Apache and enable it to start on boot:
**Ubuntu**
```sh
sudo apt install -y apache2
sudo systemctl enable apache2
sudo systemctl start apache2
```

### B. Verify Apache is running:
**Ubuntu**
```sh
systemctl status apache2
```

### C. Apache should now be accessible at:
```
http://localhost
```
<br>

## 4. Install MySQL/MariaDB <a id="mysql"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
This section will guide you through installing MySQL or MariaDB, configuring it securely, and verifying the installation.

### A. Install MySQL or MariaDB
Depending on your Linux distribution, install either MySQL or MariaDB using the following instructions.

**Ubuntu & Debian**
To install MySQL:
```sh
sudo apt install -y mysql-server
sudo systemctl enable mysql
sudo systemctl start mysql
```

To install MariaDB:
```sh
sudo apt install -y mariadb-server
sudo systemctl enable mariadb
sudo systemctl start mariadb
```

**Rocky Linux (RHEL-based)**
To install MySQL:
```sh
sudo dnf install -y @mysql
sudo systemctl enable mysqld
sudo systemctl start mysqld
```

To install MariaDB:
```sh
sudo dnf install -y mariadb-server
sudo systemctl enable mariadb
sudo systemctl start mariadb
```
**Verify MySQL/MariaDB Installation**
Run the following command to check the installed version:
```sh
mysql -V
```
<br>

### B. Secure MySQL/MariaDB Using `mysql_secure_installation`
Run the mysql_secure_installation script to secure your database by setting a root password and removing default insecure settings.

**Ubuntu/Debian (MySQL 8+)**
```sh
sudo mysql_secure_installation
```

- MySQL 8+ on Ubuntu/Debian defaults to auth_socket authentication, meaning the root user does NOT need a password to log in locally.
- The root password setup step may be skipped during the process.

**Rocky Linux (RHEL-based)**
```sh
sudo mysql_secure_installation
```

- MySQL on Rocky Linux requires setting a root password during installation.
<br>

### C. Steps for Running `mysql_secure_installation`
The script will ask a series of security questions. Here's a breakdown of the common prompts and how to respond:
#### 1. VALIDATE PASSWORD COMPONENT (Password Policy)
You will see this message:

```rust
VALIDATE PASSWORD COMPONENT can be used to test passwords
and improve security. It checks the strength of password
and allows the users to set only those passwords which are
secure enough. Would you like to setup VALIDATE PASSWORD component?

Press y|Y for Yes, any other key for No:
```

- Recommended: Type n (No) unless you want strict password rules.

- If you choose y, you must select a password strength level:

```rust
0 = LOW (minimum 8 characters)
1 = MEDIUM (includes numbers, mixed case, special characters)
2 = STRONG (must contain dictionary words + mixed case, numbers, and special characters)
```

Choose `1` for a good balance.

#### 2. Set or Change the Root Password
**Ubuntu/Debian**
- If auth_socket is enabled, this step will be skipped.
- If prompted:
```rust
Would you like to set up a root password? [Y/n]
```

**Rocky Linux (RHEL-based)**
- You must set a root password.
```rust
Would you like to set up a root password? [Y/n]
```

#### 3. Remove Anonymous Users
- You’ll see this prompt:
```rust
Remove anonymous users? (Press y|Y for Yes, any other key for No) :
```
- Type `Y` and press **Enter** to improve security.

#### 4. Disable Remote Root Login
- You’ll see this prompt:
```rust
Disallow root login remotely? (Press y|Y for Yes, any other key for No) :
```
- Type `Y` and press **Enter** to prevent unauthorized remote access.

#### 5. Remove the Test Database
- You'll see:
```rust
Remove test database and access to it? (Press y|Y for Yes, any other key for No) :
```
- Type `Y` and press **Enter**.

#### 6. Reload Privilege Tables
- Finally, MySQL will ask:
```rust
Reload privilege tables now? (Press y|Y for Yes, any other key for No) :
```
- Type `Y` and press **Enter** to apply all changes.

#### 7. Secure Installation Complete
- You should see a message like:
```rust
All done! If you've completed all of the above steps, your MySQL installation should now be secure.
```
<br>

### D. **Verify MySQL is Secure**
After running `mysql_secure_installation`, you can verify your settings by logging in:
```sh
sudo mysql -u root -p
```
- If prompted, enter the **root password** you set earlier.

Run this SQL command to authentication settings:
```sql
SELECT user, host FROM mysql.user;
```
- Ensure that root@localhost exists and that anonymous users were removed.

<br>

### E. **Changing MySQL Authentication (Ubuntu/Debian)**
The step to set root password is skipped in Ubuntu and Debian.
```rust
Skipping password set for root as authentication with auth_socket is used by default.
If you would like to use password authentication instead, this can be done with the "ALTER_USER" command.
See https://dev.mysql.com/doc/refman/8.0/en/alter-user.html#alter-user-password-management for more information.
```
<br>

### F. **How to Switch MySQL Root to Password Authentication (Ubuntu & Debian)**
If you want to **use a password for the root user instead of auth_socket**, follow these steps:
#### 1. Log into MySQL as Root
Since `auth_socket` is enabled, use **sudo** to access MySQL without a password:
```sh
sudo mysql
```

#### 2. Check Current Authentication Method
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

#### 3. Change Root to Use Password Authentication
To switch from `auth_socket` to `mysql_native_password`, run:
```sql
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'your-secure-password';
FLUSH PRIVILEGES;
```

#### 4. Verify the Change
Run the authentication check again:
```sql
SELECT user, host, plugin FROM mysql.user;
```
It should now show `mysql_native_password` instead of `auth_socket`.

#### 5. Exit and Test
Exit MySQL:
```sql
EXIT;
```

Now try logging in with your new password:
```sh
mysql -u root -p
```

#### 6. Final Notes
- For production servers, always use a strong root password and disable remote root login.
- If you forget your MySQL root password, you’ll need to reset it manually via mysqld_safe mode.

<br>

## 5. Install PHP 8.4 <a id="php"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
**Ubuntu**
```sh
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update && sudo apt upgrade -y
sudo apt install -y php8.4 php8.4-cli php8.4-mbstring php8.4-xml php8.4-curl php8.4-zip php8.4-mysql libapache2-mod-php8.4 php8.4-sqlite3 sqlite3 php8.4-bcmath
```

- Verify installation:
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

- Configure upload size For profile image upload support.  Edit the file:
```sh
sudo vi /etc/php/8.4/apache2/php.i
```

- Then modify the setting
```rust
upload_max_size = 2M
```

to a value appropriate for your needs.  We set it to `10M`.
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
- If you have issues regarding **[ERROR 1819 (HY000) during the phpMyAdmin installation indicates that the password you've set doesn't meet MySQL's current policy requirements.]** refer to solutions in troubleshooting section.

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
cd ~/
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
#### A. Navigate to your user's root directory, install dependencies, then move to final location:
```sh
cd ~/
git clone git@github.com:chapmancbVCU/chappy-php.git
cd chappy-php/
composer run install-project
cd ..
sudo mv chappy-php /var/www/html
cd /var/www/html/chappy-php
```

#### B. Set proper permissions:
```sh
sudo chown -R your-username:www-data /var/www/html/chappy-php
sudo chmod -R 755 /var/www/html/chappy-php
```

#### D. Project Configuration
Open your preferred IDE (We use VSCode) and edit the `.env` file:
- Set `APP_DOMAIN` TO `/`.  If you renamed your project directory then the second portion of the URL must match.  The URL must have the last forward slash.  Otherwise, the page and routing will not work correctly.
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

#### E. Apache Virtual Host Configuration
- Run the following command to create a new Apache configuration file:
```sh
sudo vi /etc/apache2/sites-available/chappy-php.conf
```

- Paste the following content into the file (adjust ServerName to your actual IP or domain):

```rust
<VirtualHost *:80>
ServerName 192.168.1.162
ServerAdmin webmaster@thedomain.com
DocumentRoot /var/www/html/chappy-php

<Directory /var/www/html/chappy-php>
    AllowOverride All
    Require all granted
</Directory>

ErrorLog ${APACHE_LOG_DIR}/error.log
CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

- Save and exit (ESC then :wq).

- Enable the Site and Required Modules:

```sh
# Enable mod_rewrite first
sudo a2enmod rewrite

# Then enable the VirtualHost
sudo a2ensite chappy-php.conf
sudo systemctl restart apache2
```

- Set permissions for storage directory (This will enable writing to logs and uploads):
```sh
sudo chmod -R 775 storage/
```

- Run migrations:
```sh
php console migrate
```

- Your project should now be accessible at:
```rust
http://<your_ip_address>
```
<br>

## 10. Troubleshooting <a id="troubleshooting"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>



## 11. References <a id="references"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
A. [How To Install Linux, Apache, MySQL, PHP (LAMP) Stack on Ubuntu - Digital Ocean](https://www.digitalocean.com/community/tutorials/how-to-install-lamp-stack-on-ubuntu#step-2-installing-mysql)
B. [How To Install and Secure phpMyAdmin on Ubuntu - Digital Ocean](https://www.digitalocean.com/community/tutorials/how-to-install-and-secure-phpmyadmin-on-ubuntu)