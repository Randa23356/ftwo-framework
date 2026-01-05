<?php

echo "========================================\n";
echo " FTwoDev Framework Installer \n";
echo "========================================\n\n";

// 1. Check Directory Permissions
$directories = ['storage', 'storage/logs', 'public', 'config'];

foreach ($directories as $dir) {
    if (!file_exists($dir)) {
        mkdir($dir, 0755, true);
        echo "[+] Created: $dir\n";
    }
    
    // Attempt to set permissions (might fail on some hosts, that's regular)
    @chmod($dir, 0777); 
}

echo "[+] Directory structure verified.\n";

// 2. Generate App Key
$configFile = 'config/app.php';
if (file_exists($configFile)) {
    $content = file_get_contents($configFile);
    if (strpos($content, 'base64:GENERATE_YOUR_OWN_KEY_HERE') !== false) {
        $key = 'base64:' . base64_encode(random_bytes(32));
        $content = str_replace('base64:GENERATE_YOUR_OWN_KEY_HERE', $key, $content);
        file_put_contents($configFile, $content);
        echo "[+] Generated Application Key: $key\n";
    } else {
        echo "[i] Application Key already set.\n";
    }
} else {
    echo "[!] config/app.php not found. Skipping key generation.\n";
}

// 3. Final Message
echo "\n========================================\n";
echo " Framework berhasil di-install! \n";
echo "========================================\n";
echo "1. Run: composer dump-autoload\n";
echo "2. Run: php ftwo ignite\n";
