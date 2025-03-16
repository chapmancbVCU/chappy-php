<h1 style="font-size: 50px; text-align: center;">MacOS</h1>

## Table of contents
1. [Overview](#overview)
2. [Install Homebrew](#homebrew)
3. [Node.js](nodejs)
4. [Without XAMPP](#no-xampp)
<br>
<br>

## 1. Overview <a id="overview"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
This guide shows you how to setup this framework on MacOS.

## 2. Install Homebrew <a id="homebrew"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
* A. If not already installed, setup Homebrew using the command below:
```sh
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
```

* B. Apple Silicon Extra Steps
    - Ensure you run the 3 commands required after the setup process is finished to setup your path.
<br>

## 2. Node.js <a id="nodejs"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
#### 1: Option 1 - Install via Homebrew (Recommended)
* A. Run:
```sh
brew install node
```
<br>

#### 2: Option 2: Install via NVM (Node Version Manager)
This allows you to manage multiple Node.js versions.
* A. Step 1: Install NVM
```sh
brew install nvm
```
<br>

* B. Step 2: Setup NVM
    - Add the following to your ~/.zshrc (or ~/.bashrc if using Bash):
```sh
export NVM_DIR="$HOME/.nvm"
[ -s "/opt/homebrew/opt/nvm/nvm.sh" ] && . "/opt/homebrew/opt/nvm/nvm.sh"
[ -s "/opt/homebrew/opt/nvm/etc/bash_completion" ] && . "/opt/homebrew/opt/nvm/etc/bash_completion"
```

    - Reload shell configuration:
```sh
source ~/.zshrc
```
<br>

* C. Step 3: Install Node.js using NVM
```sh
nvm install --lts
```
<br>

* D. Step 4: Verify installation
    - Run
```sh
node -v
npm -v
```

   - Expected output:
```sh
vXX.XX.X (Node.js version)
X.X.X (NPM version)
```
<br>

## 3. Without XAMPP <a id="XAMPP"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
#### 1: PHP Setup
* A. Step 1: Install PHP
    - Run:
```sh
brew install php
```
<br>

* B. Step 2: Verify install
    - Run:
```sh
php -v
```
<br>

* C: Step 3: Start PHP as a service
    - Run:
```sh
brew services start php
```
<br>

#### 2: Setup Composer
* A. Run:
```sh
brew install composer
```
<br>

* B. Verify install.  Run:
```sh
composer -v
```
<br>

#### 3: Setup and Run Project
* A. Cone the project:
```sh
git clone git@github.com:chapmancbVCU/chappy-php.git
```

* B. cd into project and run the command:
```sh
composer run install-project
```

* C. Open the project with your preferred IDE.  We use VScode.
* D. In the terminal run the command:
```sh
php console serve
```
* E. In a new terminal tab run the command:
```sh
npm run dev
```
* F. Navigate to `localhost:8000` in your preferred web browser.
