<h1 style="font-size: 50px; text-align: center;">Linux PHP Standalone</h1>

## Table of contents
1. [Overview](#overview)
2. [Install System Dependencies](#dependencies)
3. [Install PHP 8.3+](#php)
4. [Install Composer](#composer)
5. [Install Node.js &  NPM](#nodejs)
6. [Project Setup](#project-setup)
<br>
<br>

## 1. Overview <a id="overview"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
This guide walks through setting up your the Chappy.php framework on Ubuntu (22.04 LTS), Debian (LMDE), and RHEL (Rocky Linux 9) based distributions without requiring XAMPP, Nginx, or Apache. The framework is self-hosted using PHP’s built-in development server (php console serve).

**Requirements**
- PHP 8.3+
- Composer
- Node.js & NPM
- Git (for cloning the repository)
<br>

## 2. Install System Dependencies <a id="dependencies"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
First, update your system and install essential dependencies:
**RHEL**
```sh
sudo dnf update -y
sudo dnf install -y curl wget git unzip
```

**Ubuntu**
```sh
sudo apt update && sudo apt upgrade -y
sudo apt install -y curl wget git unzip software-properties-common
```
<br>

## 3. Install PHP 8.3+ <a id="php"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
**RHEL**
```sh
sudo dnf install -y epel-release
sudo dnf install -y https://rpms.remirepo.net/enterprise/remi-release-9.rpm
sudo dnf module list php                    # List available PHP modules
sudo dnf module enable php:remi-8.3 -y      # Enabled PHP 8.3 from Remi repo
sudo dnf install -y php php-cli php-mbstring php-xml php-curl php-zip php-sqlite3 php-bcmath
```

**Ubuntu**
```sh
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
sudo apt install -y php8.3 php8.3-cli php8.3-mbstring php8.3-xml php8.3-curl php8.3-zip php8.3-sqlite3 php8.3-bcmath
```

Verify installation:
```sh
php -v
```
<br>

## 4. Install Composer <a id="composer"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Composer is required to manage PHP dependencies.
#### 1: Download and Install Composer
**RHEL**
```sh
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

**Ubuntu**
```sh
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

#### 2: Verify Installation
```sh
composer -v
```
<br>

## 5. Install Node.js & NPM <a id="nodejs"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Use NodeSource to install the latest stable Node.js version.
#### 1: Add Node.js Repository
**RHEL**
```sh
curl -fsSL https://rpm.nodesource.com/setup_lts.x | sudo bash -
```

**Ubuntu**
```sh
curl -fsSL https://deb.nodesource.com/setup_lts.x | sudo -E bash -
```

#### 2: Install Node.js & NPM
**RHEL**
```sh
sudo dnf install -y nodejs
```

**Ubuntu**
```sh
sudo apt install -y nodejs
```

#### 3: Verify Installation
```sh
node -v
npm -v
```

## 6. Project Setup <a id="project-setup"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
Navigate to your preferred development directory and clone the project:
#### 1. Cloning The Project
```sh
cd ~/projects
git clone git@github.com:chapmancbVCU/chappy-php.git
cd chappy-php
```

#### 2. Install
Run:
```sh
composer run install-project
```

#### 3. Run Project
* A. Run:
```sh
php console serve
```

* B. Navigate to `http://localhost:8000`