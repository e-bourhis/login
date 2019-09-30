<?php

if (file_exists(__DIR__ . '/db.sqlite')) {
    $db = new SQLite3(__DIR__ . '/db.sqlite', SQLITE3_OPEN_READONLY);

    $users = $db->query('SELECT "username","password","level" FROM "users"');

    echo "[ username , password_hash , level ] \n";
    while ($user = $users->fetchArray()) {
        echo "[ " . $user['username'] . " , " . $user['password'] . " , " . $user['level'] . " ] \n";
    };

    $db->close();
} else {
    echo "The database doesn't exist, create it using the setup.php script";
}
