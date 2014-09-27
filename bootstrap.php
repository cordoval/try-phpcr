<?php

$autoload = require_once __DIR__.'/vendor/autoload.php';

$params = array(
    'driver'    => 'pdo_mysql',
    'host'      => 'localhost',
    'user'      => 'root',
    'password'  => 'test',
    'dbname'    => 'try-db',
);

$workspace = 'default';
$user = 'admin';
$pass = 'admin';

$dbConn = \Doctrine\DBAL\DriverManager::getConnection($params);
$parameters = array('jackalope.doctrine_dbal_connection' => $dbConn);
$repository = \Jackalope\RepositoryFactoryDoctrineDBAL::getRepository($parameters);
$credentials = new \PHPCR\SimpleCredentials(null, null);


$session = $repository->login($credentials, $workspace);

/* prepare the doctrine configuration */
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ODM\PHPCR\Mapping\Driver\AnnotationDriver;
use Doctrine\ODM\PHPCR\Configuration;
use Doctrine\ODM\PHPCR\DocumentManager;

AnnotationRegistry::registerLoader(array($autoload, 'loadClass'));

$reader = new AnnotationReader();
$driver = new AnnotationDriver($reader, array(
    // this is a list of all folders containing document classes
    'vendor/doctrine/phpcr-odm/lib/Doctrine/ODM/PHPCR/Document',
    'src/Demo',
));

$config = new Configuration();
$config->setMetadataDriverImpl($driver);

$documentManager = DocumentManager::create($session, $config);

return $autoload;
