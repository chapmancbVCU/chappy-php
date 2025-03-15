<h1 style="font-size: 50px; text-align: center;">Windows</h1>

## Table of contents
1. [Overview](#overview)
2. [Common](#common)
3. [XAMPP](#xampp)

<br>
<br>

## 1. Overview <a id="overview"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
This guide shows you how to setup this framework on Windows.  There are two ways to achieve this as described below.
1. XAMPP
2. Install only dependencies needed.
<br>

## 2. Common <a id="common"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
#### 1: Install Composer
* A. **Download Composer Installer**  
   - Visit [Composer's official site](https://getcomposer.org/download/) and download the Windows installer.

* B. **Run the Installer**  
   - During installation, ensure it detects `php.exe` in `C:\php`.

* C. **Verify Installation**  
   - Open **Command Prompt** and run:
     ```sh
     composer -V
     ```
   - You should see the Composer version output.

OR
 
Install with Chocolatey
```powershell
choco install nodejs -y
```
<br>

#### 2: Install Node.js and npm
* A. **Download Node.js**  
   - Go to [Node.js official site](https://nodejs.org/).
   - Download and install the **LTS version** (includes npm).

* B. **Verify Installation**  
   - Open **Command Prompt** and check versions:
     ```sh
     node -v
     npm -v
     ```
   - These should return the installed versions.

OR

Install with Chocolatey
```powershell
choco install composer -y
```
#### 3. Install 7zip
Run the following command:
```powershell
choco install 7zip -y
```
<br>

## 3. XAMPP <a id="xampp"></a><span style="float: right; font-size: 14px; padding-top: 15px;">[Table of Contents](#table-of-contents)</span>
#### 1: Setup
* A. Open browser and go to https://www.apachefriends.org/ and download **XAMPP for Windows**.
* B. Select download location and run installer using default options.
* D. If installer requests firewall ports to be open click **Allow**.
* E. Navigate to `C:\xampp\htdocs` in Windows explorer then type cmd in the address bar.
* F. Cone the project:

```powershell
git clone git@github.com:chapmancbVCU/chappy-php.git
```

* G. Run the command:
```powershell
composer run install-project
```

There will be some error messages that can be ignored regarding migrations.

* H. Open the project with your preferred IDE.  We use VScode.
* J. 
