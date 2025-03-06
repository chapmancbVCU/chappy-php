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

// 🔟 Ensure .env exists and is populated
$envFile = '.env';
$envSampleFile = '.env.sample'; // Assuming your sample file is named .env.sample

if (!file_exists($envFile)) {
    if (file_exists($envSampleFile)) {
        copy($envSampleFile, $envFile);
        echo "✅ Copied .env.sample to .env\n";
    } else {
        echo "⚠️ Warning: .env.sample not found. Creating a blank .env file with defaults.\n";
        $defaultEnv = <<<EOL
APP_KEY=
CURRENT_USER_SESSION_NAME=
REMEMBER_ME_COOKIE_NAME=
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=my_database
DB_USERNAME=root
DB_PASSWORD=
EOL;
        file_put_contents($envFile, $defaultEnv);
    }
}

// 4️⃣ Require Composer autoloader AFTER ensuring .env exists
require_once "vendor/autoload.php";

use Dotenv\Dotenv;

// 5️⃣ Load environment variables safely
$dotenv = Dotenv::createImmutable($projectRoot);
$dotenv->load();

echo "✅ Loaded environment variables.\n";

// 6️⃣ Generate random keys for security
$appKey = 'base64:' . base64_encode(random_bytes(32));
$cookieSecret = bin2hex(random_bytes(32));
$sessionSecret = bin2hex(random_bytes(32));

// 7️⃣ Update .env file with generated keys
$envLines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$updatedEnv = [];

foreach ($envLines as $line) {
    if (str_starts_with($line, 'APP_KEY=')) {
        $updatedEnv[] = "APP_KEY={$appKey}";
    } elseif (str_starts_with($line, 'CURRENT_USER_SESSION_NAME=')) {
        $updatedEnv[] = "CURRENT_USER_SESSION_NAME={$cookieSecret}";
    } elseif (str_starts_with($line, 'REMEMBER_ME_COOKIE_NAME=')) {
        $updatedEnv[] = "REMEMBER_ME_COOKIE_NAME={$sessionSecret}";
    } else {
        $updatedEnv[] = $line;
    }
}

// 8️⃣ Write the updated content back to .env
file_put_contents($envFile, implode("\n", $updatedEnv) . "\n");

chmod($envFile, 0777);

echo "🔑 Successfully updated .env with generated keys.\n";

// 9️⃣ Final instructions
echo "\n✅ Setup complete!\n";
echo "➡️ Run: git add .\n";
echo "➡️ Run: git commit -m \"Initial commit\"\n";
echo "➡️ Set git to origin: git remote add origin https://github.com/YOUR_GITHUB_USERNAME/YOUR_REPO_NAME.git\n";
echo "➡️ Run: git push -u origin main\n";
echo "➡️ Run: php console serve\n";
echo "🌍 Open your project at: http://localhost:8000\n";
exit(0);

