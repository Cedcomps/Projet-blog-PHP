<?php

// Doctrine (db)
$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'charset'  => 'utf8',
    'host'     => 'localhost',
    'port'     => '3306',
    'dbname'   => 'projet4',
    'user'     => 'projet4_user',
    'password' => 'secret',
);

// define log parameters
$app['monolog.level'] = 'WARNING';
