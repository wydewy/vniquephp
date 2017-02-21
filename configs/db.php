<?php
return [
    'class' => '\vnique\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=wydewy_db',
    'username' => 'wydewy_user',
    'password' => 'mariadb5.5_wydewy_user',
    'attributes' => [
        \PDO::ATTR_EMULATE_PREPARES => false,
        \PDO::ATTR_STRINGIFY_FETCHES => false,
    ],
];
