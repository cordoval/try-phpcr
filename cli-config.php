<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ODM\PHPCR\Configuration;
use Doctrine\ODM\PHPCR\DocumentManager;
use Doctrine\ODM\PHPCR\Mapping\Driver\YamlDriver;
use Doctrine\ODM\PHPCR\Tools\Console\Helper\DocumentManagerHelper;
use Jackalope\RepositoryFactoryDoctrineDBAL;
use PHPCR\SimpleCredentials;
use PHPCR\Util\Console\Helper\PhpcrConsoleDumperHelper;
use PHPCR\Util\Console\Helper\PhpcrHelper;
use Symfony\Component\Console\Helper\DialogHelper;
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

$repository = (new RepositoryFactoryDoctrineDBAL())
    ->getRepository(
        [
            'jackalope.doctrine_dbal_connection' => $dbConn
        ]
    )
;

$session = $repository->login(
    new SimpleCredentials($user = 'admin', $pass = 'admin'),
    $workspace = 'default'
);

$config = new Configuration();
$config->setMetadataDriverImpl(new YamlDriver(['src/Cordoval']));

$documentManager = new DocumentManager($session, $config);

$helperSet = new HelperSet(array(
    'dialog' => new DialogHelper(),
    'phpcr' => new PhpcrHelper($session),
    'phpcr_console_dumper' => new PhpcrConsoleDumperHelper(),
    'dm' => new DocumentManagerHelper(null, $documentManager),
));
