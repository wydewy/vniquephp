<?php
return [
    'class' => '\vnique\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=vnique',
    'username' => 'wydewy',
    'password' => 'wydewy',
    'attributes' => [
        \PDO::ATTR_EMULATE_PREPARES => false,
        \PDO::ATTR_STRINGIFY_FETCHES => false,
    ],
];
