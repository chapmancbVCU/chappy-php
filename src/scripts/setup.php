#!/usr/bin/env php
<?php

// 1️⃣ Determine the project root dynamically (if inside src/scripts/)
$projectRoot = dirname(__DIR__, 2); // Go up two levels from 'src/scripts'
chdir($projectRoot); // Ensure we run from the project root

echo "🚀 Setting up the project at: $projectRoot\n";

// 2️⃣ Check if Composer is installed
$composerExists = shell_exec('composer --version');
if (!$composerExists) {
    echo "❌ Composer is not installed. Please install Composer and run this script again.\n";
    exit(1);
}

// 3️⃣ Install Composer dependencies (if vendor folder is missing)
if (!is_dir("vendor")) {
    echo "📦 Running 'composer install'...\n";
    system("composer install --no-interaction");
} else {
    echo "✅ Dependencies are already installed. Skipping 'composer install'.\n";
}

// 🔟 Generate .env file (if missing) **BEFORE LOADING PHPDOTENV**
$envFile = '.env';
if (!file_exists($envFile)) {
    if (file_exists('.env.example')) {
        copy('.env.example', $envFile);
        echo "✅ Copied .env.example to .env\n";
    } else {
        echo "⚠️ Warning: .env.example not found. Creating a blank .env file.\n";
        touch($envFile);
    }
}

// 4️⃣ Require Composer autoloader **AFTER ensuring .env exists**
require_once "vendor/autoload.php";

use Dotenv\Dotenv;

// 5️⃣ Load environment variables safely
$dotenv = Dotenv::createImmutable($projectRoot);
$dotenv->load();

echo "✅ Loaded environment variables.\n";

// 6️⃣ Check if Node.js and npm are installed
$npmExists = shell_exec('npm --version');
if (!$npmExists) {
    echo "⚠️ Warning: Node.js (npm) is not installed. Skipping npm install.\n";
} else {
    // Install Node dependencies (if node_modules folder is missing)
    if (!is_dir("node_modules")) {
        echo "📦 Running 'npm install'...\n";
        system("npm install");
    } else {
        echo "✅ Node dependencies are already installed. Skipping 'npm install'.\n";
    }
}

// 7️⃣ Remove .git directory (for fresh installs)
if (is_dir('.git')) {
    echo "🗑 Removing Git repository...\n";
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        system('rmdir /s /q .git');
    } else {
        system('rm -rf .git');
    }
    echo "✅ Git repository removed.\n";
}

// 8️⃣ Initialize a new Git repository
echo "🔄 Initializing a new Git repository...\n";
system("git init");
system("git add .");
system("git commit -m 'Initial commit'");
echo "✅ New Git repository initialized.\n";

// 9️⃣ Create necessary directories
$directories = [
    'storage/app/private/profile_images',
    'storage/logs',
    'database'
];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
        echo "📂 Created directory: $dir\n";
    }
}

// 🔟 Set permissions (Linux/macOS only)
if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
    chmod('storage', 0777);
    chmod('storage/logs', 0777);
    chmod('database', 0777);
    echo "🔧 Set permissions for storage, logs, and database directories.\n";
}

// 1️⃣1️⃣ Create SQLite database file if it doesn't exist
$sqliteFile = 'database/database.sqlite';
if (!file_exists($sqliteFile)) {
    touch($sqliteFile);
    echo "📄 Created SQLite database file: $sqliteFile\n";
} else {
    echo "✅ SQLite database file already exists.\n";
}

// 1️⃣2️⃣ Generate random keys for security
$appKey = 'base64:' . base64_encode(random_bytes(32));
$cookieSecret = bin2hex(random_bytes(32));
$sessionSecret = bin2hex(random_bytes(32));

//  🔄 Update .env file with generated keys
$envContents = file_get_contents($envFile);
$envContents = preg_replace('/^APP_KEY=.*$/m', "APP_KEY={$appKey}", $envContents);
$envContents = preg_replace('/^CURRENT_USER_SESSION_NAME=.*$/m', "CURRENT_USER_SESSION_NAME={$cookieSecret}", $envContents);
$envContents = preg_replace('/^REMEMBER_ME_COOKIE_NAME=.*$/m', "REMEMBER_ME_COOKIE_NAME={$sessionSecret}", $envContents);
file_put_contents($envFile, $envContents);

echo "🔑 Generated APP_KEY: $appKey\n";
echo "🔑 Generated CURRENT_USER_SESSION_NAME: $cookieSecret\n";
echo "🔑 Generated REMEMBER_ME_COOKIE_NAME: $sessionSecret\n";

// 1️⃣3️⃣ Run database migrations
echo "⚙️ Running database migrations...\n";
$migrateCommand = "php console migrate";
$migrateOutput = shell_exec($migrateCommand);

if ($migrateOutput) {
    echo "✅ Migrations completed successfully.\n";
} else {
    echo "❌ Migration process failed. Check your database connection.\n";
}

// 1️⃣4️⃣ Final instructions
echo "✅ Setup complete!\n";
echo "➡️ Run: git add .\n";
echo "➡️ Run: git commit -m \"Initial commit\"\n";
echo "➡️ Set git to origin: git remote add origin https://github.com/YOUR_GITHUB_USERNAME/YOUR_REPO_NAME.git\n";
echo "➡️ Run: php console serve\n";
echo "🌍 Open your project at: http://localhost:8000\n";
exit(0);
