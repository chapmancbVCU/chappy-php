<?php

echo "Setting up the project...\n";

// Install composer dependencies.
system('composer install');

// Remove .git directory
if (is_dir('.git')) {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        system('rmdir /s /q .git');
    } else {
        system('rm -rf .git');
    }
    echo "Git repository removed.\n";
}


// Create necessary directories
$directories = [
    'storage/app/private/profile_images',
];
foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
        echo "Created directory: $dir\n";
    }
}

// Set permissions (Linux/macOS only)
if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
    chmod('storage', 0777);
    chmod('logs', 777);
    echo "Set permissions for storage and bootstrap/cache.\n";
}

// Generate APP_KEY
$envFile = '.env';
if (!file_exists($envFile)) {
    copy('.env.example', $envFile);
    echo "Copied .env.example to .env\n";
}

// Generate random keys
$appKey = 'base64:' . base64_encode(random_bytes(32));
$cookieSecret = bin2hex(random_bytes(32));
$sessionSecret = bin2hex(random_bytes(32));

// Update .env file
$envContents = file_get_contents($envFile);
$envContents = preg_replace('/^APP_KEY=.*$/m', "APP_KEY={$appKey}", $envContents);
$envContents = preg_replace('/^CURRENT_USER_SESSION_NAME=.*$/m', "CURRENT_USER_SESSION_NAME={$cookieSecret}", $envContents);
$envContents = preg_replace('/^REMEMBER_ME_COOKIE_NAME=.*$/m', "REMEMBER_ME_COOKIE_NAME={$sessionSecret}", $envContents);

file_put_contents($envFile, $envContents);

echo "Generated APP_KEY: $appKey\n";
echo "Generated CURRENT_USER_SESSION_NAME: $cookieSecret\n";
echo "Generated REMEMBER_ME_COOKIE_NAME: $sessionSecret\n";

echo "Setup complete!\n";
echo "Run php console migrate and then php console serve.  Open project at localhost:8000\n";
