<?php

use Doctrine\DBAL\DriverManager;
use Jackalope\Tools\Console\Helper\DoctrineDbalHelper;
use Symfony\Component\Console\Helper\HelperSet;

$dbConn = DriverManager::getConnection(
    [
        'driver'    => 'pdo_mysql',
        'host'      => 'localhost',
        'user'      => 'root',
        'password'  => 'test',
        'dbname'    => 'try-db',
    ]
);

$helperSet = new HelperSet([
    'connection' => new DoctrineDbalHelper($dbConn)
]);
