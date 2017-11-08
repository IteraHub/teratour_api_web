<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('teratour', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'dsn' => 'mysql:host=us-cdbr-iron-east-05.cleardb.net;port=3306;dbname=heroku_fecc38fe00a7499',
  'user' => 'b88bc98d545c7c',
  'password' => '062a2ce9',
  'settings' =>
  array (
    'charset' => 'utf8',
    'queries' =>
    array (
    ),
  ),
  'classname' => '\\Propel\\Runtime\\Connection\\ConnectionWrapper',
  'model_paths' =>
  array (
    0 => 'src',
    1 => 'vendor',
  ),
));
$manager->setName('teratour');
$serviceContainer->setConnectionManager('teratour', $manager);
$serviceContainer->setDefaultDatasource('teratour');