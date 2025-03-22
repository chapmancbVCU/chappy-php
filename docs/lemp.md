<h1 style="font-size: 50px; text-align: center;">LEMP Stack</h1>

## Table of contents
1. [Overview](#overview)
2. [Install System Dependencies](#dependencies)
3. [Install Nginx](#nginx)
4. [Install MySQL/MariaDB](#mysql)
5. [Install PHP 8.4](#php)
6. [Configure Nginx and PHP-FPM](#configure-nginx-php)
7. [Install phpMyAdmin](#phpMyAdmin)
8. [Install Composer](#composer)
9. [Install Node.js & NPM](#nodejs)
10. [Project Setup](#project-setup)
11. [Troubleshooting](#troubleshooting)
12. [References](#references)
<br>
<br>

## 1. Overview <a id="overview"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
This guide walks through setting up a LEMP stack (Linux, Nginx, MySQL/MariaDB, PHP) on Ubuntu (22.04 LTS), Debian (LMDE), and RHEL (Rocky Linux) for deploying PHP applications, including the Chappy.php framework.

**Requirements**
- Nginx
- PHP 8.3+
- MySQL or MariaDB
- Composer
- Node.js & NPM
- Git (for cloning the repository)
<br>

## 2. Install System Dependencies <a id="dependencies"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
First, update your system and install essential dependencies:

**Ubuntu & Debian**
```sh
sudo apt update && sudo apt upgrade -y
sudo apt install -y curl wget git unzip software-properties-common net-tools
```
<br>

**Rocky Linux (RHEL-based)**
```sh
sudo dnf install -y epel-release
sudo dnf update -y
sudo dnf install -y curl wget git unzip net-tools
```
<br>

## 3. Install Nginx <a id="nginx"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
### A. Install Nginx and enable it to start on boot:
**Ubuntu and Debian**
```sh
sudo apt install -y nginx
sudo systemctl enable nginx
sudo systemctl start nginx
```
<br>

**Rocky Linux (RHEL-based)**
```sh
sudo dnf install -y nginx
sudo systemctl enable nginx
sudo systemctl start nginx
```
<br>

### B. Verify Nginx is Running
To confirm that Nginx is running:
```sh
systemctl status nginx
```
<br>

The default page for Nginx should be accessible at:
```rust
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
<br>

To install MariaDB (Recommended for Debian):
```sh
sudo apt install -y mariadb-server
sudo systemctl enable mariadb
sudo systemctl start mariadb
```
<br>

**Rocky Linux (RHEL-based)**

To install MySQL:
```sh
sudo dnf install -y https://dev.mysql.com/get/mysql80-community-release-el8-1.noarch.rpm
sudo dnf install -y mysql-server
sudo systemctl enable mysqld
sudo systemctl start mysqld
```
<br>

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

- ✅ MySQL: Type n unless you want strict password rules. Choosing y might cause errors (e.g., ERROR 1819 (HY000)) during tools like phpMyAdmin setup.
- ✅ MariaDB: This step may not appear. If it does, it’s safe to disable it (n) for local or development use.
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

- MySQL (Ubuntu/Debian): Skipped if `auth_socket` is enabled.
- MySQL (RHEL-based): You must set a password.
- ✅ MariaDB (All distros): You’ll be asked even if a password is already set. Choose `n` if you already have it protected with a password or socket.

#### 3. Switch to unix_socket Authentication (MariaDB Only)
```sh
Switch to unix_socket authentication [Y/n]
```
- ✅ MariaDB on Debian/Ubuntu: Choose `n` if you want to use password authentication (especially for phpMyAdmin compatibility).
- Choose `y` only if you're confident with CLI-only login and not using GUI tools like phpMyAdmin.

#### 4. Remove Anonymous Users
- You’ll see this prompt:
```rust
Remove anonymous users? (Press y|Y for Yes, any other key for No) :
```
- Type `Y` and press **Enter** to improve security.

#### 5. Disable Remote Root Login
- You’ll see this prompt:
```rust
Disallow root login remotely? (Press y|Y for Yes, any other key for No) :
```
- Type `Y` and press **Enter** to prevent unauthorized remote access.

#### 6. Remove the Test Database
- You'll see:
```rust
Remove test database and access to it? (Press y|Y for Yes, any other key for No) :
```
- Type `Y` and press **Enter**.

#### 7. Reload Privilege Tables
- Finally, MySQL will ask:
```rust
Reload privilege tables now? (Press y|Y for Yes, any other key for No) :
```
- Type `Y` and press **Enter** to apply all changes.

#### 8. Secure Installation Complete
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
### A. Ubuntu
```sh
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update && sudo apt upgrade -y
sudo apt install -y php8.4 php8.4-cli php8.4-fpm php8.4-mbstring php8.4-xml php8.4-curl php8.4-zip php8.4-mysql php8.4-sqlite3 sqlite3 php8.4-bcmath
```

Enable and start PHP-FPM:
```sh
sudo systemctl enable php8.4-fpm
sudo systemctl start php8.4-fpm
```
<br>

### B. Debian
#### 1. Add the SURY repository (trusted PHP repo for Debian)
```sh
sudo apt install -y lsb-release apt-transport-https ca-certificates wget gnupg2
```

Then import the GPG key:
```sh
wget -qO - https://packages.sury.org/php/apt.gpg | sudo tee /etc/apt/trusted.gpg.d/php.gpg >/dev/null
```

Now add the repo to your sources list:
```sh
echo "deb https://packages.sury.org/php/ bookworm main" | sudo tee /etc/apt/sources.list.d/php.list
```

#### 2. Update and install PHP 8.3
```sh
sudo apt update
sudo apt install -y php8.3 php8.3-cli php8.3-fpm php8.3-mysql php8.3-curl php8.3-zip php8.3-mbstring php8.3-xml php8.3-bcmath php8.3-soap php8.3-intl php8.3-readline php8.3-sqlite3 sqlite3
```
<br>

### C. Rocky Linux (RHEL-based)
```sh
sudo dnf install -y https://rpms.remirepo.net/enterprise/remi-release-9.rpm
sudo dnf module list php                    # Optional: list available versions
sudo dnf module enable php:remi-8.4 -y      # Enable PHP 8.4 from Remi
sudo dnf install -y php php-cli php-fpm php-mbstring php-xml php-curl php-zip php-mysqlnd php-bcmath php-json php-gd php-opcache php-intl php-pear php-soap
```

Enable and start PHP-FPM:
```sh
sudo systemctl enable php-fpm
sudo systemctl start php-fpm
```
<br>

### C. Verify installation:
```sh
php -v
```
<br>

## 6. Configure Nginx and PHP-FPM <a id="configure-nginx-php"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
### A. Configure PHP-FPM
PHP-FPM (FastCGI Process Manager) allows Nginx to process PHP scripts.

**Ubuntu**
```sh
sudo systemctl enable php8.4-fpm
sudo systemctl start php8.4-fpm
```
<br>

**Debian**
```sh
sudo systemctl enable php8.3-fpm
sudo systemctl start php8.3-fpm
```
<br>

**Rocky Linux (RHEL-based)**
```sh
sudo systemctl enable php-fpm
sudo systemctl start php-fpm
```
<br>

### B. Configure Nginx Server Block
Create a new configuration file:
**Ubuntu & Debian**
```sh
sudo vi /etc/nginx/sites-available/chappy-php
```
<br>

**Rocky Linux (RHEL-based)**
```sh
sudo vi /etc/nginx/conf.d/chappy-php.conf
```
<br>

Paste the following content (replace server_domain_or_IP with your IP address or domain name):
```rust
server {
    listen 80;
    server_name server_domain_or_IP;
    root /var/www/chappy-php;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    index index.html index.htm index.php;

    charset utf-8;

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Enable site on Ubuntu/Debian:
```sh
sudo ln -s /etc/nginx/sites-available/chappy-php /etc/nginx/sites-enabled/
```

Then test the configuration and reload Nginx:
```sh
sudo nginx -t
sudo systemctl reload nginx
```
<br>

### C. Test PHP
Create a test file:
```sh
echo "<?php phpinfo(); ?>" | sudo tee /var/www/chappy-php/info.php
```

Open in a browser:
```rust
http://localhost/info.php
```

Remove the file after testing:
```sh
sudo rm /var/www/chappy-php/info.php
```
<br>

### D. Configure Upload Size (for Profile Image Support):

**Ubuntu & Debian**
```sh
sudo vi /etc/php/8.4/fpm/php.ini

```
<br>

**Rocky Linux (RHEL-based)**
```sh
sudo vi /etc/php.ini
```

Then modify the setting
```rust
upload_max_filesize = 2M
```

to a value appropriate for your needs.  We set it to `10M`.

Then restart PHP-FPM:

**Ubuntu & Debian**
```sh
sudo systemctl restart php8.4-fpm
```
<br>
**Rocky Linux (RHEL-based)**
```sh
sudo systemctl restart php-fpm
```
<br>
<br>

## 7. Install phpMyAdmin <a id="phpMyAdmin"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
phpMyAdmin provides a web interface to manage MySQL or MariaDB databases.
### A. Install phpMyAdmin
**Ubuntu & Debian**
```sh
sudo apt install -y phpmyadmin
```
When prompted:
- Do not select a web server (Nginx is not listed).
- Choose Yes to configure dbconfig-common and create the phpMyAdmin database.
- Set a phpMyAdmin password or leave it blank to auto-generate.
<br>

**Rocky Linux (RHEL-based)**
```sh
sudo dnf install -y phpmyadmin
```
<br>

### B. Configure Nginx to Serve phpMyAdmin
Symlink phpMyAdmin into your Nginx-accessible root path:
```sh
sudo ln -s /usr/share/phpmyadmin /var/www/phpmyadmin
```

Then edit your Nginx config:
```sh
sudo vi /etc/nginx/sites-enabled/chappy-php
```

Add the following inside the `server {}` block:
```rust
location /phpmyadmin {
    root /var/www;
    index index.php index.html index.htm;

    location ~ ^/phpmyadmin/(.+\.php)$ {
        try_files $uri =404;
        root /var/www;
        fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~* ^/phpmyadmin/(.+\.(jpg|jpeg|gif|css|png|js|ico|html|xml|txt))$ {
        root /var/www;
    }
}
```
If you're using a custom root path like /var/www/chappy-php, adjust root accordingly.

Reload Nginx to apply the config:
```sh
sudo systemctl reload nginx
```
<br>

### C. Verify phpMyAdmin Installation
Open your browser and visit:
```rust
http://localhost/phpmyadmin
```

Log in using:
- **Username**: root
- **Password**: (set during MySQL/MariaDB setup)
⚠️ If you're using `auth_socket`, see Section 4F to switch to mysql_native_password.
<br>
<br>

### D. Setup Your Database
* In the left panel click on the **New** link.
* In the main panel under **Create Database** enter the name for your database.  This will be the database you will set to `DB_DATABASE` in your `.env` file.
* Click create.

<br>

## 8. Install Composer <a id="composer"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Composer is required to manage PHP dependencies.
### A. Download and Install Composer
```sh
cd ~/
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```
<br>

### B. Verify Installation
```sh
composer -v
```
<br>

## 9. Install Node.js & NPM <a id="nodejs"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Use NodeSource to install the latest stable Node.js version.
### A. Add Node.js Repository
**Ubuntu and Debian**
```sh
sudo apt install -y ca-certificates     # On minimal OS installs
curl -fsSL https://deb.nodesource.com/setup_lts.x | sudo -E bash -
```
<br>

**Rocky Linux (RHEL-based)**
```sh
# ca-certificates on minimal OS installs
rpm -q ca-certificates || sudo dnf install -y ca-certificates
curl -fsSL https://rpm.nodesource.com/setup_lts.x | sudo bash -
```
<br>

### B. Install Node.js & NPM
**Ubuntu**
```sh
sudo apt install -y nodejs
```
<br>

**Rocky Linux (RHEL-based)**
```sh
sudo dnf install -y nodejs
```
<br>

### C. Verify Installation
```sh
node -v
npm -v
```
<br>

## 10. Project Setup <a id="project-setup"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
### A. Navigate to your user's root directory, install dependencies, then move to final location:
```sh
git clone git@github.com:chapmancbVCU/chappy-php.git
cd chappy-php/
composer run install-project
cd ..
sudo mv chappy-php /var/www
cd /var/www/chappy-php
```
<br>

### B. Set proper permissions:
**Ubuntu**
```sh
sudo chown -R your-username:www-data /var/www/chappy-php
sudo chmod -R 755 /var/www/chappy-php
```
<br>

**Rocky Linux (RHEL-based)**
```sh
sudo chown -R your-username:nginx /var/www/chappy-php 
sudo chmod -R 755 /var/www/chappy-php
```
<br>

### C. Project Configuration
Open your preferred IDE (We use VSCode) and edit the `.env` file:
- Set `APP_DOMAIN` TO `/`.
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

<br>

### D. Update /etc/hosts (For Custom Domain)
If you want to access your site using http://chappyphp.local, you can edit your /etc/hosts file:
```sh
sudo vi /etc/hosts
```

Example configuration:
```rust
127.0.0.1       localhost chappyphp.local
127.0.1.1       ubuntu-vm
your_ip_addr    chappyphp.local
```

Now, http://chappyphp.local will work as expected.

<br>

### E. Enable the Site:
Restart Nginx After Modifying Server Block or /etc/hosts:
```sh
sudo systemctl restart nginx
```

**See Section D in Troubleshooting if you are having issues with Rocky Linux (RHEL)**

<br>

**Rocky Linux (RHEL-based)**
#### 1. Fix SELinux Contexts for Nginx
Allow Nginx to read and serve content from your project directory:
```sh
sudo chcon -Rt httpd_sys_content_t /var/www/chappy-php
```

Also apply recursively to any .htaccess, uploads, or views:
```sh
sudo restorecon -Rv /var/www/chappy-php
```

#### 2. Allow Nginx to Write and Connect (If Needed)
Run these SELinux booleans if your app writes to disk (e.g., for logs/uploads) or needs outbound network access:
```sh
sudo setsebool -P httpd_unified 1
sudo setsebool -P httpd_can_network_connect 1
sudo setsebool -P httpd_enable_homedirs 1
```

#### 3. Set the Correct SELinux Context for Writable Log Files and to Storage:
Step 1: Apply the Right Context:
```sh
sudo chcon -R -t httpd_sys_rw_content_t /var/www/chappy-php/storage
```

Step 2: Make it Persistent (Survives Reboots):
```sh
sudo semanage fcontext -a -t httpd_sys_rw_content_t "/var/www/chappy-php/storage(/.*)?"
sudo restorecon -Rv /var/www/chappy-php/storage
```
📁 If you’re using other writable paths, repeat these steps for those as well.

#### 4. Add Firewalld Rules for Nginx
```sh
sudo firewall-cmd --permanent --add-service=http
sudo firewall-cmd --permanent --add-service=https
sudo firewall-cmd --reload
```

Now restart Nginx:
```sh
sudo systemctl restart nginx
```
<br>

### F. Final Steps
Set permissions for storage directory (This will enable writing to logs and uploads):
```sh
sudo chmod -R 775 storage/
```

Run migrations:
```sh
php console migrate
```

Your project should now be accessible at:
```rust
http://<your_ip_address>
```
<br>

## 11. Troubleshooting <a id="troubleshooting"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
### A. Common Issues:
- ERROR 1819 (HY000) during phpMyAdmin installation → Your password does not meet MySQL’s policy. Disable VALIDATE PASSWORD or use a strong password.
- mysql_secure_installation skips root password setup on Ubuntu/Debian → Run:
```sh
sudo mysql
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'your-password';
FLUSH PRIVILEGES;
```
<br>

### B. SELinux Permissions for phpMyAdmin (Rocky Linux)
Since `phpMyAdmin` is installed via `dnf` on Rocky Linux, SELinux might block it from reading `/var/www/phpmyadmin`.

🔹 Fix:
If users get 403 Forbidden on phpMyAdmin, they need to run:
```sh
sudo chcon -R -t httpd_sys_content_t /usr/share/phpmyadmin
sudo semanage fcontext -a -t httpd_sys_content_t "/usr/share/phpmyadmin(/.*)?"
sudo restorecon -Rv /usr/share/phpmyadmin
```
<br>

### C. MySQL 8 Authentication in Rocky Linux
If `mysql_secure_installation` doesn't ask for a password, users may need to set one manually:
```sh
sudo mysql
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'your-secure-password';
FLUSH PRIVILEGES;
EXIT;
```