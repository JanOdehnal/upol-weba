<?php
return [
    'host' => getenv('DB_HOST') ?: 'db-server',
    'dbname' => getenv('DB_NAME') ?: 'my_web',
    'user' => getenv('DB_USER') ?: 'root',
    'password' => getenv('DB_PASSWORD') ?: 'heslo',
    'charset' => 'utf8mb4'
];