<?php

// Connect or Create the sqlite database
$db = new SQLite3(__DIR__ . '/db.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

// Create the users table
$db->query(
'CREATE TABLE IF NOT EXISTS "users" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "username" VARCHAR(50) UNIQUE NOT NULL,
    "password" VARCHAR(250) NOT NULL,
    "level" VARCHAR(50) NOT NULL
  )'
);

// Insert the users data
$db->query('INSERT INTO "users" ("username","password","level") VALUES ("ben","' . password_hash("benpass123", PASSWORD_DEFAULT) . '","user")');
$db->query('INSERT INTO "users" ("username","password","level") VALUES ("ed","' . password_hash("edpass123", PASSWORD_DEFAULT) . '","superadmin")');
$db->query('INSERT INTO "users" ("username","password","level") VALUES ("matt","' . password_hash("mattpass123", PASSWORD_DEFAULT) . '","admin")');
$db->query('INSERT INTO "users" ("username","password","level") VALUES ("simon","' . password_hash("simonpass123", PASSWORD_DEFAULT) . '","user")');
$db->query('INSERT INTO "users" ("username","password","level") VALUES ("geoff","' . password_hash("geoffpass123", PASSWORD_DEFAULT) . '","admin")');


$userCount = $db->querySingle('SELECT COUNT(DISTINCT "id") FROM "users"');
if ($userCount>0) {
    echo " The database contains " . $userCount . " users";
} else {
    echo " ERROR: The database is empty";
}

// Close the connection
$db->close();
